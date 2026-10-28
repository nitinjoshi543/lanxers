<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SanitizeInput;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckProfileCompletion;
use App\Http\Middleware\EnsureFreelancer;
use App\Http\Middleware\EnsureEmployer;
use App\Http\Middleware\GuestOrFreelancer;
use App\Http\Middleware\GuestOrEmployer;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        channels: __DIR__.'/../routes/channels.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(SanitizeInput::class);

        $middleware->alias([
            'profile.complete' => CheckProfileCompletion::class,
            'freelancer' => \App\Http\Middleware\EnsureFreelancer::class,
            'employer' => \App\Http\Middleware\EnsureEmployer::class,
            'guest.or.freelancer' => GuestOrFreelancer::class,
            'guest.or.employer'   => GuestOrEmployer::class,
        ]);


        Authenticate::redirectUsing(function (Request $request) {

            if ($request->is('employer/*')) {
                return route('employer.login');
            }

            return route('jobseekers.login');
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();