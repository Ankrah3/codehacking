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
    ->withMiddleware(function (Middleware $middleware): void {

        // Registering your custom 'admin' middleware alias safely
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // 1. Catch missing URLs and route configurations
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->view('errors.404', [], 404);
        });

        // 2. Catch pages where the controller exists but the Blade view file hasn't been created yet
        $exceptions->render(function (\InvalidArgumentException $e) {
            if (str_contains($e->getMessage(), 'View') && str_contains($e->getMessage(), 'not found')) {
                return response()->view('errors.404', [], 404);
            }
        });

    })->create();
