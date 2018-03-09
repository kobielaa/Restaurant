<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class IsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request HTTP request
     * @param \Closure                 $next    pipe to pass request
     * 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->verified) {
            Session::flush();
            return redirect()->route('login')->withAlert('Please verify your email before login.');
        }
        return $next($request);
    }
}
