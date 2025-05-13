<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\PageController;

// Página Inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Webhook Routes (sem CSRF)
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/tools/webhook/{token}', [ToolController::class, 'webhookReceive'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
        ->name('tools.webhook.receive');
});

// Rotas das Ferramentas
Route::prefix('tools')->group(function () {
    Route::get('/webhook', [ToolController::class, 'webhook'])->name('tools.webhook');
    Route::get('/json', [ToolController::class, 'json'])->name('tools.json');
    Route::get('/password', [ToolController::class, 'password'])->name('tools.password');
    Route::get('/base64', [ToolController::class, 'base64'])->name('tools.base64');
    Route::get('/qrcode', [ToolController::class, 'qrcode'])->name('tools.qrcode');
    Route::get('/email', [ToolController::class, 'email'])->name('tools.email');
    Route::get('/sha256', [ToolController::class, 'sha256'])->name('tools.sha256');
    Route::get('/xml', [ToolController::class, 'xml'])->name('tools.xml');
});

// Páginas Estáticas
Route::get('/documentation', [PageController::class, 'documentation'])->name('documentation');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
