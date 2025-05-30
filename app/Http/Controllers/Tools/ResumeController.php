<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tools\GenerateResumeRequest;
use App\Services\Resume\ResumeGeneratorService;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function __construct(
        private ResumeGeneratorService $resumeGeneratorService
    ) {}

    public function index(): View
    {
        return view('tools.resume-generator');
    }

    public function generate(GenerateResumeRequest $request): RedirectResponse|Response
    {
        try {
            $validatedData = $request->validated();
            
            // Log dos dados recebidos
            Log::info('Dados recebidos para geração de currículo', $validatedData);
            
            // Reorganizar dados para o formato esperado pelo serviço
            $formattedData = [
                'personal' => [
                    'fullName' => $validatedData['fullName'],
                    'position' => $validatedData['position'],
                    'email' => $validatedData['email'],
                    'phone' => $validatedData['phone'],
                    'linkedin' => $validatedData['linkedin'] ?? '',
                    'website' => $validatedData['website'] ?? '',
                    'location' => $validatedData['location'] ?? '',
                    'summary' => $validatedData['summary'] ?? '',
                ],
                'template' => $validatedData['template'] ?? 'modern',
                'experience' => $validatedData['experience'] ?? [],
                'education' => $validatedData['education'] ?? [],
                'skills' => $validatedData['skills'] ?? [],
                'languages' => $validatedData['languages'] ?? [],
                'additional' => $validatedData['additional'] ?? [],
            ];
            
            Log::info('Dados formatados para o serviço', $formattedData);
            
            $pdfContent = $this->resumeGeneratorService->generatePdf($formattedData);

            // Gerar nome único para o arquivo
            $filename = 'curriculo_' . time() . '.pdf';
            
            // Salvar temporariamente o PDF
            Storage::disk('local')->put('temp/resumes/' . $filename, $pdfContent);
            
            // Salvar filename na sessão para download posterior
            session(['resume_filename' => $filename, 'resume_content' => $pdfContent]);
            
            // Redirecionar diretamente para página de sucesso
            return redirect()->route('tools.resume.success')
                ->with('success', 'Currículo gerado com sucesso!')
                ->with('download_ready', true);

        } catch (\Throwable $e) {
            Log::error('Erro ao gerar currículo', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return back()->withErrors(['error' => 'Erro ao gerar currículo: ' . $e->getMessage()]);
        }
    }
    
    public function success(): View
    {
        return view('tools.resume-success');
    }
    
    public function download(string $filename): Response
    {
        try {
            $filePath = 'temp/resumes/' . $filename;
            
            if (!Storage::disk('local')->exists($filePath)) {
                abort(404, 'Arquivo não encontrado');
            }
            
            $pdfContent = Storage::disk('local')->get($filePath);
            
            // Remover arquivo temporário após download
            Storage::disk('local')->delete($filePath);
            
            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="curriculo.pdf"');
                
        } catch (\Throwable $e) {
            Log::error('Erro ao fazer download do currículo', [
                'message' => $e->getMessage(),
                'filename' => $filename
            ]);
            
            abort(404, 'Arquivo não encontrado');
        }
    }
} 