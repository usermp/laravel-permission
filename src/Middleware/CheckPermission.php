<?php

namespace Usermp\LaravelPermission\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Usermp\LaravelPermission\Models\ExtendedUser;

/**
 * Class CheckPermission
 *
 * @package Usermp\LaravelPermission\Middleware
 */
class CheckPermission
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
        // Get the authenticated user
        $user = ExtendedUser::find(Auth::id());

        // Get the current route name
        $routeName = $request->route()->getName();

        // Check if the user has permission to access the current route
        if ($user && $user->hasPermissionToRoute($routeName)) {
            return $next($request);
        }

        return abort(403);
    }
}
