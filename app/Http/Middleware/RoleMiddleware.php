<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role, string ...$roles): Response
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        $allowedRoles = array_map('trim', array_merge([$role], $roles));

        if (! in_array($request->user()->role, $allowedRoles, true)) {
            abort(403, 'Geen toegang');
        }

        return $next($request);
    }
}