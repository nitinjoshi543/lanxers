<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmployer
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('employer.login');
        }

        $userType = DB::table('users')
            ->where('id', Auth::id())
            ->value('role');

        // Change this according to your DB values
        if ($userType != 'employer') {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}