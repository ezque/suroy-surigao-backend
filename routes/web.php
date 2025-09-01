<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/user-dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

