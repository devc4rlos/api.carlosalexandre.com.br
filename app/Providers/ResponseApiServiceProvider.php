<?php

namespace App\Providers;

use App\Http\Response\Builder\ResponseBuilder;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseApiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Response::macro('api', function (ResponseBuilder $responseBuilder) {
            $data = [
                'message' => $responseBuilder->getMessage(),
                'data' => $responseBuilder->getData(),
                'error' => $responseBuilder->getErrors(),
                'code' => $responseBuilder->getCode(),
                ...$responseBuilder->getMetadata(),
            ];

            return response()->json($data, $responseBuilder->getCode());
        });
    }
}
