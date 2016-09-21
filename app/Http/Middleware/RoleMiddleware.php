<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roleName)
    {
        if (auth()->check() && !auth()->user()->hasRole($roleName))
        {
            return redirect('auth-login');
        }
        return $next($request);
    }
}
