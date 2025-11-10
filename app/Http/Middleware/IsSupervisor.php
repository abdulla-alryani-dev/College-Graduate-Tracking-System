<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSupervisor
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->hasRole('supervisor')) {
            return $next($request);
        }

        abort(403); // Forbidden
    }
}

