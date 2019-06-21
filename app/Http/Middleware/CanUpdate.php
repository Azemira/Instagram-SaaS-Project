<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CanUpdate
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
        $migrations = Storage::disk('migrations')->files();
        $migrations = collect(str_replace('.php', '', $migrations));
        $migrated   = collect(DB::table('migrations')->pluck('migration')->all());
        $pending    = $migrations->diff($migrated);

        if ($pending->count() == 0) {
            abort(404);
        }

        return $next($request);
    }
}
