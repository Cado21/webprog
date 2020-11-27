<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsLoggedIn
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
        $loggedIn = Auth::check();
        return $loggedIn ? redirect('/product/search') : $next($request);
    }
}
