<?php

namespace App\Http\Controllers;

use App\Models\OrderLine;
use App\Http\Requests\StoreOrderLineRequest;
use App\Http\Requests\UpdateOrderLineRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public function index()
    {
        $orderLines = OrderLine::orderBy('created_at', 'desc')->paginate(2);

        $data = [
            'status' => 200,
            'orderLines' => $orderLines
            //'orderLines' => $orderLines->items(),
        ];

        return response()->json($data, 200);
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
                'message' => 'Order Line created successfully',
                'orderLine' => $orderLine,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing the request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $orderLine = OrderLine::find($id);
        $data = [
            'status'=>200,
            'orderLine' =>$orderLine
        ];
        return response()->json($data, 200);

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
            "message" => 'Order Line updated successfully',
            "orderLine" => $orderLine
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $orderLine = OrderLine::find($id);
        $orderLine->delete();

        $data = [
            "status"=>200,
            "message"=>'Order lines deleted successfully'
        ];
        return response()->json($data, 200);
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
            "message" => 'Quantity updated successfully',
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
                "message" => 'You cannot modify a confirmed order.',
            ], 403);
        }

        $orderLine->delete();

        return response()->json([
            "status" => 200,
            "message" => 'Product removed from order successfully',
        ], 200);
    }



}
