<?php

use App\Http\Controllers\Admin\NotifyController;
use Illuminate\Support\Facades\Route;

Route::get('/renderBoxNotifyCompany', [NotifyController::class, 'renderBoxNotifyCompany']);
Route::get('/getNotifyCompany', [NotifyController::class, 'getNotifyCompany']);