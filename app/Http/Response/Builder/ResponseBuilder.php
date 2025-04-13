<?php

namespace App\Http\Response\Builder;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseBuilder implements ResponseBuilderInterface
{
    private string $message;
    private ?array $data;
    private ?array $errors;
    private int $code;
    private array $metadata;

    public function __construct(
        string $message,
        ?array $data = null,
        ?array $errors = null,
        int $code = 200,
        array $metadata = [],
    )
    {
        $this->message = $message;
        $this->data = $data;
        $this->errors = $errors;
        $this->code = $code;
        $this->metadata = $metadata;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function setDataResource(JsonResource $resource): self
    {
        return $this->setData($resource->toArray(request()));
    }

    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function setMetadata(string $attribute, mixed $value): self
    {
        $this->metadata[$attribute] = $value;
        return $this;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function response(): JsonResponse
    {
        return response()->api($this);
    }
}
