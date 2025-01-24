<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle 404 errors
        $exceptions->renderable(function (NotFoundHttpException $exception, $request) {
            return redirect()->to('/404-not-found');
        });

        // Handle 500 errors
        $exceptions->renderable(function (Throwable $exception, $request) {
            if (app()->environment() !== 'production') {
                // Use default error display in non-production environments
                return null;
            }

            if ($exception->getCode() === 500 || $exception instanceof Error) {
                return redirect()->to('/500-system-error');
            }

            // Let other exceptions pass through
            return null;
        });
    })->create();
