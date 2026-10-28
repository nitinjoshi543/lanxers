<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExternalJobController extends Controller
{
    public function externalJobsList()
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            return view('adminend/external_jobs_list');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getExternalJobsList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('external_jobs')
            ->select('*');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('title', 'like', "%$searchValue%")
                  ->orWhere('organization', 'like', "%$searchValue%")
                  ->orWhere('locations', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $jobs = $query->orderBy('external_jobs.id', 'ASC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Compute live active/expired status per row (date_valid_through based)
        $jobs = $jobs->map(function ($job) {
            $job->computed_status = ($job->date_valid_through && Carbon::parse($job->date_valid_through)->isPast())
                ? 'Expired'
                : ($job->is_active ? 'Active' : 'Inactive');
            return $job;
        });

        // Get total count
        $totalCount = DB::table('external_jobs')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $jobs
        ]);
    }

    public function setExternalJobsStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $result = DB::table('external_jobs')
            ->where('id', $id)
            ->update([
                'is_active' => $status,
                'updated_at' => Carbon::now('Asia/Kolkata'),
            ]);

        if ($result !== false) {
            echo $status; die;
        }
    }
    
    public function toggleExternalJobStatus($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {

            $job = DB::table('external_jobs')->where('id', $id)->first();

            if (!$job) {
                return response()->json(['success' => false, 'message' => 'Job not found.']);
            }

            $newStatus = $job->is_accepting_applications == 1 ? 0 : 1;

            $result = DB::table('external_jobs')->where('id', $id)->update([
                'is_accepting_applications' => $newStatus,
                'updated_at'                => Carbon::now('Asia/Kolkata'),
            ]);

            if ($result !== false) {
                return response()->json(['success' => true, 'status' => $newStatus]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to update status.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Unauthorized.']);
        }
    }

    public function externalJobView($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            $job = DB::table('external_jobs')->where('id', $id)->first();

            if (!$job) {
                return redirect()->route('external.jobs.list')->with('error', 'Job not found.');
            }

            $job->computed_status = ($job->date_valid_through && Carbon::parse($job->date_valid_through)->isPast())
                ? 'Expired'
                : ($job->is_active ? 'Active' : 'Inactive');

            return view('adminend/external_jobs_view', compact('job'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function editExternalJobsEmployer($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            $job = DB::table('external_jobs')->where('id', $id)->first();

            if (!$job) {
                return redirect()->route('external.jobs.list')->with('error', 'Job not found.');
            }

            return view('adminend/external_jobs_edit', compact('job'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitEditExternalJobsEmployerForm(Request $request, $id)
    {
        $validated = $request->validate([
            'title'                            => 'required|string|max:255',
            'organization'                      => 'nullable|string|max:255',
            'organization_logo'                 => 'nullable|string|max:500',
            'locations'                          => 'nullable|string|max:255',
            'employment_type'                   => 'nullable|string|max:100',
            'seniority'                          => 'nullable|string|max:100',
            'date_posted'                        => 'nullable|date',
            'date_valid_through'                 => 'nullable|date',
            'url'                                => 'nullable|url|max:500',
            'description_text'                   => 'nullable|string',
            'ai_experience_level'                => 'nullable|string|max:100',
            'ai_work_arrangement'                => 'nullable|string|max:100',
            'ai_work_arrangement_office_days'    => 'nullable|string|max:100',
            'ai_key_skills'                      => 'nullable|string',
            'org_linkedin_website'               => 'nullable|url|max:500',
            'org_linkedin_size'                  => 'nullable|string|max:100',
            'org_linkedin_industry'              => 'nullable|string|max:255',
            'org_linkedin_slogan'                => 'nullable|string|max:255',
            'org_linkedin_description'           => 'nullable|string',
        ]);

        // ai_key_skills textarea me comma-separated aayega, JSON array me convert karna hai
        $skillsInput = $request->input('ai_key_skills');
        $skillsJson  = null;
        if (!empty($skillsInput)) {
            $skillsArray = array_filter(array_map('trim', explode(',', $skillsInput)));
            $skillsJson  = json_encode(array_values($skillsArray));
        }

        $data = [
            'title'                            => $validated['title'],
            'organization'                      => $request->input('organization'),
            'organization_logo'                 => $request->input('organization_logo'),
            'locations'                          => $request->input('locations'),
            'employment_type'                   => $request->input('employment_type'),
            'seniority'                          => $request->input('seniority'),
            'date_posted'                        => $request->input('date_posted'),
            'date_valid_through'                 => $request->input('date_valid_through'),
            'url'                                => $request->input('url'),
            'description_text'                   => $request->input('description_text'),
            'ai_experience_level'                => $request->input('ai_experience_level'),
            'ai_work_arrangement'                => $request->input('ai_work_arrangement'),
            'ai_work_arrangement_office_days'    => $request->input('ai_work_arrangement_office_days'),
            'ai_key_skills'                      => $skillsJson,
            'org_linkedin_website'               => $request->input('org_linkedin_website'),
            'org_linkedin_size'                  => $request->input('org_linkedin_size'),
            'org_linkedin_industry'              => $request->input('org_linkedin_industry'),
            'org_linkedin_slogan'                => $request->input('org_linkedin_slogan'),
            'org_linkedin_description'           => $request->input('org_linkedin_description'),
            'updated_at'                         => Carbon::now('Asia/Kolkata'),
        ];

        $result = DB::table('external_jobs')->where('id', $id)->update($data);

        if ($result !== false) {
            return redirect()->back()->with('success', 'Job updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update job.');
        }
    }
}