<?php

namespace App\Http\Resources;

use App\Http\DTO\ErrorResourceDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ErrorResourceDTO */
class ErrorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
            'details' => $this->getErrors(),
        ];
    }
}
