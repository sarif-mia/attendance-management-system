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
    public function handle($request, Closure $next)
    {
        // Try to get authenticated user from default guard first, then employee guard
        $user = auth()->user();
        if (!$user && auth()->guard('employee')->check()) {
            $user = auth()->guard('employee')->user();
        }

        if ($user === null) {
            abort(403, 'Unauthorized action.');
        }

        $actions = request()->route()->getAction();
        $roles = isset($actions['roles']) ? $actions['roles'] : null;

        // If no roles specified on route, allow access for authenticated users
        if ($roles === null) {
            return $next($request);
        }

        // If the user model provides hasAnyRole, use it; otherwise, deny
        if (method_exists($user, 'hasAnyRole') && $user->hasAnyRole($roles)) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
