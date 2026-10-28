<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\View;
use App\Models\Home_model;

class EmployerController extends Controller
{
    public function termsAndConditions()
    {
        return view('employer.terms_and_conditions');
    }

    public function userAgreement()
    {
        return view('employer.user_agreement');
    }

    public function privacyPolicy()
    {
        return view('employer.privacy_policy');
    }
    
    public function knowUs()
    {
        return view('employer.know_us');
    }

    public function contactUs()
    {
        return view('employer.contact_us');
    }

    public function contactUsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'regex:/^[A-Za-z\s]+$/'
            ],

            'email' => [
                'required',
                'email:rfc,dns',
                'max:150'
            ],

            'phone' => [
                'required',
                'digits_between:10,15',
                'regex:/^[0-9]+$/'
            ],

            'message' => [
                'required',
                'string',
                'min:20',
                'max:2000'
            ]
        ], [
            'name.regex' => 'Name should contain only letters.',
            'phone.regex' => 'Phone number should contain only digits.'
        ]);

        DB::table('contact_messages')->insert([
            'name'       => $validated['name'],
            'email'      => strtolower($validated['email']),
            'phone'      => $validated['phone'],
            'message'    => trim($validated['message']),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Your message has been sent successfully.');
    }
    
    public function ajaxJobDetails($id)
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
        
        $job->job_type = 'native';

        if (!$job) {
            return response()->json([
                'status' => false,
                'message' => 'Job not found.'
            ], 404);
        }
    
        $html = view('employer.partials_job_details', compact('job'))->render();
    
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }

    public function employerMainPage()
    {
        $fields = ['id', 'name', 'position', 'image', 'description'];
        $getTestimonial = Home_model::getTestimonials($fields);

        return view('employer.home', compact('getTestimonial'));
    }

    public function ourOfferings()
    {
        return view('employer.our_offerings');
    }

    public function howItWorks()
    {
        return view('employer.how_it_work');
    }

    public function talentSolutions()
    {
        return view('employer.career_solutions');
    }

    public function storeTransaction(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|string|max:100|unique:manual_transaction,transaction_id',
        ], [
            'transaction_id.required' => 'Transaction ID is required.',
            'transaction_id.unique'   => 'This Transaction ID is already submitted.',
        ]);

        $userId = Auth::id();
        $txnId  = trim($request->transaction_id);

        DB::table('manual_transaction')->insert([
            'user_id'        => $userId,
            'transaction_id' => $txnId,
            'status'         => 'pending',
            'created_at'     => now(),
        ]);

        // logged-in user ki details (name/email admin ko dikhane ke liye)
        $user = DB::table('users')->where('id', $userId)->first();

        $email       = 'ashwanidhillon77@gmail.com';
        $header_ref  = 'New Manual Transaction - Verification Pending';
        $message_ref = View::make('mails.transation_update', [
            'transaction_id' => $txnId,
            'name'           => $user->name  ?? 'N/A',
            'user_email'     => $user->email ?? 'N/A',
            'user_id'        => $userId,
            'submitted_at'   => now()->format('d M Y, h:i A'),
        ])->render();

        send_mail($email, $header_ref, $message_ref);

        return response()->json([
            'status'  => 'success',
            'message' => 'Transaction ID submitted successfully. Verification pending.',
        ]);
    }

    public function walletPage()
    {
        abort_if(auth()->user()->role !== 'employer', 403);

        $wallet = get_wallet(auth()->id());

        $transactions = DB::table('wallet_transactions')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('employer.wallet', compact('wallet', 'transactions'));
    }

    public function updateProposalStatus(Request $request, $proposal)
    {
        abort_if(auth()->user()->role !== 'employer', 403);

        $request->validate([
            'action' => 'required|in:accepted,rejected',
        ]);

        // proposal + ownership verify
        $row = DB::table('proposals as p')
            ->join('project_jobs as pj', 'pj.id', '=', 'p.project_job_id')
            ->where('p.id', $proposal)
            ->where('pj.employer_id', auth()->id())
            ->select(
                'p.id',
                'p.status',
                'p.bid_amount',
                'p.project_job_id',
                'p.freelancer_id',
                'pj.id as job_id',
                'pj.status as job_status'
            )
            ->first();

        abort_if(!$row, 404);

        if ($row->status !== 'pending') {
            return response()->json([
                'status'  => false,
                'message' => 'This proposal has already been processed.',
            ], 422);
        }

        DB::beginTransaction();
        try {

            /* ================= REJECT ================= */
            if ($request->action === 'rejected') {

                // 1. proposals
                DB::table('proposals')->where('id', $row->id)->update([
                    'status'      => 'rejected',
                    'rejected_at' => now(),
                    'updated_at'  => now(),
                ]);

                // 2. conversations
                DB::table('conversations')->where('proposal_id', $row->id)->update([
                    'status'      => 'closed',
                    'hire_status' => 'rejected',
                    'updated_at'  => now(),
                ]);

                $message = 'Proposal has been rejected successfully.';
            }

            /* ================= ACCEPT ================= */ else {
                if ($row->job_status !== 'open') {
                    DB::rollBack();
                    return response()->json([
                        'status'  => false,
                        'message' => 'This job has already been assigned.',
                    ], 422);
                }

                /* ---- Wallet check ---- */
                $agreedAmount    = $row->bid_amount;
                $advancePercent  = 10.00;
                $advanceAmount   = round($agreedAmount * $advancePercent / 100, 2);
                $remainingAmount = $agreedAmount - $advanceAmount;

                $wallet = get_wallet(auth()->id());

                if ($wallet->available_balance < $advanceAmount) {
                    DB::rollBack();
                    return response()->json([
                        'status'   => false,
                        'message' => 'Insufficient wallet balance. Required: ₹' . number_format($advanceAmount, 2) . ', Available: ₹' . number_format($wallet->available_balance, 2),
                        'redirect' => route('employer.wallet.page'),
                    ], 422);
                }

                /* ---- 1. project_jobs ---- */
                DB::table('project_jobs')->where('id', $row->job_id)->update([
                    'assigned_freelancer_id' => $row->freelancer_id,
                    'status'                 => 'assigned',
                    'updated_at'             => now(),
                ]);

                /* ---- 2. proposals ---- */
                DB::table('proposals')->where('id', $row->id)->update([
                    'status'      => 'accepted',
                    'accepted_at' => now(),
                    'updated_at'  => now(),
                ]);

                /* ---- 3. conversations ---- */
                DB::table('conversations')->where('proposal_id', $row->id)->update([
                    'hire_status'      => 'accepted',
                    'hire_accepted_at' => now(),
                    'updated_at'       => now(),
                ]);

                $conversation = DB::table('conversations')->where('proposal_id', $row->id)->first();

                /* ---- 4. contract ---- */
                $contractId = DB::table('contracts')->insertGetId([
                    'project_job_id'   => $row->project_job_id,
                    'proposal_id'      => $row->id,
                    'conversation_id'  => $conversation ? $conversation->id : null,
                    'employer_id'      => auth()->id(),
                    'freelancer_id'    => $row->freelancer_id,
                    'agreed_amount'    => $agreedAmount,
                    'advance_percent'  => $advancePercent,
                    'advance_amount'   => $advanceAmount,
                    'advance_paid_at'  => now(),
                    'remaining_amount' => $remainingAmount,
                    'payment_status'   => 'advance_paid',
                    'status'           => 'active',
                    'started_at'       => now(),
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);

                /* ---- 5. employer wallet: available → on_hold ---- */
                DB::table('wallets')->where('user_id', auth()->id())->update([
                    'available_balance' => DB::raw("available_balance - {$advanceAmount}"),
                    'on_hold_balance'   => DB::raw("on_hold_balance + {$advanceAmount}"),
                    'updated_at'        => now(),
                ]);

                /* ---- 6. freelancer wallet: on_hold + ---- */
                get_wallet($row->freelancer_id);   // wallet ensure

                DB::table('wallets')->where('user_id', $row->freelancer_id)->update([
                    'on_hold_balance' => DB::raw("on_hold_balance + {$advanceAmount}"),
                    'updated_at'      => now(),
                ]);

                /* ---- 7. ledger ---- */
                wallet_log(auth()->id(), 'escrow_out', $advanceAmount, $contractId, 'Advance hold for contract #' . $contractId);
                wallet_log($row->freelancer_id, 'escrow_in', $advanceAmount, $contractId, 'Advance received (locked)');

                /* ---- 8. baaki proposals reject ---- */
                $otherIds = DB::table('proposals')
                    ->where('project_job_id', $row->project_job_id)
                    ->where('id', '<>', $row->id)
                    ->where('status', 'pending')
                    ->pluck('id');

                if ($otherIds->count()) {
                    DB::table('proposals')->whereIn('id', $otherIds)->update([
                        'status'      => 'rejected',
                        'rejected_at' => now(),
                        'updated_at'  => now(),
                    ]);

                    DB::table('conversations')->whereIn('proposal_id', $otherIds)->update([
                        'status'      => 'closed',
                        'hire_status' => 'rejected',
                        'updated_at'  => now(),
                    ]);
                }

                $message = 'Proposal accepted successfully. ₹' . number_format($advanceAmount, 2) . ' has been reserved from your wallet as the advance payment.';
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $message,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Proposal status failed: ' . $e->getMessage());

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),        // 👈 temporary — asli error dikhega
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ], 500);
        }
    }

    public function proposalDetail($proposal)
    {
        abort_if(auth()->user()->role !== 'employer', 403);

        $data = DB::table('proposals as p')
            ->join('project_jobs as pj', 'pj.id', '=', 'p.project_job_id')
            ->join('users as u', 'u.id', '=', 'p.freelancer_id')
            ->select(
                'p.id',
                'p.bid_amount',
                'p.cover_letter',
                'p.delivery_days',
                'p.status',
                'p.created_at',
                'u.name as freelancer_name'
            )
            ->where('p.id', $proposal)
            ->where('pj.employer_id', auth()->id())   // 👈 apni hi job ka proposal dekh sake
            ->first();

        abort_if(!$data, 404);

        $files = DB::table('proposal_attachments')
            ->where('proposal_id', $proposal)
            ->select('file_name', 'file_path')
            ->get();

        return response()->json([
            'proposal' => $data,
            'files'    => $files,
        ]);
    }

    public function jobDetailPage($slug)
    {
        $job = DB::table('project_jobs as pj')
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
            ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
            ->leftJoin('job_skills as js', 'js.project_job_id', '=', 'pj.id')
            ->leftJoin('skills as s', 's.id', '=', 'js.skill_id')
            ->select(
                'pj.*',
                'c.name as category_name',
                'u.id as company_id',
                'u.name as company_name',
                'u.email as company_email',
                'u.phone as company_phone',
                'ep.company_name as profile_company_name',
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
                'c.name'
            )
            ->first();

        if (!$job) {
            abort(404);
        }

        $attachments = DB::table('job_attachments')
            ->where('project_job_id', $job->id)
            ->get();

        $proposals = DB::table('proposals as p')
            ->leftJoin('users as u', 'u.id', '=', 'p.freelancer_id')
            ->join('freelancer_profiles as fp', 'fp.user_id', '=', 'u.id')
            ->leftJoin('countries as co', 'co.id', '=', 'fp.country')
            ->leftJoin('states as st', 'st.id', '=', 'fp.state')
            ->select(
                'p.id as proposal_id',
                'u.id as user_id',
                'u.name',
                'u.profile_photo',
                'fp.job_title',
                'fp.resume',
                'co.name as country_name',
                'st.name as state_name',
                'p.status','p.ats_score'
            )
            ->where('p.project_job_id', $job->id)
            ->orderByDesc('p.created_at')
            ->get();
        
        $shortlistedApplicants = $proposals->where('status', 'shortlisted')->values();
        
        /* ---------- Skills attach ---------- */
        $proposalUserIds = $proposals->pluck('user_id')->all();

        $skillsByUser = empty($proposalUserIds) ? collect() : DB::table('user_skills as us')
            ->join('skills as sk', 'sk.id', '=', 'us.skill_id')
            ->whereIn('us.user_id', $proposalUserIds)
            ->select('us.user_id', 'sk.id', 'sk.name')
            ->orderBy('sk.name')
            ->get()
            ->groupBy('user_id');

        $proposals->transform(function ($p) use ($skillsByUser) {
            $p->skills = $skillsByUser->get($p->user_id, collect());
            return $p;
        });

        return view('employer.view_job', compact('job', 'attachments', 'proposals','shortlistedApplicants'));
    }

    public function freelancerProfileDetail($id, $proposal)
    {
        $decoded = Hashids::decode($id);

        if (empty($decoded)) {
            abort(404);
        }

        $freelanceId = $decoded[0];
        
        $proposalDecoded = Hashids::decode($proposal);
        
        if (empty($proposalDecoded)) {
            abort(404);
        }
        
        $proposalId = $proposalDecoded[0];
        
        $freelancer = DB::table('users as u')
            ->join('freelancer_profiles as fp', 'fp.user_id', '=', 'u.id')
            ->leftJoin('countries as co', 'co.id', '=', 'fp.country')
            ->leftJoin('states as st', 'st.id', '=', 'fp.state')
            ->where('u.role', 'freelancer')
            ->where('u.id', $freelanceId)
            ->select(
                'u.id',
                'u.name',
                'u.email',
                'u.phone',
                'u.email_verified_at',
                'u.profile_photo',
                'fp.*',
                'co.name as country_name',
                'st.name as state_name'
            )
            ->first();

        if (!$freelancer) {
            abort(404);
        }
        
        $proposalData = DB::table('proposals')
            ->where('id', $proposalId)
            ->where('freelancer_id', $freelanceId)
            ->first();
        
        if (!$proposalData) {
            abort(404);
        }
        
        // Mark profile as viewed only once
        if (is_null($proposalData->profile_viewed_at)) {
        
            DB::table('proposals')
                ->where('id', $proposalId)
                ->update([
                    'profile_viewed_at' => now(),
                    'updated_at' => now(),
                ]);
        
            // Update local object also
            $proposalData->profile_viewed_at = now();
            
            $job = DB::table('project_jobs as pj')
                ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
                ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
                ->leftJoin('proposals', 'proposals.project_job_id', '=', 'pj.id')
                ->select(
                    'pj.*',
                    'u.email as company_email',
                    'ep.company_name'
                    )
                ->where('proposals.id', $proposalId)
                ->first();
                
            // dd($job);
            
            $employer_profiles = DB::table('employer_profiles')
                ->where('user_id', Auth::id())
                ->select('company_name')
                ->first();
            
            $subject1 = 'Your application was viewed';
                
            $message1 = view('mails.emp_profile_viewed', [
                'company_name' => $job->company_name,
                'job' => $job->title,
                'url'     => route('jobseekers.job.detail.page', $job->slug),
            ])->render();
                
            send_mail($job->company_email, $subject1, $message1);
        }

        // freelancer ke skills
        $skills = DB::table('user_skills as us')
            ->join('skills as s', 's.id', '=', 'us.skill_id')
            ->where('us.user_id', $freelanceId)
            ->select('s.name', 'us.experience', 'us.proficiency')
            ->orderBy('s.name')
            ->get();

        // freelancer ke experiences
        $experiences = DB::table('user_experiences')
            ->where('user_id', $freelanceId)
            ->select('*')
            ->orderByDesc('start_date')
            ->get();

        $educations = DB::table('user_educations')
            ->where('user_id', $freelanceId)
            ->select('*')
            ->get();

        $preferredTitles = DB::table('freelancer_job_preferences')
            ->where('user_id', $freelanceId)
            ->get();

        $preferredLocations = DB::table('freelancer_job_preference_locations')
            ->where('user_id', $freelanceId)
            ->get();

        $projects = DB::table('freelancer_projects')
            ->where('user_id', $freelanceId)
            ->get();

        $socialLinks = DB::table('freelancer_social_links')
            ->where('user_id', $freelanceId)
            ->get();

        return view('employer.freelancer_profile_detail', compact('freelancer','proposalData', 'skills', 'experiences', 'educations', 'preferredTitles', 'preferredLocations', 'projects', 'socialLinks'));
    }
    
    public function downloadCV($proposalId)
    {
        $proposal = DB::table('proposals as p')
            ->join('users as u', 'u.id', '=', 'p.freelancer_id')
            ->join('freelancer_profiles as fp', 'fp.user_id', '=', 'u.id')
            ->where('p.id', $proposalId)
            ->select(
                'p.id',
                'p.cv_downloaded_at',
                'fp.resume'
            )
            ->first();
    
        if (!$proposal) {
            abort(404);
        }
    
        if (empty($proposal->resume)) {
            abort(404, 'CV not found.');
        }
    
        // Mark CV/profile as viewed only once
        if (is_null($proposal->cv_downloaded_at)) {
            DB::table('proposals')
                ->where('id', $proposalId)
                ->update([
                    'cv_downloaded_at' => now(),
                    'updated_at' => now(),
                ]);
                
            $job = DB::table('project_jobs as pj')
                ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
                ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
                ->leftJoin('proposals', 'proposals.project_job_id', '=', 'pj.id')
                ->select(
                    'pj.*',
                    'u.email as company_email',
                    'ep.company_name'
                    )
                ->where('proposals.id', $proposalId)
                ->first();
                
            // dd($job);
            
            $employer_profiles = DB::table('employer_profiles')
                ->where('user_id', Auth::id())
                ->select('company_name')
                ->first();
            
            $subject1 = $job->company_name .' downloaded your resume';
                
            $message1 = view('mails.emp_resume_download', [
                'company_name' => $job->company_name,
                'job' => $job->title,
                'url'     => route('jobseekers.job.detail.page', $job->slug),
            ])->render();
                
            send_mail($job->company_email, $subject1, $message1);
        }
    
        return redirect()->away($proposal->resume);
    }
    
    public function shortlist(Request $request, $proposalId)
    {
        $proposal = DB::table('proposals')
            ->where('id', $proposalId)
            ->first();
    
        if (!$proposal) {
            return response()->json([
                'success' => false,
                'message' => 'Proposal not found.'
            ], 404);
        }
    
        if ($proposal->status === 'shortlisted') {
            return response()->json([
                'success' => false,
                'message' => 'This candidate is already shortlisted.'
            ], 422);
        }
    
        if ($proposal->status === 'rejected') {
            return response()->json([
                'success' => false,
                'message' => 'This candidate has already been rejected.'
            ], 422);
        }
    
        DB::transaction(function () use ($proposalId) {
    
            DB::table('proposals')
                ->where('id', $proposalId)
                ->update([
                    'status' => 'shortlisted',
                    'rejected_at' => null,
                    'updated_at' => now(),
                ]);
        });
    
        $freelancer = DB::table('users')
            ->where('id', $proposal->freelancer_id)
            ->first();
    
        if (!$freelancer) {
            return response()->json([
                'success' => false,
                'message' => 'Freelancer not found.'
            ], 404);
        }
        
            $job = DB::table('project_jobs as pj')
                ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
                ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
                ->leftJoin('proposals', 'proposals.project_job_id', '=', 'pj.id')
                ->select(
                    'pj.*',
                    'u.email as company_email',
                    'ep.company_name'
                    )
                ->where('proposals.id', $proposalId)
                ->first();
                
            // dd($job);
            
            $employer_profiles = DB::table('employer_profiles')
                ->where('user_id', Auth::id())
                ->select('company_name')
                ->first();
            
            $subject1 = 'Your application has been shortlisted!';
                
            $message1 = view('mails.freelancer-shortlisted', [
                'company_name' => $job->company_name,
                'job' => $job->title,
                'url'     => route('jobseekers.job.detail.page', $job->slug),
            ])->render();
                
            send_mail($job->company_email, $subject1, $message1);
    
        return response()->json([
            'success' => true,
            'message' => 'Candidate shortlisted successfully. Email sent to the candidate.'
        ]);
    }


    public function reject(Request $request, $proposalId)
    {
        $proposal = DB::table('proposals')
            ->where('id', $proposalId)
            ->first();
    
        if (!$proposal) {
            return response()->json([
                'success' => false,
                'message' => 'Proposal not found.'
            ], 404);
        }
    
        if ($proposal->status === 'rejected') {
            return response()->json([
                'success' => false,
                'message' => 'This candidate is already rejected.'
            ], 422);
        }
    
        if ($proposal->status === 'shortlisted') {
            return response()->json([
                'success' => false,
                'message' => 'This candidate has already been shortlisted.'
            ], 422);
        }
    
        DB::transaction(function () use ($proposalId) {
    
            DB::table('proposals')
                ->where('id', $proposalId)
                ->update([
                    'status' => 'rejected',
                    'rejected_at' => now(),
                    'updated_at' => now(),
                ]);
        });
    
        $freelancer = DB::table('users')
            ->where('id', $proposal->freelancer_id)
            ->first();
    
        if (!$freelancer) {
            return response()->json([
                'success' => false,
                'message' => 'Freelancer not found.'
            ], 404);
        }
        
            $job = DB::table('project_jobs as pj')
                ->leftJoin('users as u', 'u.id', '=', 'pj.employer_id')
                ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
                ->leftJoin('proposals', 'proposals.project_job_id', '=', 'pj.id')
                ->select(
                    'pj.*',
                    'u.email as company_email',
                    'ep.company_name'
                    )
                ->where('proposals.id', $proposalId)
                ->first();
                
            // dd($job);
            
            $employer_profiles = DB::table('employer_profiles')
                ->where('user_id', Auth::id())
                ->select('company_name')
                ->first();
            
            $subject1 = 'Update on your application';
                
            $message1 = view('mails.freelancer-rejected', [
                'user_name' => $freelancer->name,
                'company_name' => $job->company_name,
                'job' => $job->title,
                'url'     => route('jobseekers.find.work'),
            ])->render();
                
            send_mail($job->company_email, $subject1, $message1);
    
        return response()->json([
            'success' => true,
            'message' => 'Candidate rejected successfully. Email sent to the candidate.'
        ]);
    }

    public function deleteJob(Request $request)
    {
        $request->validate([
            'job_id' => 'required|integer'
        ]);

        $job = DB::table('project_jobs')
            ->where('id', $request->job_id)
            ->where('employer_id', Auth::id())
            ->first();

        if (!$job) {
            return response()->json([
                'status' => false,
                'message' => 'Job not found.'
            ]);
        }

        // Allow delete only for Draft, Pending and Open jobs
        if (!in_array($job->status, ['draft', 'pending', 'open'])) {
            return response()->json([
                'status' => false,
                'message' => 'This job cannot be deleted.'
            ]);
        }

        // Do not allow delete if proposals exist
        if ($job->total_proposals > 0) {
            return response()->json([
                'status' => false,
                'message' => 'This job has received proposals and cannot be deleted.'
            ]);
        }

        DB::table('project_jobs')
            ->where('id', $job->id)
            ->update([
                'status' => 'deleted',
                'updated_at' => now(),
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Job deleted successfully.'
        ]);
    }

    public function toggleFreelancerFavourite(Request $request, $freelancer)
    {
        // sirf employer save kar sake
        abort_if(auth()->user()->role !== 'employer', 403);

        // target actually freelancer hai?
        $isFreelancer = DB::table('users')
            ->where('id', $freelancer)
            ->where('role', 'freelancer')
            ->exists();

        abort_if(!$isFreelancer, 404);

        $employerId = auth()->id();

        $existing = DB::table('freelancer_favourites')
            ->where('employer_id', $employerId)
            ->where('freelancer_id', $freelancer)
            ->first();

        if ($existing) {
            DB::table('freelancer_favourites')->where('id', $existing->id)->delete();
            $saved = false;
        } else {
            DB::table('freelancer_favourites')->insert([
                'employer_id'   => $employerId,
                'freelancer_id' => $freelancer,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
            $saved = true;
        }

        return response()->json([
            'saved'   => $saved,
            'message' => $saved ? 'Freelancer saved to your list' : 'Removed from saved list',
        ]);
    }

    public function employerJobs(Request $request)
    {
        $query = DB::table('project_jobs as pj')
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->leftJoin('job_skills as js', 'js.project_job_id', '=', 'pj.id')
            ->leftJoin('skills as s', 's.id', '=', 'js.skill_id')
            ->select(
                'pj.*',
                'c.name as category_name',
                DB::raw("GROUP_CONCAT(DISTINCT s.name ORDER BY s.name SEPARATOR ', ') as skills"),
                DB::raw("(SELECT COUNT(*) FROM job_attachments ja WHERE ja.project_job_id = pj.id) as attachment_count")
            )
            ->where('pj.employer_id', Auth::id())
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
                'c.name'
            );

        $liveJobs = (clone $query)
            // ->whereIn('pj.status', ['open', 'pending'])
            ->orderByDesc('pj.created_at')
            ->paginate(2, ['*'], 'live_page');

        $ongoingJobs = (clone $query)
            ->where('pj.status', 'assigned')
            ->orderByDesc('pj.created_at')
            ->paginate(2, ['*'], 'ongoing_page');

        $previousJobs = (clone $query)
            ->where('pj.status', 'completed')
            ->orderByDesc('pj.created_at')
            ->paginate(2, ['*'], 'previous_page');

        return view('employer.employer_jobs', compact(
            'liveJobs',
            'ongoingJobs',
            'previousJobs'
        ));
    }

    public function findTalent(Request $request, $slug = null)
    {
        $isFavourite = $slug === 'favourites';

        /* ====== Freelancers query ====== */
        $freelancers = DB::table('users as u')
            ->join('freelancer_profiles as fp', 'fp.user_id', '=', 'u.id')
            ->leftJoin('countries as c', 'c.id', '=', 'fp.country')
            ->select('u.id as user_id', 'u.name', 'u.role', 'u.profile_photo', 'fp.*','c.name as country_name')
            ->where('u.role', 'freelancer')
            ->where('u.profile_complete', '1')
            ->where('u.webview', '1')
            
            ->when($isFavourite, function ($q) {
                $q->join('freelancer_favourites as ff', function ($join) {
                    $join->on('ff.freelancer_id', '=', 'u.id')
                        ->where('ff.employer_id', auth()->id());
                });
            })

            // keyword — naam ya profile me
            ->when($request->filled('keyword'), function ($q) use ($request) {
                $term = '%' . addcslashes($request->keyword, '%_\\') . '%';
                $q->where(function ($sub) use ($term) {
                    $sub->where('u.name', 'like', $term)
                        // skill name se bhi match karo
                        ->orWhereIn('u.id', function ($s) use ($term) {
                            $s->select('us.user_id')
                                ->from('user_skills as us')
                                ->join('skills as sk', 'sk.id', '=', 'us.skill_id')
                                ->where('sk.name', 'like', $term);
                        });
                });
            })

            // skills checkbox filter
            ->when($request->filled('skills'), function ($q) use ($request) {
                $q->whereIn('u.id', function ($sub) use ($request) {
                    $sub->select('user_id')
                        ->from('user_skills')
                        ->whereIn('skill_id', (array) $request->skills);
                });
            })


            ->orderByDesc('u.id')
            ->paginate(10)
            ->withQueryString();

        /* ====== Skills attach ====== */
        $userIds = $freelancers->pluck('user_id')->all();

        $skillsByUser = empty($userIds) ? collect() : DB::table('user_skills as us')
            ->join('skills as sk', 'sk.id', '=', 'us.skill_id')
            ->whereIn('us.user_id', $userIds)
            ->select('us.user_id', 'sk.id', 'sk.name', 'sk.popular', 'us.experience', 'us.proficiency')
            ->orderBy('sk.name')
            ->get()
            ->groupBy('user_id');

        $experienceByUser = empty($userIds) ? collect() : DB::table('user_experiences')
            ->whereIn('user_id', $userIds)
            ->select('user_id', 'start_date', 'end_date')
            ->get()
            ->groupBy('user_id');

        // employer ne kaunse freelancers save kar rakhe hain — EK query
        $savedIds = (auth()->check() && auth()->user()->role === 'employer' && !empty($userIds))
            ? DB::table('freelancer_favourites')
            ->where('employer_id', auth()->id())
            ->whereIn('freelancer_id', $userIds)
            ->pluck('freelancer_id')
            ->flip()          // [id => idx] → has() O(1)
            : collect();

        $freelancers->getCollection()->transform(function ($f) use ($skillsByUser, $savedIds, $experienceByUser) {
            $f->skills        = $skillsByUser->get($f->user_id, collect());
            $f->is_favourited = $savedIds->has($f->user_id);
            $experiences = $experienceByUser->get($f->user_id, collect());

            $totalMonths = 0;

            foreach ($experiences as $exp) {

                $start = \Carbon\Carbon::parse($exp->start_date);
                $end = $exp->end_date
                    ? \Carbon\Carbon::parse($exp->end_date)
                    : now();

                $totalMonths += $start->diffInMonths($end);
            }

            $f->experience_years = round($totalMonths / 12, 1);

            return $f;
        });

        /* ====== AJAX → sirf partial ====== */
        if ($request->ajax()) {
            return view('employer.ajax_find_talent', compact('freelancers'))->render();
        }

        $skills = DB::table('skills as sk')
            ->leftJoin('user_skills as us', 'us.skill_id', '=', 'sk.id')
            ->leftJoin('users as u', function ($join) {
                $join->on('u.id', '=', 'us.user_id')
                    ->where('u.role', '=', 'freelancer');
            })
            ->where('sk.status', 1)
            ->select('sk.id', 'sk.name', 'sk.popular', DB::raw('COUNT(u.id) as users_count'))
            ->groupBy('sk.id', 'sk.name', 'sk.popular')
            ->orderByDesc('users_count')
            ->get();

        return view('employer.find_talent', compact('freelancers', 'skills', 'isFavourite'));
    }
}
