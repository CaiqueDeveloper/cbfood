<?php

use App\Http\Controllers\Admin\UltilsController;
use Illuminate\Support\Facades\Route;

Route::post('/uploadedFile', [UltilsController::class, 'uploadedFile']);
Route::post('/storageNameModuleUserAccessing', [UltilsController::class, 'storageNameModuleUserAccessing']);