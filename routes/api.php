<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\TaskController;

Route::get('/health', [HealthController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);

//Route::get('/health', function () {
//    return response()->json([
//        'status' => 'ok'
//    ]);
//});

