<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/category', [CategoryController::class, 'index']);
Route::get('/getModalCreateCategory', [CategoryController::class, 'getModalCreateCategory']);
Route::post('/storageCategory', [CategoryController::class, 'storageCategory']);
Route::get('/getAllCategoryCompany', [CategoryController::class, 'getAllCategoryCompany']);
Route::get('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);
Route::get('/getModalUpdateCategory/{id}', [CategoryController::class, 'getModalUpdateCategory']);
Route::post('/storageUpdateCategory', [CategoryController::class, 'storageUpdateCategory']);