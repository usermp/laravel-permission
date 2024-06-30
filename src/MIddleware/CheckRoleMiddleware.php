<?php

namespace Usermp\LaravelPermission\Middleware;

use Closure;
use Usermp\LaravelPermission\Models\ExtendedUser;
use Illuminate\Http\Request;

class CheckRoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if (!$user instanceof ExtendedUser) {
            abort(403, 'Unauthorized.');
        }

        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
