<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderLineController;
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



// Ajouter des produits au panier avant de créer une commande
Route::post('/orders/add-to-cart', [OrderController::class, 'addToCart']);
// Valider la commande (confirmer le panier)
Route::patch('/orders/{orderId}/confirm', [OrderController::class, 'confirmOrder']);
// Route pour annuler une commande
Route::post('/order/{orderId}/cancel', [OrderController::class, 'cancelOrder']);
// Route pour récupérer l'historique des commandes passées
Route::get('/order/history', [OrderController::class, 'orderHistory']);
// Route pour afficher les détails des produits commandés dans une commande
Route::get('/order/details/{id}', [OrderController::class, 'orderDetails']);

// Route spécifique pour la mise à jour de la quantité
Route::patch('order-lines/{orderLine}/update-quantity', [OrderLineController::class, 'updateQuantity']);
// Route spécifique pour la Suppression de produits d'une commande
Route::delete('/orderLine-Product/{orderLine}', [OrderLineController::class, 'destroyProduct']);

Route::apiResource('order', OrderController::class);
Route::apiResource('order-line', OrderLineController::class);

