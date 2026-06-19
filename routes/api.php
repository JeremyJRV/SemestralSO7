<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\PrizeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AdminController;

/**
 * RUTAS PÚBLICAS (Sin autenticación)
 */
Route::prefix('v1')->group(function () {
    // Autenticación
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Temas públicos (solo lectura)
    Route::get('/themes', [ThemeController::class, 'index']);
    Route::get('/themes/{id}', [ThemeController::class, 'show']);
    Route::get('/themes/{id}/statistics', [ThemeController::class, 'getStatistics']);
});

/**
 * RUTAS PROTEGIDAS (Requieren autenticación)
 */
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    
    // Autenticación
    Route::post('/logout', [AuthController::class, 'logout']);

    // Perfil del usuario
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show']);
        Route::post('/avatar', [ProfileController::class, 'updateAvatar']);
        Route::get('/points', [ProfileController::class, 'getTotalPoints']);
        Route::get('/prizes', [ProfileController::class, 'getPrizes']);
        Route::get('/progress', [ProfileController::class, 'getProgress']);
    });

    // Usuarios (CRUD - solo administradores)
    Route::middleware('role:administrador')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::get('/role/{role}', [UserController::class, 'getByRole']);
    });

    // Temas (CRUD - solo armadores y administradores)
    Route::middleware('role:armador,administrador')->prefix('themes')->group(function () {
        Route::post('/', [ThemeController::class, 'store']);
        Route::put('/{id}', [ThemeController::class, 'update']);
        Route::delete('/{id}', [ThemeController::class, 'destroy']);
    });

    // Preguntas (CRUD - solo armadores y administradores)
    Route::middleware('role:armador,administrador')->prefix('questions')->group(function () {
        Route::get('/', [QuestionController::class, 'index']);
        Route::get('/{id}', [QuestionController::class, 'show']);
        Route::post('/', [QuestionController::class, 'store']);
        Route::put('/{id}', [QuestionController::class, 'update']);
        Route::delete('/{id}', [QuestionController::class, 'destroy']);
    });

    // Premios (CRUD - solo administradores)
    Route::middleware('role:administrador')->prefix('prizes')->group(function () {
        Route::get('/', [PrizeController::class, 'index']);
        Route::get('/{id}', [PrizeController::class, 'show']);
        Route::post('/', [PrizeController::class, 'store']);
        Route::put('/{id}', [PrizeController::class, 'update']);
        Route::delete('/{id}', [PrizeController::class, 'destroy']);
    });

    // Juego
    Route::prefix('game')->group(function () {
        Route::post('/start-session', [GameController::class, 'startSession']);
        Route::post('/submit-answer', [GameController::class, 'submitAnswer']);
        Route::post('/end-session', [GameController::class, 'endSession']);
        Route::get('/user-sessions', [GameController::class, 'getUserSessions']);
    });

    // Estadísticas
    Route::prefix('statistics')->group(function () {
        Route::get('/most-played-themes', [StatisticsController::class, 'getMostPlayedThemes']);
        Route::get('/general', [StatisticsController::class, 'getGeneralStatistics']);
        Route::get('/user/{userId}', [StatisticsController::class, 'getUserStatistics']);
        Route::get('/progress-report', [StatisticsController::class, 'getUserProgressReport']);
        Route::get('/response-times', [StatisticsController::class, 'getAverageResponseTimes']);
    });

    // Panel de Administración (solo administradores)
    Route::middleware('role:administrador')->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/failed-logins', [AdminController::class, 'getFailedLoginAttempts']);
        Route::post('/unlock-user/{userId}', [AdminController::class, 'unlockUserAccount']);
        Route::get('/audit-log', [AdminController::class, 'getAuditLog']);
    });
});