<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEmployerStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('employer')->check() && Auth::guard('employer')->user()->status == 'inactive') {
            Auth::guard('employer')->logout();
            return redirect()->route('empLogin')->with('error', 'Your account is inactive.');    
            }

        return $next($request);
    }
}
