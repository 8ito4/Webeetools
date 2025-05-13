<?php

namespace App\Interfaces\Services;

use App\Models\Webhook;
use Illuminate\Http\Request;

interface WebhookServiceInterface
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
     * Processa uma requisição de webhook
     */
    public function processRequest(Webhook $webhook, Request $request): void;

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
     * Gera uma URL única para o webhook
     */
    public function generateUniqueUrl(): string;
} 