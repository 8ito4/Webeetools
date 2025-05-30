<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ApiException extends Exception
{
    public function __construct(
        string $message = "",
        public readonly int $statusCode = 400,
        public readonly ?array $context = null,
        Throwable $previous = null
    ) {
        parent::__construct($message, $this->statusCode, $previous);
    }

    public function getContext(): ?array
    {
        return $this->context;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}

class ValidationException extends ApiException
{
    public function __construct(
        string $message = "Dados de entrada inválidos",
        ?array $context = null,
        Throwable $previous = null
    ) {
        parent::__construct($message, 422, $context, $previous);
    }
}

class ServiceException extends ApiException
{
    public function __construct(
        string $message = "Erro interno do serviço",
        ?array $context = null,
        Throwable $previous = null
    ) {
        parent::__construct($message, 500, $context, $previous);
    }
} 