<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tools\GenerateResumeRequest;
use App\Services\Resume\ResumeGeneratorService;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ResumeController extends Controller
{
    public function __construct(
        private ResumeGeneratorService $resumeGeneratorService
    ) {}

    public function index(): View
    {
        return view('tools.resume');
    }

    public function generate(GenerateResumeRequest $request): Response
    {
        try {
            $validatedData = $request->validated();
            $pdfContent = $this->resumeGeneratorService->generatePdf($validatedData);

            return response($pdfContent)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="curriculo.pdf"');

        } catch (\Throwable $e) {
            Log::error('Erro ao gerar currículo', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->validated()
            ]);

            return response('Erro interno no servidor.', 500);
        }
    }
} 