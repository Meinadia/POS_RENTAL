<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\SewaMobilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', [WelcomeController::class, 'index'])->name('dashboard');

    Route::prefix('mobil')->name('mobil.')->group(function () {
        Route::get('/', [MobilController::class, 'index'])->name('index');
        Route::get('/create', [MobilController::class, 'create'])->name('create');
        Route::post('/', [MobilController::class, 'store'])->name('store');
        Route::post('/list', [MobilController::class, 'list'])->name('list');
        
        Route::prefix('{mobil}')->group(function () {
            Route::get('/', [MobilController::class, 'show'])->name('show');
            Route::get('/edit', [MobilController::class, 'edit'])->name('edit');
            Route::put('/', [MobilController::class, 'update'])->name('update');
            Route::delete('/', [MobilController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('sewa-mobil')->name('sewa-mobil.')->group(function () {
        Route::get('/', [SewaMobilController::class, 'index'])->name('index');
        Route::get('/create', [SewaMobilController::class, 'create'])->name('create');
        Route::post('/', [SewaMobilController::class, 'store'])->name('store');
        Route::post('/list', [SewaMobilController::class, 'list'])->name('list');
        
        Route::prefix('{sewaMobil}')->group(function () {
            Route::get('/', [SewaMobilController::class, 'show'])->name('show');
            Route::get('/edit', [SewaMobilController::class, 'edit'])->name('edit');
            Route::put('/', [SewaMobilController::class, 'update'])->name('update');
            Route::delete('/', [SewaMobilController::class, 'destroy'])->name('destroy');
        });
    });
});