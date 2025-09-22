<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;   // 
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\DailyExportController;

Route::apiResource('users', UserController::class);
Route::apiResource('devices', DeviceController::class);
Route::apiResource('faces', FaceController::class);
Route::apiResource('attendances', AttendanceController::class);
Route::apiResource('shifts', ShiftController::class);
Route::apiResource('daily-exports', DailyExportController::class);

// endpoint khusus
Route::post('devices/{device}/heartbeat', [DeviceController::class, 'heartbeat']);
Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus']);
