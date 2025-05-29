<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    public function networkTools()
    {
        return view('tools.network-tools');
    }

    public function whatsappLink()
    {
        return view('tools.whatsapp-link');
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

    public function resumeGenerator()
    {
        return view('tools.resume-generator');
    }

    public function generateResume(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'fullName' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'template' => 'sometimes|string|in:modern,classic,creative'
        ]);

        try {
            // Log para debug
            Log::info('Iniciando geração de currículo', [
                'nome' => $request->input('fullName'),
                'template' => $request->input('template', 'modern')
            ]);
            
            // Verificar se TCPDF está disponível
            if (!class_exists('TCPDF')) {
                throw new \Exception('Biblioteca TCPDF não encontrada. Execute: composer require tecnickcom/tcpdf');
            }

            // Coletar todos os dados do formulário
            $data = [
                'personal' => [
                    'fullName' => $request->input('fullName'),
                    'position' => $request->input('position'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'linkedin' => $request->input('linkedin'),
                    'website' => $request->input('website'),
                    'location' => $request->input('location'),
                    'summary' => $request->input('summary')
                ],
                'experience' => $this->formatExperience($request->input('experience', [])),
                'education' => $this->formatEducation($request->input('education', [])),
                'skills' => [
                    'technical' => $request->input('skills.technical'),
                    'interpersonal' => $request->input('skills.interpersonal'),
                    'specialization' => $request->input('skills.specialization'),
                    'certifications' => $request->input('skills.certifications')
                ],
                'languages' => $this->formatLanguages($request->input('languages', [])),
                'additional' => [
                    'courses' => $request->input('additional.courses'),
                    'projects' => $request->input('additional.projects'),
                    'volunteer' => $request->input('additional.volunteer')
                ],
                'template' => $request->input('template', 'modern')
            ];

            // Log dos dados coletados
            Log::info('Dados coletados para o PDF', ['template' => $data['template']]);

            // Gerar PDF baseado no template selecionado
            $pdf = $this->createResumePDF($data);

            // Criar nome do arquivo
            $fileName = 'curriculo_' . str_replace(' ', '_', strtolower($data['personal']['fullName'])) . '_' . date('Y-m-d') . '.pdf';

            Log::info('PDF gerado com sucesso', ['arquivo' => $fileName, 'tamanho' => strlen($pdf)]);

            // Limpar qualquer output anterior
            if (ob_get_length()) {
                ob_end_clean();
            }

            // Retornar PDF como resposta de download com headers mais específicos
            return response($pdf, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"')
                ->header('Content-Length', strlen($pdf))
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0')
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        } catch (\Exception $e) {
            Log::error('Erro ao gerar currículo: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'error' => 'Erro ao gerar currículo: ' . $e->getMessage()
            ], 500);
        }
    }

    private function formatExperience($experience)
    {
        $formatted = [];
        foreach ($experience as $exp) {
            if (!empty($exp['position']) && !empty($exp['company'])) {
                $formatted[] = [
                    'position' => $exp['position'],
                    'company' => $exp['company'],
                    'startDate' => $exp['startDate'] ?? null,
                    'endDate' => isset($exp['current']) && $exp['current'] ? 'Atual' : ($exp['endDate'] ?? null),
                    'description' => $exp['description'] ?? ''
                ];
            }
        }
        return $formatted;
    }

    private function formatEducation($education)
    {
        $formatted = [];
        foreach ($education as $edu) {
            if (!empty($edu['degree']) && !empty($edu['institution'])) {
                $formatted[] = [
                    'degree' => $edu['degree'],
                    'institution' => $edu['institution'],
                    'startYear' => $edu['startYear'] ?? null,
                    'endYear' => $edu['endYear'] ?? null
                ];
            }
        }
        return $formatted;
    }

    private function formatLanguages($languages)
    {
        $formatted = [];
        foreach ($languages as $lang) {
            if (!empty($lang['language'])) {
                $formatted[] = [
                    'language' => $lang['language'],
                    'level' => $lang['level'] ?? 'Básico'
                ];
            }
        }
        return $formatted;
    }

    private function createResumePDF($data)
    {
        // Criar nova instância do TCPDF
        $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        
        // Configurações do documento
        $pdf->SetCreator('Webeetools');
        $pdf->SetAuthor($data['personal']['fullName']);
        $pdf->SetTitle('Currículo - ' . $data['personal']['fullName']);
        $pdf->SetSubject('Currículo Profissional');
        
        // Remover header e footer padrão
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        // Configurar margens
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 15);
        
        // Adicionar página
        $pdf->AddPage();
        
        // Escolher template baseado na seleção
        switch ($data['template']) {
            case 'modern':
                $this->generateModernTemplate($pdf, $data);
                break;
            case 'classic':
                $this->generateClassicTemplate($pdf, $data);
                break;
            case 'creative':
                $this->generateCreativeTemplate($pdf, $data);
                break;
            default:
                $this->generateModernTemplate($pdf, $data);
        }
        
        return $pdf->Output('curriculo.pdf', 'S');
    }

    private function generateModernTemplate($pdf, $data)
    {
        // Definir cores do template moderno
        $primaryColor = [59, 130, 246]; // Azul
        $accentColor = [29, 78, 216]; // Azul escuro
        $textColor = [31, 41, 55]; // Cinza escuro
        
        $y = 20;
        
        // Header com fundo colorido
        $pdf->SetFillColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        $pdf->Rect(0, 0, 210, 70, 'F');
        
        // Nome e cargo
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B', 28);
        $pdf->SetXY(20, 20);
        $pdf->Cell(0, 15, $data['personal']['fullName'], 0, 1, 'L');
        
        $pdf->SetFont('helvetica', '', 16);
        $pdf->SetXY(20, 35);
        $pdf->Cell(0, 10, $data['personal']['position'], 0, 1, 'L');
        
        // Informações de contato
        $pdf->SetFont('helvetica', '', 10);
        $contactInfo = [];
        if ($data['personal']['email']) $contactInfo[] = 'Email: ' . $data['personal']['email'];
        if ($data['personal']['phone']) $contactInfo[] = 'Tel: ' . $data['personal']['phone'];
        if ($data['personal']['location']) $contactInfo[] = $data['personal']['location'];
        if ($data['personal']['linkedin']) $contactInfo[] = 'LinkedIn';
        if ($data['personal']['website']) $contactInfo[] = 'Website';
        
        $pdf->SetXY(20, 50);
        $pdf->Cell(0, 8, implode('  |  ', $contactInfo), 0, 1, 'L');
        
        $y = 80;
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        
        // Resumo Profissional
        if ($data['personal']['summary']) {
            $y = $this->addSection($pdf, 'RESUMO PROFISSIONAL', $data['personal']['summary'], $y, $primaryColor);
        }
        
        // Experiência Profissional
        if (!empty($data['experience'])) {
            $y = $this->addExperienceSection($pdf, $data['experience'], $y, $primaryColor);
        }
        
        // Formação Acadêmica
        if (!empty($data['education'])) {
            $y = $this->addEducationSection($pdf, $data['education'], $y, $primaryColor);
        }
        
        // Habilidades e Competências
        $skills = array_filter($data['skills']);
        if (!empty($skills)) {
            $y = $this->addSkillsSection($pdf, $skills, $y, $primaryColor);
        }
        
        // Idiomas
        if (!empty($data['languages'])) {
            $y = $this->addLanguagesSection($pdf, $data['languages'], $y, $primaryColor);
        }
        
        // Informações Adicionais
        if (!empty($data['additional'])) {
            $y = $this->addAdditionalSection($pdf, $data['additional'], $y, $primaryColor);
        }
    }

    private function generateClassicTemplate($pdf, $data)
    {
        // Template clássico em preto e branco
        $primaryColor = [31, 41, 55]; // Cinza escuro
        $accentColor = [75, 85, 99]; // Cinza médio
        $textColor = [31, 41, 55];
        
        $y = 20;
        
        // Header simples
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        $pdf->SetFont('helvetica', 'B', 24);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 12, $data['personal']['fullName'], 0, 1, 'C');
        
        $y += 15;
        $pdf->SetFont('helvetica', '', 14);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 8, $data['personal']['position'], 0, 1, 'C');
        
        $y += 12;
        // Linha separadora
        $pdf->SetDrawColor($accentColor[0], $accentColor[1], $accentColor[2]);
        $pdf->Line(20, $y, 190, $y);
        
        $y += 10;
        // Informações de contato centralizadas
        $contactInfo = [];
        if ($data['personal']['email']) $contactInfo[] = $data['personal']['email'];
        if ($data['personal']['phone']) $contactInfo[] = $data['personal']['phone'];
        if ($data['personal']['location']) $contactInfo[] = $data['personal']['location'];
        
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 6, implode('  |  ', $contactInfo), 0, 1, 'C');
        
        $y += 15;
        
        // Continuar com o resto das seções...
        if ($data['personal']['summary']) {
            $y = $this->addSection($pdf, 'RESUMO PROFISSIONAL', $data['personal']['summary'], $y, $primaryColor);
        }
        
        if (!empty($data['experience'])) {
            $y = $this->addExperienceSection($pdf, $data['experience'], $y, $primaryColor);
        }
        
        if (!empty($data['education'])) {
            $y = $this->addEducationSection($pdf, $data['education'], $y, $primaryColor);
        }
        
        $skills = array_filter($data['skills']);
        if (!empty($skills)) {
            $y = $this->addSkillsSection($pdf, $skills, $y, $primaryColor);
        }
        
        if (!empty($data['languages'])) {
            $y = $this->addLanguagesSection($pdf, $data['languages'], $y, $primaryColor);
        }
        
        if (!empty($data['additional'])) {
            $y = $this->addAdditionalSection($pdf, $data['additional'], $y, $primaryColor);
        }
    }

    private function generateCreativeTemplate($pdf, $data)
    {
        // Template criativo com verde
        $primaryColor = [16, 185, 129]; // Verde
        $accentColor = [4, 120, 87]; // Verde escuro
        $textColor = [31, 41, 55];
        
        $y = 20;
        
        // Header criativo com forma geométrica
        $pdf->SetFillColor($primaryColor[0], $primaryColor[1], $primaryColor[2]);
        
        // Criar um header em forma de losango/diagonal
        $points = array(
            0, 0,
            210, 0,
            190, 80,
            0, 60
        );
        $pdf->Polygon($points, 'F');
        
        // Nome e cargo (texto branco sobre verde)
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('helvetica', 'B', 26);
        $pdf->SetXY(20, 20);
        $pdf->Cell(0, 12, $data['personal']['fullName'], 0, 1, 'L');
        
        $pdf->SetFont('helvetica', '', 15);
        $pdf->SetXY(20, 35);
        $pdf->Cell(0, 8, $data['personal']['position'], 0, 1, 'L');
        
        // Informações de contato em layout moderno - CORRIGIDO: usar texto escuro
        $pdf->SetTextColor(31, 41, 55); // Texto escuro para contraste
        $pdf->SetFont('helvetica', '', 9);
        $contactY = 70; // Mover mais para baixo, fora da área verde
        
        if ($data['personal']['email']) {
            $pdf->SetXY(20, $contactY);
            $pdf->Cell(0, 5, 'Email: ' . $data['personal']['email'], 0, 1, 'L');
            $contactY += 6;
        }
        if ($data['personal']['phone']) {
            $pdf->SetXY(20, $contactY);
            $pdf->Cell(0, 5, 'Telefone: ' . $data['personal']['phone'], 0, 1, 'L');
            $contactY += 6;
        }
        if ($data['personal']['location']) {
            $pdf->SetXY(20, $contactY);
            $pdf->Cell(0, 5, 'Local: ' . $data['personal']['location'], 0, 1, 'L');
            $contactY += 6;
        }
        if ($data['personal']['linkedin']) {
            $pdf->SetXY(20, $contactY);
            $pdf->Cell(0, 5, 'LinkedIn: Disponivel', 0, 1, 'L');
            $contactY += 6;
        }
        if ($data['personal']['website']) {
            $pdf->SetXY(20, $contactY);
            $pdf->Cell(0, 5, 'Website: Disponivel', 0, 1, 'L');
            $contactY += 6;
        }
        
        $y = $contactY + 10; // Começar conteúdo após as informações de contato
        $pdf->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        
        // Continuar com as seções
        if ($data['personal']['summary']) {
            $y = $this->addSection($pdf, 'RESUMO PROFISSIONAL', $data['personal']['summary'], $y, $primaryColor);
        }
        
        if (!empty($data['experience'])) {
            $y = $this->addExperienceSection($pdf, $data['experience'], $y, $primaryColor);
        }
        
        if (!empty($data['education'])) {
            $y = $this->addEducationSection($pdf, $data['education'], $y, $primaryColor);
        }
        
        $skills = array_filter($data['skills']);
        if (!empty($skills)) {
            $y = $this->addSkillsSection($pdf, $skills, $y, $primaryColor);
        }
        
        if (!empty($data['languages'])) {
            $y = $this->addLanguagesSection($pdf, $data['languages'], $y, $primaryColor);
        }
        
        if (!empty($data['additional'])) {
            $y = $this->addAdditionalSection($pdf, $data['additional'], $y, $primaryColor);
        }
    }

    private function addSection($pdf, $title, $content, $y, $color)
    {
        // Verificar se precisa de nova página
        if ($y > 250) {
            $pdf->AddPage();
            $y = 20;
        }
        
        // Título da seção
        $pdf->SetTextColor($color[0], $color[1], $color[2]);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 8, $title, 0, 1, 'L');
        
        $y += 10;
        
        // Linha sob o título
        $pdf->SetDrawColor($color[0], $color[1], $color[2]);
        $pdf->Line(20, $y, 190, $y);
        
        $y += 8;
        
        // Conteúdo
        $pdf->SetTextColor(31, 41, 55);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetXY(20, $y);
        
        // MultiCell para texto com quebra de linha
        $pdf->MultiCell(170, 5, $content, 0, 'L', false);
        
        return $pdf->GetY() + 10;
    }

    private function addExperienceSection($pdf, $experiences, $y, $color)
    {
        if ($y > 250) {
            $pdf->AddPage();
            $y = 20;
        }
        
        // Título da seção
        $pdf->SetTextColor($color[0], $color[1], $color[2]);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 8, 'EXPERIÊNCIA PROFISSIONAL', 0, 1, 'L');
        
        $y += 10;
        $pdf->SetDrawColor($color[0], $color[1], $color[2]);
        $pdf->Line(20, $y, 190, $y);
        $y += 8;
        
        foreach ($experiences as $exp) {
            if ($y > 250) {
                $pdf->AddPage();
                $y = 20;
            }
            
            // Cargo e empresa
            $pdf->SetTextColor(31, 41, 55);
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 6, $exp['position'] . ' - ' . $exp['company'], 0, 1, 'L');
            
            $y += 7;
            
            // Período
            $pdf->SetFont('helvetica', 'I', 9);
            $pdf->SetTextColor(75, 85, 99);
            $pdf->SetXY(20, $y);
            
            $period = '';
            if ($exp['startDate']) {
                $period = date('m/Y', strtotime($exp['startDate']));
                if ($exp['endDate'] && $exp['endDate'] !== 'Atual') {
                    $period .= ' - ' . date('m/Y', strtotime($exp['endDate']));
                } else {
                    $period .= ' - Atual';
                }
            }
            
            $pdf->Cell(0, 5, $period, 0, 1, 'L');
            $y += 7;
            
            // Descrição
            if ($exp['description']) {
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetTextColor(31, 41, 55);
                $pdf->SetXY(20, $y);
                $pdf->MultiCell(170, 4, $exp['description'], 0, 'L', false);
                $y = $pdf->GetY() + 5;
            }
            
            $y += 5;
        }
        
        return $y + 5;
    }

    private function addEducationSection($pdf, $education, $y, $color)
    {
        if ($y > 250) {
            $pdf->AddPage();
            $y = 20;
        }
        
        $pdf->SetTextColor($color[0], $color[1], $color[2]);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 8, 'FORMAÇÃO ACADÊMICA', 0, 1, 'L');
        
        $y += 10;
        $pdf->SetDrawColor($color[0], $color[1], $color[2]);
        $pdf->Line(20, $y, 190, $y);
        $y += 8;
        
        foreach ($education as $edu) {
            if ($y > 250) {
                $pdf->AddPage();
                $y = 20;
            }
            
            $pdf->SetTextColor(31, 41, 55);
            $pdf->SetFont('helvetica', 'B', 11);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 6, $edu['degree'], 0, 1, 'L');
            
            $y += 7;
            
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 5, $edu['institution'], 0, 1, 'L');
            
            $y += 6;
            
            if ($edu['startYear'] && $edu['endYear']) {
                $pdf->SetFont('helvetica', 'I', 9);
                $pdf->SetTextColor(75, 85, 99);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 5, $edu['startYear'] . ' - ' . $edu['endYear'], 0, 1, 'L');
                $y += 6;
            }
            
            $y += 5;
        }
        
        return $y + 5;
    }

    private function addSkillsSection($pdf, $skills, $y, $color)
    {
        if ($y > 250) {
            $pdf->AddPage();
            $y = 20;
        }
        
        $pdf->SetTextColor($color[0], $color[1], $color[2]);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 8, 'COMPETÊNCIAS E HABILIDADES', 0, 1, 'L');
        
        $y += 10;
        $pdf->SetDrawColor($color[0], $color[1], $color[2]);
        $pdf->Line(20, $y, 190, $y);
        $y += 8;
        
        $skillTitles = [
            'technical' => 'Habilidades Técnicas',
            'interpersonal' => 'Habilidades Interpessoais',
            'specialization' => 'Áreas de Especialização',
            'certifications' => 'Certificações'
        ];
        
        foreach ($skills as $key => $value) {
            if (!empty($value)) {
                if ($y > 250) {
                    $pdf->AddPage();
                    $y = 20;
                }
                
                $pdf->SetTextColor(31, 41, 55);
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 6, $skillTitles[$key] . ':', 0, 1, 'L');
                
                $y += 7;
                
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetXY(20, $y);
                $pdf->MultiCell(170, 4, $value, 0, 'L', false);
                $y = $pdf->GetY() + 3;
            }
        }
        
        return $y + 5;
    }

    private function addAdditionalSection($pdf, $additional, $y, $color)
    {
        $hasContent = false;
        foreach ($additional as $content) {
            if (!empty($content)) {
                $hasContent = true;
                break;
            }
        }
        
        if (!$hasContent) {
            return $y;
        }
        
        if ($y > 250) {
            $pdf->AddPage();
            $y = 20;
        }
        
        $pdf->SetTextColor($color[0], $color[1], $color[2]);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 8, 'INFORMAÇÕES ADICIONAIS', 0, 1, 'L');
        
        $y += 10;
        $pdf->SetDrawColor($color[0], $color[1], $color[2]);
        $pdf->Line(20, $y, 190, $y);
        $y += 8;
        
        $additionalTitles = [
            'courses' => 'Cursos e Treinamentos',
            'projects' => 'Projetos e Realizações',
            'volunteer' => 'Trabalho Voluntário'
        ];
        
        foreach ($additional as $key => $value) {
            if (!empty($value)) {
                if ($y > 250) {
                    $pdf->AddPage();
                    $y = 20;
                }
                
                $pdf->SetTextColor(31, 41, 55);
                $pdf->SetFont('helvetica', 'B', 10);
                $pdf->SetXY(20, $y);
                $pdf->Cell(0, 6, $additionalTitles[$key] . ':', 0, 1, 'L');
                
                $y += 7;
                
                $pdf->SetFont('helvetica', '', 9);
                $pdf->SetXY(20, $y);
                $pdf->MultiCell(170, 4, $value, 0, 'L', false);
                $y = $pdf->GetY() + 8;
            }
        }
        
        return $y + 5;
    }

    private function addLanguagesSection($pdf, $languages, $y, $color)
    {
        if ($y > 250) {
            $pdf->AddPage();
            $y = 20;
        }
        
        $pdf->SetTextColor($color[0], $color[1], $color[2]);
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->SetXY(20, $y);
        $pdf->Cell(0, 8, 'IDIOMAS', 0, 1, 'L');
        
        $y += 10;
        $pdf->SetDrawColor($color[0], $color[1], $color[2]);
        $pdf->Line(20, $y, 190, $y);
        $y += 8;
        
        foreach ($languages as $lang) {
            if ($y > 250) {
                $pdf->AddPage();
                $y = 20;
            }
            
            $pdf->SetTextColor(31, 41, 55);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->SetXY(20, $y);
            $pdf->Cell(0, 5, $lang['language'] . ' - ' . $lang['level'], 0, 1, 'L');
            $y += 6;
        }
        
        return $y + 10;
    }
} 