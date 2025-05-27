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

    public function findByCustomUrl(string $customUrl): ?Webhook
    {
        return Webhook::where('custom_url', $customUrl)->first();
    }

    public function saveRequest(Webhook $webhook, array $data): WebhookRequest
    {
        return $webhook->requests()->create($data);
    }

    public function getLatestRequests(Webhook $webhook, int $lastId = 0): array
    {
        $query = $webhook->requests()
            ->orderBy('created_at', 'desc');
            
        if ($lastId > 0) {
            $query->where('id', '>', $lastId);
        }
        
        return $query->take(50) // Limitar a 50 requisições por vez
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

    public function customUrlExists(string $customUrl): bool
    {
        return Webhook::where('custom_url', $customUrl)->exists();
    }
} 