<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(): AnonymousResourceCollection
    {
        return OrderResource::collection(Order::paginate(self::PAGINATION_SIZE));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreOrderRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $order = Order::create($validatedData);

            $orderLinesData = $validatedData['order_lines'];

            // Bouclez sur les lignes de commande et associez-les à la commande
            foreach ($orderLinesData as $orderLineData) {
                $orderLineData['order_id'] = $order->id;

                $product = Product::findOrFail($orderLineData['product_id']);
                $productPrice = $product->price;

                // Calculer le prix en fonction du produit
                $orderLineData['price'] = $orderLineData['quantity'] * $productPrice;

                OrderLine::create($orderLineData);
            }

            return response()->json([
                'message' => 'Commande ajoutée avec succès',
                'order' => $order,
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
    public function show(Order $order)
    {
        return response()->json([
            'data' => new OrderResource($order)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $validatedData = $request->validated();
        if (!$validatedData) {
            return response()->json([
                'message' => 'Une erreur est survenue lors de la validation des données',
                'error' => $validatedData->errors()
            ], 400);
        }
        $order->update($validatedData);
          return response()->json([
            'message' => 'Commande modifiée avec succès'
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->orderLines()->delete();
        $order->delete();
        return response()->json([
            'message' => 'Commande supprimée avec succès'
        ], 200);
    }



    /**
     * Ajouter des produits avant de créer une commande.
     */
    public function addToCart(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'client_id' => 'required|integer|exists:users,id',
            'restaurant_id' => 'required|integer|exists:users,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        // Récupérer les données du formulaire
        $client_id = $request->input('client_id');
        $restaurant_id = $request->input('restaurant_id');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Vérifier si un panier existe déjà pour le client et le restaurant
        $cart = Order::where('client_id', $client_id)
            ->where('restaurant_id', $restaurant_id)
            ->whereNull('confirmed_at')
            ->first();

        // Si le panier n'existe pas, en créer un
        if (!$cart) {
            $cart = new Order();
            $cart->client_id = $client_id;
            $cart->restaurant_id = $restaurant_id;
            $cart->save();
        }

        // Récupérer le prix du produit depuis la table products
        $product = Product::findOrFail($product_id);
        $productPrice = $product->price;

        // Calculer le prix en fonction du produit
        $totalPrice = $quantity * $productPrice;

        // Ajouter le produit
        $orderLine = new OrderLine();
        $orderLine->order_id = $cart->id;
        $orderLine->product_id = $product_id;
        $orderLine->quantity = $quantity;
        $orderLine->price = $totalPrice;
        $orderLine->save();

        $data = [
            "status" => 200,
            "message" => 'Produit ajouté avec succès',
            "orderLine" => $orderLine->toArray(),
        ];

        return response()->json($data, 200);
    }


    /**
     * Valider la commande.
     */
    public function confirmOrder(Request $request, $orderId)
    {
        $request->validate([
            'confirmed_at' => 'required|date',
        ]);

        // Récupérer la commande à confirmer
        $order = Order::findOrFail($orderId);

        // Confirmer la commande
        $order->confirmed_at = $request->input('confirmed_at');
        $order->save();

        $data = [
            "status" => 200,
            "message" => 'Commande confirmée avec succès',
            "order" => $order->toArray(),
        ];

        return response()->json($data, 200);
    }


    /**
     * Annuler une commande avant sa préparation.
     */
    public function cancelOrder(Request $request, $orderId)
    {
        $request->validate([
            'cancellation_reason' => 'required|string',
        ]);

        // Récupérer la commande à annuler
        $order = Order::findOrFail($orderId);
        // Vérifier si la commande peut être annulée (non confirmée)
        if ($order->confirmed_at !== null) {
            $data = [
                "status" => 400,
                "message" => 'Il n\est pas possible d\annuler une commande qui a été confirmée.',
            ];

            return response()->json($data, 400);
        }

        // Annuler la commande
        $order->cancellation_reason = $request->input('cancellation_reason');
        $order->cancelled_at = now();
        $order->save();

        $data = [
            "status" => 200,
            "message" => 'Commande annulé avec succès',
            "order" => $order->toArray(),
        ];

        return response()->json($data, 200);
    }

    /**
     * Récupérer l'historique des commandes passées.
     */
    public function orderHistory()
    {
        $orders = Order::whereNotNull('confirmed_at')->get();
        $data = [
            'status' => 200,
            'orderHistory' => $orders->toArray(),
        ];

        return response()->json($data, 200);
    }

    /**
     * Afficher les détails des produits commandés dans une commande spécifiée.
     */
    public function orderDetails($id)
    {
        $order = Order::with('orderLines.product')->find($id);

        if (!$order) {
            $data = [
                'status' => 404,
                'message' => 'La Commande n\a pas été trouvé',
            ];
            return response()->json($data, 404);
        }

        $data = [
            'status' => 200,
            'orderDetails' => $order->toArray(),
        ];

        return response()->json($data, 200);
    }

}
