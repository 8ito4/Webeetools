<?php

namespace App\Interfaces\Services;

use App\DTO\WhatsAppLinkData;

interface WhatsAppLinkServiceInterface
{
    /**
     * Gera um link do WhatsApp a partir dos dados validados
     *
     * @param WhatsAppLinkData $data
     * @return array
     * @throws \InvalidArgumentException
     */
    public function generateLink(WhatsAppLinkData $data): array;
} 