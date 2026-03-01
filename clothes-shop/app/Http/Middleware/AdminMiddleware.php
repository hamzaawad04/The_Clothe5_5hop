<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is not logged in or not admin, return them to home
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return abort(403, 'You do not have access to this page.');  // MAY CHANGE THIS!!
        }

        return $next($request);
    }
}
