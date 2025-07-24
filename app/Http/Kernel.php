<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Không có middleware toàn cục nào vì dự án không có các file mặc định
    ];

    protected $middlewareGroups = [
        'web' => [
            // Không có middleware nhóm web nào vì dự án không có các file mặc định
        ],
        'api' => [
            // Không có middleware nhóm api nào vì dự án không có các file mặc định
        ],
    ];

    protected $middlewareAliases = [
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'admin.access' => \App\Http\Middleware\CheckAdminAccess::class,
    ];
}
