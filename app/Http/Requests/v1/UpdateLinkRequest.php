<?php

namespace App\Http\Requests\v1;

use App\Http\Requests\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkRequest extends FormRequest
{
    use FailedValidationTrait;

    public function rules(): array
    {
        $link = $this->route('link');
        return [
            'name' => ['nullable', 'string', 'min:3', 'max:255', 'unique:links,name,' . $link->id],
            'url' => ['nullable', 'string', 'min:3', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
