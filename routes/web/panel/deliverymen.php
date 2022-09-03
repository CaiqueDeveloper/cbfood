<?php

use App\Http\Controllers\Admin\DeliveryMenController;
use Illuminate\Support\Facades\Route;

Route::get('/deliveries', [DeliveryMenController::class , 'index']);
Route::get('/showModalGeteDelirevyMen/{id}', [DeliveryMenController::class, 'showModalGeteDelirevyMen']);
Route::get('/sendOrderToDeliveryPerson', [DeliveryMenController::class, 'sendOrderToDeliveryPerson']);
Route::get('/getOrdersDeliveryMen', [DeliveryMenController::class, 'getOrdersDeliveryMen']);
Route::get('/getRederIdicatorsDeliveryMen', [DeliveryMenController::class, 'getRederIdicatorsDeliveryMen']);