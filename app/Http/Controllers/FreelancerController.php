<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserSession;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Validator;
use App\Events\NotificationCreated;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\JobListingController;
use Illuminate\Support\Facades\Log;

class FreelancerController extends Controller
{
    public function ajaxJobDetails($id)
    {
        $data = $this->jobDetail((int) $id);

        if (!$data || empty($data['job'])) {
            return response()->json([
                'status'  => false,
                'message' => 'Job not found.'
            ], 404);
        }

        $html = view('freelancer.partials_job_details', $data)->render();

        return response()->json([
            'status' => true,
            'html'   => $html
        ]);
    }

    private function jobDetail(int $id): ?array
    {
        $job = DB::table('project_jobs as pj')
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
            ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
            ->leftJoin('countries as co', 'co.id', '=', 'ep.country')
            ->leftJoin('states as st', 'st.id', '=', 'ep.state')
            ->select(
                'pj.*',
                'c.name as category_name',
                'u.id as company_id',
                'u.name as company_name',
                'u.email as company_email',
                'u.phone as company_phone',
                'u.profile_photo as image',
                'ep.employer_type',
                'ep.company_name as profile_company_name',
                'ep.about as about_employer',
                'co.name as employer_country',
                'st.name as employer_state'
            )
            ->where('pj.id', $id)
            ->first();

        if (!$job) {
            return null;
        }

        // Views tracking (session based, ek job ek baar hi count hogi)
        $viewedJobs = session()->get('viewed_jobs', []);
        if (!in_array($job->id, $viewedJobs)) {
            DB::table('project_jobs')->where('id', $job->id)->increment('views');
            $viewedJobs[] = $job->id;
            session()->put('viewed_jobs', $viewedJobs);
            $job->views += 1;
        }

        $job->posted_ago = Carbon::parse($job->created_at)->diffForHumans();

        $job->skills = DB::table('job_skills as js')
            ->join('skills as s', 's.id', '=', 'js.skill_id')
            ->where('js.project_job_id', $job->id)
            ->orderBy('s.name')
            ->pluck('s.name');

        $attachments = DB::table('job_attachments')
            ->where('project_job_id', $job->id)
            ->get();

        $alreadyApplied = auth()->check()
            ? DB::table('proposals')
                ->where('project_job_id', $job->id)
                ->where('freelancer_id', auth()->id())
                ->exists()
            : false;

        $isFavourited = auth()->check()
            ? DB::table('job_favourites')
                ->where('user_id', auth()->id())
                ->where('project_job_id', $job->id)
                ->exists()
            : false;

        $similarJobs = DB::table('project_jobs as pj')
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
            ->select(
                'pj.id', 'pj.title', 'pj.budget_min', 'pj.budget_max', 'pj.created_at',
                'c.name as category_name', 'u.name as employer_name', 'u.profile_photo'
            )
            ->where('pj.category_id', $job->category_id)
            ->where('pj.status', 'open')
            ->where('pj.id', '<>', $job->id)
            ->orderByDesc('pj.created_at')
            ->limit(5)
            ->get();

        return compact('job', 'attachments', 'alreadyApplied', 'isFavourited', 'similarJobs');
    }
    
    public function howItWorks()
    {
        return view('freelancer.how_it_works');
    }

    public function careerAdvise()
    {
        return view('freelancer.career_advise');
    }

    public function walletPage()
    {
        abort_if(auth()->user()->role !== 'freelancer', 403);

        $wallet = get_wallet(auth()->id());

        $transactions = DB::table('wallet_transactions as wt')
            ->leftJoin('contracts as c', 'c.id', '=', 'wt.contract_id')
            ->leftJoin('project_jobs as pj', 'pj.id', '=', 'c.project_job_id')
            ->leftJoin('users as u', 'u.id', '=', 'c.employer_id')
            ->select(
                'wt.*',
                'pj.title as project_title',
                'u.name as counterparty_name'
            )
            ->where('wt.user_id', auth()->id())
            ->orderByDesc('wt.created_at')
            ->paginate(10);

        return view('freelancer.wallet', compact('wallet', 'transactions'));
    }

    public function companyProfileDetails($id)
    {
        $decoded = Hashids::decode($id);

        if (empty($decoded)) {
            abort(404);
        }

        $companyId = $decoded[0];

        $company = DB::table('users as u')
            ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
            ->leftJoin('countries as co', 'co.id', '=', 'ep.country')
            ->leftJoin('states as st', 'st.id', '=', 'ep.state')
            ->select(
                'u.id',
                'u.name',
                'u.email',
                'u.phone',
                'u.profile_photo',
                'u.created_at',
                'ep.employer_type',
                'ep.company_name',
                'ep.about',
                'ep.industry',
                'ep.company_size',
                'ep.website',
                'co.name as country_name',
                'st.name as state_name'
            )
            ->where('u.id', $companyId)
            ->first();

        if (!$company) {
            abort(404);
        }

        $recentJobs = DB::table('project_jobs as pj')
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->leftJoin('job_skills as js', 'js.project_job_id', '=', 'pj.id')
            ->leftJoin('skills as s', 's.id', '=', 'js.skill_id')
            ->select(
                'pj.*',
                'c.name as category_name',
                DB::raw('(SELECT COUNT(*) FROM proposals p WHERE p.project_job_id = pj.id) as total_proposals'),
                DB::raw("GROUP_CONCAT(DISTINCT s.name ORDER BY s.name SEPARATOR ', ') as skills")
            )
            ->where('pj.employer_id', $companyId)
            ->where('pj.status', 'open')
            ->groupBy(
                'pj.id',
                'pj.title',
                'pj.slug',
                'pj.description',
                'pj.category_id',
                'pj.employer_id',
                'pj.budget_min',
                'pj.budget_max',
                'pj.duration',
                'pj.status',
                'pj.views',
                'pj.total_proposals',
                'pj.assigned_freelancer_id',
                'pj.created_at',
                'pj.updated_at',
                'c.name'
            )
            ->orderByDesc('pj.created_at')
            ->limit(3)
            ->get();

        return view('freelancer.company_details', compact('company', 'recentJobs'));
    }

    private function uploadAndCompressImage($file)
    {
        if (!$file) {
            return null;
        }

        $path = public_path('uploads/profile/');

        // Create folder if it doesn't exist
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Move uploaded file
        $file->move($path, $filename);

        $imagePath = $path . $filename;

        // Get image dimensions
        $imageInfo = getimagesize($imagePath);

        if (!$imageInfo) {
            return null;
        }

        $width  = $imageInfo[0];
        $height = $imageInfo[1];

        // Compress image and upload (or save)
        return imageCompress($path, $filename, $height, $width);
    }

    public function jobApply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_id' => 'required|exists:project_jobs,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $job = DB::table('project_jobs')
            ->where('id', $request->job_id)
            ->first();
    
        if (!$job) {
            return response()->json([
                'status' => false,
                'message' => 'Job not found.'
            ], 404);
        }
    
        // Base validation
        $rules = [];
    
        // Only freelance jobs require proposal fields
        if ($job->job_type === 'freelance') {
            $rules = [
                'proposedAmount'     => 'required|numeric|min:1',
                'projectDescription' => 'required|string|max:3000',
                'proposalFiles.*'    => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            ];
        } else {
            $rules = [
                'proposedAmount'     => 'nullable|numeric|min:1',
                'projectDescription' => 'nullable|string|max:3000',
                'proposalFiles.*'    => 'nullable|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            ];
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        
        DB::beginTransaction();

        try {

            $user = DB::table('users')
                ->where('id', Auth::id())
                ->select('id', 'role', 'name', 'email')
                ->first();

            if (!$user || $user->role != 'freelancer') {
                return response()->json([
                    'status' => false,
                    'message' => 'Only Jobseekers can apply.'
                ], 403);
            }

            // $job = DB::table('project_jobs')
            //     ->where('id', $request->job_id)
            //     ->first();

            // if (!$job) {
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'Job not found.'
            //     ], 404);
            // }

            if ($job->employer_id == $user->id) {
                return response()->json([
                    'status' => false,
                    'message' => 'You cannot apply to your own job.'
                ], 403);
            }

            $alreadyApplied = DB::table('proposals')
                ->where('project_job_id', $request->job_id)
                ->where('freelancer_id', $user->id)
                ->exists();

            if ($alreadyApplied) {
                return response()->json([
                    'status' => false,
                    'message' => 'You have already applied.'
                ], 422);
            }

            // $proposalId = DB::table('proposals')->insertGetId([
            //     'project_job_id' => $request->job_id,
            //     'freelancer_id'  => $user->id,
            //     'cover_letter'   => $request->projectDescription,
            //     'bid_amount'     => $request->proposedAmount,
            //     // 'delivery_days'  => $request->delivery_days,
            //     'status'         => 'pending',
            //     'created_at'     => now(),
            //     'updated_at'     => now(),
            // ]);
            
            $proposalId = DB::table('proposals')->insertGetId([
                'project_job_id' => $request->job_id,
                'freelancer_id'  => $user->id,
                'cover_letter'   => $job->job_type === 'freelance'
                    ? $request->projectDescription
                    : null,
                'bid_amount'     => $job->job_type === 'freelance'
                    ? $request->proposedAmount
                    : null,
                'status'         => 'pending',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
            
            if ($job->job_type === 'freelance') {
                foreach ($request->file('proposalFiles', []) as $file) {
    
                    $extension = strtolower($file->getClientOriginalExtension());
    
                    $originalName = $file->getClientOriginalName();
                    $fileSize     = $file->getSize();
    
                    if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                        $filePath = $this->uploadAndCompressImage($file);
                    } else {
                        $filePath = moveDocumentToAws($file);
                    }
    
                    DB::table('proposal_attachments')->insert([
                        'proposal_id' => $proposalId,
                        'file_name'   => $originalName,
                        'file_path'   => $filePath,
                        'file_type'   => $extension,
                        'file_size'   => $fileSize,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }
            }
            
            DB::table('project_jobs')
                ->where('id', $request->job_id)
                ->increment('total_proposals');

            $conversation = DB::table('conversations')
                ->where('project_job_id', $request->job_id)
                ->where('freelancer_id', $user->id)
                ->where('employer_id', $job->employer_id)
                ->first();

            if (!$conversation) {

                DB::table('conversations')->insert([
                    'project_job_id' => $request->job_id,
                    'proposal_id'    => $proposalId,
                    'employer_id'    => $job->employer_id,
                    'freelancer_id'  => $user->id,
                    'status'         => 'active',
                    'hire_status'    => 'none',
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            } else {

                DB::table('conversations')
                    ->where('id', $conversation->id)
                    ->update([
                        'proposal_id' => $proposalId,
                        'updated_at' => now(),
                    ]);
            }

            sendNotification(
                $job->employer_id,
                'New Job Application',
                $user->name . ' applied for your job "' . $job->title . '".',
                'job',
                route('employer.job.detail.page', $job->slug),
                'fa-briefcase'
            );

            $profile = DB::table('freelancer_profiles')
                ->where('user_id', $user->id)
                ->first();

            $resumeText = "Proposal:\n";
            
            if ($job->job_type === 'freelance') {
                $resumeText .= ($request->projectDescription ?? '') . "\n\n";
            }

            if ($profile) {

                $resumeText .= "Candidate Name: {$user->name}\n";
                $resumeText .= "Job Title: {$profile->job_title}\n";
                $resumeText .= "Bio: {$profile->bio}\n";
                $resumeText .= "Experience: {$profile->total_experience} Years\n";
                $resumeText .= "Hourly Rate: {$profile->hourly_rate}\n";
                $resumeText .= "Languages: {$profile->languages}\n";
                $resumeText .= "Country: {$profile->country}\n";
                $resumeText .= "State: {$profile->state}\n";
                $resumeText .= "City: {$profile->city}\n";
                $resumeText .= "Website: {$profile->website}\n";
                $resumeText .= "LinkedIn: {$profile->linkedin}\n";
                $resumeText .= "GitHub: {$profile->github}\n";
                $resumeText .= "Portfolio: {$profile->portfolio}\n";
                $resumeText .= "Profile Level: {$profile->profile_level}\n\n";
            }


            $skills = DB::table('user_skills as us')
                ->join('skills as s', 's.id', '=', 'us.skill_id')
                ->where('us.user_id', $user->id)
                ->select(
                    's.name',
                    'us.experience',
                    'us.proficiency'
                )
                ->get();

            if ($skills->count()) {

                $resumeText .= "Skills:\n";

                foreach ($skills as $skill) {

                    $resumeText .= "- {$skill->name}";

                    if (!empty($skill->experience)) {
                        $resumeText .= " ({$skill->experience} Years";
                    }

                    if (!empty($skill->proficiency)) {
                        $resumeText .= ", {$skill->proficiency}";
                    }

                    if (!empty($skill->experience)) {
                        $resumeText .= ")";
                    }

                    $resumeText .= "\n";
                }

                $resumeText .= "\n";
            }

            $experiences = DB::table('user_experiences')
                ->where('user_id', $user->id)
                ->orderByDesc('start_date')
                ->get();

            if ($experiences->count()) {

                $resumeText .= "Work Experience:\n";

                foreach ($experiences as $exp) {

                    $resumeText .= "Position: {$exp->position}\n";
                    $resumeText .= "Employment Type: {$exp->employment_type}\n";
                    $resumeText .= "Start Date: {$exp->start_date}\n";
                    $resumeText .= "End Date: " . ($exp->end_date ?: 'Present') . "\n";
                    $resumeText .= "Description: {$exp->description}\n\n";
                }
            }

            if (!empty($profile->resume)) {

                try {
                    $parser = new Parser();
                    $pdf = $parser->parseFile($profile->resume);
                    $resumeContent = $pdf->getText();

                    if (!empty($resumeContent)) {

                        $resumeText .= "\nUploaded Resume:\n";
                        $resumeText .= $resumeContent;
                    }
                } catch (\Exception $e) {
                    Log::warning('Resume extraction failed : ' . $e->getMessage());
                }
            }

            $atsResponse = Http::asForm()
                ->withHeaders([
                    'X-API-KEY' => env('AI_API_KEY'),
                    'Accept'    => 'application/json',
                ])
                ->post(env('AI_API_URL') . '/ats-score', [
                    'job_description' => $job->description,
                    'resume_text'     => $resumeText,
                ]);

            // dd($atsResponse->status(), $atsResponse->json(), $atsResponse->body());

            if ($atsResponse->successful()) {

                $result = $atsResponse->json();

                if (($result['status'] ?? '') === 'success') {

                    $data = $result['data'];

                    DB::table('proposals')
                        ->where('id', $proposalId)
                        ->update([
                            'ats_score'  => $data['ats_score'] ?? 0,
                            'updated_at' => now(),
                        ]);
                }
            } else {

                Log::error('ATS API Error', [
                    'status' => $atsResponse->status(),
                    'body'   => $atsResponse->body(),
                ]);
            }

            DB::commit();

            $fields = ['email'];
            $employer = getUserDetails($job->employer_id, $fields);
            
            $employer_profiles = DB::table('employer_profiles')
                ->where('user_id', $job->employer_id)
                ->select('company_name')
                ->first();

            // $message = view('mails.notification', [
            //     'title'   => 'New Job Application',
            //     'message' => $user->name . ' applied for your job "' . $job->title . '".',
            //     'url'     => route('employer.job.detail.page', $job->slug),
            // ])->render();

            $subject = 'New application received for '. $job->title;
                
            $message = view('mails.notification', [
                'title'   => 'New Job Application',
                'user' => $user->name,
                'job' => $job->title,
                'url'     => route('employer.job.detail.page', $job->slug),
            ])->render();
                
            send_mail($employer->email, $subject, $message);
            
            $subject1 = 'Application submitted: '. $job->title;
                
            $message1 = view('mails.application_submitted', [
                'company_name' => $employer_profiles->company_name,
                'job' => $job->title,
                'url'     => route('jobseekers.job.detail.page', $job->slug),
            ])->render();
                
            send_mail($user->email, $subject1, $message1);

            // send_mail(
            //     $employer->email,
            //     'New Job Application',
            //     $message
            // );

            // $interviewId = DB::table('ai_interviews')->insertGetId([
            //     'job_id'           => $job->id,
            //     'proposal_id'      => $proposalId,
            //     'employer_id'      => $job->employer_id,
            //     'candidate_id'     => $user->id,
            //     'created_at'       => now(),
            //     'updated_at'       => now(),
            // ]);

            // $mailBody = view('mails.ai_interview_invitation', [
            //     'user_name'     => $user->name,
            //     'job_title'     => $job->title,
            //     'duration'      => 10,
            //     'questions'     => 10,
            //     'interview_url' => route('ai.interview', $interviewId),
            // ])->render();

            // send_mail(
            //     $user->email,
            //     'AI Interview Invitation',
            //     $mailBody
            // );

            return response()->json([
                'status' => true,
                'message' => 'Applied successfully.'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function jobDetailPage($slug)
    {

        $job = DB::table('project_jobs as pj')
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
            ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
            ->leftJoin('countries as co', 'co.id', '=', 'ep.country')   // 👈 country name
            ->leftJoin('states as st', 'st.id', '=', 'ep.state')        // 👈 state name
            ->leftJoin('job_skills as js', 'js.project_job_id', '=', 'pj.id')
            ->leftJoin('skills as s', 's.id', '=', 'js.skill_id')
            ->select(
                'pj.*',
                'c.name as category_name',
                'u.id as company_id',
                'u.name as company_name',
                'u.email as company_email',
                'u.phone as company_phone',
                'u.profile_photo as image',
                'ep.employer_type',
                'ep.company_name as profile_company_name',
                'ep.about as about_employer',
                'co.name as employer_country',   // 👈 country name
                'st.name as employer_state',     // 👈 state name
                DB::raw("GROUP_CONCAT(DISTINCT s.name ORDER BY s.name SEPARATOR ', ') as skills"),
                DB::raw("(SELECT COUNT(*) FROM job_attachments ja WHERE ja.project_job_id = pj.id) as attachment_count")
            )
            ->where('pj.slug', $slug)
            ->groupBy(
                'pj.id',
                'pj.title',
                'pj.slug',
                'pj.description',
                'pj.budget_min',
                'pj.budget_max',
                'pj.duration',
                'pj.status',
                'pj.views',
                'pj.total_proposals',
                'pj.created_at',
                'pj.assigned_freelancer_id',
                'c.name',
                'co.name',  
                'st.name'   
            )
            ->first();

        if (!$job) {
            abort(404);
        }


        $viewedJobs = session()->get('viewed_jobs', []);

        if (!in_array($job->id, $viewedJobs)) {
            DB::table('project_jobs')->where('id', $job->id)->increment('views');

            $viewedJobs[] = $job->id;
            session()->put('viewed_jobs', $viewedJobs);

            $job->views += 1;
        }

        $alreadyApplied = false;
        $proposal = null;

        if (auth()->check()) {
            $proposal = DB::table('proposals')
                ->where('project_job_id', $job->id)
                ->where('freelancer_id', Auth::id())
                ->first();
    
            $alreadyApplied = $proposal !== null;
        }
        
        // Total applicants for this job
        $totalApplicants = DB::table('proposals')
            ->where('project_job_id', $job->id)
            ->count();
    
        // Applications viewed by recruiters
        $applicationsViewed = DB::table('proposals')
            ->where('project_job_id', $job->id)
            ->whereNotNull('profile_viewed_at')
            ->count();


        $attachments = DB::table('job_attachments')
            ->where('project_job_id', $job->id)
            ->get();

        $similarJobs = DB::table('project_jobs as pj')
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
            ->select(
                'pj.id',
                'pj.title',
                'pj.slug',
                'pj.budget_min',
                'pj.budget_max',
                'pj.created_at',
                'c.name as category_name',
                'u.name as employer_name',
                'u.profile_photo'
            )
            ->where('pj.category_id', $job->category_id)
            ->where('pj.status', 'open')
            ->where('pj.id', '<>', $job->id)          // Exclude current job
            ->where('pj.slug', '<>', $job->slug)      // Extra safety
            ->orderByDesc('pj.created_at')
            ->limit(5)
            ->get();
         
        return view('freelancer.job_details', compact('job', 'attachments', 'similarJobs', 'alreadyApplied','proposal','totalApplicants','applicationsViewed'));
    }

    public function toggleFavourite(Request $request, $job)
    {
        $userId = auth()->id();

        $exists = DB::table('project_jobs')->where('id', $job)->exists();
        abort_if(!$exists, 404);

        $favourite = DB::table('job_favourites')
            ->where('user_id', $userId)
            ->where('project_job_id', $job)
            ->first();

        if ($favourite) {
            DB::table('job_favourites')->where('id', $favourite->id)->delete();
            $saved = false;
        } else {
            DB::table('job_favourites')->insert([
                'user_id'        => $userId,
                'project_job_id' => $job,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
            $saved = true;
        }

        return response()->json([
            'saved'   => $saved,
            'message' => $saved ? 'Job saved to your list' : 'Removed from saved jobs',
        ]);
    }

    public function userJobs(Request $request)
    {
        $query = DB::table('project_jobs as pj')
            ->join('proposals as p', function ($join) {
                $join->on('p.project_job_id', '=', 'pj.id')
                    ->where('p.freelancer_id', Auth::id());
            })
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
            ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'pj.employer_id')
            ->leftJoin('job_skills as js', 'js.project_job_id', '=', 'pj.id')
            ->leftJoin('skills as s', 's.id', '=', 'js.skill_id')
            ->select(
                'pj.*',
                'p.status as proposal_status',
                'p.ats_score as ats_score',
                'p.profile_viewed_at as profile_viewed_at',
                'p.cv_downloaded_at as cv_downloaded_at',
                'p.created_at as applied_at',
                'c.name as category_name',
                'u.id as company_id',
                DB::raw('COALESCE(NULLIF(ep.company_name, ""), u.name) as company_name'),
                'u.profile_photo as company_logo',
                DB::raw("GROUP_CONCAT(DISTINCT s.name ORDER BY s.name SEPARATOR ', ') as skills"),
                DB::raw("(SELECT COUNT(*) FROM job_attachments ja WHERE ja.project_job_id = pj.id) as attachment_count")
            )
            ->groupBy(
                'pj.id',
                'pj.title',
                'pj.description',
                'pj.budget_min',
                'pj.budget_max',
                'pj.duration',
                'pj.status',
                'pj.views',
                'pj.total_proposals',
                'pj.created_at',
                'pj.assigned_freelancer_id',
                'p.id',
                'c.name',
                'u.id',
                'u.name',
                'u.profile_photo',
                'ep.company_name'
            );

        $liveJobs = (clone $query)
            ->where('pj.status', 'open')
            ->orderByDesc('pj.created_at')
            ->paginate(2, ['*'], 'live_page');

        $ongoingJobs = (clone $query)
            ->where('pj.status', 'assigned')
            ->where('pj.assigned_freelancer_id', Auth::id())
            ->orderByDesc('pj.created_at')
            ->paginate(2, ['*'], 'ongoing_page');

        $previousJobs = (clone $query)
            ->where('pj.status', 'completed')
            ->where('pj.assigned_freelancer_id', Auth::id())
            ->orderByDesc('pj.created_at')
            ->paginate(2, ['*'], 'previous_page');

        return view('freelancer.user_jobs', compact(
            'liveJobs',
            'ongoingJobs',
            'previousJobs'
        ));
    }

    // public function findJobs(Request $request, $slug = null)
    // {
    //     $isFavourite = $slug === 'favourites';

    //     $activeCategory = null;

    //     if ($slug && !$isFavourite) {
    //         $activeCategory = DB::table('categories')
    //             ->where('slug', $slug)
    //             ->where('status', 1)
    //             ->first();

    //         abort_if(!$activeCategory, 404);
    //     }

    //     $jobs = DB::table('project_jobs')
    //         ->join('categories', 'project_jobs.category_id', '=', 'categories.id')
    //         ->join('users', 'project_jobs.employer_id', '=', 'users.id')
    //         ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'project_jobs.employer_id')
    //         ->select(
    //             'project_jobs.*',
    //             'categories.name as category_name',
    //             'categories.slug as category_slug',
    //             'users.profile_photo as profile_photo',
    //             DB::raw('COALESCE(NULLIF(ep.company_name, ""), users.name) as company_name')
    //         )
    //         ->where('project_jobs.status', 'open')
    //         ->when($isFavourite, function ($q) {
    //             $q->join('job_favourites as jf', function ($join) {
    //                 $join->on('jf.project_job_id', '=', 'project_jobs.id')
    //                     ->where('jf.user_id', auth()->id());
    //             });
    //         })

    //         ->when($activeCategory, fn($q) =>
    //         $q->where('project_jobs.category_id', $activeCategory->id))
    //         ->when(!$activeCategory && $request->filled('category'), fn($q) =>
    //         $q->whereIn('project_jobs.category_id', (array) $request->category))

    //         ->when($request->filled('keyword'), function ($q) use ($request) {
    //             $term = '%' . addcslashes($request->keyword, '%_\\') . '%';
    //             $q->where(function ($sub) use ($term) {
    //                 $sub->where('project_jobs.title', 'like', $term)
    //                     ->orWhere('project_jobs.description', 'like', $term);
    //             });
    //         })

    //         ->when($request->filled('company'), function ($q) use ($request) {
    //             $term = '%' . addcslashes($request->company, '%_\\') . '%';
    //             $q->where(function ($sub) use ($term) {
    //                 $sub->where('ep.company_name', 'like', $term)
    //                     ->orWhere('users.name', 'like', $term);
    //             });
    //         })

    //         ->when($request->filled('skills'), function ($q) use ($request) {
    //             $q->whereIn('project_jobs.id', function ($sub) use ($request) {
    //                 $sub->select('project_job_id')
    //                     ->from('job_skills')
    //                     ->whereIn('skill_id', (array) $request->skills);
    //             });
    //         })

    //         // -- Simple dropdowns --
    //         ->when($request->filled('budget_type'), fn($q) =>
    //         $q->where('project_jobs.budget_type', $request->budget_type))
    //         ->when($request->filled('experience_level'), fn($q) =>
    //         $q->where('project_jobs.experience_level', $request->experience_level))
    //         ->when($request->filled('location_type'), fn($q) =>
    //         $q->where('project_jobs.location_type', $request->location_type))

    //         // -- Budget: job ki range user ki range se overlap kare --
    //         ->when($request->min_budget > 0, fn($q) =>
    //         $q->where('project_jobs.budget_max', '>=', $request->min_budget))
    //         ->when($request->filled('max_budget') && $request->max_budget < 100000, fn($q) =>
    //         $q->where('project_jobs.budget_min', '<=', $request->max_budget))

    //         ->orderByDesc('project_jobs.created_at')
    //         ->paginate(10)
    //         ->withQueryString();

    //     /* ---------- Skills + favourites attach ---------- */
    //     $jobIds = $jobs->pluck('id')->all();

    //     $skillsByJob = empty($jobIds) ? collect() : DB::table('job_skills as js')
    //         ->join('skills as s', 's.id', '=', 'js.skill_id')
    //         ->whereIn('js.project_job_id', $jobIds)
    //         ->select('js.project_job_id', 's.id', 's.name')
    //         ->orderBy('s.name')
    //         ->get()
    //         ->groupBy('project_job_id');

    //     // user ne kaunsi jobs save kar rakhi hain
    //     $favouritedIds = (auth()->check() && !empty($jobIds))
    //         ? DB::table('job_favourites')
    //         ->where('user_id', auth()->id())
    //         ->whereIn('project_job_id', $jobIds)
    //         ->pluck('project_job_id')
    //         ->flip()          // [job_id => index] — isset() O(1)
    //         : collect();

    //     $jobs->getCollection()->transform(function ($job) use ($skillsByJob, $favouritedIds) {
    //         $job->skills        = $skillsByJob->get($job->id, collect());
    //         $job->is_favourited = $favouritedIds->has($job->id);
    //         $job->posted_ago    = Carbon::parse($job->created_at)
    //             ->timezone('Asia/Kolkata')
    //             ->diffForHumans();
    //         return $job;
    //     });

    //     if ($request->ajax()) {
    //         return view('freelancer.ajax_find_jobs', compact('jobs'))->render();
    //     }

    //     $categories = DB::table('categories as c')
    //         ->leftJoin('project_jobs as pj', function ($join) {
    //             $join->on('pj.category_id', '=', 'c.id')
    //                 ->where('pj.status', '=', 'open');
    //         })
    //         ->where('c.status', 1)
    //         ->select('c.id', 'c.name', 'c.slug', DB::raw('COUNT(pj.id) as jobs_count'))
    //         ->groupBy('c.id', 'c.name', 'c.slug')
    //         ->orderByDesc('jobs_count')
    //         ->get();

    //     $skills = DB::table('skills as s')
    //         ->leftJoin('job_skills as js', 'js.skill_id', '=', 's.id')
    //         ->leftJoin('project_jobs as pj', function ($join) {
    //             $join->on('pj.id', '=', 'js.project_job_id')
    //                 ->where('pj.status', '=', 'open');
    //         })
    //         ->where('s.status', 1)
    //         ->select('s.id', 's.name', DB::raw('COUNT(pj.id) as jobs_count'))
    //         ->groupBy('s.id', 's.name')
    //         ->orderByDesc('jobs_count')
    //         ->orderBy('s.name')
    //         ->get();

    //     return view('freelancer.find_jobs', compact('jobs', 'categories', 'activeCategory', 'skills'));
    // }

    public function findJobsBCK(Request $request, $slug = null)
    {
        $isFavourite = $slug === 'favourites';
        $activeCategory = null;

        if ($slug && !$isFavourite) {
            $activeCategory = DB::table('categories')
                ->where('slug', $slug)->where('status', 1)->first();
            abort_if(!$activeCategory, 404);
        }

        // category filter / favourites tab has no equivalent on external_jobs today
        // -> scope to native-only when either is active
        $scopeNativeOnly = $isFavourite || $activeCategory || $request->filled('category');

        /* ---------------- NATIVE (project_jobs) ---------------- */
        $native = DB::table('project_jobs')
            ->join('categories', 'project_jobs.category_id', '=', 'categories.id')
            ->join('users', 'project_jobs.employer_id', '=', 'users.id')
            ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'project_jobs.employer_id')
            ->select(
                'project_jobs.id',
                DB::raw("'native' as job_type"),
                DB::raw("NULL as source"),
                'project_jobs.title',
                'project_jobs.description',
                DB::raw('COALESCE(NULLIF(ep.company_name, ""), users.name) as company_name'),
                'users.profile_photo as company_logo',
                'project_jobs.location_type',
                'project_jobs.budget_type',
                'project_jobs.budget_min',
                'project_jobs.budget_max',
                'project_jobs.experience_level',
                'categories.slug as category_slug',
                'project_jobs.created_at as sort_date'
            )
            ->where('project_jobs.status', 'open')
            ->when($isFavourite, function ($q) {
                $q->join('job_favourites as jf', function ($join) {
                    $join->on('jf.project_job_id', '=', 'project_jobs.id')
                        ->where('jf.user_id', auth()->id());
                });
            })
            ->when($activeCategory, fn($q) => $q->where('project_jobs.category_id', $activeCategory->id))
            ->when(!$activeCategory && $request->filled('category'), fn($q) =>
                $q->whereIn('project_jobs.category_id', (array) $request->category))
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $term = '%' . addcslashes($request->keyword, '%_\\') . '%';
                $q->where(fn($sub) => $sub->where('project_jobs.title', 'like', $term)
                    ->orWhere('project_jobs.description', 'like', $term));
            })
            ->when($request->filled('company'), function ($q) use ($request) {
                $term = '%' . addcslashes($request->company, '%_\\') . '%';
                $q->where(fn($sub) => $sub->where('ep.company_name', 'like', $term)
                    ->orWhere('users.name', 'like', $term));
            })
            ->when($request->filled('skills'), function ($q) use ($request) {
                $q->whereIn('project_jobs.id', function ($sub) use ($request) {
                    $sub->select('project_job_id')->from('job_skills')
                        ->whereIn('skill_id', (array) $request->skills);
                });
            })
            ->when($request->filled('budget_type'), fn($q) => $q->where('project_jobs.budget_type', $request->budget_type))
            ->when($request->filled('experience_level'), fn($q) => $q->where('project_jobs.experience_level', $request->experience_level))
            ->when($request->filled('location_type'), fn($q) => $q->where('project_jobs.location_type', $request->location_type))
            ->when($request->min_budget > 0, fn($q) => $q->where('project_jobs.budget_max', '>=', $request->min_budget))
            ->when($request->filled('max_budget') && $request->max_budget < 100000, fn($q) =>
                $q->where('project_jobs.budget_min', '<=', $request->max_budget));

        $jobs = $native;

        /* ---------------- EXTERNAL (external_jobs) ---------------- */
        if (!$scopeNativeOnly) {
            $external = DB::table('external_jobs')
                ->select(
                    'external_jobs.id',
                    DB::raw("'external' as job_type"),
                    'external_jobs.source',
                    'external_jobs.title',
                    'external_jobs.description_text as description',
                    'external_jobs.organization as company_name',
                    'external_jobs.organization_logo as company_logo',
                    'external_jobs.ai_work_arrangement as location_type',
                    DB::raw('NULL as budget_type'),
                    DB::raw('NULL as budget_min'),
                    DB::raw('NULL as budget_max'),
                    'external_jobs.ai_experience_level as experience_level',
                    DB::raw('NULL as category_slug'),
                    DB::raw('COALESCE(external_jobs.date_posted, external_jobs.created_at) as sort_date')
                )
                ->where('external_jobs.is_active', 1)
                ->whereNull('external_jobs.deleted_at')
                ->when($request->filled('keyword'), function ($q) use ($request) {
                    $term = '%' . addcslashes($request->keyword, '%_\\') . '%';
                    $q->where(fn($sub) => $sub->where('external_jobs.title', 'like', $term)
                        ->orWhere('external_jobs.description_text', 'like', $term));
                })
                ->when($request->filled('company'), function ($q) use ($request) {
                    $term = '%' . addcslashes($request->company, '%_\\') . '%';
                    $q->where('external_jobs.organization', 'like', $term);
                })
                ->when($request->filled('skills'), function ($q) use ($request) {
                    // ai_key_skills is a JSON array of skill NAME strings.
                    // Resolve selected skill_ids -> names, then JSON_SEARCH (LIKE-based, case-insensitive) each.
                    $skillNames = DB::table('skills')
                        ->whereIn('id', (array) $request->skills)
                        ->pluck('name');

                    if ($skillNames->isNotEmpty()) {
                        $q->where(function ($sub) use ($skillNames) {
                            foreach ($skillNames as $name) {
                                $sub->orWhereRaw(
                                    "JSON_SEARCH(external_jobs.ai_key_skills, 'one', ?) IS NOT NULL",
                                    [$name]
                                );
                            }
                        });
                    }
                })
                ->when($request->filled('experience_level'), fn($q) =>
                    $q->where('external_jobs.ai_experience_level', $request->experience_level))
                ->when($request->filled('location_type'), fn($q) =>
                    $q->where('external_jobs.ai_work_arrangement', $request->location_type));
                // no budget filters — external_jobs.salary is unstructured varchar, skip

            $jobs = $native->unionAll($external);
        }

        $jobs = $jobs->orderByDesc('sort_date')->paginate(10)->withQueryString();

        /* ---------- Post-fetch enrichment (native only) ---------- */
        $nativeIds = $jobs->getCollection()->where('job_type', 'native')->pluck('id')->all();

        $skillsByJob = empty($nativeIds) ? collect() : DB::table('job_skills as js')
            ->join('skills as s', 's.id', '=', 'js.skill_id')
            ->whereIn('js.project_job_id', $nativeIds)
            ->select('js.project_job_id', 's.id', 's.name')
            ->orderBy('s.name')->get()->groupBy('project_job_id');

        $favouritedIds = (auth()->check() && !empty($nativeIds))
            ? DB::table('job_favourites')->where('user_id', auth()->id())
                ->whereIn('project_job_id', $nativeIds)->pluck('project_job_id')->flip()
            : collect();

        $jobs->getCollection()->transform(function ($job) use ($skillsByJob, $favouritedIds) {
            $job->skills = $job->job_type === 'native'
                ? $skillsByJob->get($job->id, collect())
                : collect(json_decode($job->ai_key_skills ?? '[]') ?? []); // won't exist post-union unless selected; add to SELECT if you want it rendered as chips

            $job->is_favourited = $job->job_type === 'native' && $favouritedIds->has($job->id);
            $job->posted_ago    = Carbon::parse($job->sort_date)->timezone('Asia/Kolkata')->diffForHumans();
            $job->job_url        = route('jobseekers.job.show', ['type' => $job->job_type, 'id' => $job->id]);

            return $job;
        });

        if ($request->ajax()) {
            return view('freelancer.ajax_find_jobs_bkk', compact('jobs'))->render();
        }

        $categories = DB::table('categories as c')
            ->leftJoin('project_jobs as pj', fn($j) => $j->on('pj.category_id', '=', 'c.id')->where('pj.status', '=', 'open'))
            ->where('c.status', 1)
            ->select('c.id', 'c.name', 'c.slug', DB::raw('COUNT(pj.id) as jobs_count'))
            ->groupBy('c.id', 'c.name', 'c.slug')->orderByDesc('jobs_count')->get();

        $skills = DB::table('skills as s')
            ->leftJoin('job_skills as js', 'js.skill_id', '=', 's.id')
            ->leftJoin('project_jobs as pj', fn($j) => $j->on('pj.id', '=', 'js.project_job_id')->where('pj.status', '=', 'open'))
            ->where('s.status', 1)
            ->select('s.id', 's.name', DB::raw('COUNT(pj.id) as jobs_count'))
            ->groupBy('s.id', 's.name')->orderByDesc('jobs_count')->orderBy('s.name')->get();

        return view('freelancer.find_jobs_bkk', compact('jobs', 'categories', 'activeCategory', 'skills'));
    }

    // public function findJobs(Request $request, $slug = null)
    // {
    //     $isFavourite = $slug === 'favourites';
    //     $activeCategory = null;

    //     if ($slug && !$isFavourite) {
    //         $activeCategory = DB::table('categories')
    //             ->where('slug', $slug)->where('status', 1)->first();
    //         abort_if(!$activeCategory, 404);
    //     }

    //     // TEMP: EXTERNAL JOBS — category filter/favourites has no equivalent on external_jobs
    //     // -> scope to native-only when either is active. Remove this line when external jobs sunset ho.
    //     $scopeNativeOnly = $isFavourite || $activeCategory || $request->filled('category');

    //     /* ---------------- NATIVE (project_jobs) — permanent ---------------- */
    //     $native = DB::table('project_jobs')
    //         ->leftJoin('categories', 'project_jobs.category_id', '=', 'categories.id')
    //         ->join('users', 'project_jobs.employer_id', '=', 'users.id')
    //         ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'project_jobs.employer_id')
    //         ->select(
    //             'project_jobs.id',
    //             // DB::raw("'native' as job_type"),
    //             DB::raw("NULL as source"),
    //             'project_jobs.title',
    //             'project_jobs.description',
    //             DB::raw('COALESCE(NULLIF(ep.company_name, ""), users.name) as company_name'),
    //             'users.profile_photo as company_logo',
    //             'project_jobs.location_type',
    //             'project_jobs.budget_type',
    //             'project_jobs.budget_min',
    //             'project_jobs.budget_max',
    //             'project_jobs.experience_level',
    //             'categories.slug as category_slug',
    //             'categories.name as category_name',
    //             'project_jobs.created_at as sort_date'
    //         )
    //         ->where('project_jobs.status', 'open')
    //         ->when($isFavourite, function ($q) {
    //             $q->join('job_favourites as jf', function ($join) {
    //                 $join->on('jf.project_job_id', '=', 'project_jobs.id')
    //                     ->where('jf.user_id', auth()->id());
    //             });
    //         })
    //         ->when($activeCategory, fn($q) => $q->where('project_jobs.category_id', $activeCategory->id))
    //         ->when(!$activeCategory && $request->filled('category'), fn($q) =>
    //             $q->whereIn('project_jobs.category_id', (array) $request->category))
    //         ->when($request->filled('keyword'), function ($q) use ($request) {
    //             $term = '%' . addcslashes($request->keyword, '%_\\') . '%';
    //             $q->where(fn($sub) => $sub->where('project_jobs.title', 'like', $term));
    //                 // ->orWhere('project_jobs.description', 'like', $term));
    //         })
    //         ->when($request->filled('company'), function ($q) use ($request) {
    //             $term = '%' . addcslashes($request->company, '%_\\') . '%';
    //             $q->where(fn($sub) => $sub->where('ep.company_name', 'like', $term)
    //                 ->orWhere('users.name', 'like', $term));
    //         })
    //         ->when($request->filled('skills'), function ($q) use ($request) {
    //             $q->whereIn('project_jobs.id', function ($sub) use ($request) {
    //                 $sub->select('project_job_id')->from('job_skills')
    //                     ->whereIn('skill_id', (array) $request->skills);
    //             });
    //         })
    //         ->when($request->filled('category_slug'), function ($q) use ($request) {
    //             $q->whereIn('project_jobs.id', function ($sub) use ($request) {
    //                 $sub->select('js.project_job_id')
    //                     ->from('job_skills as js')
    //                     ->join('skills as s', 's.id', '=', 'js.skill_id')
    //                     ->whereIn('s.name', array_map(
    //                         fn($value) => str_replace('-', ' ', $value),
    //                         (array) $request->category_slug
    //                     ));
    //             });
    //         })
    //         ->when($request->filled('budget_type'), fn($q) => $q->where('project_jobs.budget_type', $request->budget_type))
    //         ->when($request->filled('experience_level'), fn($q) => $q->where('project_jobs.experience_level', $request->experience_level))
    //         ->when($request->filled('location_type'), function ($q) use ($request) {
    //             $q->whereIn(
    //                 'project_jobs.location_type',
    //                 (array) $request->location_type
    //             );
    //         })
    //         ->when($request->filled('job_location'), function ($q) use ($request) {
    //             $q->whereIn(
    //                 'project_jobs.job_location',
    //                 (array) $request->job_location
    //             );
    //         })
    //         ->when($request->min_budget > 0, fn($q) => $q->where('project_jobs.budget_max', '>=', $request->min_budget))
    //         ->when($request->filled('max_budget') && $request->max_budget < 100000, fn($q) =>
    //             $q->where('project_jobs.budget_min', '<=', $request->max_budget));

    //     $jobs = $native;

    //     /* ============================================================
    //     * TEMP: EXTERNAL JOBS BLOCK — jab external_jobs sunset ho jaye
    //     * to ye poora block (yahan se neeche "END TEMP EXTERNAL BLOCK"
    //     * tak) delete kar dena, aur $scopeNativeOnly variable bhi hata dena.
    //     * ============================================================ */
    //     if (!$scopeNativeOnly) {
    //         $external = DB::table('external_jobs')
    //             ->select(
    //                 'external_jobs.id',
    //                 // DB::raw("'external' as job_type"),
    //                 'external_jobs.source',
    //                 'external_jobs.title',
    //                 'external_jobs.description_text as description',
    //                 'external_jobs.organization as company_name',
    //                 'external_jobs.organization_logo as company_logo',
    //                 'external_jobs.ai_work_arrangement as location_type',
    //                 DB::raw('NULL as budget_type'),
    //                 DB::raw('NULL as budget_min'),
    //                 DB::raw('NULL as budget_max'),
    //                 'external_jobs.ai_experience_level as experience_level',
    //                 DB::raw('NULL as category_slug'),
    //                 DB::raw('NULL as category_name'),
    //                 DB::raw('COALESCE(external_jobs.date_posted, external_jobs.created_at) as sort_date')
    //             )
    //             ->where('external_jobs.is_active', 1)
    //             ->whereNull('external_jobs.deleted_at')
    //             ->when($request->filled('keyword'), function ($q) use ($request) {
    //                 $term = '%' . addcslashes($request->keyword, '%_\\') . '%';
    //                 $q->where(fn($sub) => $sub->where('external_jobs.title', 'like', $term)
    //                     ->orWhere('external_jobs.description_text', 'like', $term));
    //             })
    //             ->when($request->filled('company'), function ($q) use ($request) {
    //                 $term = '%' . addcslashes($request->company, '%_\\') . '%';
    //                 $q->where('external_jobs.organization', 'like', $term);
    //             })
    //             ->when($request->filled('skills'), function ($q) use ($request) {
    //                 $skillNames = DB::table('skills')
    //                     ->whereIn('id', (array) $request->skills)
    //                     ->pluck('name');

    //                 if ($skillNames->isNotEmpty()) {
    //                     $q->where(function ($sub) use ($skillNames) {
    //                         foreach ($skillNames as $name) {
    //                             $sub->orWhereRaw(
    //                                 "JSON_SEARCH(external_jobs.ai_key_skills, 'one', ?) IS NOT NULL",
    //                                 [$name]
    //                             );
    //                         }
    //                     });
    //                 }
    //             })
    //             ->when($request->filled('experience_level'), fn($q) =>
    //                 $q->where('external_jobs.ai_experience_level', $request->experience_level))
    //             ->when($request->filled('location_type'), fn($q) =>
    //                 $q->where('external_jobs.ai_work_arrangement', $request->location_type));

    //         $jobs = $native->unionAll($external);
    //     }
    //     /* ============================================================
    //     * END TEMP EXTERNAL BLOCK
    //     * ============================================================ */

    //     $sortDir = $request->get('sort_dir', 'desc');
        
    //     if (!in_array($sortDir, ['asc', 'desc'])) {
    //         $sortDir = 'desc';
    //     }
        
    //     $jobs = $jobs
    //         ->orderBy('sort_date', $sortDir)
    //         ->paginate(10)
    //         ->withQueryString();

    //     /* ---------- Post-fetch enrichment (native only) — permanent ---------- */
    //     $nativeIds = $jobs->getCollection()->where('job_type', 'native')->pluck('id')->all();

    //     $skillsByJob = empty($nativeIds) ? collect() : DB::table('job_skills as js')
    //         ->join('skills as s', 's.id', '=', 'js.skill_id')
    //         ->whereIn('js.project_job_id', $nativeIds)
    //         ->select('js.project_job_id', 's.id', 's.name')
    //         ->orderBy('s.name')->get()->groupBy('project_job_id');

    //     $favouritedIds = (auth()->check() && !empty($nativeIds))
    //         ? DB::table('job_favourites')->where('user_id', auth()->id())
    //             ->whereIn('project_job_id', $nativeIds)->pluck('project_job_id')->flip()
    //         : collect();

    //     $jobs->getCollection()->transform(function ($job) use ($skillsByJob, $favouritedIds) {
    //         // TEMP: EXTERNAL JOBS — ternary ka "native" branch permanent hai, else branch hata dena
    //         $job->skills = $job->job_type === 'native'
    //             ? $skillsByJob->get($job->id, collect())
    //             : collect(json_decode($job->ai_key_skills ?? '[]') ?? []);

    //         $job->is_favourited = $job->job_type === 'native' && $favouritedIds->has($job->id);
    //         $job->posted_ago    = Carbon::parse($job->sort_date)->timezone('Asia/Kolkata')->diffForHumans();
    //         $job->job_url       = route('jobseekers.job.show', ['type' => $job->job_type, 'id' => $job->id]);

    //         return $job;
    //     });

    //     // AJAX -> sirf list ka HTML chunk return (filter/sort/pagination sab isi se chalte hain)
    //     if ($request->ajax()) {
    //         return view('freelancer.ajax_find_jobs', compact('jobs'))->render();
    //     }

    //     $categories = DB::table('categories as c')
    //         ->leftJoin('project_jobs as pj', fn($j) => $j->on('pj.category_id', '=', 'c.id')->where('pj.status', '=', 'open'))
    //         ->where('c.status', 1)
    //         ->select('c.id', 'c.name', 'c.slug', DB::raw('COUNT(pj.id) as jobs_count'))
    //         ->groupBy('c.id', 'c.name', 'c.slug')->orderByDesc('jobs_count')->get();

    //     $skills = DB::table('skills as s')
    //         ->leftJoin('job_skills as js', 'js.skill_id', '=', 's.id')
    //         ->leftJoin('project_jobs as pj', fn($j) => $j->on('pj.id', '=', 'js.project_job_id')->where('pj.status', '=', 'open'))
    //         ->where('s.status', 1)
    //         ->select('s.id', 's.name', DB::raw('COUNT(pj.id) as jobs_count'))
    //         ->groupBy('s.id', 's.name')->orderByDesc('jobs_count')->orderBy('s.name')->get();
            
    //     $jobLocations = DB::table('project_jobs')
    //         ->select(
    //             'job_location',
    //             DB::raw('COUNT(*) as jobs_count')
    //         )
    //         ->whereNotNull('job_location')
    //         ->where('job_location', '!=', '')
    //         ->where('status', 'open')
    //         ->groupBy('job_location')
    //         ->orderBy('job_location')
    //         ->get();
            
    //     $locationTypes = DB::table('project_jobs')
    //         ->select(
    //             'location_type',
    //             DB::raw('COUNT(*) as jobs_count')
    //         )
    //         ->whereNotNull('location_type')
    //         ->where('status', 'open')
    //         ->groupBy('location_type')
    //         ->orderBy('location_type')
    //         ->get();

    //     // Note: yahan koi "default detail" fetch NAHI kar rahe. Page load hote hi
    //     // JS khud pehli job ka /job/{type}/{id} AJAX call karega (see JS section).
    //     // Isse ye function sirf list-related kaam karta hai, koi cross-controller
    //     // dependency nahi banti.
    //     return view('freelancer.find_jobs', compact('jobs', 'categories', 'activeCategory', 'skills', 'jobLocations','locationTypes'));
    // }

    public function findJobs(Request $request, $slug = null)
    {
        $isFavourite = $slug === 'favourites';
        $activeSkill = null;

        /* ---------- Slug se skill dhundo ---------- */
        if ($slug && !$isFavourite) {
            $activeSkill = DB::table('skills')
                ->where('status', 1)
                ->where(function ($q) use ($slug) {
                    $q->where('slug', $slug)
                      // slug null wali purani rows ke liye fallback
                      ->orWhere('name', str_replace('-', ' ', $slug));
                })
                ->first();

            abort_if(!$activeSkill, 404);
        }

        /* ---------- Logged-in user ki skills ---------- */
        $userSkillIds = collect();

        if (auth()->check()) {
            $userSkillIds = DB::table('user_skills')
                ->where('user_id', auth()->id())
                ->pluck('skill_id');
        }

        /* ---------- Jobs query ---------- */
        $jobsQuery = DB::table('project_jobs')
            ->join('users', 'project_jobs.employer_id', '=', 'users.id')
            ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'project_jobs.employer_id')
            ->select(
                'project_jobs.id',
                'project_jobs.title',
                'project_jobs.description',
                DB::raw('COALESCE(NULLIF(ep.company_name, ""), users.name) as company_name'),
                'users.profile_photo as company_logo',
                'project_jobs.job_type',
                'project_jobs.location_type',
                'project_jobs.job_location',
                'project_jobs.budget_type',
                'project_jobs.budget_min',
                'project_jobs.budget_max',
                'project_jobs.experience_level',
                'project_jobs.created_at as sort_date'
            )
            ->where('project_jobs.status', 'open')

            // Favourites page
            ->when($isFavourite, function ($q) {
                $q->join('job_favourites as jf', function ($join) {
                    $join->on('jf.project_job_id', '=', 'project_jobs.id')
                        ->where('jf.user_id', auth()->id());
                });
            })

            // URL wali skill (/find-work/{slug})
            ->when($activeSkill, function ($q) use ($activeSkill) {
                $q->whereIn('project_jobs.id', function ($sub) use ($activeSkill) {
                    $sub->select('project_job_id')
                        ->from('job_skills')
                        ->where('skill_id', $activeSkill->id);
                });
            })

            ->when($request->filled('keyword'), function ($q) use ($request) {
                $term = '%' . addcslashes($request->keyword, '%_\\') . '%';
                $q->where('project_jobs.title', 'like', $term);
            })
            ->when($request->filled('company'), function ($q) use ($request) {
                $term = '%' . addcslashes($request->company, '%_\\') . '%';
                $q->where(fn($sub) => $sub->where('ep.company_name', 'like', $term)
                    ->orWhere('users.name', 'like', $term));
            })

            // Sidebar se multiple skills (skills[]=1&skills[]=5) -> OR logic
            ->when($request->filled('skills'), function ($q) use ($request) {
                $q->whereIn('project_jobs.id', function ($sub) use ($request) {
                    $sub->select('project_job_id')->from('job_skills')
                        ->whereIn('skill_id', (array) $request->skills);
                });
            })

            // Personalised: user ki apni skills wali jobs (sirf jab koi filter/slug na ho)
            ->when(
                auth()->check()
                    && $userSkillIds->isNotEmpty()
                    && !$isFavourite
                    && !$activeSkill
                    && !$request->boolean('reset')
                    && !$request->filled('skills')
                    && !$request->filled('category_slug')
                    && !$request->filled('keyword')
                    && !$request->filled('company')
                    && !$request->filled('budget_type')
                    && !$request->filled('experience_level')
                    && !$request->filled('location_type')
                    && !$request->filled('job_location')
                    && !$request->filled('min_budget')
                    && !$request->filled('max_budget'),
                function ($q) use ($userSkillIds) {
                    $q->whereIn('project_jobs.id', function ($sub) use ($userSkillIds) {
                        $sub->select('project_job_id')
                            ->from('job_skills')
                            ->whereIn('skill_id', $userSkillIds);
                    });
                }
            )

            // Purana category_slug param (skill name se match) - backward compatible
            ->when($request->filled('category_slug'), function ($q) use ($request) {
                $q->whereIn('project_jobs.id', function ($sub) use ($request) {
                    $sub->select('js.project_job_id')
                        ->from('job_skills as js')
                        ->join('skills as s', 's.id', '=', 'js.skill_id')
                        ->whereIn('s.name', array_map(
                            fn($value) => str_replace('-', ' ', $value),
                            (array) $request->category_slug
                        ));
                });
            })

            ->when($request->filled('budget_type'), fn($q) =>
                $q->where('project_jobs.budget_type', $request->budget_type))
            ->when($request->filled('experience_level'), fn($q) =>
                $q->where('project_jobs.experience_level', $request->experience_level))
            ->when($request->filled('location_type'), fn($q) =>
                $q->whereIn('project_jobs.location_type', (array) $request->location_type))
            ->when($request->filled('job_location'), fn($q) =>
                $q->whereIn('project_jobs.job_location', (array) $request->job_location))
            ->when($request->min_budget > 0, fn($q) =>
                $q->where('project_jobs.budget_max', '>=', $request->min_budget))
            ->when($request->filled('max_budget') && $request->max_budget < 100000, fn($q) =>
                $q->where('project_jobs.budget_min', '<=', $request->max_budget));

        $sortDir = $request->get('sort_dir', 'desc');
        if (!in_array($sortDir, ['asc', 'desc'])) {
            $sortDir = 'desc';
        }

        $jobs = $jobsQuery
            ->orderBy('project_jobs.created_at', $sortDir)
            ->paginate(10)
            ->withQueryString();

        /* ---------- Post-fetch enrichment ---------- */
        $jobIds = $jobs->getCollection()->pluck('id')->all();

        $skillsByJob = empty($jobIds) ? collect() : DB::table('job_skills as js')
            ->join('skills as s', 's.id', '=', 'js.skill_id')
            ->whereIn('js.project_job_id', $jobIds)
            ->select('js.project_job_id', 's.id', 's.name', 's.slug')
            ->orderBy('s.name')
            ->get()
            ->groupBy('project_job_id');

        $favouritedIds = (auth()->check() && !empty($jobIds))
            ? DB::table('job_favourites')
                ->where('user_id', auth()->id())
                ->whereIn('project_job_id', $jobIds)
                ->pluck('project_job_id')
                ->flip()
            : collect();

        $jobs->getCollection()->transform(function ($job) use ($skillsByJob, $favouritedIds) {
            $job->skills        = $skillsByJob->get($job->id, collect());
            $job->is_favourited = $favouritedIds->has($job->id);
            $job->posted_ago    = Carbon::parse($job->sort_date)->timezone('Asia/Kolkata')->diffForHumans();
            $job->job_url       = route('jobseekers.job.show', ['id' => $job->id]);

            return $job;
        });

        // AJAX -> sirf list ka HTML chunk
        if ($request->ajax()) {
            return view('freelancer.ajax_find_jobs', compact('jobs'))->render();
        }

        /* ---------- Sidebar data ---------- */
        $skills = DB::table('skills as s')
            ->leftJoin('job_skills as js', 'js.skill_id', '=', 's.id')
            ->leftJoin('project_jobs as pj', fn($j) =>
                $j->on('pj.id', '=', 'js.project_job_id')->where('pj.status', '=', 'open'))
            ->where('s.status', 1)
            ->select('s.id', 's.name', 's.slug', DB::raw('COUNT(pj.id) as jobs_count'))
            ->groupBy('s.id', 's.name', 's.slug')
            ->orderByDesc('jobs_count')
            ->orderBy('s.name')
            ->get();

        $jobLocations = DB::table('project_jobs')
            ->select('job_location', DB::raw('COUNT(*) as jobs_count'))
            ->whereNotNull('job_location')
            ->where('job_location', '!=', '')
            ->where('status', 'open')
            ->groupBy('job_location')
            ->orderBy('job_location')
            ->get();

        $locationTypes = DB::table('project_jobs')
            ->select('location_type', DB::raw('COUNT(*) as jobs_count'))
            ->whereNotNull('location_type')
            ->where('status', 'open')
            ->groupBy('location_type')
            ->orderBy('location_type')
            ->get();

        return view('freelancer.find_jobs', compact(
            'jobs', 'activeSkill', 'skills', 'jobLocations', 'locationTypes'
        ));
    }

    public function findJobsBK(Request $request, $slug = null)
    {
    return view('freelancer.find_jobs_bk');
    }

}
