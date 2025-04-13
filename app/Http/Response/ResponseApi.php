<?php

namespace App\Http\Response;

use App\Http\Response\Builder\ResponseBuilder;
use App\Http\Response\Builder\ResponseBuilderInterface;

class ResponseApi implements ResponseApiInterface
{
    public static function builder(string $message): ResponseBuilderInterface
    {
        return new ResponseBuilder($message);
    }
}
