<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderLineResource;
use App\Models\OrderLine;
use App\Http\Requests\StoreOrderLineRequest;
use App\Http\Requests\UpdateOrderLineRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): AnonymousResourceCollection
    {
        return OrderLineResource::collection(OrderLine::paginate(self::PAGINATION_SIZE));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderLineRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $product = Product::findOrFail($validatedData['product_id']);
            $productPrice = $product->price;

            // Calculer le prix en fonction de la quantité
            $validatedData['price'] = $validatedData['quantity'] * $productPrice;

            $orderLine = OrderLine::create($validatedData);

            return response()->json([
                'message' => 'Ligne de commande ajoutée avec succès',
                'orderLine' => $orderLine,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur s\est produite lors du traitement de la demande',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(OrderLine $orderLine)
    {
        return response()->json([
            'data' => new OrderLineResource($orderLine)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderLineRequest $request, OrderLine $orderLine)
    {
        $validatedData = $request->validated();

        $orderLine->update($validatedData);

        // Mettez à jour le prix en fonction de la nouvelle quantité
        if (isset($validatedData['quantity'])) {
            $orderLine->price = $orderLine->quantity * $orderLine->product->price;
            $orderLine->save();
        }

        return response()->json([
            "status" => 200,
            "message" => 'Ligne de commande modifié avec succès',
            "orderLine" => $orderLine
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderLine $orderLine): JsonResponse
    {
        $orderLine->delete();
        return response()->json([
            'message' => 'Ligne de commande supprimé avec succès'
        ], 200);
    }

    /**
     * Mettre à jour la quantité d'un produit dans une ligne de commande.
     */
    public function updateQuantity(Request $request, OrderLine $orderLine)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        // Mettre à jour la quantité
        $orderLine->quantity = $request->input('quantity');

        // Mettre à jour le prix en fonction de la nouvelle quantité
        $orderLine->price = $orderLine->quantity * $orderLine->product->price;

        $orderLine->save();

        $data = [
            "status" => 200,
            "message" => 'Quantity modifié avec succès',
            "orderLine" => $orderLine->toArray(),
        ];

        return response()->json($data, 200);
    }

    /**
     * Supprimer un produit d'une commande.
     */
    public function destroyProduct(OrderLine $orderLine)
    {
        if ($orderLine->order->confirmed_at) {
            return response()->json([
                "status" => 403,
                "message" => 'Vous ne pouvez pas modifier une commande confirmée.',
            ], 403);
        }

        $orderLine->delete();

        return response()->json([
            "status" => 200,
            "message" => 'Produit supprimé de la commande avec succès',
        ], 200);
    }



}
