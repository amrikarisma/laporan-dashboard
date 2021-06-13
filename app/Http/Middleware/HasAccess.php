<?php

namespace App\Http\Middleware;

use App\Lib\MyHelper;
use Closure;
use Illuminate\Http\Request;

class HasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (MyHelper::hasAccess($roles, session('roles'))) {
            return $next($request);
        }
        return redirect('/')->with('error', 'Tidak memiliki akses');
    }
}
