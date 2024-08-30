<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedStudent
{
    public function handle($request, Closure $next, $guard = 'student')
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/student'); // Redirect authenticated students to their home page
        }

        return $next($request);
    }
}
