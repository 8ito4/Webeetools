<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * Gera link do WhatsApp com mensagem personalizada
     */
    public function generateWhatsAppLink(Request $request): JsonResponse
    {
        $request->validate([
            'phone' => 'required|string|min:8|max:20',
            'message' => 'nullable|string|max:1000',
            'shorten' => 'boolean'
        ]);

        $phone = preg_replace('/[^0-9+]/', '', $request->phone);
        $message = $request->message ?? '';
        $shouldShorten = $request->shorten ?? true;

        // Construir URL do WhatsApp
        $waUrl = "https://wa.me/{$phone}";
        if (!empty($message)) {
            $waUrl .= "?text=" . urlencode($message);
        }

        // Simular encurtamento (em produção, usar serviço real)
        $shortUrl = null;
        if ($shouldShorten) {
            $shortId = substr(md5($waUrl . time()), 0, 6);
            $shortUrl = "https://webeetools.link/{$shortId}";
        }

        return response()->json([
            'success' => true,
            'data' => [
                'original_url' => $waUrl,
                'short_url' => $shortUrl,
                'phone' => $phone,
                'message' => $message
            ],
            'meta' => [
                'generated_at' => now()->toISOString(),
                'expires_at' => null
            ]
        ]);
    }

    /**
     * Formata, valida ou minifica JSON
     */
    public function formatJson(Request $request): JsonResponse
    {
        $request->validate([
            'json' => 'required|string',
            'action' => 'in:format,minify,validate',
            'indent' => 'integer|min:0|max:8'
        ]);

        $jsonString = $request->json;
        $action = $request->action ?? 'format';
        $indent = $request->indent ?? 2;

        try {
            $decoded = json_decode($jsonString, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            return response()->json([
                'success' => false,
                'error' => 'JSON inválido: ' . $e->getMessage()
            ], 400);
        }

        $result = [];

        switch ($action) {
            case 'validate':
                $result = [
                    'valid' => true,
                    'size' => strlen($jsonString),
                    'formatted' => json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE, $indent)
                ];
                break;

            case 'minify':
                $result = [
                    'minified' => json_encode($decoded, JSON_UNESCAPED_UNICODE),
                    'original_size' => strlen($jsonString),
                    'minified_size' => strlen(json_encode($decoded, JSON_UNESCAPED_UNICODE))
                ];
                break;

            case 'format':
            default:
                $formatted = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE, $indent);
                $result = [
                    'formatted' => $formatted,
                    'size' => strlen($formatted),
                    'lines' => substr_count($formatted, "\n") + 1
                ];
                break;
        }

        return response()->json([
            'success' => true,
            'data' => $result,
            'meta' => [
                'action' => $action,
                'processed_at' => now()->toISOString()
            ]
        ]);
    }

    /**
     * Gera senhas seguras
     */
    public function generatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'length' => 'integer|min:8|max:128',
            'uppercase' => 'boolean',
            'lowercase' => 'boolean',
            'numbers' => 'boolean',
            'symbols' => 'boolean'
        ]);

        $length = $request->length ?? 12;
        $includeUppercase = $request->uppercase ?? true;
        $includeLowercase = $request->lowercase ?? true;
        $includeNumbers = $request->numbers ?? true;
        $includeSymbols = $request->symbols ?? true;

        $characters = '';
        $requiredChars = [];

        if ($includeUppercase) {
            $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $requiredChars[] = $this->getRandomChar('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        }

        if ($includeLowercase) {
            $characters .= 'abcdefghijklmnopqrstuvwxyz';
            $requiredChars[] = $this->getRandomChar('abcdefghijklmnopqrstuvwxyz');
        }

        if ($includeNumbers) {
            $characters .= '0123456789';
            $requiredChars[] = $this->getRandomChar('0123456789');
        }

        if ($includeSymbols) {
            $characters .= '!@#$%^&*()_+-=[]{}|;:,.<>?';
            $requiredChars[] = $this->getRandomChar('!@#$%^&*()_+-=[]{}|;:,.<>?');
        }

        if (empty($characters)) {
            return response()->json([
                'success' => false,
                'error' => 'Pelo menos um tipo de caractere deve ser selecionado'
            ], 400);
        }

        // Gerar senha garantindo pelo menos um caractere de cada tipo
        $password = '';
        $remainingLength = $length - count($requiredChars);

        // Adicionar caracteres obrigatórios
        foreach ($requiredChars as $char) {
            $password .= $char;
        }

        // Completar com caracteres aleatórios
        for ($i = 0; $i < $remainingLength; $i++) {
            $password .= $this->getRandomChar($characters);
        }

        // Embaralhar a senha
        $password = str_shuffle($password);

        // Calcular força da senha
        $strength = $this->calculatePasswordStrength($password);

        return response()->json([
            'success' => true,
            'data' => [
                'password' => $password,
                'length' => strlen($password),
                'strength' => $strength,
                'options' => [
                    'uppercase' => $includeUppercase,
                    'lowercase' => $includeLowercase,
                    'numbers' => $includeNumbers,
                    'symbols' => $includeSymbols
                ]
            ],
            'meta' => [
                'generated_at' => now()->toISOString()
            ]
        ]);
    }

    /**
     * Gera texto Lorem Ipsum
     */
    public function generateLorem(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'in:words,sentences,paragraphs',
            'count' => 'integer|min:1|max:50',
            'start_with_lorem' => 'boolean'
        ]);

        $type = $request->type ?? 'paragraphs';
        $count = $request->count ?? 3;
        $startWithLorem = $request->start_with_lorem ?? true;

        $loremWords = [
            'lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
            'sed', 'do', 'eiusmod', 'tempor', 'incididunt', 'ut', 'labore', 'et', 'dolore',
            'magna', 'aliqua', 'enim', 'ad', 'minim', 'veniam', 'quis', 'nostrud',
            'exercitation', 'ullamco', 'laboris', 'nisi', 'aliquip', 'ex', 'ea', 'commodo',
            'consequat', 'duis', 'aute', 'irure', 'in', 'reprehenderit', 'voluptate',
            'velit', 'esse', 'cillum', 'fugiat', 'nulla', 'pariatur', 'excepteur', 'sint',
            'occaecat', 'cupidatat', 'non', 'proident', 'sunt', 'culpa', 'qui', 'officia',
            'deserunt', 'mollit', 'anim', 'id', 'est', 'laborum'
        ];

        $result = [];

        switch ($type) {
            case 'words':
                $words = [];
                for ($i = 0; $i < $count; $i++) {
                    if ($i === 0 && $startWithLorem) {
                        $words[] = 'Lorem';
                    } else {
                        $words[] = $loremWords[array_rand($loremWords)];
                    }
                }
                $result = [
                    'text' => implode(' ', $words),
                    'word_count' => count($words)
                ];
                break;

            case 'sentences':
                $sentences = [];
                for ($i = 0; $i < $count; $i++) {
                    $sentenceLength = rand(8, 15);
                    $sentence = [];
                    
                    for ($j = 0; $j < $sentenceLength; $j++) {
                        if ($i === 0 && $j === 0 && $startWithLorem) {
                            $sentence[] = 'Lorem';
                        } else {
                            $sentence[] = $loremWords[array_rand($loremWords)];
                        }
                    }
                    
                    $sentences[] = ucfirst(implode(' ', $sentence)) . '.';
                }
                $result = [
                    'text' => implode(' ', $sentences),
                    'sentence_count' => count($sentences)
                ];
                break;

            case 'paragraphs':
            default:
                $paragraphs = [];
                for ($i = 0; $i < $count; $i++) {
                    $sentences = [];
                    $sentenceCount = rand(3, 6);
                    
                    for ($j = 0; $j < $sentenceCount; $j++) {
                        $sentenceLength = rand(8, 15);
                        $sentence = [];
                        
                        for ($k = 0; $k < $sentenceLength; $k++) {
                            if ($i === 0 && $j === 0 && $k === 0 && $startWithLorem) {
                                $sentence[] = 'Lorem';
                            } else {
                                $sentence[] = $loremWords[array_rand($loremWords)];
                            }
                        }
                        
                        $sentences[] = ucfirst(implode(' ', $sentence)) . '.';
                    }
                    
                    $paragraphs[] = implode(' ', $sentences);
                }
                $result = [
                    'text' => implode("\n\n", $paragraphs),
                    'paragraph_count' => count($paragraphs)
                ];
                break;
        }

        return response()->json([
            'success' => true,
            'data' => $result,
            'meta' => [
                'type' => $type,
                'count' => $count,
                'start_with_lorem' => $startWithLorem,
                'generated_at' => now()->toISOString()
            ]
        ]);
    }

    /**
     * Obtém um caractere aleatório de uma string
     */
    private function getRandomChar(string $characters): string
    {
        return $characters[random_int(0, strlen($characters) - 1)];
    }

    /**
     * Calcula a força da senha
     */
    private function calculatePasswordStrength(string $password): array
    {
        $score = 0;
        $feedback = [];

        // Comprimento
        $length = strlen($password);
        if ($length >= 12) {
            $score += 2;
        } elseif ($length >= 8) {
            $score += 1;
        } else {
            $feedback[] = 'Use pelo menos 8 caracteres';
        }

        // Tipos de caracteres
        if (preg_match('/[a-z]/', $password)) $score += 1;
        if (preg_match('/[A-Z]/', $password)) $score += 1;
        if (preg_match('/[0-9]/', $password)) $score += 1;
        if (preg_match('/[^a-zA-Z0-9]/', $password)) $score += 2;

        // Determinar nível
        if ($score >= 6) {
            $level = 'forte';
        } elseif ($score >= 4) {
            $level = 'média';
        } else {
            $level = 'fraca';
        }

        return [
            'score' => $score,
            'level' => $level,
            'feedback' => $feedback
        ];
    }
}
