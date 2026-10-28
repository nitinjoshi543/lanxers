<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Admin_model extends Model
{
    protected $table = 'admin_login';

    // Check if email exists and store OTP
    public function storeOtp($email)
    {
        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now('Asia/Kolkata')->addMinutes(10);

        $user = DB::table('admin_login')->where('user_email', $email)->first();
        if (!$user) {
            return false;
        }

        DB::table('admin_login')
            ->where('user_email', $email)
            ->update([
                'login_otp' => $otp,
                'otp_expires_at' => $expiresAt,
            ]);

        return $otp; // Return OTP for sending via email
    }

    // Verify OTP
    public function verifyOtp($email, $otp)
    {
        $user = DB::table('admin_login')->where('user_email', $email)->first();

        $current_time = Carbon::now('Asia/Kolkata');
        $expiresAt = Carbon::parse($user->otp_expires_at);

        // Validate OTP and check expiration
        if (!$user) {
            return (object) ['error' => 'User not found.'];
        }

        if (trim($user->login_otp) !== trim($otp)) {
            return (object) ['error' => 'OTP does not match.'];
        }

        if ($current_time->gt($expiresAt)) {
            return (object) ['error' => 'OTP expired.'];
        }

        // Clear OTP after successful login
        DB::table('admin_login')
            ->where('user_email', $email)
            ->update([
                'login_otp' => null,
                'otp_expires_at' => null,
                'last_login_time' => Carbon::now('Asia/Kolkata'),
            ]);

        return $user; // Return user data for authentication
    }
}
