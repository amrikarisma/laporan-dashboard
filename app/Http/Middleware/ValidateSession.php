<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateSession
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
        if (session()->has('email')) {
            return $next($request);
        } elseif ($request->path() == '/') {
            return redirect('login')->withErrors(['e' => 'Please login.']);
        } else {
            return redirect('login')->withErrors(['e' => 'Please login.']);
        }
    }
}
