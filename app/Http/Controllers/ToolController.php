<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\Services\WebhookServiceInterface;
use App\Repositories\CellphoneGeneratorRepository;

class ToolController extends Controller
{
    public function __construct(
        private WebhookServiceInterface $webhookService
    ) {}

    public function webhook()
    {
        $webhook = session('webhook');
        $requests = $webhook ? $this->webhookService->getLatestRequests($webhook) : [];
        return view('tools.webhook', compact('webhook', 'requests'));
    }

    public function createWebhook(Request $request)
    {
        $webhook = $this->webhookService->create([
            'name' => $request->input('project_name'),
            'description' => 'Webhook criado para teste'
        ]);
        
        session(['webhook' => $webhook]);
        return redirect()->route('tools.webhook');
    }

    public function deleteWebhook()
    {
        $webhook = session('webhook');
        if ($webhook) {
            $this->webhookService->delete($webhook);
            session()->forget('webhook');
        }
        return redirect()->route('tools.webhook');
    }

    public function clearWebhookSession()
    {
        session()->forget('webhook');
        return response()->json(['message' => 'Sessão limpa com sucesso']);
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

    public function document()
    {
        return view('tools.document');
    }

    public function sha256()
    {
        return view('tools.sha256');
    }

    public function xml()
    {
        return view('tools.xml');
    }

    public function cellphone(Request $request, CellphoneGeneratorRepository $repository)
    {
        if ($request->isMethod('post')) {
            $ddd = $request->input('ddd');
            $cellphone = $repository->generate($ddd);
            return redirect()->route('tools.cellphone')->with('cellphone', $cellphone);
        }
        return view('tools.cellphone');
    }

    public function pomodoro()
    {
        return view('tools.pomodoro');
    }
} 