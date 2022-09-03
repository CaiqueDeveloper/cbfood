<?php

use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;


Route::get('/showModalCreateNewPermission', [PermissionController::class, 'showModalCreateNewPermission']);
Route::post('/storagePermission', [PermissionController::class, 'storagePermission']);
Route::get('/geAllPermissions', [PermissionController::class, 'geAllPermissions']);
Route::get('/showModalUpdatePermission/{id}', [PermissionController::class, 'showModalUpdatePermission']);
Route::post('/updatePermission', [PermissionController::class, 'updatePermission']);
Route::get('/deletePermission/{id}', [PermissionController::class, 'deletePermission']);


