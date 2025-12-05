<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // Đăng ký Middleware Alias cho khu vực Admin
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class, // <-- ĐÃ THÊM DÒNG NÀY
        ]);
        
        // Bạn có thể đăng ký các middleware groups ở đây nếu cần, nhưng hiện tại chỉ cần alias.
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();