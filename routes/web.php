<?php

use Illuminate\Support\Facades\Route;

/**
 * RUTAS WEB - Landing Page y Páginas Públicas
 */

// Home / Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Sobre el sistema
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Contacto
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', 'ContactController@store')->name('contact.store');

// Encuesta pública (landing page)
Route::get('/survey', function () {
    return view('pages.survey');
})->name('survey');

Route::post('/survey', 'SurveyController@store')->name('survey.store');

// Dashboard (requiere autenticación)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/game', function () {
        return view('game.play');
    })->name('game.play');

    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile');
});