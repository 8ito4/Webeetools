<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\Api\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/webhook/{identifier}', [ToolController::class, 'webhookReceive'])->name('api.webhook.receive');

// API v1 Routes
Route::prefix('v1')->group(function () {
    // WhatsApp API
    Route::post('/whatsapp/generate', [ApiController::class, 'generateWhatsAppLink']);
    
    // JSON API
    Route::post('/json/format', [ApiController::class, 'formatJson']);
    
    // Password API
    Route::get('/password/generate', [ApiController::class, 'generatePassword']);
    
    // Lorem Ipsum API
    Route::get('/lorem/generate', [ApiController::class, 'generateLorem']);
}); 