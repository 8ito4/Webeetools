<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GenerateWhatsAppLinkRequest;
use App\Http\Requests\Api\FormatJsonRequest;
use App\Http\Requests\Api\GeneratePasswordRequest;
use App\Http\Requests\Api\GenerateLoremRequest;
use App\Interfaces\Services\WhatsAppLinkServiceInterface;
use App\Interfaces\Services\JsonFormatterServiceInterface;
use App\Interfaces\Services\PasswordGeneratorServiceInterface;
use App\Interfaces\Services\LoremIpsumServiceInterface;
use App\DTO\WhatsAppLinkData;
use App\DTO\ApiResponse;
use App\Exceptions\ApiException;
use App\Exceptions\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use JsonException;

class ApiController extends Controller
{
    public function __construct(
        private WhatsAppLinkServiceInterface $whatsAppLinkService,
        private JsonFormatterServiceInterface $jsonFormatterService,
        private PasswordGeneratorServiceInterface $passwordGeneratorService,
        private LoremIpsumServiceInterface $loremIpsumService
    ) {}

    /**
     * Gera link do WhatsApp com mensagem personalizada
     */
    public function generateWhatsAppLink(GenerateWhatsAppLinkRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $whatsAppData = WhatsAppLinkData::fromArray($validatedData);
            $linkData = $this->whatsAppLinkService->generateLink($whatsAppData);

            $response = ApiResponse::success(
                data: $linkData,
                meta: [
                    'generated_at' => now()->toISOString(),
                    'expires_at' => null
                ]
            );

            return response()->json($response->toArray(), $response->statusCode);

        } catch (ValidationException $e) {
            Log::error('Validation error ao gerar link do WhatsApp', [
                'message' => $e->getMessage(),
                'context' => $e->getContext(),
                'input' => $request->validated()
            ]);

            $response = ApiResponse::error($e->getMessage(), statusCode: $e->getStatusCode());
            return response()->json($response->toArray(), $response->statusCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao gerar link do WhatsApp', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->validated()
            ]);

            $response = ApiResponse::error('Erro interno no servidor.', statusCode: 500);
            return response()->json($response->toArray(), $response->statusCode);
        }
    }

    /**
     * Formata, valida ou minifica JSON
     */
    public function formatJson(FormatJsonRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $jsonResult = $this->jsonFormatterService->processJson($validatedData);

            $response = ApiResponse::success(
                data: $jsonResult,
                meta: [
                    'action' => $validatedData['action'] ?? 'format',
                    'processed_at' => now()->toISOString()
                ]
            );

            return response()->json($response->toArray(), $response->statusCode);

        } catch (ValidationException $e) {
            $response = ApiResponse::error($e->getMessage(), statusCode: $e->getStatusCode());
            return response()->json($response->toArray(), $response->statusCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao processar JSON', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->validated()
            ]);

            $response = ApiResponse::error('Erro interno no servidor.', statusCode: 500);
            return response()->json($response->toArray(), $response->statusCode);
        }
    }

    /**
     * Gera senhas seguras
     */
    public function generatePassword(GeneratePasswordRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $passwordData = $this->passwordGeneratorService->generatePassword($validatedData);

            $response = ApiResponse::success(
                data: $passwordData,
                meta: [
                    'generated_at' => now()->toISOString()
                ]
            );

            return response()->json($response->toArray(), $response->statusCode);

        } catch (ValidationException $e) {
            $response = ApiResponse::error($e->getMessage(), statusCode: $e->getStatusCode());
            return response()->json($response->toArray(), $response->statusCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao gerar senha', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->validated()
            ]);

            $response = ApiResponse::error('Erro interno no servidor.', statusCode: 500);
            return response()->json($response->toArray(), $response->statusCode);
        }
    }

    /**
     * Gera texto Lorem Ipsum
     */
    public function generateLorem(GenerateLoremRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $loremResult = $this->loremIpsumService->generateLorem($validatedData);

            $response = ApiResponse::success(
                data: $loremResult,
                meta: [
                    'type' => $validatedData['type'] ?? 'paragraphs',
                    'count' => $validatedData['count'] ?? 3,
                    'start_with_lorem' => $validatedData['start_with_lorem'] ?? true,
                    'generated_at' => now()->toISOString()
                ]
            );

            return response()->json($response->toArray(), $response->statusCode);

        } catch (\Throwable $e) {
            Log::error('Erro ao gerar Lorem Ipsum', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->validated()
            ]);

            $response = ApiResponse::error('Erro interno no servidor.', statusCode: 500);
            return response()->json($response->toArray(), $response->statusCode);
        }
    }
}
