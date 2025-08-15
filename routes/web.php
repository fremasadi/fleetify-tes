<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('departements', DepartementController::class);
    Route::resource('employees', EmployeeController::class);

   
});

require __DIR__.'/auth.php';
