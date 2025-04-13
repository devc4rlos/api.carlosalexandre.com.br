<?php

namespace App\Http\Response;

use App\Http\Response\Builder\ResponseBuilderInterface;

interface ResponseApiInterface
{
    public static function builder(string $message): ResponseBuilderInterface;
}
