<?php

namespace App\Services\Api;

use App\Config\WhatsAppConfig;
use App\DTO\WhatsAppLinkData;
use App\Interfaces\Services\WhatsAppLinkServiceInterface;
use App\Traits\LogsActivity;

class WhatsAppLinkService implements WhatsAppLinkServiceInterface
{
    use LogsActivity;

    public function __construct(
        private WhatsAppConfig $config
    ) {}

    public function generateLink(WhatsAppLinkData $data): array
    {
        $sanitizedPhone = $this->sanitizePhone($data->phone);
        $whatsappUrl = $this->buildWhatsAppUrl($sanitizedPhone, $data->message);
        $shortUrl = $data->shorten ? $this->generateShortUrl($whatsappUrl) : null;

        $this->logInfo('WhatsApp link generated', [
            'phone' => $sanitizedPhone,
            'has_message' => !empty($data->message),
            'shortened' => $data->shorten
        ]);

        return [
            'original_url' => $whatsappUrl,
            'short_url' => $shortUrl,
            'phone' => $sanitizedPhone,
            'message' => $data->message
        ];
    }

    private function sanitizePhone(string $phone): string
    {
        return preg_replace('/[^0-9+]/', '', $phone);
    }

    private function buildWhatsAppUrl(string $phone, ?string $message): string
    {
        $url = "{$this->config->baseUrl}/{$phone}";
        
        if (!empty($message)) {
            $url .= "?text=" . urlencode($message);
        }

        return $url;
    }

    private function generateShortUrl(string $originalUrl): string
    {
        $shortId = substr(md5($originalUrl . time()), 0, 6);
        return "https://{$this->config->shortUrlDomain}/{$shortId}";
    }
} 