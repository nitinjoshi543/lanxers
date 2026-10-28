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

class HireController extends Controller
{
    public function index()
    {
        return view('hire.index');
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


        /*
     * Check if account already exists
     */
        if (DB::table('users')->where('email', $email)->exists()) {

            return response()->json([
                'status' => false,
                'message' => 'An account with this email already exists.',
            ], 422);
        }


        /*
     * Generate 6 digit OTP
     */
        $otp = random_int(100000, 999999);


        /*
     * Store OTP in session
     */
        session([
            'hire_otp' => $otp,
            'hire_otp_email' => $email,
            'hire_otp_expires_at' => now()->addMinutes(10),
            'hire_email_verified' => false,
        ]);


        try {

            $subject = 'Email Verification OTP';

            $message = "Your verification OTP is: {$otp}. "
                . "This OTP is valid for 10 minutes.";

            send_mail($email, $subject, $message);

            return response()->json([
                'status' => true,
                'message' => 'OTP has been sent to your email address.',
            ]);
        } catch (\Exception $e) {

            Log::error('Hire OTP email failed', [
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
        if (!session()->has('hire_otp')) {
            return response()->json([
                'status' => false,
                'message' => 'OTP not found. Please request a new OTP.',
            ], 422);
        }

        // Check email matches the email for which OTP was sent
        if (session('hire_otp_email') !== $email) {
            return response()->json([
                'status' => false,
                'message' => 'Email address does not match the OTP request.',
            ], 422);
        }

        // Check OTP expiry
        if (
            !session('hire_otp_expires_at') ||
            now()->greaterThan(session('hire_otp_expires_at'))
        ) {
            session()->forget([
                'hire_otp',
                'hire_otp_email',
                'hire_otp_expires_at',
            ]);

            return response()->json([
                'status' => false,
                'message' => 'OTP has expired. Please request a new OTP.',
            ], 422);
        }

        // Check OTP
        if ((string) session('hire_otp') !== $otp) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please enter the correct OTP.',
            ], 422);
        }

        // OTP verified
        session([
            'hire_email_verified' => true,
            'hire_verified_email' => $email,
        ]);

        // Remove OTP after successful verification
        session()->forget([
            'hire_otp',
            'hire_otp_email',
            'hire_otp_expires_at',
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
                'digits_between:8,12',
            ],

            'looking_for' => [
                'required',
                'in:job,internship,freelancer',
            ],

            'qualification' => [
                'required',
                'string',
                'max:150',
            ],

            'skills' => [
                'required',
                'array',
                'min:1',
            ],

            'skills.*' => [
                'string',
                'max:100',
            ],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $email = strtolower(trim($request->email));


        /*
     * Check Email OTP Verification
     */
        if (
            !session('hire_email_verified') ||
            session('hire_verified_email') !== $email
        ) {
            return back()
                ->withErrors([
                    'email' => 'Please verify your email address first.',
                ])
                ->withInput();
        }


        /*
     * Check Existing User
     */
        if (DB::table('users')->where('email', $email)->exists()) {
            return back()
                ->withErrors([
                    'email' => 'An account with this email already exists.',
                ])
                ->withInput();
        }


        /*
     * Generate Random Password
     */
        $password = \Illuminate\Support\Str::password(
            length: 12,
            letters: true,
            numbers: true,
            symbols: false
        );


        /*
     * Create User
     */
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


        /*
     * Create Hire Profile
     */
        DB::table('hire_profiles')->insert([

            'user_id' => $userId,

            'looking_for' => $request->looking_for,

            'qualification' => trim($request->qualification),

            'skills' => json_encode($request->skills),

            'created_at' => now(),

            'updated_at' => now(),
        ]);


        /*
     * Send Login Details
     */
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

            Log::error('Hire account email failed', [
                'user_id' => $userId,
                'email' => $email,
                'error' => $e->getMessage(),
            ]);
        }


        /*
     * Clear Email Verification Session
     */
        session()->forget([
            'hire_email_verified',
            'hire_verified_email',
        ]);


        /*
     * Redirect
     */
        return redirect()
            ->route('hire.index')
            ->with(
                'success',
                'Your account has been created successfully. Login details have been sent to your email.'
            );
    }
}
