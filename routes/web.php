<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlanningPokerController;
use Illuminate\Support\Facades\Auth;

// Rotas de Autenticação padrão do Laravel
Auth::routes();

// Página Inicial
Route::get('/', [HomeController::class, 'index'])->name('home');

// Webhook Routes (sem CSRF)
Route::middleware(['throttle:60,1'])->group(function () {
    Route::post('/tools/webhook/create', [ToolController::class, 'createWebhook'])->name('tools.webhook.create');
    Route::post('/tools/webhook/delete', [ToolController::class, 'deleteWebhook'])->name('tools.webhook.delete');
    Route::post('/tools/webhook/clear-session', [ToolController::class, 'clearWebhookSession'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
        ->name('tools.webhook.clear-session');
    // Route::any('/tools/webhook/{token}', [ToolController::class, 'webhookReceive'])
    //     ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
    //     ->name('tools.webhook.receive');
});

// Rotas das Ferramentas
Route::prefix('tools')->group(function () {
    Route::get('/webhook', [ToolController::class, 'webhook'])->name('tools.webhook');
    Route::get('/json', [ToolController::class, 'json'])->name('tools.json');
    Route::get('/password', [ToolController::class, 'password'])->name('tools.password');
    Route::get('/base64', [ToolController::class, 'base64'])->name('tools.base64');
    Route::get('/qrcode', [ToolController::class, 'qrcode'])->name('tools.qrcode');
    Route::get('/email', [ToolController::class, 'email'])->name('tools.email');
    Route::get('/document', [ToolController::class, 'document'])->name('tools.document');
    Route::get('/sha256', [ToolController::class, 'sha256'])->name('tools.sha256');
    Route::get('/xml', [ToolController::class, 'xml'])->name('tools.xml');
    Route::match(['get', 'post'], '/cellphone', [ToolController::class, 'cellphone'])->name('tools.cellphone');
    Route::get('/pomodoro', [ToolController::class, 'pomodoro'])->name('tools.pomodoro');
    Route::get('/api-tester', [ToolController::class, 'apiTester'])->name('tools.api-tester');
    Route::post('/api-tester/send', [ToolController::class, 'sendRequest'])->name('tools.api-tester.send');
    Route::post('/api-tester/save', [ToolController::class, 'saveRequest'])->name('tools.api-tester.save');
    Route::get('/api-tester/load', [ToolController::class, 'loadRequest'])->name('tools.api-tester.list');
    Route::get('/api-tester/load/{id}', [ToolController::class, 'loadRequest'])->name('tools.api-tester.load');
    Route::delete('/api-tester/delete/{id}', [ToolController::class, 'deleteRequest'])->name('tools.api-tester.delete');
});

// Páginas Estáticas
Route::get('/documentation', [PageController::class, 'documentation'])->name('documentation');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

// Novas rotas de Sugestões e Fale Conosco
Route::get('/suggestions', [PageController::class, 'suggestions'])->name('suggestions');
Route::match(['get', 'post'], '/contact', [PageController::class, 'contact'])->name('contact');

// Planning Poker Routes
Route::prefix('planning-poker')->name('planning-poker.')->group(function () {
    Route::get('/', [PlanningPokerController::class, 'index'])->name('index');
    Route::post('/create', [PlanningPokerController::class, 'createRoom'])->name('create');
    Route::match(['get', 'post'], '/join', [PlanningPokerController::class, 'joinRoom'])->name('join');
    Route::get('/room/{code}', [PlanningPokerController::class, 'room'])->name('room');
    Route::post('/room/{code}/select-card', [PlanningPokerController::class, 'selectCard'])->name('selectCard');
    Route::post('/room/{code}/vote', [PlanningPokerController::class, 'vote'])->name('vote');
    Route::post('/room/{code}/end-voting', [PlanningPokerController::class, 'endVoting'])->name('endVoting');
    Route::post('/room/{code}/add-task', [PlanningPokerController::class, 'addTask'])->name('addTask');
    Route::post('/room/{code}/reset', [PlanningPokerController::class, 'reset'])->name('reset');
    Route::post('/room/{code}/reset-timer', [PlanningPokerController::class, 'resetTimer'])->name('reset-timer');
    Route::post('/room/{code}/set-timer', [PlanningPokerController::class, 'setTimer'])->name('set-timer');
    Route::post('/room/{code}/pause-timer', [PlanningPokerController::class, 'pauseTimer'])->name('pause-timer');
    Route::post('/room/{code}/reveal', [PlanningPokerController::class, 'reveal'])->name('reveal');
    Route::post('/room/{code}/next-task', [PlanningPokerController::class, 'nextTask'])->name('next-task');
});
