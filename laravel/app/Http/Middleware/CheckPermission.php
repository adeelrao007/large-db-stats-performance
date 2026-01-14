<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission)
    {
        $admin = auth()->user();

        if (! $admin || ! method_exists($admin, 'hasPermission')) {
            abort(403);
        }

        if (! $admin->hasPermission($permission)) {
            abort(403, 'Permission denied');
        }

        return $next($request);
    }
}
