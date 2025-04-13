<?php

namespace App\Http\Response\Builder;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

interface ResponseBuilderInterface
{
    public function getMessage(): string;
    public function getCode(): int;
    public function getData(): ?array;
    public function getErrors(): ?array;
    public function getMetadata(): array;

    public function setMessage(string $message): self;
    public function setCode(int $code): self;
    public function setData(array $data): self;
    public function setDataResource(JsonResource $resource): self;
    public function setErrors(array $errors): self;
    public function setMetadata(string $attribute, mixed $value): self;

    public function response(): JsonResponse;
}
