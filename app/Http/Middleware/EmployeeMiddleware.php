<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user has the employee role
        if ($request->user()->hasRole('Employee')) {
            return $next($request);
        }

        // If the user doesn't have the employee role, redirect or handle accordingly
        return redirect('/')->with('error', 'Unauthorized access');
    }
}