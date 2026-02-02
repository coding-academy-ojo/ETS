<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        
//Check if user id in user table == user_id in role table
// User Role
// Admin    = Super Admin or Admin
// JobCoach = JobCoach
// Company  = Employer
//  Manager = Manager
$role = Auth::user()->role->role;
if (Auth::check() && ($role === 'Admin' || in_array($role, $roles))) {
    return $next($request);
}
return redirect('/login');
    }
    


}