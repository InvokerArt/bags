<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RouteNeedsRole
 * @package App\Http\Middleware
 */
class RouteNeedsRole
{

    /**
     * @param $request
     * @param Closure $next
     * @param $roles
     * @param bool $needsAll
     * @return mixed
     */
    public function handle($request, Closure $next, $roles, $needsAll = false, $guard = 'admin')
    {
        if (Auth::guard($guard)->guest() || !$request->user($guard)->hasRole(explode('|', $roles))) {
            abort(403);
        }

        return $next($request);
    }
}
