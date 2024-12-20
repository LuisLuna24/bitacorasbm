<?php

use App\Http\Middleware\EnsureUserHasRol;
use App\Http\Middleware\hasVerifiedEmail;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware([
                'web',
                'auth:sanctum',
                'role:1',
                config('jetstream.auth_session'),
            ])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware([
                'web',
                'auth:sanctum',
                'role:2',
                'verified',
                config('jetstream.auth_session'),
            ])
                ->prefix('empleado')
                ->name('empleado.')
                ->group(base_path('routes/empleado.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'role' => EnsureUserHasRol::class,
            'email' => hasVerifiedEmail::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
