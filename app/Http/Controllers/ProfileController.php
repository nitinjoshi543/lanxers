<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function updatePhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'digits:10', 'regex:/^[6-9]\d{9}$/'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first('phone'),
            ], 422);
        }

        $userId = Auth::id();
        $phone = $request->phone;

        // ✅ Check ki ye number kisi aur account mein already use to nahi ho raha
        $exists = DB::table('users')
            ->where('phone', $phone)
            ->where('id', '!=', $userId)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'This phone number is already registered with another account.',
            ], 422);
        }

        DB::table('users')
            ->where('id', $userId)
            ->update([
                'phone' => $phone,
                'updated_at' => now(),
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Phone number updated successfully.',
        ]);
    }

    public function updateLanguages(Request $request)
    {
        $request->validate([
            'languages' => 'required|array|min:1',
            'languages.*' => 'required|string|in:Basic,Intermediate,Fluent,Native',
        ]);

        $userId = Auth::id();

        DB::table('freelancer_profiles')
            ->where('user_id', $userId)
            ->update([
                'languages' => json_encode($request->languages),
                'updated_at' => now(),
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Languages updated successfully.',
        ]);
    }

    public function updateSocialLinks(Request $request)
    {
        $request->validate([
            'social' => 'nullable|array',
            'social.facebook' => 'nullable|url|max:500',
            'social.linkedin' => 'nullable|url|max:500',
            'social.instagram' => 'nullable|url|max:500',
            'social.twitter' => 'nullable|url|max:500',
        ]);

        $userId = Auth::id();

        DB::transaction(function () use ($request, $userId) {

            // Delete existing social links
            DB::table('freelancer_social_links')
                ->where('user_id', $userId)
                ->delete();

            // Insert new social links
            foreach ($request->social ?? [] as $platform => $url) {

                if (empty($url)) {
                    continue;
                }

                DB::table('freelancer_social_links')->insert([
                    'user_id'    => $userId,
                    'platform'   => $platform,
                    'url'        => $url,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return response()->json([
            'status' => true,
            'message' => 'Social links updated successfully.',
        ]);
    }

    public function searchSkills(Request $request)
    {
        $search = trim($request->search ?? '');

        if (strlen($search) < 2) {
            return response()->json([]);
        }

        $skills = DB::table('skills')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->orderBy('name')
            ->limit(10)
            ->pluck('name');

        return response()->json($skills);
    }

    public function updateSkills(Request $request)
    {
        $request->validate([
            'skills' => 'required|array|min:1',
            'skills.*' => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        DB::transaction(function () use ($request, $userId) {

            // Remove existing user skills
            DB::table('user_skills')
                ->where('user_id', $userId)
                ->delete();

            foreach ($request->skills as $skillName) {

                $skillName = trim($skillName);

                if (!$skillName) {
                    continue;
                }

                // Find skill
                $skill = DB::table('skills')
                    ->where('name', $skillName)
                    ->first();

                // If skill does not exist, create it
                if (!$skill) {
                    $skillId = DB::table('skills')->insertGetId([
                        'name' => $skillName,
                        'slug'       => Str::slug($skillName),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    $skillId = $skill->id;
                }

                // Insert user skill
                DB::table('user_skills')->insert([
                    'user_id' => $userId,
                    'skill_id' => $skillId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return response()->json([
            'status' => true,
            'message' => 'Skills updated successfully.'
        ]);
    }

    public function deleteProject($id)
    {
        $project = DB::table('freelancer_projects')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$project) {
            return response()->json([
                'status' => false,
                'message' => 'Project not found.'
            ], 404);
        }

        DB::table('freelancer_projects')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Project deleted successfully.',
        ]);
    }

    public function saveProject(Request $request)
    {
        $request->validate([
            'project_id' => 'nullable|integer|exists:freelancer_projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $userId = Auth::id();

        if ($request->filled('project_id')) {

            $project = DB::table('freelancer_projects')
                ->where('id', $request->project_id)
                ->where('user_id', $userId)
                ->first();

            if (!$project) {
                return response()->json([
                    'status' => false,
                    'message' => 'Project not found.'
                ], 404);
            }

            DB::table('freelancer_projects')
                ->where('id', $request->project_id)
                ->where('user_id', $userId)
                ->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'updated_at' => now(),
                ]);

            $message = 'Project updated successfully.';
        } else {

            DB::table('freelancer_projects')->insert([
                'user_id' => $userId,
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $message = 'Project added successfully.';
        }

        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    public function searchJobPreference(Request $request)
    {
        $type = $request->get('type');
        $search = trim($request->get('search', ''));

        if (!$search || !in_array($type, ['title', 'location'])) {
            return response()->json([]);
        }

        if ($type === 'title') {

            $results = DB::table('freelancer_job_preferences')
                ->where('title', 'LIKE', '%' . $search . '%')
                ->select('title')
                ->distinct()
                ->orderBy('title')
                ->limit(10)
                ->pluck('title');
        } else {

            $results = DB::table('freelancer_job_preference_locations')
                ->where('location', 'LIKE', '%' . $search . '%')
                ->select('location')
                ->distinct()
                ->orderBy('location')
                ->limit(10)
                ->pluck('location');
        }

        return response()->json($results);
    }

    public function updateJobPreference(Request $request)
    {
        $request->validate([
            'preferred_titles' => 'required|array|min:1',
            'preferred_titles.*' => 'required|string|max:255',

            'preferred_locations' => 'required|array|min:1',
            'preferred_locations.*' => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        DB::transaction(function () use ($request, $userId) {

            // Remove old titles
            DB::table('freelancer_job_preferences')
                ->where('user_id', $userId)
                ->delete();

            // Save new titles
            foreach ($request->preferred_titles as $title) {
                DB::table('freelancer_job_preferences')->insert([
                    'user_id' => $userId,
                    'title' => $title,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Remove old locations
            DB::table('freelancer_job_preference_locations')
                ->where('user_id', $userId)
                ->delete();

            // Save new locations
            foreach ($request->preferred_locations as $location) {
                DB::table('freelancer_job_preference_locations')->insert([
                    'user_id' => $userId,
                    'location' => $location,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return response()->json([
            'status' => true,
            'message' => 'Job preferences updated successfully.'
        ]);
    }

    public function getBasicDetails()
    {
        $userId = Auth::id();

        $data = DB::table('users')
            ->leftJoin(
                'freelancer_profiles',
                'freelancer_profiles.user_id',
                '=',
                'users.id'
            )
            ->where('users.id', $userId)
            ->select([
                'users.name',
                'users.profile_photo',
                'freelancer_profiles.job_title',
                'freelancer_profiles.gender',
                'freelancer_profiles.total_experience',
                'freelancer_profiles.salary',
                'freelancer_profiles.dob',
                'freelancer_profiles.city',
            ])
            ->first();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function updateBasicDetails(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'experience_range' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'dob' => 'required|date',
            'city' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // dd([
        //     'has_file' => $request->hasFile('profile_photo'),
        //     'file' => $request->file('profile_photo'),
        //     'user_id' => Auth::id(),
        // ]);

        $userId = Auth::id();

        $userData = [
            'name' => $request->name,
            'updated_at' => now(),
        ];

        if ($request->hasFile('profile_photo')) {
            // dd($request->hasFile('profile_photo'));
            $userData['profile_photo'] = $this->uploadAndCompressImage(
                $request->file('profile_photo')
            );
        }

        // dd($userData);

        DB::table('users')
            ->where('id', $userId)
            ->update($userData);


        $profileData = [
            'job_title' => $request->job_title,
            'gender' => $request->gender,
            'total_experience' => $request->experience_range,
            'salary' => $request->salary,
            'dob' => $request->dob,
            'city' => $request->city,
            'updated_at' => now(),
        ];

        $profile = DB::table('freelancer_profiles')
            ->where('user_id', $userId)
            ->first();

        if ($profile) {

            DB::table('freelancer_profiles')
                ->where('user_id', $userId)
                ->update($profileData);
        } else {

            $profileData['user_id'] = $userId;
            $profileData['created_at'] = now();

            DB::table('freelancer_profiles')
                ->insert($profileData);
        }

        return response()->json([
            'status' => true,
            'message' => 'Basic details updated successfully.'
        ]);
    }

    public function deleteResume(Request $request)
    {
        $userId = auth()->id();

        $profile = DB::table('freelancer_profiles')
            ->where('user_id', $userId)
            ->first();

        if (!$profile) {
            return response()->json([
                'message' => 'Freelancer profile not found.'
            ], 404);
        }

        if (!$profile->resume) {
            return response()->json([
                'message' => 'No resume found.'
            ], 404);
        }

        // Remove resume from database
        DB::table('freelancer_profiles')
            ->where('user_id', $userId)
            ->update([
                'resume' => null,
                'updated_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Resume deleted successfully.'
        ]);
    }

    public function saveResume(Request $request)
    {
        $request->validate([
            'resume' => [
                'required',
                'file',
                'mimes:pdf',
                'max:5120', // Maximum 5 MB
            ],
        ]);

        $file = $request->file('resume');
        
        $profile = DB::table('freelancer_profiles')
            ->where('user_id', auth()->id())
            ->first();
    
        if (!$profile) {
            return response()->json([
                'status' => false,
                'message' => 'Freelancer profile not found.',
            ], 404);
        }

        // Upload to AWS
        $url = moveDocumentToAws($file);

        if (!$url) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to upload resume.'
            ], 500);
        }

        DB::table('freelancer_profiles')
            ->where('id', $profile->id)
            ->update([
                'resume' => $url,
                'updated_at' => now(),
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Resume uploaded successfully.',
            'resume' => $url,
            'file_name' => $file->getClientOriginalName(),
        ]);
    }

    public function generateProfileSummary(Request $request)
    {
        $currentBio = $request->current_bio;

        // AI API call here

        $summary = 'Generated profile summary will come here.';

        return response()->json([
            'status' => true,
            'summary' => $summary
        ]);
    }

    public function saveProfileSummary(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
        ]);

        $updated = DB::table('freelancer_profiles')
            ->where('user_id', auth()->id())
            ->update([
                'bio' => $request->bio,
                'updated_at' => now(),
            ]);

        if (!$updated) {
            return response()->json([
                'status' => false,
                'message' => 'Profile summary could not be updated.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Profile summary updated successfully.'
        ]);
    }

    public function getEducation($id)
    {
        $education = DB::table('user_educations')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$education) {
            return response()->json([
                'status' => false,
                'message' => 'Education not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'education' => $education
        ]);
    }

    public function saveEducation(Request $request)
    {
        $request->validate([
            'degree'         => 'required|string|max:255',
            'institute'      => 'required|string|max:255',
            'passing_year'   => 'required',
            'education_type' => 'required|string|max:100',
        ]);

        $data = [
            'degree'         => $request->degree,
            'institute'      => $request->institute,
            'passing_year'   => $request->passing_year,
            'education_type' => $request->education_type,
            'updated_at'     => now(),
        ];

        // EDIT
        if ($request->education_id) {

            $updated = DB::table('user_educations')
                ->where('id', $request->education_id)
                ->where('user_id', auth()->id())
                ->update($data);

            if (!$updated) {
                return response()->json([
                    'status' => false,
                    'message' => 'Education not found or nothing was changed.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Education updated successfully.'
            ]);
        }

        // ADD
        $data['user_id'] = auth()->id();
        $data['created_at'] = now();

        DB::table('user_educations')->insert($data);

        return response()->json([
            'status' => true,
            'message' => 'Education added successfully.'
        ]);
    }

    public function getExperience($id)
    {
        $experience = DB::table('user_experiences')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$experience) {
            return response()->json([
                'status' => false,
                'message' => 'Experience not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'experience' => $experience
        ]);
    }

    public function saveExperience(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'salary' => 'required',
            'notice_period' => 'required',
            'industry' => 'required',
            'employment_type' => 'required',
            'description' => 'nullable|string',
        ]);

        $data = [
            'position'         => $request->position,
            'company'          => $request->company,
            'start_date'       => $request->start_date,
            'end_date'         => $request->currently_working ? null : $request->end_date,
            'salary'           => $request->salary,
            'notice_period'    => $request->notice_period,
            'industry'         => $request->industry,
            'employment_type'  => $request->employment_type,
            'description'      => $request->description,
            'updated_at'       => now(),
        ];

        // EDIT
        if ($request->experience_id) {
            $updated = DB::table('user_experiences')
                ->where('id', $request->experience_id)
                ->where('user_id', auth()->id())
                ->update($data);

            if (!$updated) {
                return response()->json([
                    'status' => false,
                    'message' => 'Experience not found or nothing was changed.'
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Experience updated successfully.'
            ]);
        }
        // ADD
        $data['user_id'] = auth()->id();
        $data['created_at'] = now();

        DB::table('user_experiences')->insert($data);

        return response()->json([
            'status' => true,
            'message' => 'Experience added successfully.'
        ]);
    }

    public function showEmployerStartProfile()
    {
        $user = auth()->user();

        $profile = DB::table('employer_profiles as ep')
            ->leftJoin('countries as c', 'c.id', '=', 'ep.country')
            ->leftJoin('users as u', 'u.id', '=', 'ep.user_id')
            ->where('ep.user_id', $user->id)
            ->select(
                'ep.*',
                'c.name as country_name',
                'u.name as user_name',
                'u.email',
                'u.phone','u.email_verified_at'
            )
            ->first();

        return view('employer.profile_start', compact('user', 'profile'));
    }

    public function showEmployerCompleteProfileForm()
    {
        $user = auth()->user();

        $profile = DB::table('employer_profiles as ep')
            ->leftJoin('countries as c', 'c.id', '=', 'ep.country')
            ->leftJoin('users as u', 'u.id', '=', 'ep.user_id')
            ->where('ep.user_id', $user->id)
            ->select(
                'ep.*',
                'c.name as country_name',
                'u.name as user_name',
                'u.email',
                'u.phone'
            )
            ->first();

        return view('employer.complete_profile', compact('user', 'profile'));
    }

    public function showStartProfile()
    {
        return view('freelancer.profile_start');
    }
    
    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:5120',
        ]);
    
        $userId = Auth::id();
        $file = $request->file('resume');
    
        /*
        |--------------------------------------------------------------------------
        | 1. Upload resume to AWS
        |--------------------------------------------------------------------------
        */
    
        $url = moveDocumentToAws($file);
    
        if (!$url) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to upload resume.',
            ], 500);
        }
    
        /*
        |--------------------------------------------------------------------------
        | 2. Send resume to AI parser
        |--------------------------------------------------------------------------
        */
    
        $bytes = file_get_contents($file->getRealPath());
        $fileName = $file->getClientOriginalName();
    
        try {
    
            $response = Http::timeout(90)
                ->withHeaders([
                    'x-api-key' => '852745',
                    'accept'    => 'application/json',
                ])
                ->attach(
                    'file',
                    $bytes,
                    $fileName
                )
                ->post(
                    'https://lanxers-api-414344039975.asia-south1.run.app/upload-resume'
                );
    
            if (!$response->successful()) {
                return response()->json([
                    'status' => false,
                    'message' => 'CV API error: ' . $response->status(),
                ], 500);
            }
    
            $parsed = $response->json();
            $parsed = $parsed['data'] ?? [];
    
        } catch (\Exception $e) {
    
            return response()->json([
                'status' => false,
                'message' => 'CV API unreachable.',
            ], 500);
        }
    
        // dd($parsed);
        
        /*
        |--------------------------------------------------------------------------
        | 3. Save everything
        |--------------------------------------------------------------------------
        */
    
        DB::transaction(function () use ($parsed, $userId, $url) {
    
            /*
            |--------------------------------------------------------------------------
            | Resume
            |--------------------------------------------------------------------------
            */
    
            DB::table('freelancer_profiles')
                ->where('user_id', $userId)
                ->update([
                    'resume' => $url,
                    'updated_at' => now(),
                ]);
    
    
            /*
            |--------------------------------------------------------------------------
            | Basic Details
            |--------------------------------------------------------------------------
            */
    
            // Example:
            // $parsed['name']
            // $parsed['gender']
            // $parsed['experience_range']
            // etc.
    
            if (!empty($parsed['name'])) {
    
                DB::table('users')
                    ->where('id', $userId)
                    ->update([
                        'name' => $parsed['name'],
                        'updated_at' => now(),
                    ]);
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | Freelancer Profile
            |--------------------------------------------------------------------------
            */
    
            $profileData = [
                'updated_at' => now(),
            ];
    
            if (isset($parsed['gender'])) {
                $profileData['gender'] = $parsed['gender'];
            }
    
            if (isset($parsed['experience_range'])) {
                $profileData['total_experience'] = $parsed['experience_range'];
            }
    
            if (isset($parsed['salary'])) {
                $profileData['salary'] = $parsed['salary'];
            }
    
            if (isset($parsed['dob'])) {
                $profileData['dob'] = $parsed['dob'];
            }
    
            if (isset($parsed['city'])) {
                $profileData['city'] = $parsed['city'];
            }
    
            if (isset($parsed['bio'])) {
                $profileData['bio'] = $parsed['bio'];
            }
    
            DB::table('freelancer_profiles')
                ->where('user_id', $userId)
                ->update($profileData);
    
    
            /*
            |--------------------------------------------------------------------------
            | Skills
            |--------------------------------------------------------------------------
            */
    
            if (!empty($parsed['skills']) && is_array($parsed['skills'])) {
    
                DB::table('user_skills')
                    ->where('user_id', $userId)
                    ->delete();
    
                foreach ($parsed['skills'] as $skillName) {
    
                    $skillName = trim($skillName);
    
                    if (!$skillName) {
                        continue;
                    }
    
                    $skill = DB::table('skills')
                        ->where('name', $skillName)
                        ->first();
    
                    if (!$skill) {
    
                        $skillId = DB::table('skills')->insertGetId([
                            'name' => $skillName,
                            'slug' => Str::slug($skillName),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
    
                    } else {
    
                        $skillId = $skill->id;
                    }
    
                    DB::table('user_skills')->insert([
                        'user_id' => $userId,
                        'skill_id' => $skillId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | Education
            |--------------------------------------------------------------------------
            */
    
            if (!empty($parsed['education']) && is_array($parsed['education'])) {
    
                DB::table('user_educations')
                    ->where('user_id', $userId)
                    ->delete();
    
                foreach ($parsed['education'] as $education) {
    
                    DB::table('user_educations')->insert([
                        'user_id' => $userId,
                        'degree' => $education['degree'] ?? null,
                        'institute' => $education['institute'] ?? null,
                        'passing_year' => $education['passing_year'] ?? null,
                        'education_type' => $education['education_type'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | Experience
            |--------------------------------------------------------------------------
            */
    
            if (!empty($parsed['experience']) && is_array($parsed['experience'])) {
    
                DB::table('user_experiences')
                    ->where('user_id', $userId)
                    ->delete();
    
                foreach ($parsed['experience'] as $experience) {
                    
                    $position = trim($experience['designation'] ?? '');
                    $company  = trim($experience['company'] ?? '');
                    $duration = trim($experience['duration'] ?? '');
                    
                    // If required data is missing, skip this experience
                    if (
                        empty($position) ||
                        empty($company) ||
                        empty($duration)
                    ) {
                        continue;
                    }
                    
                    $startDate = null;
                    $endDate   = null;
                    
                    // Normalize different dash characters
                    $duration = str_replace(
                        ['–', '—', '−'],
                        '-',
                        $duration
                    );
            
                    $parts = array_map('trim', explode('-', $duration));
                    
                    if (count($parts) >= 2) {
            
                        $startText = trim($parts[0]);
                        $endText   = trim(implode('-', array_slice($parts, 1)));
            
                        try {
            
                            $startDate = \Carbon\Carbon::parse(
                                '01 ' . $startText
                            )->format('Y-m-d');
            
                        } catch (\Exception $e) {
            
                            // Cannot determine start date
                            continue;
                        }
            
                        if (
                            strtolower($endText) === 'present' ||
                            strtolower($endText) === 'current'
                        ) {
            
                            $endDate = null;
            
                        } else {
            
                            try {
            
                                $endDate = \Carbon\Carbon::parse(
                                    '01 ' . $endText
                                )->format('Y-m-d');
            
                            } catch (\Exception $e) {
            
                                // If end date cannot be parsed,
                                // keep it null.
                                $endDate = null;
                            }
                        }
            
                    } else {
            
                        // Duration format is invalid
                        // Skip this experience.
                        continue;
                    }
    
                    DB::table('user_experiences')->insert([
                        'user_id'          => $userId,
                        'position'         => $position,
                        'company'          => $company,
                        'start_date'       => $startDate,
                        'end_date'         => $endDate,
                        'salary'           => $experience['salary'] ?? null,
                        'notice_period'    => $experience['notice_period'] ?? null,
                        'industry'        => $experience['industry'] ?? null,
                        'employment_type' => $experience['employment_type'] ?? null,
                        'description'     => $experience['description'] ?? null,
                        'created_at'      => now(),
                        'updated_at'      => now(),
                    ]);
                }
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | Job Preferences
            |--------------------------------------------------------------------------
            */
    
            if (!empty($parsed['preferred_titles']) &&
                is_array($parsed['preferred_titles'])) {
    
                DB::table('freelancer_job_preferences')
                    ->where('user_id', $userId)
                    ->delete();
    
                foreach ($parsed['preferred_titles'] as $title) {
    
                    DB::table('freelancer_job_preferences')->insert([
                        'user_id' => $userId,
                        'title' => $title,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
    
            if (!empty($parsed['preferred_locations']) &&
                is_array($parsed['preferred_locations'])) {
    
                DB::table('freelancer_job_preference_locations')
                    ->where('user_id', $userId)
                    ->delete();
    
                foreach ($parsed['preferred_locations'] as $location) {
    
                    DB::table('freelancer_job_preference_locations')->insert([
                        'user_id' => $userId,
                        'location' => $location,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | Social Links
            |--------------------------------------------------------------------------
            */
    
            if (!empty($parsed['social']) && is_array($parsed['social'])) {
    
                DB::table('freelancer_social_links')
                    ->where('user_id', $userId)
                    ->delete();
    
                foreach ($parsed['social'] as $platform => $socialUrl) {
    
                    if (empty($socialUrl)) {
                        continue;
                    }
    
                    DB::table('freelancer_social_links')->insert([
                        'user_id' => $userId,
                        'platform' => $platform,
                        'url' => $socialUrl,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
    
    
            /*
            |--------------------------------------------------------------------------
            | Projects
            |--------------------------------------------------------------------------
            */
    
            if (!empty($parsed['projects']) && is_array($parsed['projects'])) {
    
                DB::table('freelancer_projects')
                    ->where('user_id', $userId)
                    ->delete();
    
                foreach ($parsed['projects'] as $project) {
    
                    DB::table('freelancer_projects')->insert([
                        'user_id' => $userId,
                        'title' => $project['title'] ?? null,
                        'description' => $project['description'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });
    
    
        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */
    
        return response()->json([
            'status' => true,
            'message' => 'Resume uploaded and profile details saved successfully.',
            'resume_url' => $url,
            'parsed' => $parsed,
        ]);
    }

    public function freelancerProfile()
    {
        $freelanceId = Auth::id();

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
                'st.name as state_name','u.profile_complete','fp.resume'
            )
            ->first();

        if (!$freelancer) {
            abort(404);
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

        return view('freelancer.profile', compact('freelancer', 'skills', 'experiences', 'educations', 'preferredTitles', 'preferredLocations', 'projects', 'socialLinks'));
    }

    public function showCompleteProfileForm()
    {
        $user = auth()->user();

        $profile = DB::table('freelancer_profiles')
            ->leftJoin('countries as c', 'c.id', '=', 'freelancer_profiles.country')
            ->where('freelancer_profiles.user_id', $user->id)
            ->select('c.name as country_name')
            ->first();

        $allSkills = DB::table('skills')
            ->where('status', 1)
            ->select('name')
            ->orderBy('name')
            ->get();

        return view('freelancer.complete_profile', compact('user', 'profile', 'allSkills'));
    }


    public function completeProfile(Request $request)
    {
        $validated = $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'designation'   => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'portfolio_url' => 'nullable|url|max:255',
            'about'         => 'required|string|min:50|max:2000',

            'skills'                 => 'required|array|min:1',
            'skills.*'               => 'required|string|max:100',

            'languages'              => 'nullable|array',
            'languages.*.name'       => 'required|string|max:50',
            'languages.*.level'      => 'required|in:Basic,Intermediate,Fluent,Native',

            'experiences'            => 'nullable|array',
            'experiences.*.position' => 'required|string|max:255',
            'experiences.*.type'     => 'required|string|max:30',
            'experiences.*.start'    => 'required|date',
            'experiences.*.end'      => 'nullable|date|after_or_equal:experiences.*.start',
            'experiences.*.desc'     => 'nullable|string|max:1000',
        ], [
            'about.min'       => 'About me kam se kam 50 characters ka hona chahiye',
            'skills.required' => 'Kam se kam ek skill add karo',
        ]);

        $userId = auth()->id();

        /* ---------- STEP 1: Skills (find-or-create, phir link) ---------- */
        DB::table('user_skills')->where('user_id', $userId)->delete();

        foreach ($validated['skills'] as $skillName) {
            $skillName = trim($skillName);
            if (empty($skillName)) {
                continue;
            }

            $skill = DB::table('skills')
                ->whereRaw('LOWER(name) = ?', [strtolower($skillName)])
                ->first();

            $skillId = $skill
                ? $skill->id
                : DB::table('skills')->insertGetId([
                    'name'       => $skillName,
                    'slug'       => Str::slug($skillName),
                    'status'     => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            DB::table('user_skills')->insert([
                'user_id'    => $userId,
                'skill_id'   => $skillId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /* ---------- STEP 2: Experiences ---------- */
        DB::table('user_experiences')->where('user_id', $userId)->delete();

        if (!empty($validated['experiences'])) {
            DB::table('user_experiences')->insert(
                collect($validated['experiences'])->map(fn($e) => [
                    'user_id'         => $userId,
                    'position'        => $e['position'],
                    'employment_type' => $e['type'],
                    'start_date'      => $e['start'],
                    'end_date'        => $e['end'] ?: null,   // NULL = Present
                    'description'     => $e['desc'] ?? null,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ])->all()
            );
        }

        /* ---------- STEP 3: Freelancer profile ---------- */
        $profileData = [
            'job_title'  => $validated['designation'],
            'portfolio'  => $validated['portfolio_url'] ?? null,
            'bio'        => $validated['about'],
            'languages'  => !empty($validated['languages'])
                ? json_encode(
                    collect($validated['languages'])
                        ->mapWithKeys(fn($l) => [strtolower($l['name']) => strtolower($l['level'])])
                        ->all()
                )
                : null,
            'updated_at' => now(),
        ];

        DB::table('freelancer_profiles')->where('user_id', $userId)->update($profileData);

        $profilePhoto = null;

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $this->uploadAndCompressImage($request->file('profile_photo'));
        }

        /* ---------- STEP 4: Flag ---------- */
        $userData = [
            'phone'         => $validated['phone'],
            'profile_complete' => 1,
            'updated_at' => now(),
        ];

        if ($profilePhoto) {
            $userData['profile_photo'] = $profilePhoto;
        }

        DB::table('users')
            ->where('id', $userId)
            ->update($userData);

        return redirect()->route('home')->with('success', 'Profile complete!');
    }

    public function employerProfile()
    {
        $companyId = Auth::id();

        $company = DB::table('users as u')
            ->leftJoin('employer_profiles as ep', 'ep.user_id', '=', 'u.id')
            ->leftJoin('countries as co', 'co.id', '=', 'ep.country')
            ->leftJoin('states as st', 'st.id', '=', 'ep.state')
            ->select(
                'u.*',
                'ep.*',
                'co.name as country_name',
                'st.name as state_name'
            )
            ->where('u.id', $companyId)
            ->first();

        if (!$company) {
            abort(404);
        }

        $documents = DB::table('employer_documents')
            ->where('user_id', $companyId)
            ->get();

        $services = DB::table('employer_services')
            ->where('user_id', $companyId)
            ->get();

        $teamMembers = DB::table('employer_team_members')
            ->where('user_id', $companyId)
            ->get();

        $hiringPreferences = DB::table('employer_hiring_preferences')
            ->where('user_id', $companyId)
            ->first();

        if ($hiringPreferences) {

            $hiringPreferences->preferred_roles =
                is_string($hiringPreferences->preferred_roles)
                ? json_decode($hiringPreferences->preferred_roles, true)
                : ($hiringPreferences->preferred_roles ?? []);

            $hiringPreferences->work_modes =
                is_string($hiringPreferences->work_modes)
                ? json_decode($hiringPreferences->work_modes, true)
                : ($hiringPreferences->work_modes ?? []);

            $hiringPreferences->preferred_locations =
                is_string($hiringPreferences->preferred_locations)
                ? json_decode($hiringPreferences->preferred_locations, true)
                : ($hiringPreferences->preferred_locations ?? []);
        }

        $socialLinks = DB::table('employer_social_links')
            ->where('user_id', $companyId)
            ->get();

        $languages = DB::table('employer_languages')
            ->where('user_id', $companyId)
            ->get();

        $recentJobs = DB::table('project_jobs as pj')
            ->leftJoin('categories as c', 'c.id', '=', 'pj.category_id')
            ->select(
                'pj.*',
                'c.name as category_name',
                DB::raw('(SELECT COUNT(*) FROM proposals p WHERE p.project_job_id = pj.id) as total_proposals')
            )
            ->where('pj.employer_id', $companyId)
            ->where('pj.status', 'open')
            ->orderByDesc('pj.created_at')
            ->limit(3)
            ->get();

        // Attach Skills
        foreach ($recentJobs as $job) {

            $job->skills = DB::table('job_skills as js')
                ->join('skills as s', 's.id', '=', 'js.skill_id')
                ->where('js.project_job_id', $job->id)
                ->orderBy('s.name')
                ->pluck('s.name')
                ->toArray();
        }

        // dd($recentJobs);

        return view('employer.profile', compact(
            'company',
            'documents',
            'services',
            'teamMembers',
            'hiringPreferences',
            'socialLinks',
            'languages',
            'recentJobs'
        ));
    }
    
    public function saveGetStarted(Request $request)
    {
        $userId = Auth::id();
    
        if (!$userId) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated user.'
            ], 401);
        }
    
        $validator = Validator::make($request->all(), [
    
            // STEP 1
            // 'company_name' => [
            //     'nullable',
            //     'string',
            //     'max:255'
            // ],
    
            'email' => [
                'required',
                'email',
                'max:255'
            ],
            
            'phone' => [
                'required',
                'digits:10'
            ],
    
            'email_verified' => [
                'required',
                'boolean'
            ],
    
            // STEP 2
            'organization_name' => [
                'nullable',
                'string',
                'max:255'
            ],
    
            'is_freelancer' => [
                'required',
                'boolean'
            ],
    
            'organization_website' => [
                'nullable',
                'url',
                'max:500'
            ],
    
            'organization_description' => [
                'required',
                'string',
                'max:5000'
            ],
    
            'organization_city' => [
                'required',
                'string',
                'max:255'
            ],
    
            'industry' => [
                'required',
                'string',
                'max:255'
            ],
    
            'employee_count' => [
                'required',
                'string',
                'max:100'
            ],
    
            'organization_logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,gif,bmp',
                'max:1024'
            ],
    
            'documents' => [
                'nullable',
                'array',
                'max:5',
            ],
            
            'documents.*' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],
    
            'no_website' => [
                'required',
                'boolean'
            ],
    
            'no_documents' => [
                'nullable',
                'boolean',
            ],
    
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $profile = DB::table('users')
            ->join('employer_profiles', 'employer_profiles.user_id', '=', 'users.id')
            ->where('users.id', $userId)
            ->select(
                'users.email_verified_at',
                'employer_profiles.company_logo'
            )
            ->first();
    
        if (!$profile) {
            return response()->json([
                'status' => false,
                'message' => 'Employer profile not found.'
            ], 404);
        }
    
        if (empty($profile->email_verified_at)) {
            return response()->json([
                'status' => false,
                'message' => 'Please verify your email address before continuing.'
            ], 422);
        }
    
        $isFreelancer = $request->boolean('is_freelancer');
        $noWebsite = $request->boolean('no_website');
        $noDocuments = $request->boolean('no_documents');
    
        // Organization name required if NOT freelancer
        if (!$isFreelancer && empty(trim($request->organization_name ?? ''))) {
            return response()->json([
                'status' => false,
                'message' => 'Organization name is required.'
            ], 422);
        }
    
        // City required
        if (empty(trim($request->organization_city ?? ''))) {
            return response()->json([
                'status' => false,
                'message' => 'Organization city is required.'
            ], 422);
        }
    
        // Website required if website exists
        if (!$noWebsite && empty(trim($request->organization_website ?? ''))) {
            return response()->json([
                'status' => false,
                'message' => 'Organization website is required.'
            ], 422);
        }
    
        DB::beginTransaction();
    
        try {
    
            $logoPath = $profile->company_logo ?? null;
    
            if ($request->hasFile('organization_logo')) {
    
                $logo = $request->file('organization_logo');
    
                $logoPath = moveDocumentToAws($logo);
            }
    
            DB::table('employer_profiles')
                ->where('user_id', $userId)
                ->update([
    
                    // STEP 2
                    'company_name' => $request->organization_name
                        ? trim($request->organization_name)
                        : null,
    
                    'is_freelancer' => $isFreelancer,
    
                    'website' => $noWebsite
                        ? null
                        : ($request->organization_website
                            ? trim($request->organization_website)
                            : null),
    
                    'about' => $request->organization_description
                        ? trim($request->organization_description)
                        : null,
    
                    'city' => $request->organization_city
                        ? trim($request->organization_city)
                        : null,
    
                    'industry' => $request->industry
                        ? trim($request->industry)
                        : null,
    
                    'company_size' => $request->employee_count
                        ? trim($request->employee_count)
                        : null,
    
                    'company_logo' => $logoPath,
    
                    'updated_at' => now(),
                ]);
    
            if ($request->hasFile('documents')) {
            
                foreach ($request->file('documents') as $document) {
            
                    if (!$document->isValid()) {
                        throw new \RuntimeException('Invalid document upload.');
                    }
            
                    $documentPath = moveDocumentToAws($document);
            
                    DB::table('employer_documents')->insert([
                        'user_id'       => $userId,
                        'document_name' => $document->getClientOriginalName(),
                        'document_path' => $documentPath,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }
            
            DB::table('users')
                ->where('id', $userId)
                ->update([
                    'profile_photo' => $logoPath,
                    'phone' => trim($request->phone),
                    'profile_complete' => 1,
                    'updated_at' => now(),
            ]);
                    
            DB::commit();
    
            return response()->json([
                'status' => true,
                'message' => 'Your employer profile has been saved successfully.',
                'redirect' => route('employer.post.job'),
            ]);
    
        } catch (\Throwable $e) {
    
            DB::rollBack();
    
            Log::error('Employer Get Started Save Error', [
                'user_id' => $userId,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
    
            return response()->json([
                'status' => false,
                'message' => 'Unable to save your details. Please try again.'
            ], 500);
        }
    }

    public function saveBasicDetails(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'company_name'     => ['required', 'string', 'max:255'],
            'website'          => ['required', 'url', 'max:500'],
            'established_date' => ['required', 'date'],
            'city'             => ['required', 'string', 'max:255'],
            'industry'         => ['required', 'string', 'max:255'],
            'company_size'     => ['required', 'string', 'max:100'],
            'profile_photo'    => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        DB::transaction(function () use ($request, $userId) {

            $profileData = [
                'company_name'     => $request->company_name,
                'website'          => $request->website,
                'established_date' => $request->established_date,
                'city'             => $request->city,
                'industry'         => $request->industry,
                'company_size'     => $request->company_size,
                'updated_at'       => now(),
            ];

            $userData = [
                'updated_at' => now(),
            ];

            if ($request->hasFile('profile_photo')) {
                $userData['profile_photo'] = $this->uploadAndCompressImage(
                    $request->file('profile_photo')
                );
            }

            DB::table('users')
                ->where('id', $userId)
                ->update($userData);

            // Update/insert employer profile
            DB::table('employer_profiles')->updateOrInsert(
                ['user_id' => $userId],
                array_merge(
                    ['user_id' => $userId],
                    $profileData
                )
            );
        });

        return response()->json([
            'success' => true,
            'message' => 'Basic details saved successfully.'
        ]);
    }

    public function saveContactDetails(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'phone' => ['required', 'digits:10'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        // Email MUST be verified before update
        if (
            !session('email_verified') ||
            session('email_verified_address') !== $request->email
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Please verify your email with OTP before saving.'
            ], 422);
        }

        // Only after email verification
        DB::table('users')
            ->where('id', $userId)
            ->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'updated_at' => now(),
            ]);

        // Clear OTP verification after successful update
        session()->forget([
            'email_verified',
            'email_verified_address'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contact details updated successfully.'
        ]);
    }

    public function saveCompanyOverview(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'about' => ['required', 'string', 'max:5000'],
        ]);

        DB::table('employer_profiles')
            ->where('user_id', $userId)
            ->update([
                'about' => $request->about,
                'updated_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Company overview saved successfully.'
        ]);
    }

    public function uploadDocuments(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'documents' => ['required', 'array', 'min:1'],
            'documents.*' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:10240'
            ],
        ]);

        foreach ($request->file('documents') as $file) {

            $path = moveDocumentToAws($file);

            DB::table('employer_documents')->insert([
                'user_id'       => $userId,
                'document_name' => $file->getClientOriginalName(),
                'document_path' => $path,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Company documents uploaded successfully.'
        ]);
    }

    public function deleteDocument($id)
    {
        $userId = Auth::id();

        $document = DB::table('employer_documents')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$document) {
            return response()->json([
                'success' => false,
                'message' => 'Document not found.'
            ], 404);
        }

        DB::table('employer_documents')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Company document deleted successfully.'
        ]);
    }

    public function saveServices(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'services' => ['required', 'array', 'min:1'],
            'services.*' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($request, $userId) {

            DB::table('employer_services')
                ->where('user_id', $userId)
                ->delete();

            // Insert selected services
            foreach ($request->services as $service) {

                DB::table('employer_services')->insert([
                    'user_id' => $userId,
                    'service_name' => trim($service),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Services saved successfully.'
        ]);
    }

    public function saveTeamMember(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'designation'     => ['required', 'string', 'max:255'],
            'joining_year'    => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'employment_type' => [
                'required',
                'string',
                'in:Full Time,Part Time,Hybrid,Remote',
            ],
        ]);

        DB::table('employer_team_members')->insert([
            'user_id'         => $userId,
            'name'            => $request->name,
            'designation'     => $request->designation,
            'joining_year'    => $request->joining_year,
            'employment_type' => $request->employment_type,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Team member added successfully.'
        ]);
    }

    public function saveHiringPreferences(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'preferred_roles' => [
                'required',
                'array',
                'min:1',
            ],

            'preferred_roles.*' => [
                'required',
                'string',
                'max:255',
            ],

            'preferred_locations' => [
                'required',
                'array',
                'min:1',
            ],

            'preferred_locations.*' => [
                'required',
                'string',
                'max:255',
            ],

            'work_modes' => [
                'required',
                'array',
                'min:1',
            ],

            'work_modes.*' => [
                'required',
                'string',
                'in:Full Time,Part Time,Hybrid,Remote',
            ],
        ]);

        $existing = DB::table('employer_hiring_preferences')
            ->where('user_id', $userId)
            ->first();

        $data = [
            'preferred_roles' => json_encode(
                array_values(
                    array_unique(
                        array_map('trim', $validated['preferred_roles'])
                    )
                )
            ),

            'work_modes' => json_encode(
                array_values(
                    array_unique($validated['work_modes'])
                )
            ),

            'preferred_locations' => json_encode(
                array_values(
                    array_unique($validated['preferred_locations'])
                )
            ),

            'updated_at' => now(),
        ];

        if (!$existing) {
            $data['user_id'] = $userId;
            $data['created_at'] = now();

            DB::table('employer_hiring_preferences')
                ->insert($data);
        } else {
            DB::table('employer_hiring_preferences')
                ->where('user_id', $userId)
                ->update($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Hiring preferences saved successfully.'
        ]);
    }

    public function saveSocialLinks(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'facebook'  => ['nullable', 'url', 'max:500'],
            'linkedin'  => ['nullable', 'url', 'max:500'],
            'instagram' => ['nullable', 'url', 'max:500'],
            'x'         => ['nullable', 'url', 'max:500'],
        ]);

        DB::transaction(function () use ($validated, $userId) {

            // Remove old social links
            DB::table('employer_social_links')
                ->where('user_id', $userId)
                ->delete();

            $links = [
                'facebook'  => $validated['facebook'] ?? null,
                'linkedin'  => $validated['linkedin'] ?? null,
                'instagram' => $validated['instagram'] ?? null,
                'x'         => $validated['x'] ?? null,
            ];

            foreach ($links as $platform => $url) {

                if (!empty($url)) {
                    DB::table('employer_social_links')->insert([
                        'user_id'    => $userId,
                        'platform'   => $platform,
                        'url'        => trim($url),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Social links saved successfully.'
        ]);
    }

    public function saveLanguages(Request $request)
    {
        $userId = Auth::id();

        $validated = $request->validate([
            'languages' => ['required', 'array', 'min:1'],
            'languages.*' => ['required', 'json'],
        ]);

        $languages = [];

        foreach ($validated['languages'] as $languageJson) {

            $item = json_decode($languageJson, true);

            if (
                !is_array($item) ||
                empty($item['language']) ||
                empty($item['proficiency'])
            ) {
                continue;
            }

            $languages[] = [
                'language' => trim($item['language']),
                'proficiency' => trim($item['proficiency']),
            ];
        }

        if (empty($languages)) {
            return response()->json([
                'success' => false,
                'message' => 'Please add at least one valid language.'
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Remove duplicates
        |--------------------------------------------------------------------------
        */
        $uniqueLanguages = [];

        foreach ($languages as $item) {

            $key = strtolower($item['language']);

            $uniqueLanguages[$key] = $item;
        }

        $languages = array_values($uniqueLanguages);


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */
        DB::transaction(function () use ($languages, $userId) {

            /*
            |--------------------------------------------------------------------------
            | Delete existing languages
            |--------------------------------------------------------------------------
            */
            DB::table('employer_languages')
                ->where('user_id', $userId)
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | Insert current languages
            |--------------------------------------------------------------------------
            */
            foreach ($languages as $item) {

                DB::table('employer_languages')->insert([
                    'user_id' => $userId,
                    'language' => $item['language'],
                    'proficiency' => $item['proficiency'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });


        return response()->json([
            'success' => true,
            'message' => 'Languages saved successfully.'
        ]);
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

    public function completeEmployerProfile(Request $request)
    {
        $userId = auth()->id();

        $profile = DB::table('employer_profiles')
            ->where('user_id', $userId)
            ->first();

        $rules = [
            'phone'            => 'required|digits_between:10,15',
            'website'          => 'required|url',
            'industry'         => 'required|string',
            'company_size'     => 'required|string',
            'about'            => 'required|string|min:30|max:1000',
            'pan_card'         => ['required', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/'],
            'profile_photo'           => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ];

        $rules['company_documents'] = 'required|array|min:1|max:10';

        $rules['company_documents.*'] =
            'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240';

        if ($profile->employer_type == 0) {
            $rules['gst_number'] = [
                'required',
                'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'
            ];
        }

        $validated = $request->validate($rules);

        DB::table('employer_profiles')
            ->where('user_id', $userId)
            ->update([
                'website'          => $validated['website'] ?? null,
                'industry'         => $validated['industry'],
                'company_size'     => $validated['company_size'],
                'about'            => $validated['about'],
                'pan_card'         => strtoupper($validated['pan_card']),
                'gst_number'       => $profile->employer_type == 0
                    ? strtoupper($validated['gst_number'])
                    : null,
                'updated_at'       => now(),
            ]);


        foreach ($request->file('company_documents') as $file) {

            $documentPath = moveDocumentToAws($file);

            DB::table('employer_documents')->insert([
                'user_id'       => $userId,
                'document_name' => $file->getClientOriginalName(),
                'document_path' => $documentPath,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }


        DB::table('users')
            ->where('id', $userId)
            ->update([
                'profile_photo' => $this->uploadAndCompressImage($request->file('profile_photo')),
                'phone'         => $validated['phone'],
                'profile_complete' => 1,
                'updated_at' => now(),
            ]);

        return redirect()
            ->route('home')
            ->with('success', 'Profile completed successfully.');
    }
}
