<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles = null)
    {
        $rolesInArray = explode('|', $roles);
        if ( in_array(Auth::user()->role, $rolesInArray )) 
            return $next($request);
        return redirect()->back()->withErrors('You are not authorized to access this path');
    }
}
