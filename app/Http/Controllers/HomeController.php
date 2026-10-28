<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\UserSession;

class HomeController extends Controller
{
    public function showSetPassword()
    {
        $user = DB::table('users')
            ->where('id', Auth::id())
            ->select('id', 'password_changed')
            ->first();

        if (!$user) {
            return redirect()->route('login');
        }

        if ((int) $user->password_changed === 1) {
            return redirect()->route('home');
        }

        return view('set_password');
    }

    public function setPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 'validation',
                'errors' => $validator->errors(),
            ], 422);
        }


        $user = DB::table('users')
            ->where('id', Auth::id())
            ->select('id', 'password_changed')
            ->first();

        if (!$user) {

            return response()->json([
                'status' => 'error',
                'message' => 'Your session has expired. Please login again.',
            ], 401);
        }


        if ((int) $user->password_changed === 1) {

            return response()->json([
                'status' => 'error',
                'message' => 'Your password has already been changed.',
            ], 422);
        }


        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->password),
                'password_changed' => 1,
                'updated_at' => now(),
            ]);


        return response()->json([
            'status' => 'success',
            'message' => 'Your password has been updated successfully.',
            'redirect' => route('home'),
        ]);
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first('email'),
            ], 422);
        }

        $email = strtolower(trim($request->email));

        $existingUser = DB::table('users')->where('email', $email)->first();

        // Case 1: user exists AND already verified -> don't send OTP, tell frontend to show verified state
        if ($existingUser && !is_null($existingUser->email_verified_at)) {
            session([
                'getstarted_email_verified' => true,
                'getstarted_verified_email' => $email,
            ]);

            return response()->json([
                'status' => true,
                'verified' => true,
                'message' => 'This email is already verified.',
            ]);
        }

        // Case 2: user doesn't exist, OR exists but not verified -> send OTP normally
        $otp = random_int(100000, 999999);

        session([
            'getstarted_otp' => $otp,
            'getstarted_otp_email' => $email,
            'getstarted_otp_expires_at' => now()->addMinutes(10),
            'getstarted_email_verified' => false,
        ]);

        try {
            send_mail($email, 'Email Verification OTP', "Your verification OTP is: {$otp}. This OTP is valid for 10 minutes.");

            return response()->json([
                'status' => true,
                'verified' => false,
                'message' => 'OTP has been sent to your email address.',
            ]);
        } catch (\Exception $e) {
            Log::error('GetStarted OTP email failed', ['email' => $email, 'error' => $e->getMessage()]);
            return response()->json(['status' => false, 'message' => 'Unable to send OTP. Please try again.'], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'otp' => ['required', 'digits:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $email = strtolower(trim($request->email));
        $otp = trim($request->otp);

        if (!session()->has('getstarted_otp')) {
            return response()->json(['status' => false, 'message' => 'OTP not found. Please request a new OTP.'], 422);
        }

        if (session('getstarted_otp_email') !== $email) {
            return response()->json(['status' => false, 'message' => 'Email address does not match the OTP request.'], 422);
        }

        if (!session('getstarted_otp_expires_at') || now()->greaterThan(session('getstarted_otp_expires_at'))) {
            session()->forget(['getstarted_otp', 'getstarted_otp_email', 'getstarted_otp_expires_at']);
            return response()->json(['status' => false, 'message' => 'OTP has expired. Please request a new OTP.'], 422);
        }

        if ((string) session('getstarted_otp') !== $otp) {
            return response()->json(['status' => false, 'message' => 'Invalid OTP. Please enter the correct OTP.'], 422);
        }

        session([
            'getstarted_email_verified' => true,
            'getstarted_verified_email' => $email,
        ]);

        session()->forget(['getstarted_otp', 'getstarted_otp_email', 'getstarted_otp_expires_at']);

        return response()->json(['status' => true, 'message' => 'Email verified successfully.']);
    }

    public function store(Request $request)
    {
        // Step 1: Validate
        $validator = Validator::make($request->all(), [
            'name'   => ['required', 'string', 'max:30'],
            'email'  => ['required', 'email', 'max:255'],
            'phone'  => ['required', 'digits_between:8,12'],
            'role'   => ['required', 'string', 'max:100'],
            'resume' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'job_id' => ['nullable', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = strtolower(trim($request->email));

        if (!session('getstarted_email_verified') || session('getstarted_verified_email') !== $email) {
            return response()->json([
                'status' => false,
                'message' => 'Please verify your email address first.',
            ], 422);
        }

        $existingUser = DB::table('users')->where('email', $email)->first();
        $isNewUser = !$existingUser;

        $shouldSendPassword = $isNewUser
            ? true
            : ((int) $existingUser->password_changed === 0);

        $newPassword = null;
        if ($shouldSendPassword) {
            $newPassword = \Illuminate\Support\Str::password(12, letters: true, numbers: true, symbols: false);
            $password = Hash::make($newPassword);
        }

        $resumePath = moveDocumentToAws($request->file('resume'), 'resumes');

        if ($isNewUser) {
            $userId = DB::table('users')->insertGetId([
                'name' => trim($request->name),
                'email' => $email,
                'phone' => trim($request->phone),
                'password' => $password,
                'password_changed' => 0,
                'role' => 'freelancer',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $existingUser->id;

            $updateData = [
                'name' => trim($request->name),
                'phone' => trim($request->phone),
                'email_verified_at' => now(),
                'updated_at' => now(),
            ];

            if ($shouldSendPassword) {
                $updateData['password'] = $password;
            }

            DB::table('users')->where('id', $userId)->update($updateData);
        }

        // Store complete Get Started form submission
        DB::table('get_started_submissions')->insert([
            'user_id' => $userId,
            'job_id' => $request->job_id ?: null,
            'name' => trim($request->name),
            'email' => $email,
            'phone' => trim($request->phone),
            'role' => trim($request->role),
            'resume' => $resumePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('freelancer_profiles')->updateOrInsert(
            ['user_id' => $userId],
            [
                'job_title' => trim($request->role),
                'resume' => $resumePath,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        if ($shouldSendPassword) {
            try {
                $subject = 'Your Lanxers Account Login Details';

                $message = "Hello {$request->name},\n\n"
                    . "Your account has been created successfully.\n\n"
                    . "Login Email: {$email}\n"
                    . "Password: {$password}\n\n"
                    . "Please keep your login details secure.\n\n"
                    . "Regards,\n"
                    . "Lanxers";

                send_mail($email, $subject, $message);
            } catch (\Exception $e) {
                Log::error('GetStarted welcome mail failed', [
                    'user_id' => $userId,
                    'email' => $email,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        DB::table('user_sessions')->updateOrInsert(
            ['session_id' => session()->getId()],
            [
                'user_id' => $userId,
                'role' => 'freelancer',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'last_activity' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        session()->forget(['getstarted_email_verified', 'getstarted_verified_email']);

        $redirectUrl = null;

        if ($request->filled('job_id')) {
            $job = DB::table('external_jobs')
                ->where('id', $request->job_id)
                ->first();

            if ($job) {
                $redirectUrl = $job->url;
            }
        }

        return response()->json([
            'status' => true,
            'message' => $shouldSendPassword
                ? 'Your account has been created successfully. Login details have been sent to your email.'
                : 'Your profile has been submitted successfully.',
            'redirect_url' => $redirectUrl,
        ]);
    }

    public function getLinkedinJobs()
    {
        $response = getLinkedInJobs();
        $jobs = json_decode($response);

        foreach ($jobs as $job) {
            $data[] = [
                'job_id'       => $job->id,
                'title'        => $job->title,
                'organization' => $job->organization,
                'location'     => $job->locations_derived[0] ?? null,
                'url'          => $job->url,
                'posted_at'    => $job->date_posted,
            ];
        }

        dd($data);
    }

    public function index()
    {
        $fields = ['id', 'name', 'position', 'image', 'description'];
        $getTestimonial = Home_model::getTestimonials($fields);

        return view('home', compact('getTestimonial'));
    }

    public function knowUs()
    {
        return view('know_us');
    }

    public function contactUs()
    {
        return view('contact_us');
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

    public function register()
    {
        $countries = DB::table('countries')
            ->select('id', 'name')
            ->orderByRaw('id = 101 DESC')   // India top pe
            ->orderBy('name')
            ->get();
            
        return view('register', compact('countries'));
    }
    
    public function signup(Request $request)
    {
        try {
            
            $validated = $request->validate([
                'name'       => 'required|string|max:255',
                'email'      => 'required|email|max:255|unique:users,email',
                'password'   => 'required|min:6',
                'country_id' => 'required|exists:countries,id',
                'state_id'   => [
                    'required',
                    Rule::exists('states', 'id')->where('country_id', $request->country_id),
                ],
                'role' => 'required|in:freelancer,employer',
                'agree'      => 'accepted',
            ], [
                'email.email'  => 'please add valid credential',
                'email.unique' => 'email is already registered.',
            ]);
        
            // Log::info('Signup validation passed', $validated);

            $user = DB::transaction(function () use ($validated) {
                $user = User::create([
                    'name'     => $validated['name'],
                    'email'    => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role'     => $validated['role'],
                    'created_at' => now(),
                ]);
                
                if($validated['role'] == 'freelancer')
                {
                    DB::table('freelancer_profiles')->insert([
                        'user_id'    => $user->id,
                        'country' => $validated['country_id'],
                        'state'   => $validated['state_id'],
                        'created_at' => now(),
                    ]);
                }else if($validated['role'] == 'employer')
                {
                    DB::table('employer_profiles')->insert([
                        'user_id'    => $user->id,
                        // 'employer_type' => $validated['employer_type'],
                        // 'company_name' => $validated['company_name'],
                        'country' => $validated['country_id'],
                        'state'   => $validated['state_id'],
                        'created_at' => now(),
                    ]);
                }

                return $user;
            });
            
            // Log::info('User created', [
            //     'user_id' => $user->id,
            //     'role'    => $user->role,
            // ]);

            Auth::login($user);
            $request->session()->regenerate();

            UserSession::create([
                'user_id'       => $user->id,
                'role'          => $user->role,
                'session_id'    => session()->getId(),
                'ip_address'    => $request->ip(),
                'user_agent'    => $request->userAgent(),
                'last_activity' => now(),
            ]);
            
            if ($validated['role'] === 'freelancer') {
                return redirect()
                    ->route('freelancer.profile.start')
                    ->with('success', 'Account created! Let\'s complete your profile.');
            }
    
            return redirect()
                ->route('employer.profile.start')
                ->with('success', 'Account created! Let\'s complete your profile.');
        } catch (\Throwable $e) {
            Log::error('Signup failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->route('register')
                ->withInput($request->except('password'))
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function termsAndConditions()
    {
        return view('terms_and_conditions');
    }

    public function userAgreement()
    {
        return view('user_agreement');
    }

    public function privacyPolicy()
    {
        return view('privacy_policy');
    }

    public function showForgot()
    {
        return view('forget_password');
    }

    public function sendReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = trim($request->email);

        // registered email hai ya nahi
        $user = DB::table('users')->where('email', $email)->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'No account is associated with the provided email address. Please verify your email and try again.'], 404);
        }

        // cooldown: last token 10 min ke andar bheja to reject
        $existing = DB::table('password_reset_tokens')->where('email', $email)->first();
        if ($existing) {
            $expiry = config('constants.reset_expiry');

            $elapsed = Carbon::parse($existing->created_at)->diffInSeconds(now());
            if ($elapsed < $expiry) {   // 10 min
                $waitMin = ceil(($expiry - $elapsed) / 60);  // kitne minute bache
                return response()->json([
                    'status'  => 'cooldown',
                    'message' => "A password reset request has already been submitted. Please wait {$waitMin} minute(s) before requesting another reset link.",
                ], 429);
            }
        }

        // token: raw URL mein jayega, DB mein hashed store hoga
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $link = route('password.reset', ['token' => $token, 'email' => $email]);

        $header_ref  = 'Lanxers Forgot Password';
        $message_ref = View::make('mails.forgot_passowrd', [
            'link'  => $link,
            'token' => $token,
        ])->render();

        send_mail($email, $header_ref, $message_ref);   // @ removed

        return response()->json([
            'status'       => 'success',
            'message'      => 'A password reset link has been sent to your registered email address. Please check your inbox.',
            'seconds_left' => config('constants.reset_expiry'),   // 10 min
        ]);
    }

    public function showReset($token)
    {
        $email = request('email');

        if (!$email) {
            return view('password_expired', [
                'message' => 'Invalid password reset link.'
            ]);
        }

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        // Token doesn't exist (already used or invalid)
        if (!$record) {
            return view('password_expired', [
                'message' => 'This password reset link is invalid or has already been used.'
            ]);
        }

        // Token expired
        if (Carbon::parse($record->created_at)->addSeconds(config('constants.reset_expiry'))->isPast()) {
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();

            return view('password_expired', [
                'message' => 'This password reset link has expired. Please request a new one.'
            ]);
        }

        // Token doesn't match
        if (!Hash::check($token, $record->token)) {
            return view('password_expired', [
                'message' => 'This password reset link is invalid.'
            ]);
        }

        return view('reset_password', ['token' => $token, 'email' => $email]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'validation',
                'errors' => $validator->errors(),
            ], 422);
        }

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record) {
            return response()->json([
                'status' => 'error',
                'message' => 'This password reset link is invalid or has already been used.'
            ], 422);
        }

        if (Carbon::parse($record->created_at)
            ->addSeconds(config('constants.reset_expiry'))
            ->isPast()
        ) {

            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            return response()->json([
                'status' => 'error',
                'message' => 'This password reset link has expired. Please request a new password reset link.'
            ], 422);
        }

        if (!Hash::check($request->token, $record->token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The password reset link is invalid.'
            ], 422);
        }

        DB::table('users')
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password),
                'updated_at' => now()
            ]);

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Your password has been updated successfully.',
            'redirect' => route('login')
        ]);
    }
}
