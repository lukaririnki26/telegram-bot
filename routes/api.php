<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [\App\Http\Controllers\Api\AuthApiController::class, 'login']);
Route::post('/webhook/{bot}', [\App\Http\Controllers\Api\TelegramWebhookController::class, 'handle']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bot', [\App\Http\Controllers\Api\BotController::class, 'store']);
    Route::post('/bot/{bot}/set-webhook', [\App\Http\Controllers\Api\BotController::class, 'setWebhook']);
    Route::get('/bot/{bot}/menus', [\App\Http\Controllers\Api\BotMenuController::class, 'index']);
    Route::post('/bot/{bot}/menus', [\App\Http\Controllers\Api\BotMenuController::class, 'store']);
    Route::put('/bot/menus/{menu}', [\App\Http\Controllers\Api\BotMenuController::class, 'update']);
    Route::delete('/bot/menus/{menu}', [\App\Http\Controllers\Api\BotMenuController::class, 'destroy']);
});