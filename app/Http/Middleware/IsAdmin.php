<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdmin
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
         if (Auth::user() &&  Auth::user()->authorizeRoles(['admin'])) {
                return $next($request);
         }
        if (Auth::user() &&  !Auth::user()->authorizeRoles(['admin'])) {
            return redirect('/404');
         }
    
         return redirect('/login');
    }
}
