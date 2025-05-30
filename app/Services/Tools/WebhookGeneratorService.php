<?php

namespace App\Services\Tools;

use App\Interfaces\Services\WebhookServiceInterface;

class WebhookGeneratorService
{
    public function __construct(
        private WebhookServiceInterface $webhookService
    ) {}

    public function generateUniqueCustomUrl(): string
    {
        do {
            $adjectives = ['quick', 'smart', 'cool', 'fast', 'bright', 'sharp', 'clean', 'fresh', 'bold', 'neat'];
            $nouns = ['webhook', 'api', 'endpoint', 'hook', 'listener', 'receiver', 'handler', 'service'];
            
            $adjective = $adjectives[array_rand($adjectives)];
            $noun = $nouns[array_rand($nouns)];
            $number = rand(100, 999);
            
            $customUrl = $adjective . '-' . $noun . '-' . $number;
        } while ($this->webhookService->findByCustomUrl($customUrl));

        return $customUrl;
    }

    public function createWebhook(array $data): mixed
    {
        return $this->webhookService->create([
            'name' => $data['project_name'] ?? null,
            'custom_url' => $this->generateUniqueCustomUrl(),
            'description' => 'Webhook criado para teste'
        ]);
    }
} 