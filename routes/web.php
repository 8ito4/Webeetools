<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlanningPoker\PlanningPokerController;
use App\Http\Controllers\Tools\UtilityController;
use App\Http\Controllers\Tools\ResumeController;
use App\Http\Controllers\Tools\CellphoneController;
use App\Http\Controllers\Webhook\WebhookController;

// Auth::routes(); // TEMPORARIAMENTE COMENTADO

Route::get('/', function () {
    return response()->file(public_path('index.html'));
})->name('home');

// WEBHOOK - EM BREVE
/*
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/tools/webhook/create', [ToolController::class, 'createWebhook'])->name('tools.webhook.create');
    Route::post('/tools/webhook/delete', [ToolController::class, 'deleteWebhook'])->name('tools.webhook.delete');
    Route::post('/tools/webhook/clear-session', [ToolController::class, 'clearWebhookSession'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
        ->name('tools.webhook.clear-session');
    Route::get('/tools/webhook/requests/{token}', [ToolController::class, 'webhookRequests'])->name('tools.webhook.requests');
});
*/

Route::prefix('tools')->name('tools.')->group(function () {
    // Route::get('/webhook', [ToolController::class, 'webhook'])->name('tools.webhook'); // EM BREVE
    Route::get('/json', [UtilityController::class, 'json'])->name('json');
    Route::get('/password', [UtilityController::class, 'password'])->name('password');
    Route::get('/base64', [UtilityController::class, 'base64'])->name('base64');
    Route::get('/qrcode', [UtilityController::class, 'qrcode'])->name('qrcode');
    Route::get('/email', [UtilityController::class, 'email'])->name('email');
    Route::get('/document', [UtilityController::class, 'document'])->name('document');
    Route::get('/sha256', [UtilityController::class, 'sha256'])->name('sha256');
    Route::get('/xml', [UtilityController::class, 'xml'])->name('xml');
    Route::get('/pomodoro', [UtilityController::class, 'pomodoro'])->name('pomodoro');
    Route::get('/lorem', [UtilityController::class, 'lorem'])->name('lorem');
    
    // Novas ferramentas
    Route::get('/network-tools', [UtilityController::class, 'networkTools'])->name('network-tools');
    Route::get('/whatsapp-link', [UtilityController::class, 'whatsappLink'])->name('whatsapp-link');
    
    Route::controller(CellphoneController::class)->group(function () {
        Route::get('/cellphone', 'index')->name('cellphone');
        Route::post('/cellphone/generate', 'generate')->name('cellphone.generate');
    });
    
    Route::controller(ResumeController::class)->group(function () {
        Route::get('/resume', 'index')->name('resume');
        Route::post('/resume/generate', 'generate')->name('resume.generate');
    });
    
    Route::controller(WebhookController::class)->group(function () {
        Route::get('/webhook', 'index')->name('webhook');
        Route::post('/webhook/create', 'create')->name('webhook.create');
    });
});

Route::controller(PageController::class)->group(function () {
    Route::get('/documentation', 'documentation')->name('documentation');
    Route::get('/support', 'support')->name('support');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/privacy', 'privacy')->name('privacy');

    // Páginas legais (footer)
    Route::get('/termos-de-uso', 'termosDeUso')->name('termos-de-uso');
    Route::get('/politica-privacidade', 'politicaPrivacidade')->name('politica-privacidade');
    Route::get('/cookies', 'cookies')->name('cookies');
    Route::get('/licensa', 'licensa')->name('licensa');

    Route::get('/suggestions', 'suggestions')->name('suggestions');
    Route::get('/contact', 'contact')->name('contact');
});

Route::prefix('planning-poker')->name('planning-poker.')->controller(PlanningPokerController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/create', 'createRoom')->name('create');
    Route::match(['get', 'post'], '/join', 'joinRoom')->name('join');
    Route::get('/room/{code}', 'room')->name('room');
    Route::post('/room/{code}/select-card', 'selectCard')->name('selectCard');
    Route::post('/room/{code}/vote', 'vote')->name('vote');
    Route::post('/room/{code}/end-voting', 'endVoting')->name('endVoting');
    Route::post('/room/{code}/add-task', 'addTask')->name('addTask');
    Route::post('/room/{code}/reset', 'reset')->name('reset');
    Route::post('/room/{code}/reset-timer', 'resetTimer')->name('reset-timer');
    Route::post('/room/{code}/set-timer', 'setTimer')->name('set-timer');
    Route::post('/room/{code}/pause-timer', 'pauseTimer')->name('pause-timer');
    Route::post('/room/{code}/reveal', 'reveal')->name('reveal');
    Route::post('/room/{code}/next-task', 'nextTask')->name('next-task');
});
