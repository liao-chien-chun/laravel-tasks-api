<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\CompleteTaskController;
use App\Http\Controllers\Api\V2\TaskController;

Route::middleware('auth:sanctum')->prefix('v2')->group(function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::patch('/tasks/{task}/complete', CompleteTaskController::class);
});

