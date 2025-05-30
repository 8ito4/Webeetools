<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogsActivity
{
    protected function logInfo(string $message, array $context = []): void
    {
        Log::info($this->formatLogMessage($message), $context);
    }

    protected function logError(string $message, array $context = []): void
    {
        Log::error($this->formatLogMessage($message), $context);
    }

    protected function logWarning(string $message, array $context = []): void
    {
        Log::warning($this->formatLogMessage($message), $context);
    }

    protected function logDebug(string $message, array $context = []): void
    {
        Log::debug($this->formatLogMessage($message), $context);
    }

    private function formatLogMessage(string $message): string
    {
        $className = class_basename($this);
        return "[{$className}] {$message}";
    }
} 