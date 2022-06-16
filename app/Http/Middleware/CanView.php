<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        if(canView($permission)){
            return $next($request);
        }

        abort(403, 'Usted no tiene permiso para esta vista');
    }
}
