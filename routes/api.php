<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Support\Facades\Route;

// API v1
Route::prefix('v1')->group(function () {
    Route::apiResource('tasks', TaskController::class);
});
