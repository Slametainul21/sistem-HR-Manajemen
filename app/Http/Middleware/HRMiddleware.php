<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HRMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role_id !== 0) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}