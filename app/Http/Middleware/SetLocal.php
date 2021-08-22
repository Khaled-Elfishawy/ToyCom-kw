<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SetLocal
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
        $lang = ($request->header('local'))? $request->header('local'): app()->getLocale();
        app()->setLocale($lang);
        return $next($request);
    }
}
