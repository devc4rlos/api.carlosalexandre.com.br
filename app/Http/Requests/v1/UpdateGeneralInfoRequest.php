<?php

namespace App\Http\Requests\v1;

use App\Http\Requests\Traits\FailedValidationTrait;
use App\Models\GeneralInfo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralInfoRequest extends FormRequest
{
    use FailedValidationTrait;

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:2', 'max:255'],
            'email' => ['nullable', 'email', 'min:5', 'max:255', 'unique:general_infos,email,' . GeneralInfo::first()->id],
            'title' => ['nullable', 'string', 'min:5', 'max:255'],
            'location' => ['nullable', 'string', 'min:2', 'max:255'],
            'timezone' => ['nullable', 'string', 'min:5', 'max:40'],
            'experience_years' => ['nullable', 'integer'],
            'freelance_available' => ['nullable' ,'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
