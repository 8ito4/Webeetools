<?php

namespace App\DTO;

readonly class WhatsAppLinkData
{
    public function __construct(
        public string $phone,
        public ?string $message = null,
        public bool $shorten = true
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            phone: $data['phone'],
            message: $data['message'] ?? null,
            shorten: $data['shorten'] ?? true
        );
    }

    public function toArray(): array
    {
        return [
            'phone' => $this->phone,
            'message' => $this->message,
            'shorten' => $this->shorten
        ];
    }
} 