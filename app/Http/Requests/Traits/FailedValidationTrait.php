<?php

namespace App\Http\Requests\Traits;

use App\Http\Response\ResponseApi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidationTrait
{
    protected function failedValidation(Validator $validator)
    {
        $response = ResponseApi::error("Validation error", $validator->errors(), 422);

        throw new HttpResponseException($response);
    }
}
