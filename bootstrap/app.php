<?php

use App\Http\Response\ResponseApi;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function() {
            Route::middleware('api')
                ->prefix('v1')
                ->name('v1.')
                ->group(base_path('routes/v1/api.php'));
            Route::middleware('api')->group(base_path('routes/web.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request):?JsonResponse {
            return $request->expectsJson() ? ResponseApi::builder('You are not authorized to access this resource.')->setCode(401)->response() : null;
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request):?JsonResponse {
            return $request->expectsJson() ? ResponseApi::builder('Route not found.')->setCode(404)->response() : null;
        });
    })->create();
