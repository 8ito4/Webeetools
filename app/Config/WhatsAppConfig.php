<?php

namespace App\Config;

readonly class WhatsAppConfig
{
    public function __construct(
        public string $baseUrl = 'https://wa.me',
        public string $shortUrlDomain = 'webeetools.link',
        public int $maxMessageLength = 1000,
        public int $maxPhoneLength = 20,
        public int $minPhoneLength = 8
    ) {}

    public static function fromEnv(): self
    {
        return new self(
            baseUrl: env('WHATSAPP_BASE_URL', 'https://wa.me'),
            shortUrlDomain: env('SHORT_URL_DOMAIN', 'webeetools.link'),
            maxMessageLength: (int) env('WHATSAPP_MAX_MESSAGE_LENGTH', 1000),
            maxPhoneLength: (int) env('PHONE_MAX_LENGTH', 20),
            minPhoneLength: (int) env('PHONE_MIN_LENGTH', 8)
        );
    }
} 