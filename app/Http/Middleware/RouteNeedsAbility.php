<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RouteNeedsAbility
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $roles
     * @param $permissions
     * @param bool $validateAll
     * @return mixed
     */
    public function handle($request, Closure $next, $roles, $permissions, $validateAll = false, $guard = 'admin')
    {
        if (Auth::guard($guard)->guest() || !$request->user($guard)->ability(explode('|', $roles), explode('|', $permissions), array('validate_all' => $validateAll))) {
            abort(403);
        }

        return $next($request);
    }
}
