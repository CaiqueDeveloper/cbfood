<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/actionLogin', [AuthController::class, 'actionLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/storage', [AuthController::class, 'storage']);