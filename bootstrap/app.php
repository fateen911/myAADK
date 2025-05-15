<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

ini_set('memory_limit', '-1'); // Unlimited memory
ini_set('max_execution_time', 600); // Set to 300 seconds (5 minutes)

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'level' => \App\Http\Middleware\CheckLevel::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
       //
    })->create();
