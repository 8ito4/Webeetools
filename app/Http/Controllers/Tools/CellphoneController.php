<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tools\GenerateCellphoneRequest;
use App\Services\Tools\CellphoneGeneratorService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class CellphoneController extends Controller
{
    public function __construct(
        private CellphoneGeneratorService $cellphoneGeneratorService
    ) {}

    public function index(): View
    {
        return view('tools.cellphone');
    }

    public function generate(GenerateCellphoneRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $cellphoneNumber = $this->cellphoneGeneratorService->generate($validatedData['ddd'] ?? null);

            return response()->json([
                'success' => true,
                'data' => [
                    'number' => $cellphoneNumber
                ],
                'meta' => [
                    'generated_at' => now()->toISOString()
                ]
            ], 200);

        } catch (\Throwable $e) {
            Log::error('Erro ao gerar número de celular', [
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
} 