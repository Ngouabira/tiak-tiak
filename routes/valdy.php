<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryRequestController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/deliveries', [DeliveryController::class, 'index']);
Route::get('/deliveries/{id}', [DeliveryController::class, 'show']);
Route::post('/deliveries', [DeliveryController::class, 'store']);
Route::put('/deliveries/{id}', [DeliveryController::class, 'update']);
Route::delete('/deliveries/{id}', [DeliveryController::class, 'destroy']);

Route::get('/delivery-requests', [DeliveryRequestController::class, 'index']);
Route::get('/delivery-requests/{id}', [DeliveryRequestController::class, 'show']);
Route::post('/delivery-requests', [DeliveryRequestController::class, 'store']);
Route::put('/delivery-requests/{id}', [DeliveryRequestController::class, 'update']);
Route::delete('/delivery-requests/{id}', [DeliveryRequestController::class, 'destroy']);
