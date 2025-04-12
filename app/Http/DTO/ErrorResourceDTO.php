<?php

namespace App\Http\DTO;

class ErrorResourceDTO
{
    private string $message;
    private mixed $errors;
    private int $code;

    public function __construct(
        string $message,
        mixed $errors = null,
        int $code = 500,
    )
    {
        $this->message = $message;
        $this->errors = $errors;
        $this->code = $code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getErrors(): mixed
    {
        return $this->errors;
    }

    public function getCode(): int
    {
        return $this->code;
    }
}
