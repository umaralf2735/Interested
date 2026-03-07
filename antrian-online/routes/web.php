<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Route
Route::get('/', [QueueController::class, 'index'])->name('home');
Route::get('/queue/status', [QueueController::class, 'getStatus']);
Route::post('/queue/take', [QueueController::class, 'take']);

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Admin Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', [QueueController::class, 'admin'])->name('admin');
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/queue/call', [QueueController::class, 'callForService']);
});
