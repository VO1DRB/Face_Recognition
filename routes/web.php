<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;

// =====================
// Public Web Routes
// =====================
Route::get('/', function () {
    return view('welcome');
});

// =====================
// Auth (Web Guard)
// =====================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Attendance (Web View Only)
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

    // User Management (Web)
    Route::resource('users', UserController::class)->only(['index', 'create', 'edit', 'update', 'destroy']);
    Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('users/scan-face', [UserController::class, 'scanFace'])->name('users.scan-face');

    // Device Management (Web)
    Route::resource('devices', DeviceController::class)->only(['index', 'create', 'edit', 'update', 'destroy']);
});

// auth scaffolding (jika pakai Breeze/Fortify/Jetstream)
require __DIR__.'/auth.php';
