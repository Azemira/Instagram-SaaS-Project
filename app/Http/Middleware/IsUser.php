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
            // if (!$request->user()->hasVerifiedEmail()) {
            //     return redirect('/not-verified');
            // } else {
            //     Redirect::route($redirectToRoute ?: 'verification.notice');
            // }
            return $next($request);
        }

        if(Auth::user() && Auth::user()->authorizeRoles(['admin']) ) {
            return $next($request);
        }
      
        return redirect('/');
    }
}
