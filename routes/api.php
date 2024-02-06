<?php

use App\Http\Controllers\Api\V1\CompleteTaskController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::group(['prefix' => 'v1'], function () {
//     Route::apiResource('/tasks', TaskController::class);
// });

// Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
//     Route::apiResource('/tasks', TaskController::class);
//     Route::patch('/tasks/{task}/complete', CompleteTaskController::class);
// });

// require __DIR__ . '/api/v1.php';
require __DIR__ . '/api/v2.php';

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', LoginController::class);
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::post('/register', RegisterController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
