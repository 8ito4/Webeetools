<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Webhook\WebhookController;

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

// Webhook com rate limiting específico
Route::middleware([\App\Http\Middleware\RateLimitMiddleware::class . ':20,1'])
    ->any('/webhook/{identifier}', [WebhookController::class, 'receive'])
    ->name('api.webhook.receive');

// API v1 Routes com rate limiting
Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::controller(ApiController::class)
        ->middleware([\App\Http\Middleware\RateLimitMiddleware::class . ':100,1'])
        ->group(function () {
            Route::post('/whatsapp/generate', 'generateWhatsAppLink')->name('whatsapp.generate');
            Route::post('/json/format', 'formatJson')->name('json.format');
            Route::get('/lorem/generate', 'generateLorem')->name('lorem.generate');
        });
    
    // Password generation com rate limiting mais restritivo
    Route::middleware([\App\Http\Middleware\RateLimitMiddleware::class . ':30,1'])
        ->get('/password/generate', [ApiController::class, 'generatePassword'])
        ->name('password.generate');
}); 