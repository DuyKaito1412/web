<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->vai_tro, $roles)) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập.');
        }
        return $next($request);
    }
}
