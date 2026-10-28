<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class TalentController extends Controller
{
    public function index()
    {
        return view('talent.index');
    }

    public function salesPage()
    {
        return view('talent.sales_index');
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'max:255',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first('email'),
            ], 422);
        }

        $email = strtolower(trim($request->email));

        $existingUser = DB::table('users')
            ->where('email', $email)
            ->exists();

        if ($existingUser) {
            session()->put('talent_email_verified', true);
            session()->put('talent_verified_email', $email);

            return response()->json([
                'status' => true,
                'existing_user' => true,
                'message' => 'Email already verified.',
            ]);
        }

        /*
        * Generate 6 digit OTP
        */
        $otp = random_int(100000, 999999);

        /*
        * Store OTP in session
        */
        session([
            'talent_otp' => $otp,
            'talent_otp_email' => $email,
            'talent_otp_expires_at' => now()->addMinutes(5),
            'talent_email_verified' => false,
        ]);

        try {
            
            $subject = 'Verify Your Email Address - Lanxers';
                
            $message = view('mails.email-verification', [
                'otp' => $otp,
            ])->render();
                
            send_mail($email, $subject, $message);

            // $subject = 'Lanxers email verification';

            // $message = "
            // Dear user,<br><br>

            // Your email verification code is<br>
            // <strong style='font-size:20px;'>{$otp}</strong><br><br>

            // It will be valid for 5 minutes. To protect your details, do not disclose this to anyone.<br><br>

            // Regards,<br>
            // Lanxers<br><br>

            // This email is sent by the system automatically. Please do not reply. Thank you!
            // ";

            // send_mail($email, $subject, $message);

            return response()->json([
                'status' => true,
                'message' => 'OTP has been sent to your email address.',
            ]);
        } catch (\Exception $e) {

            Log::error('talent OTP email failed', [
                'email' => $email,
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Unable to send OTP. Please try again.',
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
            ],
            'otp' => [
                'required',
                'digits:6',
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $email = strtolower(trim($request->email));
        $otp = trim($request->otp);

        // Check OTP exists
        if (!session()->has('talent_otp')) {
            return response()->json([
                'status' => false,
                'message' => 'OTP not found. Please request a new OTP.',
            ], 422);
        }

        // Check email matches the email for which OTP was sent
        if (session('talent_otp_email') !== $email) {
            return response()->json([
                'status' => false,
                'message' => 'Email address does not match the OTP request.',
            ], 422);
        }

        // Check OTP expiry
        if (
            !session('talent_otp_expires_at') ||
            now()->greaterThan(session('talent_otp_expires_at'))
        ) {
            session()->forget([
                'talent_otp',
                'talent_otp_email',
                'talent_otp_expires_at',
            ]);

            return response()->json([
                'status' => false,
                'message' => 'OTP has expired. Please request a new OTP.',
            ], 422);
        }

        // Check OTP
        if ((string) session('talent_otp') !== $otp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please enter the correct OTP.',
            ], 422);
        }

        // OTP verified
        session([
            'talent_email_verified' => true,
            'talent_verified_email' => $email,
        ]);

        // Remove OTP after successful verification
        session()->forget([
            'talent_otp',
            'talent_otp_email',
            'talent_otp_expires_at',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Email verified successfully.',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'required',
                'digits:10',
            ],

            'looking_for' => [
                'required',
                'in:job,internship,freelancer',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            'current_profile' => [
                'required',
                'in:student_fresher,freelancer,working_professional,not_working',
            ],

            'preferred_roles' => [
                'required',
                'string',
                'max:255',
            ],
            
            'portfolio_link' => [
                'nullable',
                'url',
                'max:500',
            ],

            'cv' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120',
            ],

            // 'skills' => [
            //     'required',
            //     'array',
            //     'min:1',
            // ],

            // 'skills.*' => [
            //     'string',
            //     'max:100',
            // ],
        ], [
            'cv.max' => 'The CV file must not be greater than 5 MB.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $email = strtolower(trim($request->email));

        $existingUser = DB::table('users')
            ->where('email', $email)
            ->first();

        if ($existingUser) {
            // Existing user found.
            // Do NOT create a new users record.
            $userId = $existingUser->id;
        } else {
            // New user - OTP verification is required.
            if (
                !session('talent_email_verified') ||
                session('talent_verified_email') !== $email
            ) {
                return back()
                    ->withErrors([
                        'email' => 'Please verify your email address first.',
                    ])
                    ->withInput();
            }

            $password = \Illuminate\Support\Str::password(
                length: 12,
                letters: true,
                numbers: true,
                symbols: false
            );

            $userId = DB::table('users')->insertGetId([
                'name' => trim($request->name),
                'email' => $email,
                'phone' => trim($request->phone),
                'password' => Hash::make($password),
                'password_changed' => 0,
                'role' => 'freelancer',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'webview' => 1,
            ]);
        }
        
        $userRole = DB::table('users')
        ->where('id', $userId)
        ->value('role');

        if (
            $userRole === 'freelancer' &&
            !DB::table('freelancer_profiles')
                ->where('user_id', $userId)
                ->exists()
        ) {
            DB::table('freelancer_profiles')->insert([
                'user_id' => $userId,
                'gender' => null,
                'job_title' => trim($request->preferred_roles),
                'bio' => null,
                'hourly_rate' => 0.00,
                'total_experience' => null,
                'salary' => null,
                'country' => null,
                'state' => null,
                'city' => null,
                'languages' => null,
                'resume' => null,
                'available_for_work' => 1,
                'website' => null,
                'linkedin' => null,
                'github' => null,
                'portfolio' => null,
                'profile_level' => null,
                'account_status' => 'approve',
                'created_at' => now(),
                'updated_at' => now(),
                'ai_rating' => 0.00,
                'ai_level' => null,
                'ai_interview_at' => null,
                'latest_ai_interview_id' => null,
                'dob' => null,
            ]);
        }

        /*
        * Upload CV to AWS
        */
        $cvPath = null;

        if ($request->hasFile('cv')) {
            $cvPath = moveDocumentToAws($request->file('cv'));
        }
        
        if (!empty($cvPath)) {
            DB::table('freelancer_profiles')
                ->where('user_id', $userId)
                ->update([
                    'resume' => $cvPath,
                    'updated_at' => now(),
                ]);
        }


        /*
        * Create talent Profile
        */
        DB::table('talent_profiles')->insert([
            'user_id' => $userId,
            'looking_for' => $request->looking_for,
            'city' => trim($request->city),
            'current_profile' => $request->current_profile,
            // 'skills' => json_encode($request->skills),
            'preferred_roles' => trim($request->preferred_roles),
            'portfolio_link' => $request->filled('portfolio_link')
                ? trim($request->portfolio_link)
                : null,
            'cv' => $cvPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        /*
        * Send Login Details
        */
        if (!$existingUser) {
            try {
                
                $subject = 'Your login credentials';
                
                $message = view('mails.login-credentials', [
                    'email' => $email,
                    'password' => $password,
                ])->render();
                
                send_mail($email, $subject, $message);

                // $subject = 'Your login credentials';

                // $message = "Dear user,<br><br>"
                //     . "Your account has been created successfully. Please find your login credentials below:<br><br>"
                //     . "User ID: {$email}<br>"
                //     . "Password: {$password}<br><br>"
                //     . "Note: Please log in using the password provided above first. Once logged in, you can change your password from your account settings.<br><br>"
                //     . "Regards,<br>"
                //     . "Lanxers";

                // send_mail($email, $subject, $message);
            } catch (\Exception $e) {

                Log::error('talent account email failed', [
                    'user_id' => $userId,
                    'email' => $email,
                    'error' => $e->getMessage(),
                ]);
            }
        }


        /*
        * Clear Email Verification Session
        */
        session()->forget([
            'talent_email_verified',
            'talent_verified_email',
        ]);

        // Allow thank-you page only after successful submission
        session()->put('talent_submission_completed', true);

        /*
        * Redirect
        */
        return redirect()
            ->route('talent.thankyou')
            ->with(
                'success',
                'Your account has been created successfully. Login details have been sent to your email.'
            );
    }

    public function storeSales(Request $request)
    {
        // Honeypot: bot ho to chupchap ruk jao
        if ($request->filled('website_url')) {
            return back();
        }

        // Blade ki list ke same rakhna
        $roleOptions = [
            'Client Service Manager',
            'Business Development Manager',
            'Sales Manager',
            'Sales Development Representative',
            'Sales Team Lead',
            'Sales Consultant',
        ];
        $maxRoles = 7;

        $validator = Validator::make($request->all(), [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['required', 'digits:10'],
            'city'  => ['required', 'string', 'max:100'],

            'preferred_roles' => [
                'required', 'string', 'max:500',
                function ($attribute, $value, $fail) use ($roleOptions, $maxRoles) {
                    $chosen = array_values(array_filter(array_map('trim', explode(',', (string) $value))));

                    if (count($chosen) === 0)                            return $fail('Please select at least one role.');
                    if (count($chosen) > $maxRoles)                      return $fail("You can select up to {$maxRoles} roles.");
                    if (count($chosen) !== count(array_unique($chosen))) return $fail('Duplicate roles are not allowed.');
                    if (array_diff($chosen, $roleOptions))               return $fail('Invalid role selected.');
                },
            ],

            'portfolio_link' => ['nullable', 'url:http,https', 'max:500'],

            'cv' => [
                'required', 'file', 'mimes:pdf,doc,docx',
                'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'max:5120',
            ],
        ], [
            'cv.max' => 'The CV file must not be greater than 5 MB.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = strtolower(trim($request->email));

        // OTP verification sabke liye (new + existing user)
        if (!session('talent_email_verified') || session('talent_verified_email') !== $email) {
            return back()
                ->withErrors(['email' => 'Please verify your email address first.'])
                ->withInput();
        }

        // Clean roles
        $roles          = collect(explode(',', $request->preferred_roles))
                            ->map(fn ($r) => trim($r))->filter()->unique()->values();
        $preferredRoles = $roles->implode(',');
        $primaryRole    = $roles->first(); // freelancer_profiles.job_title ke liye

        // CV upload (transaction se bahar)
        try {
            $cvPath = moveDocumentToAws($request->file('cv'));
        } catch (\Throwable $e) {
            Log::error('talent cv upload failed', ['email' => $email, 'error' => $e->getMessage()]);
            return back()->withErrors(['cv' => 'CV upload failed. Please try again.'])->withInput();
        }

        $password  = null;
        $isNewUser = false;

        try {
            $userId = DB::transaction(function () use ($request, $email, $preferredRoles, $primaryRole, $cvPath, &$password, &$isNewUser) {

                $existingUser = DB::table('users')->where('email', $email)->lockForUpdate()->first();

                if ($existingUser) {
                    $userId = $existingUser->id;
                    $role   = $existingUser->role;
                } else {
                    $isNewUser = true;
                    $password  = Str::password(length: 12, letters: true, numbers: true, symbols: false);

                    $userId = DB::table('users')->insertGetId([
                        'name'              => trim($request->name),
                        'email'             => $email,
                        'phone'             => trim($request->phone),
                        'password'          => Hash::make($password),
                        'password_changed'  => 0,
                        'role'              => 'freelancer',
                        'email_verified_at' => now(),
                        'created_at'        => now(),
                        'updated_at'        => now(),
                        'webview'           => 1,
                    ]);
                    $role = 'freelancer';
                }

                if ($role === 'freelancer') {
                    if (DB::table('freelancer_profiles')->where('user_id', $userId)->exists()) {
                        DB::table('freelancer_profiles')->where('user_id', $userId)->update([
                            'resume'     => $cvPath,
                            'updated_at' => now(),
                        ]);
                    } else {
                        DB::table('freelancer_profiles')->insert([
                            'user_id'            => $userId,
                            'job_title'          => $primaryRole,
                            'hourly_rate'        => 0.00,
                            'available_for_work' => 1,
                            'account_status'     => 'approve',
                            'ai_rating'          => 0.00,
                            'resume'             => $cvPath,
                            'created_at'         => now(),
                            'updated_at'         => now(),
                        ]);
                    }
                }

                // Ek user = ek talent row
                $data = [
                    'city'            => trim($request->city),
                    'preferred_roles' => $preferredRoles,
                    'portfolio_link'  => $request->filled('portfolio_link') ? trim($request->portfolio_link) : null,
                    'cv'              => $cvPath,
                    'updated_at'      => now(),
                ];

                if (DB::table('talent_profiles')->where('user_id', $userId)->exists()) {
                    DB::table('talent_profiles')->where('user_id', $userId)->update($data);
                } else {
                    DB::table('talent_profiles')->insert($data + ['user_id' => $userId, 'created_at' => now()]);
                }

                return $userId;
            });
        } catch (\Throwable $e) {
            Log::error('talent submit failed', ['email' => $email, 'error' => $e->getMessage()]);
            return back()
                ->withErrors(['error' => 'Something went wrong. Please try again.'])
                ->withInput();
        }

        // Login details sirf naye user ko, commit ke baad
        if ($isNewUser && $password) {
            try {
                $subject = 'Your login credentials';
                
                $message = view('mails.login-credentials', [
                    'email' => $email,
                    'password' => $password,
                ])->render();
                
                send_mail($email, $subject, $message);
                
                // $message = "Dear user,<br><br>"
                //     . "Your account has been created successfully. Please find your login credentials below:<br><br>"
                //     . "User ID: {$email}<br>"
                //     . "Password: {$password}<br><br>"
                //     . "Note: Please log in using the password provided above first. Once logged in, you can change your password from your account settings.<br><br>"
                //     . "Regards,<br>Lanxers";

                // send_mail($email, 'Your login credentials', $message);
            } catch (\Throwable $e) {
                Log::error('talent account email failed', ['user_id' => $userId, 'error' => $e->getMessage()]);
            }
        }

        session()->forget(['talent_email_verified', 'talent_verified_email']);
        session()->regenerate();
        session()->put('talent_submission_completed', true);

        return redirect()
            ->route('talent.thankyou')
            ->with('success', 'Your details have been submitted successfully.');
    }
}
