<?php

namespace App\Repositories;

use App\Models\Webhook;
use App\Models\WebhookRequest;
use App\Interfaces\Repositories\WebhookRepositoryInterface;

class WebhookRepository implements WebhookRepositoryInterface
{
    public function create(array $data): Webhook
    {
        return Webhook::create($data);
    }

    public function findByToken(string $token): ?Webhook
    {
        return Webhook::where('token', $token)->first();
    }

    public function saveRequest(Webhook $webhook, array $data): WebhookRequest
    {
        return $webhook->requests()->create($data);
    }

    public function getLatestRequests(Webhook $webhook, int $limit = 10): array
    {
        return $webhook->requests()
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get()
            ->toArray();
    }

    public function update(Webhook $webhook, array $data): Webhook
    {
        $webhook->update($data);
        return $webhook;
    }

    public function delete(Webhook $webhook): void
    {
        $webhook->delete();
    }

    public function tokenExists(string $token): bool
    {
        return Webhook::where('token', $token)->exists();
    }
} 