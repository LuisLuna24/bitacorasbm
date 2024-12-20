<?php

namespace App\Http\Middleware;

use Closure;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {

        if (!$request->user()->hasRole($role)) {
            abort(404);
        }

        return $next($request);
    }
}
