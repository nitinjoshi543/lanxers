<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class FreelancerAuthController extends Controller
{

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
            return response()->json([
                'status' => false,
                'message' => 'OTP not found. Please request a new OTP.'
            ], 422);
        }

        if (session('getstarted_otp_email') !== $email) {
            return response()->json([
                'status' => false,
                'message' => 'Email address does not match the OTP request.'
            ], 422);
        }

        if (
            !session('getstarted_otp_expires_at') ||
            now()->greaterThan(session('getstarted_otp_expires_at'))
        ) {
            session()->forget([
                'getstarted_otp',
                'getstarted_otp_email',
                'getstarted_otp_expires_at'
            ]);

            return response()->json([
                'status' => false,
                'message' => 'OTP has expired. Please request a new OTP.'
            ], 422);
        }

        if ((string) session('getstarted_otp') !== $otp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please enter the correct OTP.'
            ], 422);
        }

        $userId = Auth::id();

        DB::table('users')
            ->where('id', $userId)
            ->update([
                'email_verified_at' => now(),
                'updated_at' => now(),
            ]);

        session([
            'email_verified' => true,
            'email_verified_address' => $email,
            'getstarted_email_verified' => true,
        ]);

        session()->forget([
            'getstarted_otp',
            'getstarted_otp_email',
            'getstarted_otp_expires_at'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Email verified successfully.',
            'verified' => true,
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
        $userId = Auth::id();

        // ✅ security: submitted email authenticated user ka khud ka email hona chahiye
        $user = DB::table('users')->where('id', $userId)->first();

        if (!$user || strtolower($user->email) !== $email) {
            return response()->json([
                'status' => false,
                'message' => 'This email does not match your account.',
            ], 422);
        }

        // ✅ FIX: ab yahi table check karega jo verify mein update hoti hai
        if (!empty($user->email_verified_at)) {
            return response()->json([
                'status' => true,
                'verified' => true,
                'message' => 'Email is already verified.',
            ]);
        }

        if (session()->has('getstarted_otp_sent_at')) {
            $sentAt = session('getstarted_otp_sent_at');

            if ($sentAt) {
                $sentAt = \Carbon\Carbon::parse($sentAt);
                $elapsedSeconds = now()->timestamp - $sentAt->timestamp;

                if ($elapsedSeconds < 300) {
                    $remaining = max(0, 300 - $elapsedSeconds);

                    return response()->json([
                        'status' => false,
                        'message' => 'Please wait before requesting another OTP.',
                        'remaining_seconds' => $remaining,
                    ], 429);
                }
            }
        }

        $otp = random_int(100000, 999999);

        session([
            'getstarted_otp' => $otp,
            'getstarted_otp_email' => $email,
            'getstarted_otp_expires_at' => now()->addMinutes(10),
            'getstarted_otp_sent_at' => now(),
            'getstarted_email_verified' => false,
        ]);

        try {
            $subject = 'Lanxers email verification';
                
            $message = view('mails.email-verification', [
                'otp' => $otp,
            ])->render();
                
            send_mail($email, $subject, $message);

            // send_mail($email, 'Email Verification OTP', "Your verification OTP is: {$otp}. This OTP is valid for 10 minutes.");

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

    public function showSignup()
    {
        $countries = DB::table('countries')
            ->select('id', 'name')
            ->orderByRaw('id = 101 DESC')
            ->orderBy('name')
            ->get();

        return view('freelancer.register', compact('countries'));
    }

    public function getStates($country_id)
    {
        if (!ctype_digit((string) $country_id)) {
            return response()->json([], 400);
        }

        $states = DB::table('states')
            ->where('country_id', (int) $country_id)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($states);
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z\s.\'-]+$/'],
            'email'      => ['required', 'email', 'max:255'],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:64',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[^A-Za-z0-9]/',
            ],
            'country_id' => ['required', 'exists:countries,id'],
            'state_id'   => ['required', Rule::exists('states', 'id')->where('country_id', $request->country_id)],
            'agree'      => ['accepted'],
        ], [
            'email.email'    => 'please add valid credential',
            'agree.accepted' => 'You must accept the terms to continue',
            
            'password.min'   => 'Password must be at least 8 characters.',
            'password.max'   => 'Password cannot be longer than 64 characters.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);

        $validator->after(function ($validator) use ($request) {
            $existingEmail = DB::table('users')->where('email', $request->email)->first();
            if ($existingEmail) {
                $roleLabel = $existingEmail->role === 'employer' ? 'an employer' : 'a freelancer';
                $validator->errors()->add('email', "This email is already registered as {$roleLabel}. Please log in instead.");
            }
        });

        $isAjax = $request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest';

        if ($validator->fails()) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'errors'  => $validator->errors(),
                ], 422);
            }

            return redirect()->route('jobseekers.register')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $validated = $validator->validated();

        try {
            $user = DB::transaction(function () use ($validated) {
                $user = User::create([
                    'name'       => $validated['name'],
                    'email'      => $validated['email'],
                    'password'   => Hash::make($validated['password']),
                    'role'       => 'freelancer',
                    'created_at' => now(),
                ]);

                DB::table('freelancer_profiles')->insert([
                    'user_id'    => $user->id,
                    'country'    => $validated['country_id'],
                    'state'      => $validated['state_id'],
                    'created_at' => now(),
                ]);

                return $user;
            });

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

            $subject = 'Welcome to Lanxers!';
                
            $message = view('mails.registration', [
            ])->render();
                
            send_mail($validated['email'], $subject, $message);

            if ($isAjax) {
                return response()->json([
                    'success'  => true,
                    'redirect' => route('jobseekers.profile'),
                ]);
            }

            return redirect()->route('jobseekers.profile')
                ->with('success', 'Account created! Let\'s complete your profile.');

        } catch (\Throwable $e) {
            Log::error('Signup failed', [
                'email' => $request->email,
                'error' => $e->getMessage(),
            ]);

            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again.',
                ], 500);
            }

            return redirect()->route('jobseekers.register')
                ->withInput($request->except('password'))
                ->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function showSignin()
    {
        return view('freelancer.login');
    }

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        // Email not registered
        if (!$user) {
            return back()
                ->withErrors([
                    'email' => 'This email is not registered with us.'
                ])
                ->withInput(['email' => $credentials['email']]);
        }
    
        // Wrong role
        if ($user->role !== 'freelancer') {
            return back()
                ->with('wrong_role', true)
                ->withInput(['email' => $credentials['email']]);
        }
    
        // Wrong password
        if (!Auth::attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ],
            $request->boolean('remember')
        )) {
            return back()
                ->withErrors([
                    'password' => 'Incorrect password. Please try again.'
                ])
                ->withInput(['email' => $credentials['email']]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        /* ---------- Session cleanup ---------- */
        UserSession::where('last_activity', '<', now()->subHours(24))->delete();
        UserSession::where('session_id', session()->getId())->delete();

        $activeSessions = UserSession::where('user_id', $user->id)
            ->orderBy('last_activity', 'asc')
            ->get();

        if ($activeSessions->count() >= 2) {
            $oldest = $activeSessions->first();
            UserSession::where('id', $oldest->id)->delete();
            DB::table('sessions')->where('id', $oldest->session_id)->delete();
        }

        UserSession::create([
            'user_id'       => $user->id,
            'role'          => $user->role,
            'session_id'    => session()->getId(),
            'ip_address'    => $request->ip(),
            'user_agent'    => $request->userAgent(),
            'last_activity' => now(),
        ]);
        
        
        if ((int) $user->password_changed === 0) {
            $token = Str::random(64);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => now(),
                ]
            );
        
            return redirect()->route('jobseekers.password.reset', [
                'token' => $token,
                'email' => $user->email,
            ]);
        }

        return redirect()->route('jobseekers.profile');
    }

    public function logout(Request $request)
    {
        UserSession::where('session_id', session()->getId())->delete();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('jobseekers.login');
    }
    
    public function showForgot()
    {
        return view('freelancer.forget_password');
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

        $link = route('jobseekers.password.reset', ['token' => $token, 'email' => $email]);

        $header_ref  = 'Lanxers Password Reset';
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
            return view('freelancer.password_expired', [
                'valid' => false,
                'message' => 'Invalid password reset link.'
            ]);
        }

        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        // Token doesn't exist (already used or invalid)
        if (!$record) {
            return view('freelancer.password_expired', [
                'valid' => false,
                'message' => 'This password reset link is invalid or has already been used.'
            ]);
        }

        // Token expired
        if (Carbon::parse($record->created_at)->addSeconds(config('constants.reset_expiry'))->isPast()) {
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();

            return view('freelancer.password_expired', [
                'valid' => false,
                'message' => 'This password reset link has expired. Please request a new one.'
            ]);
        }

        // Token doesn't match
        if (!Hash::check($token, $record->token)) {
            return view('freelancer.password_expired', [
                'valid' => false,
                'message' => 'This password reset link is invalid.'
            ]);
        }
        
        $expiresAt = Carbon::parse($record->created_at)
            ->addSeconds(config('constants.reset_expiry'));
    
        $expiresInSeconds = max(
            0,
            now()->diffInSeconds($expiresAt, false)
        );

        return view('freelancer.reset_password', ['valid' => true,'token' => $token, 'email' => $email, 'expiresInSeconds' => $expiresInSeconds,]);
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
            'redirect' => route('jobseekers.login')
        ]);
    }
}
