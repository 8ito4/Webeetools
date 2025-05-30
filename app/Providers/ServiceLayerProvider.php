<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Config\WhatsAppConfig;
use App\Interfaces\Services\WhatsAppLinkServiceInterface;
use App\Interfaces\Services\JsonFormatterServiceInterface;
use App\Interfaces\Services\PasswordGeneratorServiceInterface;
use App\Interfaces\Services\LoremIpsumServiceInterface;
use App\Services\Api\WhatsAppLinkService;
use App\Services\Api\JsonFormatterService;
use App\Services\Api\PasswordGeneratorService;
use App\Services\Api\LoremIpsumService;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Registra todos os services com suas interfaces
     */
    public function register(): void
    {
        // Registrar configurações
        $this->app->singleton(WhatsAppConfig::class, function () {
            return WhatsAppConfig::fromEnv();
        });

        // Registrar services API
        $this->app->bind(WhatsAppLinkServiceInterface::class, WhatsAppLinkService::class);
        $this->app->bind(JsonFormatterServiceInterface::class, JsonFormatterService::class);
        $this->app->bind(PasswordGeneratorServiceInterface::class, PasswordGeneratorService::class);
        $this->app->bind(LoremIpsumServiceInterface::class, LoremIpsumService::class);
    }

    /**
     * Bootstrap dos services
     */
    public function boot(): void
    {
        //
    }
} 