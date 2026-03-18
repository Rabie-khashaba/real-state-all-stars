<?php

use App\Http\Controllers\Api\ContestantAuthController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\JudgeController;
use App\Http\Controllers\Api\DeveloperController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UnitTypeController;
use App\Http\Controllers\Api\VoteController;
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

Route::get('/about', [AboutController::class, 'index']);

Route::prefix('judges')->group(function () {
    Route::get('/', [JudgeController::class, 'index']);
    Route::post('/', [JudgeController::class, 'store']);
    Route::get('/{id}', [JudgeController::class, 'show']);
    Route::get('/{id}/others', [JudgeController::class, 'others']);
});

Route::prefix('developers')->group(function () {
    Route::get('/', [DeveloperController::class, 'index']);
    Route::get('/{id}', [DeveloperController::class, 'show']);
    Route::get('/{id}/projects', [DeveloperController::class, 'projects']);
    Route::get('/{id}/projects/{projectId}', [DeveloperController::class, 'project']);
});

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/{id}', [ProjectController::class, 'show']);
    Route::get('/{id}/units', [UnitController::class, 'index']);
    Route::get('/{id}/units/{unitId}', [UnitController::class, 'show']);
});

Route::prefix('units')->group(function () {
    Route::get('/{id}', [UnitController::class, 'showUnit']);
});

Route::prefix('unit-types')->group(function () {
    Route::get('/', [UnitTypeController::class, 'index']);
    Route::get('/{id}', [UnitTypeController::class, 'show']);
});


Route::prefix('home')->group(function () {
    Route::get('/counts', [HomeController::class, 'getCounts']);
    Route::get('/header', [HomeController::class, 'getHeader']);
    Route::get('/our-program', [HomeController::class, 'getOurProgram']);
    Route::get('/countdown', [HomeController::class, 'getCountdown']);
    Route::get('/footer', [HomeController::class, 'getFooter']);
    Route::get('/vote-setting', [HomeController::class, 'getVoteSetting']);
    Route::get('/prize-setting', [HomeController::class, 'getPrizeSetting']);
    Route::get('/judge-settings', [HomeController::class, 'getJudgeSettings']);
    Route::get('/influential-body-setting', [HomeController::class, 'getInfluentialBodySetting']);
});

Route::prefix('votes')->group(function () {
    Route::get('/', [VoteController::class, 'index']);
    Route::get('/contestants', [VoteController::class, 'getAllContestants']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/{contestantId}', [VoteController::class, 'vote']);
        Route::post('/purchase', [VoteController::class, 'purchaseVotes']);
    });
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