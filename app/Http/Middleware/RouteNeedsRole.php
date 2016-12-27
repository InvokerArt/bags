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
    public function handle($request, Closure $next, $role, $needsAll = false, $guard = 'admin')
    {
        if (strpos($role, "|") !== false) {
            $roles = explode("|", $role);
            $access = access()->hasRoles($roles, ($needsAll === "true" ? true : false));
        } else {
            /**
             * Single role
             */
            $access = access()->hasRole($role);
        }
        
        if (!$access) {
            abort(403);
        }

        return $next($request);
    }
}
