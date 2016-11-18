<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class RouteNeedsRole
 * @package App\Http\Middleware
 */
class RouteNeedsPermission
{

    /**
     * @param $request
     * @param Closure $next
     * @param $permission
     * @param bool $needsAll
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions, $needsAll = false, $guard = 'admin')
    {
        if (Auth::guard($guard)->guest() || !$request->user($guard)->can(explode('|', $permissions))) {
            abort(403);
        }

        return $next($request);
    }
}
