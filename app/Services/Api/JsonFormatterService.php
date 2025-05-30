<?php

namespace App\Services\Api;

use App\DTO\JsonProcessingData;
use App\Enums\JsonAction;
use App\Exceptions\ValidationException;
use App\Interfaces\Services\JsonFormatterServiceInterface;
use App\Traits\LogsActivity;

class JsonFormatterService implements JsonFormatterServiceInterface
{
    use LogsActivity;

    public function processJson(array $validatedData): array
    {
        $data = JsonProcessingData::fromArray($validatedData);
        $decodedJson = $this->decodeJson($data->json);
        
        $result = match($data->action) {
            JsonAction::VALIDATE => $this->validateJson($decodedJson, $data->json, $data->indent),
            JsonAction::MINIFY => $this->minifyJson($decodedJson, $data->json),
            JsonAction::FORMAT => $this->formatJson($decodedJson, $data->indent)
        };

        $this->logInfo('JSON processed', [
            'action' => $data->action->value,
            'original_size' => strlen($data->json),
            'output_size' => isset($result['formatted']) ? strlen($result['formatted']) : 
                           (isset($result['minified']) ? strlen($result['minified']) : 0)
        ]);

        return $result;
    }

    private function decodeJson(string $jsonString): array
    {
        try {
            return json_decode($jsonString, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new ValidationException('JSON inválido: ' . $e->getMessage());
        }
    }

    private function validateJson(array $decodedJson, string $originalJson, int $indent): array
    {
        return [
            'valid' => true,
            'size' => strlen($originalJson),
            'formatted' => json_encode($decodedJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE, $indent)
        ];
    }

    private function minifyJson(array $decodedJson, string $originalJson): array
    {
        $minified = json_encode($decodedJson, JSON_UNESCAPED_UNICODE);
        
        return [
            'minified' => $minified,
            'original_size' => strlen($originalJson),
            'minified_size' => strlen($minified)
        ];
    }

    private function formatJson(array $decodedJson, int $indent = 2): array
    {
        $formatted = json_encode($decodedJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE, $indent);
        
        return [
            'formatted' => $formatted,
            'size' => strlen($formatted),
            'lines' => substr_count($formatted, "\n") + 1
        ];
    }
} 