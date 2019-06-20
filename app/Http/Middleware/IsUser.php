<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class IsUser
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

        if(Auth::user() && Auth::user()->authorizeRoles(['user']) ) {
            return $next($request);
        }

        if(Auth::user() && Auth::user()->authorizeRoles(['admin']) ) {
            return $next($request);
        }
      
        return redirect('/404');
    }
}
