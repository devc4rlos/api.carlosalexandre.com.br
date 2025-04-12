<?php

namespace App\Http\Response;

use App\Http\DTO\ErrorResourceDTO;
use App\Http\Resources\ErrorResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseApi implements ResponseApiInterface
{
    public static function success(?JsonResource $data = null, $code = 200): JsonResponse
    {
        return response()->api($data, null, $code);
    }

    public static function error(string $message = '', $error = null, $code = 500): JsonResponse
    {
        return response()->api(null, new ErrorResource(
            new ErrorResourceDTO($message, $error, $code),
        ), $code);
    }
}
