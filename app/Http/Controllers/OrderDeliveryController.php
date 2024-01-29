<?php

namespace App\Http\Controllers;

use App\Models\OrderDelivery;
use App\Http\Requests\StoreOrderDeliveryRequest;
use App\Http\Requests\UpdateOrderDeliveryRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class OrderDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // All order deliveries
        $orderDeliveries = OrderDelivery::all();
        return response()->json([
            'data' => $orderDeliveries
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreOrderDeliveryRequest $request
     * @return JsonResponse
     */
    public function store(StoreOrderDeliveryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if (!$validated) {
            return response()->json([
                'message' => 'Invalid request',
                'error' => $validated->errors()
            ], 400);
        }
        $orderDelivery = OrderDelivery::create($validated);
        return response()->json([
            'message' => 'Order delivery created successfully',
            'data' => $orderDelivery
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDelivery $orderDelivery)
    {
        // Show order delivery
        return response()->json([
            'data' => $orderDelivery
        ], 201);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderDeliveryRequest $request, OrderDelivery $orderDelivery)
    {
        // Update order delivery
        $validated = $request->validated();
        if (!$validated) {
            return response()->json([
                'message' => 'Invalid request',
                'error' => $validated->errors()
            ], 400);
        }
        $orderDelivery->update($validated);
        return response()->json([
            'message' => 'Order delivery updated successfully',
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDelivery $orderDelivery)
    {
        // Delete order delivery
        try {
            $orderDelivery->delete();
            return response()->json([
                'message' => 'Order delivery deleted successfully'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting order delivery',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
