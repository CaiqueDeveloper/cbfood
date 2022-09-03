<?php

use App\Http\Controllers\Admin\PromotionsController;
use Illuminate\Support\Facades\Route;

Route::get('/promotions', [PromotionsController::class, 'index']);
Route::get('/showModalCreateNewPromotion', [PromotionsController::class, 'showModalCreateNewPromotion']);