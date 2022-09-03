<?php

use App\Http\Controllers\Admin\SystemUsabilityControlController;
use Illuminate\Support\Facades\Route;

Route::get('/systemUsabilityControl', [SystemUsabilityControlController::class, 'index']);
Route::get('/systemUsabilityControl/summaryIdicator', [SystemUsabilityControlController::class, 'summaryIdicator']);
Route::get('/systemUsabilityControl/listUserUsabilityHistory', [SystemUsabilityControlController::class, 'listUserUsabilityHistory']);
Route::get('/systemUsabilityControl/getData', [SystemUsabilityControlController::class, 'getData']);