<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class GuestOrEmployer
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $userType = DB::table('users')
            ->where('id', Auth::id())
            ->value('role');

        // Allow only employers
        if ($userType === 'employer') {
            return $next($request);
        }

        abort(403, 'Unauthorized.');
    }
}