<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobListingController extends Controller
{
    public function toggleFavourite(Request $request, int $id)
    {
        abort_unless(auth()->check() && auth()->user()->role === 'freelancer', 403);

        $exists = DB::table('job_favourites')
            ->where('user_id', auth()->id())
            ->where('project_job_id', $id)
            ->exists();

        if ($exists) {
            DB::table('job_favourites')
                ->where('user_id', auth()->id())
                ->where('project_job_id', $id)
                ->delete();
            $favourited = false;
        } else {
            DB::table('job_favourites')->insert([
                'user_id'         => auth()->id(),
                'project_job_id'  => $id,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
            $favourited = true;
        }

        return response()->json(['favourited' => $favourited]);
    }
    
    public function show(Request $request, int $id)
    {
        $data = $this->jobDetail($id);

        abort_if(!$data, 404);

        if ($request->ajax()) {
            return view('freelancer.ajax_job_detail', $data)->render();
        }

        // Direct URL hit (kisi ne /job/5 seedha khola) -> find-work page par bhejo taaki same UI mile.
        return redirect()->route('jobseekers.find.work');
    }

    /**
     * Permanent — native job ka poora detail data.
     */
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

        // Views tracking
        $viewedJobs = session()->get('viewed_jobs', []);
        if (!in_array($job->id, $viewedJobs)) {
            DB::table('project_jobs')->where('id', $job->id)->increment('views');
            $viewedJobs[] = $job->id;
            session()->put('viewed_jobs', $viewedJobs);
            $job->views += 1;
        }

        // NOTE: $job->job_type ko overwrite NAHI karna, pj.* se real value aati hai
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

    /* ============================================================
    * TEMP: EXTERNAL JOBS — jab external sunset ho, ye poora method
    * aur upar show() ka ternary branch delete kar dena.
    * ============================================================ */
    private function externalDetail(int $id): array
    {
        $job = DB::table('external_jobs')
            ->where('id', $id)
            ->where('is_active', 1)
            ->whereNull('deleted_at')
            ->first();
        
        abort_if(!$job, 404);

        $job->job_type   = 'external';
        $job->key_skills = json_decode($job->ai_key_skills ?? '[]') ?: [];
        $job->posted_ago = $job->date_posted
            ? Carbon::parse($job->date_posted)->diffForHumans()
            : Carbon::parse($job->created_at)->diffForHumans();

        return ['job' => $job, 'attachments' => collect(), 'alreadyApplied' => false, 'similarJobs' => collect()];
    }
    /* ============================================================
    * END TEMP EXTERNAL BLOCK
    * ============================================================ */
}