<?php

namespace App\Http\Requests\v1;

use App\Http\Requests\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class AuthenticationRequest extends FormRequest
{
    use FailedValidationTrait;

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
