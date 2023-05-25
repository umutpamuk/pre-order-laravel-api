<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{

    /**
     * @param Request $request
     * @param Closure $next
     * @param $roles
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = $request->user();

        if ($user && $user->role == $roles) {
            return $next($request);
        }

        abort(Response::HTTP_FORBIDDEN, 'You are not authorized to access this page.');
    }
}
