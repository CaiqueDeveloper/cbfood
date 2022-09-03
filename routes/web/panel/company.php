<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompanyController;

Route::get('/company', [CompanyController::class, 'getCompany']);
Route::post('/updateOrInserAddreCompany', [CompanyController::class, 'updateOrInserAddreCompany']);
Route::post('/storageOrCreateCompany', [CompanyController::class, 'storageOrCreateCompany']);
Route::post('/removeCompanyDefaultColor', [CompanyController::class, 'removeCompanyDefaultColor']);