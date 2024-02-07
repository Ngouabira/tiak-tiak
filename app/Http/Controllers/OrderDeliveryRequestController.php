<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\OrderDeliveryRequest;
use App\Http\Requests\StoreOrderDeliveryRequestRequest;
use App\Http\Requests\UpdateOrderDeliveryRequestRequest;
use App\Http\Resources\OrderDeliveryRequestResource;

class OrderDeliveryRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderDeliveryRequestResource::collection(OrderDeliveryRequest::paginate(self::PAGINATION_SIZE));
   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderDeliveryRequestRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json([
                'message' => 'Invalid request',
                'error' => $validated->errors()
            ], 400);
        }
        $orderDeliveryRequest = OrderDeliveryRequest::create($validated);
        return response()->json([
            'message' => 'Demande de livraison de commande créée avec succès',
            'data' => $orderDeliveryRequest
        ], 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDeliveryRequest $orderDeliveryRequest)
    {
        return response()->json([
            'data' => $orderDeliveryRequest
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderDeliveryRequestRequest $request, OrderDeliveryRequest $orderDeliveryRequest)
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json([
                'message' => 'Demande non valide',
                'error' => $validated->errors()
            ], 400);
        }
        $orderDeliveryRequest->update($validated);
        return response()->json([
            'message' => 'Demande de livraison de commande mise à jour avec succès',
        ], 201);
    }

//     public function accept(OrderDeliveryRequest $orderDeliveryRequest)
// {
//     try {
//         $orderDeliveryRequest->update(['status' => 'accepted']);
//         return response()->json([
//             'message' => 'Demande de livraison de commande acceptée avec succès',
//         ], 200);
//     } catch (Exception $e) {
//         return response()->json([
//             'message' => 'Erreur lors de lacceptation de la demande de livraison',
//             'error' => $e->getMessage()
//         ], 400);
//     }
// }
// public function cancel(OrderDeliveryRequest $orderDeliveryRequest)
// {
//     try {
//         $orderDeliveryRequest->update(['status' => 'cancelled']);
//         return response()->json([
//             'message' => 'Demande de livraison de commande annulée avec succès',
//         ], 200);
//     } catch (Exception $e) {
//         return response()->json([
//             'message' => 'Erreur lors de lannulation de la demande de livraison',
//             'error' => $e->getMessage()
//         ], 400);
//     }
// }
// public function markAsProcessing(OrderDeliveryRequest $orderDeliveryRequest)
// {
//     try {
//         $orderDeliveryRequest->update(['status' => 'processing']);
//         return response()->json([
//             'message' => 'Demande de livraison de commande marquée comme en cours de traitement avec succès',
//         ], 200);
//     } catch (Exception $e) {
//         return response()->json([
//             'message' => 'Erreur lors du marquage de la demande de livraison comme en cours de traitement',
//             'error' => $e->getMessage()
//         ], 400);
//     }
// }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDeliveryRequest $orderDeliveryRequest)
    {
        try {
            $orderDeliveryRequest->delete();
            return response()->json([
                'message' => 'Demande de livraison de commande supprimée avec succès'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur de suppression',
                'error' => $e->getMessage()
            ], 400);
        }
    
}

}
