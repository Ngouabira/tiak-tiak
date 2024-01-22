<?php

use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeliveryRequestController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDeliveryController;
use App\Http\Controllers\OrderDeliveryRequestController;
use App\Http\Controllers\OrderLineController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


require __DIR__ . '/valdy.php';
require __DIR__ . '/diop.php';
require __DIR__ . '/seck.php';
require __DIR__ . '/fatou.php';
require __DIR__ . '/omar.php';
require __DIR__ . '/dienaba.php';

Route::apiResource('profile', ProfileController::class);
Route::apiResource('delivery-request', DeliveryRequestController::class);
Route::apiResource('delivery', DeliveryController::class);
Route::apiResource('transaction', TransactionController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('product', ProductController::class);
Route::apiResource('order-delivery-request', OrderDeliveryRequestController::class);
Route::apiResource('order-delivery', OrderDeliveryController::class);


