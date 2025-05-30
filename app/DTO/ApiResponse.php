<?php

namespace App\DTO;

readonly class ApiResponse
{
    public function __construct(
        public bool $success,
        public mixed $data = null,
        public ?string $message = null,
        public ?array $errors = null,
        public ?array $meta = null,
        public int $statusCode = 200
    ) {}

    public static function success(
        mixed $data = null, 
        ?string $message = null, 
        ?array $meta = null, 
        int $statusCode = 200
    ): self {
        return new self(
            success: true,
            data: $data,
            message: $message,
            meta: $meta,
            statusCode: $statusCode
        );
    }

    public static function error(
        string $message, 
        ?array $errors = null, 
        ?array $meta = null, 
        int $statusCode = 400
    ): self {
        return new self(
            success: false,
            message: $message,
            errors: $errors,
            meta: $meta,
            statusCode: $statusCode
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'success' => $this->success,
            'data' => $this->data,
            'message' => $this->message,
            'errors' => $this->errors,
            'meta' => $this->meta
        ], fn($value) => $value !== null);
    }
} 