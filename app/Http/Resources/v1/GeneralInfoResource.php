<?php

namespace App\Http\Resources\v1;

use App\Models\GeneralInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin GeneralInfo */
class GeneralInfoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'title' => $this->title,
            'bio' => $this->bio,
            'location' => $this->location,
            'timezone' => $this->timezone,
            'experience_years' => $this->experience_years,
            'freelance_available' => $this->freelance_available,
        ];
    }
}
