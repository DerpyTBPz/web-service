<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\TaskAiController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\SubtaskController;

Route::get('/health', [HealthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

    Route::post('/tasks/{task}/generate-subtasks', [TaskAiController::class, 'generateSubtasks'])
        ->name('api.tasks.generate-subtasks');

    Route::get('/subtasks', [SubtaskController::class, 'index']);
    Route::post('/subtasks', [SubtaskController::class, 'store']);
    Route::get('/subtasks/{id}', [SubtaskController::class, 'show']);
    Route::put('/subtasks/{id}', [SubtaskController::class, 'update']);
    Route::delete('/subtasks/{id}', [SubtaskController::class, 'destroy']);
});


//Route::get('/health', function () {
//    return response()->json([
//        'status' => 'ok'
//    ]);
//});

