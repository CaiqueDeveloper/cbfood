<?php

use App\Http\Controllers\Admin\settingCompanyController;
use Illuminate\Support\Facades\Route;

Route::post('/updateSettingCompany', [settingCompanyController::class, 'updateSettingCompany']);
Route::get('/OpenedOrClosedStore', [settingCompanyController::class, 'OpenedOrClosedStore']);
Route::get('/changeCompany', [settingCompanyController::class, 'changeCompany']);