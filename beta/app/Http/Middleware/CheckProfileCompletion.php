<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class CheckProfileCompletion
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $user = DB::table('users')
            ->where('id', auth()->id())
            ->select('id', 'role', 'profile_complete')
            ->first();

        if (!$user) {
            auth()->logout();
            return redirect()->route('jobseekers.login');
        }

        // Freelancer
        if ($user->role == 'freelancer') {

            // Profile already completed -> don't allow profile completion pages
            if (
                $user->profile_complete == 1 &&
                (
                    $request->routeIs('jobseekers.profile.start') ||
                    $request->routeIs('jobseekers.profile.details')
                )
            ) {
                return redirect()->route('jobseekers.profile');
            }

            // Profile not completed -> force profile completion
            if (
                $user->profile_complete == 0 &&
                !(
                    $request->routeIs('jobseekers.profile.start') ||
                    $request->routeIs('jobseekers.profile.details') ||
                    $request->routeIs('jobseekers.profile.complete.store') ||
                    $request->routeIs('jobseekers.profile.upload.resume') ||
                    $request->routeIs('jobseekers.logout')
                )
            ) {
                // AJAX / JSON request
                if ($request->ajax() || $request->expectsJson()) {
                    return response()->json([
                        'status' => false,
                        'profile_incomplete' => true,
                        'message' => 'Please complete your profile first.'
                    ], 403);
                }
                
                // Normal browser request
                return redirect()->route('jobseekers.profile');
            }
        }
        
        
        // Employer
        if ($user->role == 'employer') {

            if (
                $user->profile_complete == 1 &&
                (
                    $request->routeIs('employer.profile.start') ||
                    $request->routeIs('employer.profile.details')
                )
            ) {
                return redirect()->route('employer.profile');
            }

            if (
                $user->profile_complete == 0 &&
                !(
                    $request->routeIs('employer.profile.start') ||
                    $request->routeIs('employer.profile.details') ||
                    $request->routeIs('employer.profile.complete.store') ||
                    $request->routeIs('employer.logout')
                )
            ) {
                return redirect()->route('employer.profile.start');
            }
        }

        return $next($request);
    }
}
