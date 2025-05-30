<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    public function handle(Request $request, Closure $next, int $maxAttempts = 60, int $decayMinutes = 1): Response
    {
        $key = $this->resolveRequestSignature($request);
        $maxAttempts = $this->getMaxAttempts($request, $maxAttempts);
        
        if ($this->tooManyAttempts($key, $maxAttempts)) {
            $this->logRateLimitExceeded($request, $key);
            return $this->buildRateLimitResponse($key, $maxAttempts, $decayMinutes);
        }

        $this->incrementAttempts($key, $decayMinutes);
        
        $response = $next($request);
        
        return $this->addHeaders(
            $response,
            $maxAttempts,
            $this->calculateRemainingAttempts($key, $maxAttempts)
        );
    }

    private function resolveRequestSignature(Request $request): string
    {
        if ($user = $request->user()) {
            return sha1('user:' . $user->id . '|' . $request->route()->getName());
        }

        return sha1(
            $request->method() . '|' . 
            $request->route()->getName() . '|' . 
            $request->ip()
        );
    }

    private function getMaxAttempts(Request $request, int $default): int
    {
        // Usuários autenticados têm limite maior
        if ($request->user()) {
            return $default * 2;
        }

        // APIs críticas têm limite menor
        if ($this->isCriticalEndpoint($request)) {
            return max(10, intval($default / 3));
        }

        return $default;
    }

    private function isCriticalEndpoint(Request $request): bool
    {
        $criticalRoutes = [
            'api.v1.password.generate',
            'api.webhook.receive'
        ];

        return in_array($request->route()->getName(), $criticalRoutes);
    }

    private function tooManyAttempts(string $key, int $maxAttempts): bool
    {
        return Cache::get($key, 0) >= $maxAttempts;
    }

    private function incrementAttempts(string $key, int $decayMinutes): void
    {
        $attempts = Cache::get($key, 0) + 1;
        Cache::put($key, $attempts, now()->addMinutes($decayMinutes));
    }

    private function calculateRemainingAttempts(string $key, int $maxAttempts): int
    {
        return max(0, $maxAttempts - Cache::get($key, 0));
    }

    private function buildRateLimitResponse(string $key, int $maxAttempts, int $decayMinutes): Response
    {
        $retryAfter = Cache::remember($key . ':retry_after', $decayMinutes * 60, function () use ($decayMinutes) {
            return now()->addMinutes($decayMinutes)->timestamp;
        });

        return response()->json([
            'success' => false,
            'message' => 'Muitas tentativas. Tente novamente mais tarde.',
            'errors' => [
                'rate_limit' => 'Limite de requisições excedido'
            ],
            'meta' => [
                'retry_after' => $retryAfter,
                'limit' => $maxAttempts
            ]
        ], 429)->withHeaders([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => 0,
            'Retry-After' => $retryAfter,
        ]);
    }

    private function addHeaders(Response $response, int $maxAttempts, int $remaining): Response
    {
        $response->headers->add([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remaining,
        ]);

        return $response;
    }

    private function logRateLimitExceeded(Request $request, string $key): void
    {
        Log::warning('Rate limit exceeded', [
            'key' => $key,
            'ip' => $request->ip(),
            'route' => $request->route()->getName(),
            'user_agent' => $request->userAgent(),
            'user_id' => $request->user()?->id
        ]);
    }
} 