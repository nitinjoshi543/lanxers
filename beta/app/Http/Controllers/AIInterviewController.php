<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use App\Services\InterviewAIService;
use Exception;
use Smalot\PdfParser\Parser;
use App\Services\AtsAiService;
use Illuminate\Support\Facades\Http;

class AIInterviewController extends Controller
{
    protected InterviewAIService $interviewAI;

    public function __construct(InterviewAIService $interviewAI)
    {
        $this->interviewAI = $interviewAI;
    }

    public function resumeUpload()
    {
        return view('interview.resumeupload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:5120',
            'job_description' => 'required|string'
        ]);

        // Full file path
        $fullPath = moveDocumentToAws($request->file('resume'));

        // Extract PDF text
        $parser = new Parser();
        $pdf = $parser->parseFile($fullPath);
        $resumeText = $pdf->getText();

        try {

            $atsAiService = new AtsAiService();

            $result = $atsAiService->analyzeResume(
                $resumeText,
                $request->job_description
            );

            $response = Http::post('http://127.0.0.1:8000/generate-job-description', [
                'employer_input' => $request->job_description,
            ]);
        } catch (\Exception $e) {

            return back()->withErrors([
                'ai' => $e->getMessage()
            ]);
        }

        dd($response);

        return view('interview.resumeresult', [
            'resume_text' => $resumeText,
            'job_description' => $request->job_description,
            'ai_result' => $result
        ]);
    }

    public function show($id)
    {
        $interview = DB::table('ai_interviews')
            ->where('id', $id)
            ->first();

        if (!$interview) {
            abort(404);
        }

        // Security: Only the assigned candidate can access
        if ($interview->candidate_id != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        return view('interview.index', compact('interview'));
    }

    public function start($id)
    {
        DB::transaction(function () use ($id) {
            // Get interview
            $interview = DB::table('ai_interviews')
                ->where('id', $id)
                ->lockForUpdate()
                ->first();

            if (!$interview) {
                abort(404);
            }

            // Only assigned candidate can access
            if ($interview->candidate_id != auth()->id()) {
                abort(403);
            }

            if ($interview->status == 'started') {

                return redirect()->route('ai.interview.question', [
                    'id' => $id,
                    'question' => max(1, $interview->current_question)
                ]);
            }

            if ($interview->status == 'completed') {
                return redirect()->route('ai.interview.result', $id);
            }

            // Generate questions only once
            $questionCount = DB::table('ai_interview_questions')
                ->where('interview_id', $id)
                ->count();

            if ($questionCount == 0) {

                if ($interview->interview_type == 'job') {

                    $job = DB::table('jobs')
                        ->where('id', $interview->job_id)
                        ->first();

                    if (!$job) {
                        abort(404, 'Job not found.');
                    }

                    $jobSkills = DB::table('job_skills as js')
                        ->join('skills as s', 's.id', '=', 'js.skill_id')
                        ->where('js.project_job_id', $interview->job_id)
                        ->select('s.name')
                        ->get();

                    if ($jobSkills->isEmpty()) {
                        throw new Exception('No skills configured for this job.');
                    }

                    $questions = $this->interviewAI->generateJobQuestions($job, $jobSkills);
                } else {

                    $profile = DB::table('freelancer_profiles')
                        ->where('user_id', $interview->candidate_id)
                        ->first();

                    if (!$profile) {
                        abort(404, 'Profile not found.');
                    }

                    $skills = DB::table('user_skills as us')
                        ->join('skills as s', 's.id', '=', 'us.skill_id')
                        ->where('us.user_id', $interview->candidate_id)
                        ->select(
                            's.name',
                            'us.experience',
                            'us.proficiency'
                        )
                        ->get();

                    if ($skills->isEmpty()) {
                        throw new Exception('Candidate has no skills.');
                    }

                    $questions = $this->interviewAI->generateProfileQuestions($profile, $skills);
                }

                DB::transaction(function () use ($questions, $id) {

                    foreach ($questions['questions'] as $index => $row) {

                        DB::table('ai_interview_questions')->insert([
                            'interview_id'   => $id,
                            'question'       => $row['question'],
                            'expected_skill' => $row['expected_skill'],
                            'question_order' => $index + 1,
                            'created_at'     => now(),
                            'updated_at'     => now(),
                        ]);
                    }
                });
            }

            $token = Str::random(64);

            DB::table('ai_interviews')
                ->where('id', $id)
                ->update([
                    'status' => 'started',
                    'started_at' => now(),
                    'current_question' => 1,
                    'session_token' => hash('sha256', $token),
                    'last_activity' => now()
                ]);

            Cookie::queue(
                'ai_interview_' . $id,
                $token,
                180,     // minutes
                '/',
                null,
                true,    // https only
                true,    // httpOnly
                false,
                'Strict'
            );

            return redirect()->route('ai.interview.question', [
                'id' => $id,
                'question' => 1
            ]);
        });
    }

    public function question($id, $question)
    {
        $interview = DB::table('ai_interviews')
            ->where('id', $id)
            ->first();

        if (!$interview) {
            abort(404);
        }

        if ($interview->status == "completed") {
            abort(403);
        }

        if ($interview->candidate_id != auth()->id()) {
            abort(403);
        }

        $currentQuestion = max(1, (int)$interview->current_question);

        if ((int)$question !== $currentQuestion) {
            return redirect()->route('ai.interview.question', [
                'id' => $id,
                'question' => $currentQuestion
            ]);
        }

        $questionData = DB::table('ai_interview_questions')
            ->where('interview_id', $id)
            ->where('question_order', $question)
            ->first();

        if (!$questionData) {
            return redirect()->route('ai.interview.finish', $id);
        }

        $token = Cookie::get('ai_interview_' . $id);

        if (!$token) {
            abort(403, 'Interview token missing.');
        }

        return view('interview.question', [
            'interview'       => $interview,
            'question'        => $questionData,
            'currentQuestion' => $question,
            'token' => $token
        ]);
    }

    public function saveAnswer(Request $request)
    {
        $request->validate([
            'interview_id' => 'required',
            'question_id'  => 'required',
            'question_order' => 'required',
            'answer' => 'required'
        ]);

        $interview = DB::table('ai_interviews')
            ->where('id', $request->interview_id)
            ->first();

        $cookieToken = Cookie::get(
            'ai_interview_' . $request->interview_id
        );

        if (!$cookieToken) {
            abort(403);
        }

        if (
            hash('sha256', $cookieToken)
            !=
            $interview->session_token
        ) {
            abort(403);
        }

        if ((int)$request->question_order !== (int)$interview->current_question) {
            abort(403, 'Invalid question.');
        }

        DB::table('ai_interview_answers')->updateOrInsert(

            [
                'interview_question_id' => $request->question_id
            ],

            [
                'candidate_answer' => $request->answer,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        $total = DB::table('ai_interviews')
            ->where('id', $request->interview_id)
            ->value('total_questions');

        if ($request->question_order < $total) {

            DB::table('ai_interviews')
                ->where('id', $request->interview_id)
                ->update([
                    'current_question' => $request->question_order + 1,
                    'last_activity' => now()
                ]);
        } else {

            DB::table('ai_interviews')
                ->where('id', $request->interview_id)
                ->update([
                    'current_question' => $total,
                    'last_activity' => now()
                ]);
        }

        if ($request->question_order >= $total) {

            return redirect()->route(
                'ai.interview.finish',
                $request->interview_id
            );
        }

        return redirect()->route('ai.interview.question', [

            'id' => $request->interview_id,

            'question' => $request->question_order + 1

        ]);
    }

    public function finish($id)
    {
        $interview = DB::table('ai_interviews')
            ->where('id', $id)
            ->first();

        if (!$interview) {
            abort(404);
        }

        if ($interview->candidate_id != auth()->id()) {
            abort(403);
        }

        if ($interview->status == 'completed') {
            return redirect()->route('ai.interview.result', $id);
        }

        $cookieToken = Cookie::get('ai_interview_' . $id);

        if (!$cookieToken || hash('sha256', $cookieToken) !== $interview->session_token) {
            abort(403, 'Invalid interview session.');
        }

        DB::table('ai_interviews')
            ->where('id', $id)
            ->update([
                'status' => 'completed',
                'completed_at' => now(),
                'last_activity' => now()
            ]);

        DB::table('ai_interview_logs')->insert([
            'interview_id' => $id,
            'type' => 'INTERVIEW_COMPLETED',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->evaluateAndSaveInterview($id);

        Cookie::queue(Cookie::forget('ai_interview_' . $id));

        return redirect()->route(
            'ai.interview.result',
            $id
        );
    }

    private function evaluateAndSaveInterview($interviewId)
    {
        $interview = DB::table('ai_interviews')
            ->where('id', $interviewId)
            ->first();

        if (!$interview) {
            throw new \Exception('Interview not found.');
        }

        $questionsAnswers = DB::table('ai_interview_questions as q')
            ->leftJoin('ai_interview_answers as a', function ($join) use ($interviewId) {

                $join->on('q.id', '=', 'a.question_id')
                    ->where('a.interview_id', '=', $interviewId);
            })
            ->where('q.interview_id', $interviewId)
            ->orderBy('q.question_order')
            ->select(
                'q.question',
                'q.expected_skill',
                'a.answer'
            )
            ->get()
            ->map(function ($row) {

                return [
                    'question' => $row->question,
                    'answer' => $row->answer ?? '',
                    'expected_skill' => $row->expected_skill,
                ];
            })
            ->toArray();

        // Ask AI
        $result = $this->interviewAI->evaluateInterview($questionsAnswers);

        // Save interview evaluation
        DB::table('ai_interviews')
            ->where('id', $interviewId)
            ->update([

                'overall_score'      => $result['overall_score'] ?? null,
                'overall_rating'     => $result['overall_rating'] ?? null,

                'communication_score' => $result['communication'] ?? null,
                'technical_score'    => $result['technical'] ?? null,
                'problem_solving_score' => $result['problem_solving'] ?? null,
                'confidence_score'   => $result['confidence'] ?? null,
                'professionalism_score' => $result['professionalism'] ?? null,

                'recommendation'     => $result['recommendation'] ?? null,

                'ai_level'           => $result['level'] ?? null,
                'ai_feedback'        => $result['feedback'] ?? null,

                'strengths'          => isset($result['strengths'])
                    ? json_encode($result['strengths'])
                    : null,

                'weaknesses'         => isset($result['weaknesses'])
                    ? json_encode($result['weaknesses'])
                    : null,

                'updated_at'         => now(),

            ]);

        // Update freelancer profile (only for profile interviews)
        if ($interview->interview_type == 'profile') {

            DB::table('freelancer_profiles')
                ->where('user_id', $interview->candidate_id)
                ->update([

                    'ai_rating'       => $result['overall_score'] ?? null,
                    'ai_level'        => $result['level'] ?? null,
                    'ai_interview_at' => now(),
                    'latest_ai_interview_id' => $interviewId,
                    'updated_at'      => now(),
                ]);
        }
    }

    public function result($id)
    {
        $interview = DB::table('ai_interviews')
            ->where('id', $id)
            ->first();

        if ($interview->candidate_id != auth()->id()) {
            abort(403);
        }

        if ($interview->status != 'completed') {
            abort(403);
        }

        return view(
            'interview.result',
            compact('interview')
        );
    }

    public function autoSave(Request $request)
    {
        $request->validate([
            'interview_id' => 'required|integer',
            'question_id' => 'required|integer',
            'answer' => 'nullable|string',
        ]);

        $interview = DB::table('ai_interviews')
            ->where('id', $request->interview_id)
            ->first();

        if (!$interview) {
            return response()->json([
                'status' => false,
                'message' => 'Interview not found.'
            ], 404);
        }

        if ($interview->candidate_id != auth()->id()) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized.'
            ], 403);
        }

        if ($interview->status == 'completed') {
            return response()->json([
                'status' => false,
                'message' => 'Interview already completed.'
            ], 403);
        }

        if (!$interview->js_initialized) {
            return response()->json([
                'status' => false,
                'message' => 'JavaScript not initialized.'
            ], 403);
        }

        $cookieToken = Cookie::get(
            'ai_interview_' . $request->interview_id
        );

        if (
            hash('sha256', $cookieToken)
            !=
            $interview->session_token
        ) {
            return response()->json([
                'status' => false
            ], 403);
        }

        DB::table('ai_interview_answers')->updateOrInsert(
            [
                'interview_question_id' => $request->question_id
            ],
            [
                'candidate_answer' => $request->answer,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        DB::table('ai_interviews')
            ->where('id', $request->interview_id)
            ->update([
                'last_activity' => now()
            ]);

        return response()->json([
            'status' => true
        ]);
    }

    public function logViolation(Request $request)
    {
        $request->validate([
            'interview_id' => 'required|integer',
            'type' => 'required|string',
            'remarks' => 'nullable|string'
        ]);

        $interview = DB::table('ai_interviews')
            ->where('id', $request->interview_id)
            ->first();

        if (!$interview) {
            return response()->json(['status' => false], 404);
        }

        if ($interview->candidate_id != auth()->id()) {
            return response()->json(['status' => false], 403);
        }

        if ($interview->status == 'completed') {
            return response()->json(['status' => false], 403);
        }

        $cookieToken = Cookie::get('ai_interview_' . $request->interview_id);

        if (!$cookieToken || hash('sha256', $cookieToken) !== $interview->session_token) {
            return response()->json(['status' => false], 403);
        }

        DB::table('ai_interview_logs')->insert([

            'interview_id' => $request->interview_id,

            'type' => $request->type,

            'remarks' => $request->remarks,

            'ip' => $request->ip(),

            'user_agent' => $request->userAgent(),

            'created_at' => now(),

            'updated_at' => now()

        ]);

        return response()->json([
            'status' => true
        ]);
    }

    public function initialize(Request $request)
    {
        $request->validate([
            'interview_id' => 'required',
        ]);

        $interview = DB::table('ai_interviews')
            ->where('id', $request->interview_id)
            ->first();

        if (!$interview) {
            return response()->json([
                'status' => false
            ], 404);
        }

        if ($interview->candidate_id != auth()->id()) {
            return response()->json([
                'status' => false
            ], 403);
        }

        if ($interview->status == 'completed') {
            return response()->json([
                'status' => false
            ], 403);
        }

        $cookieToken = Cookie::get('ai_interview_' . $request->interview_id);

        if (!$cookieToken) {
            return response()->json([
                'status' => false,
                'message' => 'Interview token missing.'
            ], 403);
        }

        if (hash('sha256', $cookieToken) !== $interview->session_token) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid interview token.'
            ], 403);
        }

        DB::table('ai_interviews')
            ->where('id', $request->interview_id)
            ->update([
                'js_initialized' => 1,
                'last_activity' => now()
            ]);

        return response()->json([
            'status' => true
        ]);
    }
}
