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
            
            // Diagnóstico completo do ambiente
            Log::info('=== DIAGNÓSTICO COMPLETO DO AMBIENTE ===', [
                'php_version' => PHP_VERSION,
                'environment' => app()->environment(),
                'debug_mode' => config('app.debug'),
                'base_path' => base_path(),
                'vendor_path' => base_path('vendor'),
                'tcpdf_file_exists' => file_exists(base_path('vendor/tecnickcom/tcpdf/tcpdf.php')),
                'tcpdf_readable' => is_readable(base_path('vendor/tecnickcom/tcpdf/tcpdf.php')),
                'autoload_exists' => file_exists(base_path('vendor/autoload.php')),
                'memory_limit' => ini_get('memory_limit'),
                'max_execution_time' => ini_get('max_execution_time'),
                'loaded_extensions' => get_loaded_extensions(),
                'include_path' => get_include_path(),
                'current_working_directory' => getcwd(),
                'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown',
                'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'unknown',
                'script_filename' => $_SERVER['SCRIPT_FILENAME'] ?? 'unknown'
            ]);
            
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
            Log::error('=== ERRO COMPLETO AO GERAR CURRÍCULO ===', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
                'user_ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'php_version' => PHP_VERSION,
                'environment' => app()->environment(),
                'memory_usage' => memory_get_usage(true),
                'memory_peak' => memory_get_peak_usage(true)
            ]);

            // Mensagem genérica para o usuário, sem expor detalhes técnicos
            $userMessage = 'Não foi possível gerar o currículo no momento. Tente novamente em alguns minutos.';
            
            // Em desenvolvimento, pode mostrar mais detalhes
            if (config('app.debug')) {
                $userMessage = 'Erro ao gerar currículo: ' . $e->getMessage();
            }

            return back()->withErrors(['error' => $userMessage]);
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
                'filename' => $filename,
                'user_ip' => request()->ip(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Mensagem genérica em produção
            if (config('app.debug')) {
                abort(404, 'Erro ao baixar arquivo: ' . $e->getMessage());
            } else {
                abort(404, 'Arquivo não encontrado ou expirado');
            }
        }
    }
} 