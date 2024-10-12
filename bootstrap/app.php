<?php

use App\Exceptions\NonReportableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {
            return match (get_class($e)) {
                ValidationException::class => response()->json([
                    'errors' => $e->errors(),
                    'message' => 'Something went wrong.'
                ], 422),
                ThrottleRequestsException::class => response()->json([
                    'message' => 'Too many requests.'
                ], 429),
                NotFoundHttpException::class, MethodNotAllowedHttpException::class => response()->json([
                    'message' => 'Resource not found.'
                ], 404),
                default => response()->json([
                    'message' => 'Something went wrong.'
                ], 500),
            };
        });


    })->create();
