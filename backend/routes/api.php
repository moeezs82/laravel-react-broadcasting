<?php

use App\Http\Controllers\api\ChatController;
use App\Http\Controllers\api\UserController;
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

Route::prefix('user')->group(function(){
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function(){
        Route::get('me', [UserController::class, 'me']);
        Route::get('logout', [UserController::class, 'logout']);
        Route::get('all', [UserController::class, 'all']);
    });
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('messages/private', [ChatController::class, 'privateMsg']);
    Route::post('messages', [ChatController::class, 'sendMsg']);
});

