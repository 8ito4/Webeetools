<?php

namespace App\Services;

use App\Models\Webhook;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Interfaces\Services\WebhookServiceInterface;
use App\Interfaces\Repositories\WebhookRepositoryInterface;

class WebhookService implements WebhookServiceInterface
{
    public function __construct(
        private WebhookRepositoryInterface $webhookRepository
    ) {}

    public function create(array $data): Webhook
    {
        // Se custom_url foi fornecida, validar se é única
        if (isset($data['custom_url'])) {
            if ($this->webhookRepository->customUrlExists($data['custom_url'])) {
                throw new \InvalidArgumentException('Esta URL personalizada já está em uso.');
            }
        }
        
        $data['token'] = $this->generateUniqueToken();
        return $this->webhookRepository->create($data);
    }

    public function findByToken(string $token): ?Webhook
    {
        return $this->webhookRepository->findByToken($token);
    }

    public function findByCustomUrl(string $customUrl): ?Webhook
    {
        return $this->webhookRepository->findByCustomUrl($customUrl);
    }

    public function processRequest(Webhook $webhook, Request $request): void
    {
        $requestData = [
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'query_parameters' => $request->query->all(),
            'body' => $request->all(),
            'ip_address' => $request->ip(),
            'created_at' => now()->toDateTimeString()
        ];

        $savedRequest = $this->webhookRepository->saveRequest($webhook, $requestData);
        $webhook->incrementRequestCount();

        event(new \App\Events\WebhookRequestReceived($savedRequest->toArray(), $webhook->token));
    }

    public function getLatestRequests(Webhook $webhook, int $lastId = 0): array
    {
        return $this->webhookRepository->getLatestRequests($webhook, $lastId);
    }

    public function update(Webhook $webhook, array $data): Webhook
    {
        return $this->webhookRepository->update($webhook, $data);
    }

    public function delete(Webhook $webhook): void
    {
        $this->webhookRepository->delete($webhook);
    }

    private function generateUniqueToken(): string
    {
        do {
            $token = Str::random(32);
        } while ($this->webhookRepository->tokenExists($token));

        return $token;
    }

    public function generateUniqueUrl(): string
    {
        $webhook = $this->create([
            'name' => 'Webhook Temporário',
            'description' => 'Webhook criado para teste'
        ]);
        
        return $webhook->token;
    }
} 