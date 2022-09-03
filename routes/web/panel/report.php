<?php

use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/import', [ReportController::class, 'import']);
Route::post('/import/processingReport', [ReportController::class, 'processingReport']);
    