<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use App\Models\OrderDeliveryRequest;
use App\Http\Requests\StoreOrderDeliveryRequestRequest;
use App\Http\Requests\UpdateOrderDeliveryRequestRequest;

class OrderDeliveryRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderRequest = OrderDeliveryRequest::all();
        return response()->json([
            'data' => $orderRequest
        ], 201);
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
            'message' => 'Order delivery Request created successfully',
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
                'message' => 'Invalid request',
                'error' => $validated->errors()
            ], 400);
        }
        $orderDeliveryRequest->update($validated);
        return response()->json([
            'message' => 'Order delivery request updated successfully',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDeliveryRequest $orderDeliveryRequest)
    {
        try {
            $orderDeliveryRequest->delete();
            return response()->json([
                'message' => 'Order delivery request deleted successfully'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting order delivery request',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
