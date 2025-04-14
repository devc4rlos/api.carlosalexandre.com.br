<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            ...$this['infos'],
            'links' => $this['links'],
            'socials' => $this['social-networks'],
        ];
    }
}
