<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Services\WebhookServiceInterface;
use App\Interfaces\Repositories\WebhookRepositoryInterface;
use App\Services\WebhookService;
use App\Repositories\WebhookRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(WebhookRepositoryInterface::class, WebhookRepository::class);
        $this->app->bind(WebhookServiceInterface::class, WebhookService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
