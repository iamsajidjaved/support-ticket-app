<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('signup', [AuthController::class, 'signup']);
        Route::post('signin', [AuthController::class, 'signin']);
        Route::get('logout', [AuthController::class, 'logout']);
    });

    Route::prefix('user')->group(function () {
        Route::post('user', [UserController::class, 'register']);
        Route::put('user', [UserController::class, 'update']);
    });

    Route::prefix('support')->group(function () {
        Route::post('tickets', [TicketController::class, 'store']);
        Route::get('tickets', [TicketController::class, 'list']);
    });
});
