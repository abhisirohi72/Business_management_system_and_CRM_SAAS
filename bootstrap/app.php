<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
// use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) =>
                $request->is('api/*') || $request->expectsJson(),
        );

        $exceptions->render(function (
            AuthorizationException $e,
            Request $request
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to perform this action.',
                ], 403);
            }

            return response(
                '<h1>403 - Access Denied</h1>
                <p>You are not authorized to perform this action.</p>',
                403
            );
        });

        $exceptions->render(function (
            QueryException $e,
            Request $request
        ) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'A database error occurred. Please try again.',
                ], 500);
            }

            return back()
                ->withInput()
                ->with(
                    'error',
                    'A database error occurred. Please try again.'
                );
        });

    })
    ->create();