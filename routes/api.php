<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;


// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Attendance routes
    Route::get('attendance/history', [AttendanceController::class, 'history']);
    Route::post('attendance/record', [AttendanceController::class, 'recordAttendance']);
    
    // Super Admin only routes
    Route::middleware('super.admin')->group(function () {
        // User management
        Route::resource('users', UserController::class);
        
        // Face recognition management
        Route::post('face/register', [AttendanceController::class, 'registerFace']);
        Route::delete('face/{id}', [AttendanceController::class, 'deleteFace']);
        
        // Device management
        Route::resource('devices', DeviceController::class);
        Route::post('devices/{device}/heartbeat', [DeviceController::class, 'heartbeat']);
        Route::get('devices', [DeviceController::class, 'index']); // cek daftar device
    });
});