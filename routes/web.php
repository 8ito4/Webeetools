<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlanningPokerController;

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
    Route::get('/document', [ToolController::class, 'document'])->name('tools.document');
    Route::get('/sha256', [ToolController::class, 'sha256'])->name('tools.sha256');
    Route::get('/xml', [ToolController::class, 'xml'])->name('tools.xml');
    Route::match(['get', 'post'], '/cellphone', [ToolController::class, 'cellphone'])->name('tools.cellphone');
    Route::get('/pomodoro', [ToolController::class, 'pomodoro'])->name('tools.pomodoro');
});

// Páginas Estáticas
Route::get('/documentation', [PageController::class, 'documentation'])->name('documentation');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

// Planning Poker Routes
Route::prefix('planning-poker')->group(function () {
    Route::get('/', [PlanningPokerController::class, 'index'])->name('planning-poker.index');
    Route::post('/create', [PlanningPokerController::class, 'createRoom'])->name('planning-poker.create');
    Route::post('/join', [PlanningPokerController::class, 'joinRoom'])->name('planning-poker.join');
    Route::get('/room/{code}', [PlanningPokerController::class, 'room'])->name('planning-poker.room');
    Route::post('/room/{code}/vote', [PlanningPokerController::class, 'vote'])->name('planning-poker.vote');
    Route::post('/room/{code}/task', [PlanningPokerController::class, 'addTask'])->name('planning-poker.addTask');
    Route::post('/room/{code}/reset', [PlanningPokerController::class, 'reset'])->name('planning-poker.reset');
    Route::post('/room/{code}/reset-timer', [PlanningPokerController::class, 'resetTimer'])->name('planning-poker.reset-timer');
    Route::post('/room/{code}/set-timer', [PlanningPokerController::class, 'setTimer'])->name('planning-poker.set-timer');
    Route::post('/room/{code}/reveal', [PlanningPokerController::class, 'reveal'])->name('planning-poker.reveal');
    Route::post('/room/{code}/next-task', [PlanningPokerController::class, 'nextTask'])->name('planning-poker.next-task');
    Route::post('/room/{code}/end-voting', [PlanningPokerController::class, 'endVoting'])->name('planning-poker.endVoting');
    Route::post('/room/{code}/select-card', [PlanningPokerController::class, 'selectCard'])->name('planning-poker.selectCard');
});
