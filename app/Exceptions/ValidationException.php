<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    protected array $context;
    protected int $statusCode;

    public function __construct(string $message = "", int $statusCode = 422, array $context = [], \Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
        $this->context = $context;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function setContext(array $context): self
    {
        $this->context = $context;
        return $this;
    }
} 