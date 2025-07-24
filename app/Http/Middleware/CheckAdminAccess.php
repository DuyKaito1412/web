<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Gate::allows('access-admin-panel')) {
            abort(403, 'Bạn không có quyền truy cập vào trang quản trị.');
        }

        return $next($request);
    }
}
