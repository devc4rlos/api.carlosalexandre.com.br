<?php

namespace App\Http\Requests\Traits;

use App\Http\Response\ResponseApi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidationTrait
{
    protected function failedValidation(Validator $validator)
    {
        $response = ResponseApi::builder("Validation failed. Please check the required fields.")
            ->setErrors($validator->errors()->toArray())
            ->setCode(422)
            ->response();

        throw new HttpResponseException($response);
    }
}
