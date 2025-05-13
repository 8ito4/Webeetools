<?php

namespace App\Interfaces\Repositories;

use App\Models\Webhook;
use App\Models\WebhookRequest;

interface WebhookRepositoryInterface
{
    /**
     * Cria um novo webhook
     */
    public function create(array $data): Webhook;

    /**
     * Encontra um webhook pelo token
     */
    public function findByToken(string $token): ?Webhook;

    /**
     * Salva uma nova requisição de webhook
     */
    public function saveRequest(Webhook $webhook, array $data): WebhookRequest;

    /**
     * Obtém as últimas requisições de um webhook
     */
    public function getLatestRequests(Webhook $webhook, int $limit = 10): array;

    /**
     * Atualiza as informações de um webhook
     */
    public function update(Webhook $webhook, array $data): Webhook;

    /**
     * Exclui um webhook
     */
    public function delete(Webhook $webhook): void;

    /**
     * Verifica se um token já existe
     */
    public function tokenExists(string $token): bool;
} 