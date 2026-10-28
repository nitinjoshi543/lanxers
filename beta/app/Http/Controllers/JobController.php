<?php

namespace App\Http\Controllers;

use App\Models\Job_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function jobsCategoryList()
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            return view('adminend/jobs_category_list');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getjobsCategoryList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('categories')
            ->select('*');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('name', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('categories.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('categories')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function jobsCategoryAdd()
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            return view('adminend/jobs_category_add');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitJobsCategoryAddForm(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg|max:2048', // 2MB limit
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $imageUrl = moveDocumentToAws($file); // S3 upload, URL return karega
        }

        $data = [
            'name'       => $validated['title'],
            'slug'        => Str::slug($validated['title']),
            'description' => $validated['description'] ?? null,
            'icon'       => $imageUrl,
            'created_at'  => Carbon::now('Asia/Kolkata'),
            'updated_at'  => Carbon::now('Asia/Kolkata'),
        ];

        $result = Job_model::jobCategoryAdd($data);

        if ($result) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to save data.');
        }
    }

    public function editjobsCategory($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            $jobs = Job_model::getJobCategoryById($id);
            return view('adminend/jobs_category_edit', compact('jobs'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitEditJobsCategoryForm(Request $request, $id)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg|max:2048', // 2MB limit
        ]);

        $data = [
            'name'       => $request->input('title'),
            'slug'        => Str::slug($request->input('title')),
            'description' => $request->input('description'),
            'updated_at'  => Carbon::now('Asia/Kolkata'),
        ];

        // Naya image aaya tabhi update karo, warna purana wala rehne do
        if ($request->hasFile('image')) {
            $file          = $request->file('image');
            $data['icon'] = moveDocumentToAws($file); // S3 upload, URL return karega
        }

        $result = Job_model::updateEditJobsCategory($data, $id);

        if ($result) {
            return redirect()->back()->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

    public function setjobsCategoryStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $job = Job_model::setjobsCategoryStatus($id, $status);
        if ($job) {
            echo $status; die;
        }
    }

     public function jobsEmployerList()
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            return view('adminend/jobs_employer_list');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getjobsEmployerList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('admin_jobs_employer')
            ->select('*');

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('employer_name', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('admin_jobs_employer.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('admin_jobs_employer')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function jobsEmployerAdd()
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            return view('adminend/jobs_employer_add');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitJobsEmployerAddForm(Request $request)
    {
        $validated = $request->validate([
            'emp_name'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB limit
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $imageUrl = moveDocumentToAws($file); // S3 upload, URL return karega
        }

        $data = [
            'employer_name'       => $validated['emp_name'],
            'employer_logo'       => $imageUrl,
            'status'       => 1,
            'created_at'  => Carbon::now('Asia/Kolkata'),
            'updated_at'  => Carbon::now('Asia/Kolkata'),
        ];

        $result = Job_model::jobEmployerAdd($data);

        if ($result) {
            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to save data.');
        }
    }

    public function editjobsEmployer($id)
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            $employer = Job_model::getJobEmployerById($id);
            return view('adminend/jobs_employer_edit', compact('employer'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function submitEditJobsEmployerForm(Request $request, $id)
    {
        $validated = $request->validate([
            'emp_name'       => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB limit
        ]);

        $data = [
            'employer_name'       => $request->input('emp_name'),
            'status' => 1,
            'updated_at'  => Carbon::now('Asia/Kolkata'),
        ];

        // Naya image aaya tabhi update karo, warna purana wala rehne do
        if ($request->hasFile('image')) {
            $file          = $request->file('image');
            $data['employer_logo'] = moveDocumentToAws($file); // S3 upload, URL return karega
        }

        $result = Job_model::updateEditJobsEmployer($data, $id);

        if ($result) {
            return redirect()->back()->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }

    public function setjobsEmployerStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $employer = Job_model::setjobsEmployerStatus($id, $status);
        if ($employer) {
            echo $status; die;
        }
    }


    public function jobsList()
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            return view('adminend/scrap_job_list');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function getjobsList(Request $request)
    {
        $searchValue = $request->input('searchQuery');
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $query = DB::table('project_jobs')
            ->select('*')
            ->where('type', 1);

        // Apply search filters if present
        if (!empty($searchValue)) {
            $query->where(function ($q) use ($searchValue) {
                $q->orWhere('title', 'like', "%$searchValue%");
            });
        }

        // Clone query for count before applying limit
        $filteredCount = $query->count();

        // Apply pagination
        $users = $query->orderBy('project_jobs.id', 'DESC')
            ->limit($length)
            ->offset($start)
            ->get();

        // Get total count
        $totalCount = DB::table('project_jobs')
            ->count();

        // Return JSON response for DataTables
        return response()->json([
            "draw" => $request->input('draw'),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $filteredCount,
            "data" => $users
        ]);
    }

    public function jobsAdd()
    {
        $userData = session('user_data');
        if (isset($userData) && ( $userData->group_id == 1 || (isset($userData->parent_modules) && in_array(5, explode(',', $userData->parent_modules))))) {
            $job_category = Job_model::getJobCategory();
            $employer = Job_model::getEmployer();
            return view('adminend/scrap_job_add', compact('job_category', 'employer'));
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function searchSkills(Request $request)
    {
        $term = $request->get('q');

        $skills = Job_model::search_skills($term);

        return response()->json($skills);
    }

    public function submitJobsAddForm(Request $request)
    {
        $validated = $request->validate([
            'cat_id'            => 'required',
            'emp_id'            => 'required',
            'title'             => 'required|string|max:255',
            'description'       => 'required|string',
            'skills'            => 'required|array|min:1',
            'budget_min'        => 'required|numeric',
            'budget_max'        => 'required|numeric',
            'experience_level'  => 'required|string',
            'location_type'     => 'required|in:remote,hybrid,on-site',
            'location'          => 'required_if:location_type,hybrid,on-site|nullable|string',
        ]);

        $data = [
            'cat_id'            => $request->input('cat_id'),
            'employer_id'       => $request->input('emp_id'),
            'title'             => $request->input('title'),
            'slug'              => Str::slug($request->input('title')),
            'description'       => $request->input('description'),
            'budget_min'        => $request->input('budget_min'),
            'budget_max'        => $request->input('budget_max'),
            'experience_level'  => $request->input('experience_level'),
            'location_type'     => $request->input('location_type'),
            'location'          => $request->input('location'),
            'status'            => 0,
            'created_on'        => Carbon::now('Asia/Kolkata'),
            'updated_on'        => Carbon::now('Asia/Kolkata'),
        ];

        $jobId = Job_model::jobAdd($data);

        if ($jobId) {
            Job_model::sync_job_skills($jobId, $request->input('skills'));

            return redirect()->back()->with('success', 'Data saved successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to save data.');
        }
    }
 
}