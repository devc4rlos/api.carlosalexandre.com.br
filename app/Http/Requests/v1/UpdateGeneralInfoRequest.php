<?php

namespace App\Http\Requests\v1;

use App\Http\Requests\Traits\FailedValidationTrait;
use App\Models\GeneralInfo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UpdateGeneralInfoRequest extends FormRequest
{
    use FailedValidationTrait;

    public function rules(): array
    {
        $info =  GeneralInfo::first();

        return [
            'name' => ['nullable', 'string', 'min:2', 'max:255'],
            'email' => ['nullable', 'email', 'min:5', 'max:255', Rule::unique('general_infos', 'email')->ignore($info->id)],
            'phone' => ['nullable', 'string', 'min:10', 'max:255', Rule::unique('general_infos', 'phone')->ignore($info->id)],
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
