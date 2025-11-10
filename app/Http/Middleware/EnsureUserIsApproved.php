<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if the user is logged in
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to access this page.');
        }

        // Check if the user is an employer and not approved
        if ($user->role === 'employer' && $user->status !== 'approved') {
            return redirect('/')->with('error', 'Your account is pending approval.');
        }

        // Allow access to the requested route
        return $next($request);

    }
}
