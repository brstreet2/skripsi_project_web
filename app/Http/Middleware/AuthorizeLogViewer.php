<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Http\Request;

class AuthorizeLogViewer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Sentinel::getUser()) {
            return $next($request);
        } else {
            return redirect()->route('dashboard.index');
        }
    }
}
