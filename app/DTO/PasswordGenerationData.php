<?php

namespace App\DTO;

readonly class PasswordGenerationData
{
    public function __construct(
        public int $length = 12,
        public bool $uppercase = true,
        public bool $lowercase = true,
        public bool $numbers = true,
        public bool $symbols = true
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            length: $data['length'] ?? 12,
            uppercase: $data['uppercase'] ?? true,
            lowercase: $data['lowercase'] ?? true,
            numbers: $data['numbers'] ?? true,
            symbols: $data['symbols'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'length' => $this->length,
            'uppercase' => $this->uppercase,
            'lowercase' => $this->lowercase,
            'numbers' => $this->numbers,
            'symbols' => $this->symbols
        ];
    }

    public function hasAtLeastOneOption(): bool
    {
        return $this->uppercase || $this->lowercase || $this->numbers || $this->symbols;
    }
} 