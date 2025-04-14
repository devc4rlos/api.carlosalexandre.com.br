<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSocialNetworkRequest extends FormRequest
{
    use FailedValidationTrait;

    public function rules(): array
    {
        $socialNetwork = $this->route('social_network');

        return [
            'name' => ['nullable', 'string', 'min:3', 'max:255', Rule::unique('social_networks', 'name')->ignore($socialNetwork->id)],
            'url' => ['nullable', 'string', 'url', 'min:3', 'max:255'],
            'icon' => ['nullable', 'string', 'min:3', 'max:255'],
            'text' => ['nullable', 'string', 'min:3', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
