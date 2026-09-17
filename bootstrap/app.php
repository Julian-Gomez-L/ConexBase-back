<?php

use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\InvalidIdException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (ResourceNotFoundException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'error' => $exception->errorCode,
                'status' => 404
            ], 404);
        });

        $exceptions->render(function (InvalidIdException $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'error' => $exception->errorCode,
                'status' => 422
            ], 422);
        });

    })->create();