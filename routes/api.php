<?php

use App\Http\Controllers\Api\ContestantAuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('contestant')->group(function () {
    Route::post('/register', [ContestantAuthController::class, 'register']);
    Route::post('/verify-register', [ContestantAuthController::class, 'verifyRegister']);
    Route::post('/resend-otp', [ContestantAuthController::class, 'resendOtp']);
    Route::post('/login', [ContestantAuthController::class, 'login']);
    Route::post('/forgot-password', [ContestantAuthController::class, 'forgotPassword']);
    Route::post('/verify-otp', [ContestantAuthController::class, 'verifyOtp']);
    Route::post('/reset-password', [ContestantAuthController::class, 'resetPassword']);
    Route::get('/profile/{id}', [ContestantAuthController::class, 'profileById']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [ContestantAuthController::class, 'profile']);
        Route::post('/profile/{id}', [ContestantAuthController::class, 'updateProfile']);
        Route::post('/logout', [ContestantAuthController::class, 'logout']);
    });
});