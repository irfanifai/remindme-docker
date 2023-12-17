<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\API\ApiReminderController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('/v1')->group(function () {
    Route::post('/session', [SessionController::class, 'login']);
    Route::put('/refresh-token', [SessionController::class, 'refreshAccessToken']);
});

Route::middleware(['auth:sanctum'])->prefix('/v1')->group(function () {
    Route::get('/reminders', [ApiReminderController::class, 'index']);
    Route::get('/reminders/{id}', [ApiReminderController::class, 'show']);
    Route::post('/reminders', [ApiReminderController::class, 'store']);
    Route::put('/reminders/{id}', [ApiReminderController::class, 'update']);
    Route::delete('/reminders/{id}', [ApiReminderController::class, 'destroy']);
});

