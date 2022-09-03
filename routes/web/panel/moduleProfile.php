<?php

use App\Http\Controllers\Admin\ModulesProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/showModalPermissionAssociationWithProfile/{id}',[ModulesProfileController::class, 'showModalPermissionAssociationWithProfile']);
Route::get('/storageAssociationPermissionWithProfile', [ModulesProfileController::class, 'storageAssociationPermissionWithProfile']);
Route::get('/removeAssociationPermissionWithProfile', [ModulesProfileController::class, 'removeAssociationPermissionWithProfile']);