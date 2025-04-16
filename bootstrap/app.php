<?php

use App\Http\Middleware\AppendRateLimitInfoMiddleware;
use App\Http\Middleware\ForceJsonResponseMiddleware;
use App\Http\Response\ResponseApi;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function() {
            Route::middleware(['api', 'throttle:api'])
                ->prefix('v1')
                ->name('v1.')
                ->group(base_path('routes/v1/api.php'));
            Route::middleware('api')->group(base_path('routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ForceJsonResponseMiddleware::class);
        $middleware->append(AppendRateLimitInfoMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e):?JsonResponse {
            return ResponseApi::builder('You are not authorized to access this resource.')->setCode(401)->response();
        });
    })->create();
