<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Http\Requests\Webhook\CreateWebhookRequest;
use App\Interfaces\Services\WebhookServiceInterface;
use App\Services\Tools\WebhookGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function __construct(
        private WebhookServiceInterface $webhookService,
        private WebhookGeneratorService $webhookGeneratorService
    ) {}

    public function index(): View
    {
        $webhook = session('webhook');
        $requests = $webhook ? $this->webhookService->getLatestRequests($webhook) : [];
        return view('tools.webhook', compact('webhook', 'requests'));
    }

    public function create(CreateWebhookRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $webhookData = $this->webhookGeneratorService->createWebhook($validatedData);

            return response()->json([
                'success' => true,
                'data' => $webhookData,
                'meta' => [
                    'created_at' => now()->toISOString()
                ]
            ], 201);

        } catch (\Throwable $e) {
            Log::error('Erro ao criar webhook', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->validated()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro interno no servidor.'
            ], 500);
        }
    }

    public function destroy(): RedirectResponse
    {
        $webhook = session('webhook');
        if ($webhook) {
            $this->webhookService->delete($webhook);
            session()->forget('webhook');
        }
        return redirect()->route('tools.webhook');
    }

    public function clearSession(): JsonResponse
    {
        session()->forget('webhook');
        return response()->json(['message' => 'Sessão limpa com sucesso']);
    }

    public function receive(string $identifier, Request $request): JsonResponse
    {
        try {
            // Simulação de processamento - em produção seria implementado
            Log::info('Webhook recebido', [
                'identifier' => $identifier,
                'method' => $request->method(),
                'data' => $request->all()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Webhook recebido com sucesso',
                'timestamp' => now()->toISOString()
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Erro ao processar webhook', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'identifier' => $identifier,
                'method' => $request->method(),
                'headers' => $request->headers->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro interno no servidor.'
            ], 500);
        }
    }

    public function requests(string $token, Request $request): JsonResponse
    {
        $webhook = $this->webhookService->findByToken($token);
        
        if (!$webhook) {
            return response()->json(['error' => 'Webhook não encontrado'], 404);
        }

        $lastId = $request->query('last_id', 0);
        $requests = $this->webhookService->getLatestRequests($webhook, $lastId);

        return response()->json(['requests' => $requests]);
    }
} 