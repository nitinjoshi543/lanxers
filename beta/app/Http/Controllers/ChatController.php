<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ConversationUpdated;
use App\Events\NotificationUpdated;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function sendHireRequest(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
        ]);

        $conversation = DB::table('conversations')
            ->where('id', $request->conversation_id)
            ->first();

        if (!$conversation) {
            return response()->json([
                'status' => false,
                'message' => 'Conversation not found.'
            ]);
        }

        // Only employer can send request
        if (auth()->id() != $conversation->employer_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized.'
            ], 403);
        }

        // Already requested
        if ($conversation->hire_status != 'none') {
            return response()->json([
                'status' => false,
                'message' => 'Hire request already sent.'
            ]);
        }

        DB::table('conversations')
            ->where('id', $conversation->id)
            ->update([
                'hire_status' => 'requested',
                'hire_requested_at' => now(),
                'updated_at' => now()
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Hire request sent successfully.'
        ]);
    }

    public function acceptProject(Request $request)
    {
        $conversation = DB::table('conversations')
            ->where('id', $request->conversation_id)
            ->first();

        if (!$conversation) {
            return response()->json([
                'status' => false,
                'message' => 'Conversation not found.'
            ]);
        }

        // Only freelancer can accept
        if (auth()->id() != $conversation->freelancer_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized.'
            ]);
        }

        // Must be requested first
        if ($conversation->hire_status != 'requested') {
            return response()->json([
                'status' => false,
                'message' => 'No hire request found.'
            ]);
        }

        DB::beginTransaction();

        try {
            DB::table('conversations')
                ->where('id', $request->conversation_id)
                ->update([
                    'hire_status' => 'accepted',
                    'hire_accepted_at' => now(),
                    'updated_at' => now(),
                ]);

            // Assign freelancer to project
            DB::table('project_jobs')
                ->where('id', $conversation->project_job_id)
                ->update([
                    'assigned_freelancer_id' => $conversation->freelancer_id,
                    'status' => 'assigned',
                    'updated_at' => now(),
                ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Project accepted successfully.'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function getConversations()
    {
        $userId = auth()->id();

        return DB::table('conversations')
            ->leftJoin('project_jobs', 'project_jobs.id', '=', 'conversations.project_job_id')
            ->join('users as employer', 'employer.id', '=', 'conversations.employer_id')
            ->join('users as freelancer', 'freelancer.id', '=', 'conversations.freelancer_id')
            ->leftJoin('messages', function ($join) {
                $join->on('messages.conversation_id', '=', 'conversations.id')
                    ->whereRaw("
                    messages.id = (
                        SELECT MAX(id)
                        FROM messages
                        WHERE conversation_id = conversations.id
                    )
                ");
            })
            ->where(function ($q) use ($userId) {
                $q->where('conversations.employer_id', $userId)
                    ->orWhere('conversations.freelancer_id', $userId);
            })
            ->select(
                'conversations.*',
                'project_jobs.title',
                'employer.name as employer_name',
                'freelancer.name as freelancer_name',
                'freelancer.profile_photo as freelancer_profile_photo',
                'employer.profile_photo as employer_profile_photo',
                'messages.message as last_message',
                'messages.created_at as message_time',
                DB::raw("
                (
                    SELECT COUNT(*)
                    FROM messages m
                    WHERE
                        m.conversation_id = conversations.id
                        AND m.sender_id <> {$userId}
                        AND NOT EXISTS (
                            SELECT 1
                            FROM message_reads mr
                            WHERE mr.message_id = m.id
                            AND mr.user_id = {$userId}
                        )
                ) as unread_count
            ")
            )
            ->orderByDesc('conversations.last_message_at')
            ->get();
    }

    public function index()
    {
        $conversations = $this->getConversations();

        $selectedConversation = session()->pull('open_conversation');

        return view('chat.index', compact('conversations', 'selectedConversation'));
    }

    public function createConversation(Request $request)
    {
        $request->validate([
            'proposal_id'    => 'nullable|integer|exists:proposals,id',
            'project_job_id' => 'nullable|integer|exists:project_jobs,id',
            'freelancer_id'  => 'required_without_all:proposal_id,project_job_id|integer|exists:users,id',
        ]);

        DB::beginTransaction();

        try {

            if ($request->filled('proposal_id')) {

                $proposal = DB::table('proposals')
                    ->where('id', $request->proposal_id)
                    ->first();

                if (!$proposal) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Proposal not found.'
                    ], 404);
                }

                $job = DB::table('project_jobs')
                    ->where('id', $proposal->project_job_id)
                    ->first();

                if (!$job) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Job not found.'
                    ], 404);
                }

                // Security
                if (
                    auth()->id() != $job->employer_id &&
                    auth()->id() != $proposal->freelancer_id
                ) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Unauthorized.'
                    ], 403);
                }

                // if ($proposal->status == 'pending') {

                //     if (auth()->id() != $job->employer_id) {
                //         return response()->json([
                //             'status' => false,
                //             'message' => 'Only employer can start conversation.'
                //         ], 403);
                //     }

                //     DB::table('proposals')
                //         ->where('id', $proposal->id)
                //         ->update([
                //             'status' => 'shortlisted',
                //             'updated_at' => now()
                //         ]);

                //     $proposal->status = 'shortlisted';
                // }

                // if (!in_array($proposal->status, ['shortlisted', 'accepted'])) {
                //     return response()->json([
                //         'status' => false,
                //         'message' => 'Conversation cannot be started.'
                //     ], 422);
                // }

                $projectJobId = $proposal->project_job_id;
                $proposalId   = $proposal->id;
                $employerId   = $job->employer_id;
                $freelancerId = $proposal->freelancer_id;
            } elseif ($request->filled('project_job_id')) {

                $job = DB::table('project_jobs')
                    ->where('id', $request->project_job_id)
                    ->first();

                if (!$job) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Job not found.'
                    ], 404);
                }

                $projectJobId = $job->id;
                $proposalId   = null;
                $employerId   = $job->employer_id;
                $freelancerId = auth()->id();

                // Employer cannot start this flow
                if ($freelancerId == $employerId) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Employer cannot create direct conversation.'
                    ], 403);
                }
            } else {
                $projectJobId = null;
                $proposalId   = null;

                $employerId   = auth()->id();
                $freelancerId = $request->freelancer_id;

                if ($employerId == $freelancerId) {
                    return response()->json([
                        'status' => false,
                        'message' => 'You cannot chat with yourself.'
                    ], 422);
                }
            }

            $conversation = DB::table('conversations')
                ->where('project_job_id', $projectJobId)
                ->where('employer_id', $employerId)
                ->where('freelancer_id', $freelancerId)
                ->first();

            if ($conversation) {
                DB::commit();

                session(['open_conversation' => $conversation->id]);

                return response()->json([
                    'status' => true,
                    'conversation_id' => $conversation->id,
                    'redirect' => route('chat.index')
                ]);
            }

            $conversationId = DB::table('conversations')->insertGetId([
                'project_job_id'  => $projectJobId,
                'proposal_id'     => $proposalId,
                'employer_id'     => $employerId,
                'freelancer_id'   => $freelancerId,
                'last_message_at' => now(),
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);

            DB::commit();

            session(['open_conversation' => $conversationId]);

            return response()->json([
                'status' => true,
                'conversation_id' => $conversationId,
                'redirect' => route('chat.index')
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($conversationId)
    {
        $conversation = DB::table('conversations')
            ->leftJoin('project_jobs', 'project_jobs.id', '=', 'conversations.project_job_id')
            ->join('users as employer', 'employer.id', '=', 'conversations.employer_id')
            ->join('users as freelancer', 'freelancer.id', '=', 'conversations.freelancer_id')
            ->leftJoin('categories', 'categories.id', '=', 'project_jobs.category_id')
            ->select(
                'conversations.*',
                'project_jobs.id as project_id',
                'project_jobs.title',
                'project_jobs.description',
                'project_jobs.slug',
                'employer.name as employer_name',
                'freelancer.name as freelancer_name',
                'freelancer.profile_photo as freelancer_profile_photo',
                'employer.profile_photo as employer_profile_photo',
                'categories.name as category_name'
            )
            ->where('conversations.id', $conversationId)
            ->first();

        if (!$conversation) {
            abort(404);
        }

        if (
            auth()->id() != $conversation->employer_id &&
            auth()->id() != $conversation->freelancer_id
        ) {
            abort(403);
        }

        if ($conversation->project_job_id) {
            $conversation->skill_list = DB::table('job_skills')
                ->join('skills', 'skills.id', '=', 'job_skills.skill_id')
                ->where('job_skills.project_job_id', $conversation->project_job_id)
                ->pluck('skills.name');
        } else {
            $conversation->skill_list = collect();
        }

        return view('chat.chat-wrapper', compact('conversation'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer',
            'message' => 'required|string|max:5000',
            'reply_message_id' => 'nullable|integer'
        ]);

        DB::beginTransaction();

        try {

            $conversation = DB::table('conversations')
                ->where('id', $request->conversation_id)
                ->first();

            if (!$conversation) {

                return response()->json([
                    'status' => false,
                    'message' => 'Conversation not found.'
                ]);
            }

            if (
                auth()->id() != $conversation->employer_id &&
                auth()->id() != $conversation->freelancer_id
            ) {

                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized.'
                ], 403);
            }

            $messageId = DB::table('messages')->insertGetId([
                'conversation_id' => $conversation->id,
                'sender_id' => auth()->id(),
                'message' => trim($request->message),
                'message_type' => 'text',
                'reply_message_id' => $request->reply_message_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('conversations')
                ->where('id', $conversation->id)
                ->update([
                    'last_message_at' => now(),
                    'updated_at' => now()
                ]);

            // Get inserted message
            $message = DB::table('messages')
                ->join('users', 'users.id', '=', 'messages.sender_id')
                ->leftJoin(
                    'message_attachments',
                    'message_attachments.message_id',
                    '=',
                    'messages.id'
                )

                ->select(
                    'messages.*',
                    'users.name',
                    'users.profile_photo',
                    'message_attachments.file_name',
                    'message_attachments.original_name',
                    'message_attachments.file_type',
                    'message_attachments.file_size'
                )
                ->where('messages.id', $messageId)
                ->first();

            DB::commit();

            // Chat window
            broadcast(new MessageSent(
                $conversation->id,
                $message
            ))->toOthers();

            // Update conversation list
            broadcast(new ConversationUpdated(
                $conversation->id,
                $conversation->employer_id,
                $conversation->freelancer_id
            ));

            // Notify receiver
            $receiverId = auth()->id() == $conversation->employer_id
                ? $conversation->freelancer_id
                : $conversation->employer_id;

            $unreadCount = $this->getUnreadCountForUser($receiverId);

            broadcast(new NotificationUpdated(
                $receiverId,
                $unreadCount
            ));

            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function getUnreadCountForUser($userId)
    {
        return DB::table('messages')
            ->leftJoin('message_reads', function ($join) use ($userId) {
                $join->on('message_reads.message_id', '=', 'messages.id')
                    ->where('message_reads.user_id', $userId);
            })
            ->join('conversations', 'conversations.id', '=', 'messages.conversation_id')
            ->where(function ($q) use ($userId) {
                $q->where('conversations.employer_id', $userId)
                    ->orWhere('conversations.freelancer_id', $userId);
            })
            ->where('messages.sender_id', '!=', $userId)
            ->whereNull('message_reads.id')
            ->count();
    }

    public function loadMessages($conversationId)
    {
        $conversation = DB::table('conversations')
            ->leftJoin('project_jobs', 'project_jobs.id', '=', 'conversations.project_job_id')
            ->join('users as employer', 'employer.id', '=', 'conversations.employer_id')
            ->join('users as freelancer', 'freelancer.id', '=', 'conversations.freelancer_id')
            ->leftJoin('categories', 'categories.id', '=', 'project_jobs.category_id')
            ->select(
                'conversations.*',

                'project_jobs.title',
                'project_jobs.budget_min',
                'project_jobs.budget_max',
                'project_jobs.duration',

                'employer.name as employer_name',
                'freelancer.name as freelancer_name',

                'categories.name as category_name',
            )
            ->where('conversations.id', $conversationId)
            ->first();

        if (!$conversation) {
            abort(404);
        }

        if (
            auth()->id() != $conversation->employer_id &&
            auth()->id() != $conversation->freelancer_id
        ) {
            abort(403);
        }
        
        if ($conversation->project_job_id) {
            $conversation->skill_list = DB::table('job_skills')
                ->join('skills', 'skills.id', '=', 'job_skills.skill_id')
                ->where('job_skills.project_job_id', $conversation->project_job_id)
                ->pluck('skills.name');
        } else {
            $conversation->skill_list = collect();
        }

        $messages = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.sender_id')
            ->leftJoin(
                'message_attachments',
                'message_attachments.message_id',
                '=',
                'messages.id'
            )

            ->select(
                'messages.*',
                'users.name',
                'users.profile_photo',
                'message_attachments.file_name',
                'message_attachments.original_name',
                'message_attachments.file_type',
                'message_attachments.file_size'
            )
            ->where('messages.conversation_id', $conversationId)
            ->orderBy('messages.id')
            ->get();

        $this->markConversationReadInternal($conversationId);

        $proposal = null;

        if (!empty($conversation->proposal_id)) {

            $proposal = DB::table('proposals as p')
                ->join('users as u', 'u.id', '=', 'p.freelancer_id')
                ->leftJoin('freelancer_profiles as fp', 'fp.user_id', '=', 'u.id')
                ->where('p.id', $conversation->proposal_id)
                ->select(
                    'p.id',
                    'p.bid_amount',
                    'p.cover_letter',
                    'p.status',
                    'p.created_at',

                    'u.id as freelancer_id',
                    'u.name as freelancer_name',
                    'u.profile_photo',
                    'fp.job_title',
                )
                ->first();

            if ($proposal) {
                $proposal->attachments = DB::table('proposal_attachments')
                    ->where('proposal_id', $proposal->id)
                    ->select(
                        'file_name',
                        'file_path',
                        'file_type',
                        'file_size'
                    )
                    ->get();
            }
        }

        return response()->json([
            'status' => true,
            'messages' => $messages,
            'proposal' => $proposal,

            'has_proposal' => !is_null($proposal),
            'proposal_html' => $proposal
                ? view('chat.proposal', compact('proposal', 'conversation'))->render()
                : '',

            // 'show_accept_project' =>
            // auth()->id() == $conversation->freelancer_id &&
            //     $conversation->hire_status == 'requested',

            // 'show_hire_box' =>
            // auth()->id() == $conversation->employer_id &&
            //     $messages->count() >= 10 &&
            //     $conversation->hire_status == 'none',

            // 'show_waiting_box' =>
            // auth()->id() == $conversation->employer_id &&
            //     $conversation->hire_status == 'requested',

            // 'accept_project_html' =>
            // view('chat.accept-project', compact('conversation'))->render(),

            // 'hire_box_html' =>
            // view('chat.hire-box', compact('conversation'))->render(),

            // 'waiting_box_html' =>
            // view('chat.waiting-hire', compact('conversation'))->render(),
        ]);
    }

    private function markConversationReadInternal($conversationId)
    {
        $conversation = DB::table('conversations')
            ->where('id', $conversationId)
            ->first();

        if (!$conversation) {
            return;
        }

        $messages = DB::table('messages')
            ->where('conversation_id', $conversationId)
            ->where('sender_id', '!=', auth()->id())
            ->whereNotExists(function ($q) {

                $q->select(DB::raw(1))
                    ->from('message_reads')
                    ->whereColumn('message_reads.message_id', 'messages.id')
                    ->where('message_reads.user_id', auth()->id());
            })
            ->get();

        if ($messages->isEmpty()) {
            return;
        }

        $insert = [];

        foreach ($messages as $message) {
            $insert[] = [
                'message_id' => $message->id,
                'user_id' => auth()->id(),
                'read_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('message_reads')->insert($insert);
    }

    public function markConversationRead(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer'
        ]);

        $this->markConversationReadInternal($request->conversation_id);

        return response()->json([
            'status' => true
        ]);
    }

    public function uploadAttachment(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|integer',
            'file' => 'required|file|max:5120', // 20MB
        ]);

        DB::beginTransaction();

        try {

            $conversation = DB::table('conversations')
                ->where('id', $request->conversation_id)
                ->first();

            if (!$conversation) {
                return response()->json([
                    'status' => false,
                    'message' => 'Conversation not found.'
                ], 404);
            }

            if (
                auth()->id() != $conversation->employer_id &&
                auth()->id() != $conversation->freelancer_id
            ) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized.'
                ], 403);
            }

            if (!$request->hasFile('file')) {
                return response()->json([
                    'status' => false,
                    'message' => 'No file uploaded.'
                ], 400);
            }

            $file = $request->file('file');

            if (!$file->isValid()) {
                return response()->json([
                    'status' => false,
                    'message' => $file->getErrorMessage()
                ], 400);
            }

            $extension = strtolower($file->getClientOriginalExtension());

            $allowed = [
                'pdf',
                'doc',
                'docx',
                'xls',
                'xlsx',
                'jpg',
                'jpeg',
                'png',
                'gif',
                'zip',
                'rar',
                'mp4',
                'mp3'
            ];

            if (!in_array($extension, $allowed)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid file type.'
                ], 400);
            }

            // Store file information BEFORE moving
            $originalName = $file->getClientOriginalName();
            $fileType     = $file->getMimeType();
            $fileSize     = $file->getSize();

            $newName = 'chat/' . date('Y/m/') . uniqid() . '_' . time() . '.' . $extension;
            
            $awsFile = moveDocumentToAws($file, $newName);
            
            if (!$awsFile) {
                throw new \Exception('Unable to upload file to AWS.');
            }

            $destination = public_path('uploads/chat');

            if (!file_exists($destination)) {
                mkdir($destination, 0775, true);
            }

            // Move file ONLY ONCE
            $file->move($destination, $newName);

            $messageId = DB::table('messages')->insertGetId([
                'conversation_id' => $conversation->id,
                'sender_id'       => auth()->id(),
                'message'         => $request->message ?? '',
                'message_type'    => 'file',
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);

            DB::table('message_attachments')->insert([
                'message_id'    => $messageId,
                'original_name' => $originalName,
                'file_name'     => $awsFile,
                'file_type'     => $fileType,
                'file_size'     => $fileSize,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            DB::table('conversations')
                ->where('id', $conversation->id)
                ->update([
                    'last_message_at' => now(),
                    'updated_at'      => now()
                ]);

            DB::commit();

            // Fetch uploaded message with attachment
            $message = DB::table('messages')
                ->join('users', 'users.id', '=', 'messages.sender_id')
                ->leftJoin(
                    'message_attachments',
                    'message_attachments.message_id',
                    '=',
                    'messages.id'
                )
                ->select(
                    'messages.*',
                    'users.name',
                    'users.profile_photo',
                    'message_attachments.file_name',
                    'message_attachments.original_name',
                    'message_attachments.file_type',
                    'message_attachments.file_size'
                )
                ->where('messages.id', $messageId)
                ->first();
            
            // Broadcast to receiver chat window
            broadcast(new MessageSent(
                $conversation->id,
                $message
            ))->toOthers();
            
            // Update conversation list
            broadcast(new ConversationUpdated(
                $conversation->id,
                $conversation->employer_id,
                $conversation->freelancer_id
            ));
            
            // Update notification badge
            $receiverId = auth()->id() == $conversation->employer_id
                ? $conversation->freelancer_id
                : $conversation->employer_id;
            
            $unreadCount = $this->getUnreadCountForUser($receiverId);
            
            broadcast(new NotificationUpdated(
                $receiverId,
                $unreadCount
            ));
            
            return response()->json([
                'status'  => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => basename($e->getFile())
            ], 500);
        }
    }

    public function downloadAttachment($messageId)
    {
        $attachment = DB::table('message_attachments')
            ->join('messages', 'messages.id', '=', 'message_attachments.message_id')
            ->join('conversations', 'conversations.id', '=', 'messages.conversation_id')
            ->select(
                'message_attachments.*',
                'conversations.employer_id',
                'conversations.freelancer_id'
            )
            ->where('message_id', $messageId)
            ->first();

        if (!$attachment) {
            abort(404);
        }

        if (
            auth()->id() != $attachment->employer_id &&
            auth()->id() != $attachment->freelancer_id
        ) {
            abort(403);
        }

        $key = $attachment->file_name;
        
        if (filter_var($key, FILTER_VALIDATE_URL)) {
            $bucketUrl = 'https://idpdefault.s3.ap-south-1.amazonaws.com/';
    
            if (str_starts_with($key, $bucketUrl)) {
                $key = substr($key, strlen($bucketUrl));
            } else {
                $key = ltrim(parse_url($key, PHP_URL_PATH), '/');
            }
        }
        
        
        if (!Storage::disk('s3')->exists($key)) {
            abort(404, 'File not found.');
        }
    
        // Download the file
        return Storage::disk('s3')->download(
            $key,
            $attachment->original_name
        );

    }

    public function getUnreadCount()
    {
        $count = DB::table('messages')
            ->join(
                'conversations',
                'conversations.id',
                '=',
                'messages.conversation_id'
            )
            ->where(function ($q) {
                $q->where(
                    'conversations.employer_id',
                    auth()->id()
                )
                    ->orWhere(
                        'conversations.freelancer_id',
                        auth()->id()
                    );
            })
            ->where('messages.sender_id', '!=', auth()->id())
            ->whereNotExists(function ($q) {
                $q->select(DB::raw(1))
                    ->from('message_reads')
                    ->whereColumn(
                        'message_reads.message_id',
                        'messages.id'
                    )
                    ->where(
                        'message_reads.user_id',
                        auth()->id()
                    );
            })
            ->count();

        return response()->json([
            'status' => true,
            'count' => $count
        ]);
    }

    public function conversationList()
    {
        $conversations = $this->getConversations();

        return view('chat.conversation_list', compact('conversations'));
    }

    public function conversation($id)
    {
        $userId = auth()->id();

        $conversation = DB::table('conversations')
            ->join('project_jobs', 'project_jobs.id', '=', 'conversations.project_job_id')
            ->join('users as employer', 'employer.id', '=', 'conversations.employer_id')
            ->join('users as freelancer', 'freelancer.id', '=', 'conversations.freelancer_id')
            ->leftJoin('messages', function ($join) {
                $join->on('messages.conversation_id', '=', 'conversations.id')
                    ->whereRaw('messages.id = (
                    SELECT MAX(id)
                    FROM messages
                    WHERE conversation_id = conversations.id
                )');
            })
            ->select(
                'conversations.id',
                'messages.message',
                'messages.created_at',
                DB::raw("
                (
                    SELECT COUNT(*)
                    FROM messages m
                    WHERE
                        m.conversation_id = conversations.id
                        AND m.sender_id <> {$userId}
                        AND NOT EXISTS (
                            SELECT 1
                            FROM message_reads mr
                            WHERE mr.message_id = m.id
                            AND mr.user_id = {$userId}
                        )
                ) AS unread_count
            ")
            )
            ->where('conversations.id', $id)
            ->first();

        return response()->json($conversation);
    }
}
