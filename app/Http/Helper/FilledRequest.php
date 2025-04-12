<?php

namespace App\Http\Helper;

class FilledRequest
{
    public static function filter(array $data): array
    {
        return array_filter(
            $data,
            fn ($value) => !is_null($value) && $value !== ''
        );
    }
}
