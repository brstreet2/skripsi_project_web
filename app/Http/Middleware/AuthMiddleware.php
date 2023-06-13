<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AuthMiddleware
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
        if (!Sentinel::getUser()) {
            toastr()->error('You are not authorized!', 'Error');
            return redirect()->route('auth.login.form');
        }

        return $next($request);
    }
}
