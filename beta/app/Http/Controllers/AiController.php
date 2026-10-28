<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ConversationUpdated;
use App\Events\NotificationUpdated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
            'conversation_id' => 'nullable|integer',
        ]);

        $message = $request->message;
        $conversationId = $request->conversation_id;

        $conversation = DB::table('conversations')
            ->where('id', $conversationId)
            ->first();

        if (!$conversation) {
            return response()->json([
                'success' => false,
                'message' => 'Conversation not found.',
            ], 404);
        }

        $aiSessionId = $conversation->ai_session_id ?? null;
        $isNewAISession = false;

        if (!$aiSessionId) {

            $sessionResponse = Http::asJson()
                ->withHeaders([
                    'X-API-KEY' => 'lanxersai-prod-key-2024',
                    'Accept' => 'application/json',
                ])
                ->post('https://lanxersai-rfmbuohqtq-el.a.run.app/api/v1/session/new');


            if ($sessionResponse->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unable to create AI session.',
                    'error' => $sessionResponse->body(),
                ], $sessionResponse->status());
            }

            $sessionData = $sessionResponse->json();

            $aiSessionId = $sessionData['session_id'] ?? null;

            if (!$aiSessionId) {

                return response()->json([
                    'success' => false,
                    'message' => 'AI session ID was not returned.',
                    'data' => $sessionData,
                ], 422);
            }

            DB::table('conversations')
                ->where('id', $conversationId)
                ->update([
                    'ai_session_id' => $aiSessionId,
                ]);

            $isNewAISession = true;
        }

        $freelancerId = $conversation->freelancer_id;

        $oldMessages = DB::table('messages')
            ->where('conversation_id', $conversationId)
            ->whereNotNull('message')
            ->where('message', '!=', '')
            ->orderBy('created_at', 'asc')
            ->get([
                'sender_id',
                'message',
            ]);

        $history = '';

        foreach ($oldMessages as $oldMessage) {

            $text = trim($oldMessage->message);

            if ($text === '') {
                continue;
            }

            $sender = ((int) $oldMessage->sender_id === (int) $freelancerId)
                ? 'Freelancer'
                : 'Client';

            $history .= $sender . ': ' . $text . "\n";
        }

        $aiMessage = <<<PROMPT
            PREVIOUS CONVERSATION:
            {$history}

            NEW MESSAGE:
            {$message}
            PROMPT;

        $response = Http::asJson()
            ->withHeaders([
                'X-API-KEY' => 'lanxersai-prod-key-2024',
                'Accept' => 'application/json',
            ])
            ->post('https://lanxersai-rfmbuohqtq-el.a.run.app/api/v1/chat/main', [
                'session_id' => $aiSessionId,
                'include_sub_agent' => false,
                'message' => $aiMessage,
            ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate.',
                'error' => $response->body(),
            ], $response->status());
        }

        $aiResponse = $response->json();

        $aiResponseMessage = $aiResponse['main_agent']['message'] ?? null;

        if (!$aiResponseMessage) {
            return response()->json([
                'success' => false,
                'message' => 'AI did not return a valid response.',
                'data' => $aiResponse,
                'ai_message_sent' => $aiMessage,
            ], 422);
        }

        return response()->json([
            'success' => true,

            // AI generated response
            'message' => $aiResponseMessage,

            // EXACT message sent to AI
            'ai_message_sent' => $aiMessage,

            'session_id' => $aiResponse['session_id'] ?? $aiSessionId,
            'turn_number' => $aiResponse['turn_number'] ?? null,

            'win_score' =>
            $aiResponse['main_agent']['win_score'] ?? null,

            'win_label' =>
            $aiResponse['main_agent']['win_label'] ?? null,

            'win_color' =>
            $aiResponse['main_agent']['win_color'] ?? null,

            'strategy' =>
            $aiResponse['main_agent']['strategy'] ?? null,

            'next_action' =>
            $aiResponse['main_agent']['next_action'] ?? null,
        ]);
    }

    public function suggestion(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'conversation_id' => 'required|integer',
        ]);

        $type = $request->type;
        $conversationId = $request->conversation_id;

        $messages = DB::table('messages')
            ->where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($messages->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No conversation messages found.',
            ], 422);
        }

        $conversationText = $messages->map(function ($message) {
            return $message->message;
        })->implode("\n");

        $baseUrl = 'https://lanxersai-rfmbuohqtq-el.a.run.app';

        switch ($type) {

            case 'budget':
                $apiUrl = $baseUrl . '/api/v1/chat/budget';
                break;

            case 'requirements':
                $apiUrl = $baseUrl . '/api/v1/chat/requirement';
                break;

            case 'timeanddeadlines':
                $apiUrl = $baseUrl . '/api/v1/chat/timeline';
                break;

            case 'milestones':
                $apiUrl = $baseUrl . '/api/v1/chat/milestone';
                break;

            case 'revisions':
                return response()->json([
                    'success' => false,
                    'message' => 'Revision suggestion API is not configured yet.',
                ], 422);

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid suggestion type.',
                ], 422);
        }

        $response = Http::asJson()
            ->withHeaders([
                'X-API-KEY' => 'lanxersai-prod-key-2024',
                'Accept' => 'application/json',
            ])
            ->post($apiUrl, [
                'message' => $conversationText,
            ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate suggestions.',
                'error'   => $response->body(),
            ], $response->status());
        }

        $aiResponse = $response->json();

        $options = $aiResponse['agent']['options'] ?? [];

        $suggestions = collect($options)
            ->sortBy('option_number')
            ->map(function ($option) {
                return [
                    'text' => $option['text'] ?? '',
                    'is_best' => $option['is_best'] ?? false,
                    'option_number' => $option['option_number'] ?? null,
                ];
            })
            ->values()
            ->toArray();

        return response()->json([
            'success' => true,
            'type' => $type,
            'agent_label' => $aiResponse['agent']['agent_label'] ?? null,
            'best_reason' => $aiResponse['agent']['best_reason'] ?? null,
            'confidence_score' => $aiResponse['agent']['confidence_score'] ?? null,
            'suggestions' => $suggestions,
        ]);
    }

    public function generateWriting(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
            'conversation_id' => 'nullable|integer',
        ]);

        $message = $request->message;
        $conversationId = $request->conversation_id;

        $response = Http::asJson()
            ->withHeaders([
                'X-API-KEY' => 'lanxersai-prod-key-2024',
                'Accept' => 'application/json',
            ])
            ->post('https://lanxersai-rfmbuohqtq-el.a.run.app/api/v1/chat/pitch', [
                'message' => $message,
            ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate.',
                'error'   => $response->body(),
            ], $response->status());
        }

        return response()->json($response->json());

        $professional = "I will send you the design as soon as possible.";

        $otherOptions = [
            "I will share the design with you once it is ready.",
            "I’ll send the completed design to you as soon as possible.",
        ];


        return response()->json([
            'success' => true,

            'professional' => $professional,

            'other_options' => $otherOptions,
        ]);
    }

    public function chatSummaryDetail(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer',
            'topic' => 'required|string|max:100',
        ]);

        $conversationId = $request->conversation_id;
        $topic = $request->topic;

        $messages = DB::table('messages')
            ->where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($messages->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No messages found for this conversation.'
            ]);
        }

        $responses = [

            'initial_budget_proposal' =>
            'The initial budget proposal was discussed during the conversation. The parties reviewed the expected project cost and the proposed budget for completing the required work.',

            'inclusion_in_budget' =>
            'The conversation included a discussion about what should be covered within the proposed budget, including the expected project scope and deliverables.',

            'client_query_price' =>
            'The client asked about the project pricing and wanted clarification regarding the total cost and how the proposed amount relates to the project requirements.',

            'final_budget_confirmation' =>
            'The final budget was discussed to confirm the agreed project cost and ensure that both parties had clarity regarding the expected payment amount.',

        ];

        $content = $responses[$topic] ??
            'This topic was discussed in the conversation. More details can be provided once the AI analysis is enabled.';

        return response()->json([
            'success' => true,
            'content' => $content,
        ]);
    }


    public function chatSummary(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer',
        ]);

        $conversationId = $request->conversation_id;

        $messages = DB::table('messages')
            ->where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($messages->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No messages found for this conversation.'
            ]);
        }

        $overview = 'This conversation contains a discussion between the participants regarding the project requirements, budget, deliverables and other project-related details. The participants have exchanged information to clarify the project scope and expectations.';

        $keyPoints = [

            [
                'title' => 'Initial Budget Proposal',
                'topic' => 'initial_budget_proposal',
                'description' => 'The initial project budget was discussed.'
            ],

            [
                'title' => 'Inclusion in the Budget',
                'topic' => 'inclusion_in_budget',
                'description' => 'The participants discussed what should be included within the proposed budget.'
            ],

            [
                'title' => 'Client Query Price',
                'topic' => 'client_query_price',
                'description' => 'The client requested clarification regarding the project price.'
            ],

            [
                'title' => 'Final Budget Confirmation',
                'topic' => 'final_budget_confirmation',
                'description' => 'The final project budget was discussed for confirmation.'
            ],

        ];

        return response()->json([
            'success' => true,
            'overview' => $overview,
            'key_points' => $keyPoints,
        ]);
    }
}
