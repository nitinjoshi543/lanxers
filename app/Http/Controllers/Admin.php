<?php

namespace App\Http\Controllers;

use App\Models\Admin_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class Admin extends Controller
{
    protected $adminModel;

    public function __construct(Admin_model $adminModel)
    {
        $this->adminModel = $adminModel;
    }

    public function dashboard()
    {
        if (!session()->has('user_id')) {
            // If the user is already logged in, redirect them to the dashboard
            return redirect()->route('admin.login');
        }
        return view('adminend/dashboard');
    }

    public function logout()
    {
        // Clear the session data (destroy the session)
        session()->flush(); // This will clear all session data

        // Optionally, you can also invalidate the session ID
        session()->invalidate();

        // Redirect the user to the login page after logout
        return redirect()->route('admin.login')->with('success', 'Logged out successfully');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $otp = $this->adminModel->storeOtp($request->email);

        if (!$otp) {
            return response()->json(['success' => false, 'message' => 'Email not found!'], 404);
        }

        $header_ref  = 'Lanxers Admin OTP Mail';
        $message_ref = View::make('mails.admin_login_otp', [
            'otp'  => $otp,
        ])->render();

        send_mail($request->email, $header_ref, $message_ref);

        return response()->json([
            'success'      => true,        // ← 'status' ko 'success' => true karo
            'message'      => 'OTP has been sent to your registered email address.',
            'seconds_left' => config('constants.reset_expiry'),
        ]);
    }

    public function loginPage()
    {
        // Check if the user is already authenticated (session exists)
        if (session()->has('user_id')) {
            // If the user is already logged in, redirect them to the dashboard
            return redirect()->route('admin.dashboard');
        }

        return view('adminend/login_test');
    }

    public function verifyOtpTest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6',
        ]);

        $result = $this->adminModel->verifyOtp(
            $request->email,
            $request->otp
        );

        if (isset($result->error)) {
            return response()->json([
                'success' => false,
                'message' => $result->error
            ]);
        }

        // ✅ OTP verified — ab yahin login complete
        $request->session()->regenerate();   // session fixation guard

        session([
            'user_id'   => $result->user_id,
            'user_data' => $result
        ]);

        return response()->json([
            'success'  => true,
            'redirect' => route('admin.dashboard')
        ]);
    }

}
