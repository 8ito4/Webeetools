<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MonitoringMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage(true);
        $requestId = $this->generateRequestId();
        
        // Adicionar request ID aos logs
        Log::withContext(['request_id' => $requestId]);
        
        $this->logRequestStart($request, $requestId);
        
        $response = $next($request);
        
        $this->logRequestEnd($request, $response, $requestId, $startTime, $startMemory);
        
        return $response->withHeaders([
            'X-Request-ID' => $requestId,
            'X-Response-Time' => round((microtime(true) - $startTime) * 1000, 2) . 'ms'
        ]);
    }

    private function generateRequestId(): string
    {
        return uniqid('req_', true);
    }

    private function logRequestStart(Request $request, string $requestId): void
    {
        Log::info('API Request Started', [
            'request_id' => $requestId,
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'route' => $request->route()?->getName(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'user_id' => $request->user()?->id,
            'payload_size' => strlen($request->getContent()),
            'headers' => $this->sanitizeHeaders($request->headers->all())
        ]);
    }

    private function logRequestEnd(
        Request $request, 
        Response $response, 
        string $requestId, 
        float $startTime, 
        int $startMemory
    ): void {
        $duration = microtime(true) - $startTime;
        $memoryUsed = memory_get_usage(true) - $startMemory;
        $memoryPeak = memory_get_peak_usage(true);
        
        $level = $this->getLogLevel($response->getStatusCode(), $duration);
        
        Log::log($level, 'API Request Completed', [
            'request_id' => $requestId,
            'method' => $request->method(),
            'route' => $request->route()?->getName(),
            'status_code' => $response->getStatusCode(),
            'duration_ms' => round($duration * 1000, 2),
            'memory_used_mb' => round($memoryUsed / 1024 / 1024, 2),
            'memory_peak_mb' => round($memoryPeak / 1024 / 1024, 2),
            'response_size' => strlen($response->getContent()),
            'queries_count' => $this->getQueriesCount(),
            'cache_hits' => $this->getCacheHits(),
            'is_slow' => $duration > 1.0,
            'is_error' => $response->getStatusCode() >= 400
        ]);
        
        // Log performance issues
        if ($duration > 2.0) {
            Log::warning('Slow API Request', [
                'request_id' => $requestId,
                'duration_ms' => round($duration * 1000, 2),
                'route' => $request->route()?->getName()
            ]);
        }
        
        if ($memoryUsed > 50 * 1024 * 1024) { // 50MB
            Log::warning('High Memory Usage', [
                'request_id' => $requestId,
                'memory_used_mb' => round($memoryUsed / 1024 / 1024, 2),
                'route' => $request->route()?->getName()
            ]);
        }
    }

    private function sanitizeHeaders(array $headers): array
    {
        $sensitiveHeaders = ['authorization', 'cookie', 'x-api-key'];
        
        return array_map(function ($values, $key) use ($sensitiveHeaders) {
            if (in_array(strtolower($key), $sensitiveHeaders)) {
                return ['***REDACTED***'];
            }
            return $values;
        }, $headers, array_keys($headers));
    }

    private function getLogLevel(int $statusCode, float $duration): string
    {
        if ($statusCode >= 500) {
            return 'error';
        }
        
        if ($statusCode >= 400) {
            return 'warning';
        }
        
        if ($duration > 1.0) {
            return 'warning';
        }
        
        return 'info';
    }

    private function getQueriesCount(): int
    {
        // Em um ambiente real, você integraria com o DB profiler
        return 0;
    }

    private function getCacheHits(): int
    {
        // Em um ambiente real, você integraria com o cache profiler
        return 0;
    }
} 