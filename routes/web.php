<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WeekController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\EnsureValidCodeMiddleware;

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Signup routes with middleware
Route::middleware([EnsureValidCodeMiddleware::class, 'guest'])->group(function () {
    Route::get('/signup/terms', [RegisterController::class, 'terms'])->name('signup.terms');
    Route::get('/signup/account', [RegisterController::class, 'account'])->name('signup.account');
    Route::post('/signup/account', [RegisterController::class, 'register'])->name('signup.register');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('app.categories.show'); // Corrigé pour correspondre à l'utilisation

    // Home route
    Route::get('/', HomeController::class)->name('app.home');

    // Week ranking routes
    Route::get('/weeks', [WeekController::class, 'index'])->name('app.weeks.index');
    Route::get('/weeks/{week:uri}', [WeekController::class, 'show'])->name('app.weeks.show')->where('week', '[0-9]{4}/[0-9]{2}');
    Route::get('/weeks/{week:uri}/tracks/{track}', [TrackController::class, 'show'])->name('app.tracks.show')->where('week', '[0-9]{4}/[0-9]{2}');
    Route::post('/weeks/{week:uri}/tracks/{track}/like', [TrackController::class, 'like'])->name('app.tracks.like')->where('week', '[0-9]{4}/[0-9]{2}');

    // Track routes
    Route::get('/tracks/create', [TrackController::class, 'create'])->name('app.tracks.create');
    Route::post('/tracks/create', [TrackController::class, 'store'])->name('app.tracks.store');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('app.profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('app.profile.update');

    // Fallback route for 404 errors
    Route::fallback(fn () => abort(404));
});
