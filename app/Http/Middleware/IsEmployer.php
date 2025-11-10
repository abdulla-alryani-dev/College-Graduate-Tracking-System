<?php

namespace App\Http\Middleware;



use Closure;
use Illuminate\Http\Request;

class IsEmployer
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->hasRole('employer') ) {
            return $next($request);
        }

        abort(403); // Forbidden
    }
}

