<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Lightweight health endpoint for platform checks (no DB access)
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Admin Dashboard & Reports Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('reports')->group(function () {
        Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('/users', [ReportController::class, 'users'])->name('reports.users');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
