<?php

namespace App\Http\Controllers;

use App\Models\ProjectJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Http;

class ProjectJobController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:draft,open,paused,closed,expired',
        ]);

        try {

            // sirf apni job (employer_id check)
            $job = ProjectJob::where('id', $id)
                ->where('employer_id', Auth::id())
                ->firstOrFail();

            // deleted job ka status change nahi hoga
            if ($job->status === 'deleted') {
                return response()->json([
                    'status'  => false,
                    'message' => 'Deleted job ka status change nahi ho sakta.'
                ], 403);
            }

            $job->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Status updated successfully.'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    public function generateJobDescription(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
        ]);

        $rawInput = "Job Title: {$validated['job_title']}\n";
    
        if (!empty($validated['description'])) {
            $rawInput .= "Additional Context: {$validated['description']}\n";
        }

        $response = Http::asForm()
            ->withHeaders([
                'X-API-KEY' => env('AI_API_KEY'),
                'Accept' => 'application/json',
            ])
            ->post(env('AI_API_URL') . '/generate-brief', [
                'raw_input' => $rawInput,
            ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to generate job description.',
                'error'   => $response->body(),
            ], $response->status());
        }

        return response()->json($response->json());

        // return response()->json([
        //     'description' => 'Generated description... Generated description... Generated description... Generated description... Generated description... Generated description...'
        // ]);
    }

    public function generateJobSkills(Request $request)
    {
        $request->validate([
            'job_title' => 'required',
            'category' => 'required',
            'budget' => 'required',
            'duration' => 'required',
            'description' => 'required',
        ]);

        // Call AI here...

        return response()->json([
            'skills' => [
                'Laravel',
                'PHP',
                'MySQL',
                'REST API',
                'Git',
                'JavaScript'
            ]
        ]);
    }
    
    public function jobEdit($id)
    {
        $job = ProjectJob::where('id', $id)
            ->where('employer_id', Auth::id())
            ->firstOrFail();
    
        $skills = DB::table('job_skills')
            ->join('skills', 'skills.id', '=', 'job_skills.skill_id')
            ->where('job_skills.project_job_id', $job->id)
            ->pluck('skills.name')
            ->toArray();
    
        return view('employer.edit_post_job', compact('job', 'skills'));
    }
    
    public function jobUpdate(Request $request, $id)
    {
        $request->validate([
            'opportunity_type' => 'required|in:job,internship,freelancer',
    
            'job_title' => 'required|string|max:80',
    
            'experience' => 'required|in:fresher,0-1,2-3,4-5,6-10,10+',
    
            'location_type' => 'required|in:remote,onsite,hybrid',
    
            'job_location' => 'required|string|max:500',
    
            'job_type' => 'required|in:full_time,part_time',
    
            'salary_disclosure' => 'required|in:disclosed,not_disclosed',
    
            'budget' => 'required_if:salary_disclosure,disclosed'
                . '|nullable|numeric|min:1',
    
            'description' => ['required', 'string'],
    
            'skills' => 'required|string',
        ]);
    
        DB::beginTransaction();
    
        try {
    
            /*
            |--------------------------------------------------------------------------
            | Get Job
            |--------------------------------------------------------------------------
            */
    
            $job = ProjectJob::where('id', $id)
                ->where('employer_id', Auth::id())
                ->firstOrFail();
    
    
            /*
            |--------------------------------------------------------------------------
            | Clean Description
            |--------------------------------------------------------------------------
            */
    
            $description = preg_replace(
                "/\r\n|\r|\n/",
                "\n",
                trim(strip_tags($request->description))
            );
    
    
            /*
            |--------------------------------------------------------------------------
            | Update Job
            |--------------------------------------------------------------------------
            */
    
            $job->update([
    
                'opportunity_type' => $request->opportunity_type,
    
                'title' => $request->job_title,
    
                'description' => $description,
    
                'experience' => $request->experience,
    
                'job_type' => $request->job_type,
    
                'budget_type' => $request->salary_disclosure === 'not_disclosed'
                    ? 'not_disclosed'
                    : 'fixed',
    
                'budget_min' => $request->salary_disclosure === 'disclosed'
                    ? $request->budget
                    : null,
    
                'budget_max' => $request->salary_disclosure === 'disclosed'
                    ? $request->budget
                    : null,
    
                'location_type' => $request->location_type,
    
                'job_location' => $request->job_location,
            ]);
    
    
            /*
            |--------------------------------------------------------------------------
            | Update Skills
            |--------------------------------------------------------------------------
            */
    
            // Remove existing skills
            DB::table('job_skills')
                ->where('project_job_id', $job->id)
                ->delete();
    
    
            // Add new skills
            $skills = explode(',', $request->skills);
    
            foreach ($skills as $skillName) {
    
                $skillName = trim($skillName);
    
                if (empty($skillName)) {
                    continue;
                }
    
                /*
                |--------------------------------------------------------------------------
                | Find Existing Skill
                |--------------------------------------------------------------------------
                */
    
                $skill = DB::table('skills')
                    ->whereRaw(
                        'LOWER(name) = ?',
                        [strtolower($skillName)]
                    )
                    ->first();
    
    
                /*
                |--------------------------------------------------------------------------
                | Create Skill If Not Exists
                |--------------------------------------------------------------------------
                */
    
                if (!$skill) {
    
                    $skillId = DB::table('skills')->insertGetId([
                        'name' => $skillName,
                        'slug' => Str::slug($skillName),
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
    
                } else {
    
                    $skillId = $skill->id;
                }
    
    
                /*
                |--------------------------------------------------------------------------
                | Save Job Skill
                |--------------------------------------------------------------------------
                */
    
                DB::table('job_skills')->insert([
                    'project_job_id' => $job->id,
                    'skill_id' => $skillId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    
    
            DB::commit();
    
            return response()->json([
                'status' => true,
                'message' => 'Job updated successfully.'
            ]);
    
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function postJob()
    {
        return view('employer.post_job');
    }

    public function store(Request $request)
    {
        $request->validate([
            'opportunity_type' => 'required|in:job,internship,freelancer',
            'job_title'    => 'required|string|max:80',
            // 'category'     => 'required|exists:categories,id',
        
            'experience' => 'required|in:fresher,0-1,2-3,4-5,6-10,10+',
        
            'location_type' => 'required|in:remote,onsite,hybrid',
            'job_location'  => 'required|string|max:500',
        
            'job_type'     => 'required|in:full_time,part_time',
        
            'salary_disclosure' => 'required|in:disclosed,not_disclosed',
            'budget' => 'required_if:salary_disclosure,disclosed|nullable|numeric|min:1',
        
            // 'duration'     => 'required',
            'description'  => ['required', 'string'],
            'skills'       => 'required|string',
        
            // 'attachment'   => 'nullable|file|max:25600',
        ]);

        DB::beginTransaction();

        try {
            // dd($request->description);

            // $description = Purifier::clean($request->description);
            $description = $description = preg_replace("/\r\n|\r|\n/", "\n", trim(strip_tags($request->description)));
            // dd($request->description);

            $job = ProjectJob::create([
                'employer_id' => Auth::id(),
                'opportunity_type' => $request->opportunity_type,
                
                // 'category_id' => $request->category,
                'title'       => $request->job_title,
                'slug'        => Str::slug($request->job_title) . '-' . time(),
                
                'description' => $description,
                
                'experience' => $request->experience,
                'job_type' => $request->job_type,
                
                'budget_type' => $request->salary_disclosure === 'not_disclosed'
                    ? 'not_disclosed'
                    : 'fixed',
                
                'budget_min' => $request->salary_disclosure === 'disclosed'
                    ? $request->budget
                    : null,
                
                'budget_max' => $request->salary_disclosure === 'disclosed'
                    ? $request->budget
                    : null,
                
                'location_type' => $request->location_type,
                'job_location' => $request->job_location,

                // 'duration'    => $request->duration,
                'status'      => 'open',
            ]);

            /*Save Skills*/
            $skills = explode(',', $request->skills);

            foreach ($skills as $skillName) {

                $skillName = trim($skillName);

                if (empty($skillName)) {
                    continue;
                }

                // Find existing skill
                $skill = DB::table('skills')
                    ->whereRaw('LOWER(name) = ?', [strtolower($skillName)])
                    ->first();

                // Create if it doesn't exist
                if (!$skill) {

                    $skillId = DB::table('skills')->insertGetId([
                        'name'       => $skillName,
                        'slug'       => Str::slug($skillName),
                        'status'     => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {

                    $skillId = $skill->id;
                }

                // Save relation
                DB::table('job_skills')->insert([
                    'project_job_id' => $job->id,
                    'skill_id'       => $skillId,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }

            /*Save Attachments*/
            // if ($request->hasFile('attachment')) {

            //     $file = $request->file('attachment');

            //     $filename = time() . '_' . $file->getClientOriginalName();

            //     $path = $file->storeAs(
            //         'jobs/' . $job->id,
            //         $filename,
            //         'public'
            //     );

            //     DB::table('job_attachments')->insert([
            //         'project_job_id' => $job->id,
            //         'file_path'      => $path,
            //         'file_type'      => $file->getClientMimeType(),
            //         'created_at'     => now(),
            //         'updated_at'     => now(),
            //     ]);
            // }

            DB::commit();
            
            $fields = ['email'];
            $employer = getUserDetails(Auth::id(), $fields);
            
            $subject = 'Your job posting is live on Lanxers!';
                
            $message = view('mails.job_posted', [
                'job' => $request->job_title,
                'url'     => route('employer.job.detail.page', $job->slug),
            ])->render();
                
            send_mail($employer->email, $subject, $message);
            
            return response()->json([
                'status' => true,
                'message' => 'Job Posted Successfully.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
