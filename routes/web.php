<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('employees', EmployeeController::class);

    Route::get('attendances/history', [AttendanceController::class, 'historyIndex'])->name('attendances.history');


    Route::resource('attendances', AttendanceController::class);

    // Route untuk attendance history
    Route::get('attendances/history', [AttendanceController::class, 'historyIndex'])
        ->name('attendances.history');
    
    // Route baru untuk halaman clock in/out
    Route::get('clock-attendance', [AttendanceController::class, 'showClockPage'])
        ->name('clock-attendance.show');
    
    // Route untuk clock in/out (hanya untuk karyawan)
    Route::post('attendances/clock-in', [AttendanceController::class, 'clockIn'])
        ->name('attendances.clockIn');
    
    Route::post('attendances/clock-out', [AttendanceController::class, 'clockOut'])
        ->name('attendances.clockOut');
    });

require __DIR__.'/auth.php';
