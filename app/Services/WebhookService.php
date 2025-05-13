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
        $data['token'] = $this->generateUniqueToken();
        return $this->webhookRepository->create($data);
    }

    public function findByToken(string $token): ?Webhook
    {
        return $this->webhookRepository->findByToken($token);
    }

    public function processRequest(Webhook $webhook, Request $request): void
    {
        $requestData = [
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'query_parameters' => $request->query->all(),
            'body' => $request->all(),
            'ip_address' => $request->ip(),
        ];

        $this->webhookRepository->saveRequest($webhook, $requestData);
        $webhook->incrementRequestCount();
    }

    public function getLatestRequests(Webhook $webhook, int $limit = 10): array
    {
        return $this->webhookRepository->getLatestRequests($webhook, $limit);
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