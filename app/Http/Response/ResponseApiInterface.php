<?php

namespace App\Http\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

interface ResponseApiInterface
{
    public static function success(?JsonResource $data = null, $code = 200): JsonResponse;

    public static function error(string $message = '', $error = null, $code = 500): JsonResponse;
}
