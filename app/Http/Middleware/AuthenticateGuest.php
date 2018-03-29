<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthenticateGuest
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
    Auth::loginUsingId(1); // Guest

    return $next($request);
}
}
