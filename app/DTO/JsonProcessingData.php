<?php

namespace App\DTO;

use App\Enums\JsonAction;

readonly class JsonProcessingData
{
    public function __construct(
        public string $json,
        public JsonAction $action = JsonAction::FORMAT,
        public int $indent = 2
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            json: $data['json'],
            action: JsonAction::tryFrom($data['action'] ?? 'format') ?? JsonAction::FORMAT,
            indent: $data['indent'] ?? 2
        );
    }

    public function toArray(): array
    {
        return [
            'json' => $this->json,
            'action' => $this->action->value,
            'indent' => $this->indent
        ];
    }
} 