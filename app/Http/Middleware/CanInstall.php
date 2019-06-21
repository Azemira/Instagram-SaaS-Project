<?php

namespace App\Http\Middleware;

use Closure;

class CanInstall
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
        if (file_exists(storage_path('installed'))) {
            abort(404);
        }

        return $next($request);
    }
}
