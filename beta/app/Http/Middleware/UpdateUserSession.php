<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserSession;

class UpdateUserSession
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            UserSession::where('session_id', session()->getId())
                ->update([
                    'last_activity' => now()
                ]);
        }

        return $next($request);
    }
}
