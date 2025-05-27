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
        $request->validate([
            'project_name' => 'nullable|string|max:255',
        ]);

        $webhook = $this->webhookService->create([
            'name' => $request->input('project_name'),
            'custom_url' => $this->generateUniqueCustomUrl(),
            'description' => 'Webhook criado para teste'
        ]);
        
        session(['webhook' => $webhook]);
        return redirect()->route('tools.webhook')->with('success', 'Webhook criado com sucesso!');
    }

    private function generateUniqueCustomUrl(): string
    {
        do {
            // Gera uma URL amigável com palavras + números
            $adjectives = ['quick', 'smart', 'cool', 'fast', 'bright', 'sharp', 'clean', 'fresh', 'bold', 'neat'];
            $nouns = ['webhook', 'api', 'endpoint', 'hook', 'listener', 'receiver', 'handler', 'service'];
            
            $adjective = $adjectives[array_rand($adjectives)];
            $noun = $nouns[array_rand($nouns)];
            $number = rand(100, 999);
            
            $customUrl = $adjective . '-' . $noun . '-' . $number;
        } while ($this->webhookService->findByCustomUrl($customUrl));

        return $customUrl;
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

    public function webhookReceive(Request $request, string $identifier)
    {
        // Primeiro tenta encontrar por custom_url, depois por token (compatibilidade)
        $webhook = $this->webhookService->findByCustomUrl($identifier) 
                   ?? $this->webhookService->findByToken($identifier);
        
        if (!$webhook) {
            return response()->json(['error' => 'Webhook não encontrado'], 404);
        }

        $this->webhookService->processRequest($webhook, $request);

        return response()->json(['message' => 'Webhook recebido com sucesso']);
    }

    public function webhookRequests(string $token, Request $request)
    {
        $webhook = $this->webhookService->findByToken($token);
        
        if (!$webhook) {
            return response()->json(['error' => 'Webhook não encontrado'], 404);
        }

        $lastId = $request->query('last_id', 0);
        $requests = $this->webhookService->getLatestRequests($webhook, $lastId);

        return response()->json(['requests' => $requests]);
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

    public function lorem()
    {
        return view('tools.lorem');
    }

    public function aiChat()
    {
        return view('tools.ai-chat');
    }

    public function apiTester()
    {
        return view('tools.api-tester');
    }

    public function sendRequest(Request $request)
    {
        $request->validate([
            'method' => 'required|string|in:GET,POST,PUT,PATCH,DELETE',
            'url' => 'required|url',
            'headers' => 'array',
            'queryParams' => 'array',
            'bodyType' => 'required|string|in:none,form,json,text',
            'body' => 'nullable'
        ]);

        $client = new \GuzzleHttp\Client();
        $options = [
            'headers' => $request->input('headers', []),
            'query' => $request->input('queryParams', [])
        ];

        if ($request->input('bodyType') !== 'none') {
            switch ($request->input('bodyType')) {
                case 'form':
                    $options['form_params'] = $request->input('body');
                    break;
                case 'json':
                    $options['json'] = $request->input('body');
                    break;
                case 'text':
                    $options['body'] = $request->input('body');
                    break;
            }
        }

        try {
            $response = $client->request(
                $request->input('method'),
                $request->input('url'),
                $options
            );

            return response()->json([
                'status' => $response->getStatusCode(),
                'headers' => $response->getHeaders(),
                'body' => (string) $response->getBody()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function saveRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'method' => 'required|string|in:GET,POST,PUT,PATCH,DELETE',
            'url' => 'required|url',
            'headers' => 'array',
            'queryParams' => 'array',
            'bodyType' => 'required|string|in:none,form,json,text',
            'body' => 'nullable'
        ]);

        $savedRequests = session('api_tester_requests', []);
        $id = count($savedRequests) + 1;

        $savedRequests[] = [
            'id' => $id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'method' => $request->input('method'),
            'url' => $request->input('url'),
            'headers' => $request->input('headers', []),
            'queryParams' => $request->input('queryParams', []),
            'bodyType' => $request->input('bodyType'),
            'body' => $request->input('body')
        ];

        session(['api_tester_requests' => $savedRequests]);

        return response()->json(['id' => $id]);
    }

    public function loadRequest($id = null)
    {
        $savedRequests = session('api_tester_requests', []);

        if ($id) {
            $request = collect($savedRequests)->firstWhere('id', $id);
            return response()->json($request);
        }

        return response()->json($savedRequests);
    }

    public function deleteRequest($id)
    {
        $savedRequests = session('api_tester_requests', []);
        $savedRequests = collect($savedRequests)->filter(fn($r) => $r['id'] != $id)->values()->all();
        session(['api_tester_requests' => $savedRequests]);
        return response()->json(['success' => true]);
    }
} 