<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\Services\WebhookServiceInterface;

class ToolController extends Controller
{
    public function __construct(
        private WebhookServiceInterface $webhookService
    ) {}

    public function webhook()
    {
        $token = $this->webhookService->generateUniqueUrl();
        $webhook = $this->webhookService->findByToken($token);
        $requests = $this->webhookService->getLatestRequests($webhook);

        return view('tools.webhook', compact('token', 'requests'));
    }

    public function webhookReceive(Request $request, string $token)
    {
        $webhook = $this->webhookService->findByToken($token);
        
        if (!$webhook) {
            return response()->json(['error' => 'Webhook não encontrado'], 404);
        }

        $this->webhookService->processRequest($webhook, $request);

        return response()->json(['message' => 'Webhook recebido com sucesso']);
    }

    public function json()
    {
        return view('tools.json');
    }

    public function password()
    {
        return view('tools.password');
    }

    public function base64()
    {
        return view('tools.base64');
    }

    public function qrcode()
    {
        return view('tools.qrcode');
    }

    public function email()
    {
        return view('tools.email');
    }

    public function sha256()
    {
        return view('tools.sha256');
    }

    public function xml()
    {
        return view('tools.xml');
    }
} 