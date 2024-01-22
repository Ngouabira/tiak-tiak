<?php

namespace App\Http\Controllers;

use App\Models\DeliveryRequest;
use App\Http\Requests\StoreDeliveryRequestRequest;
use App\Http\Requests\UpdateDeliveryRequestRequest;

class DeliveryRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveryRequests = DeliveryRequest::all();
        return response()->json($deliveryRequests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryRequestRequest $request)
    {
              
               $data = $request->validate([
                'delivery_id' => 'required|exists:deliveries,id',
                'deliver_id' => 'required|exists:users,id',
                'status' => 'required|string',
            ]);
    
            $deliveryRequest = DeliveryRequest::create($data);
            return response()->json($deliveryRequest, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryRequest $deliveryRequest)
    {
        $deliveryRequest = DeliveryRequest::findOrFail($deliveryRequest);
        return response()->json($deliveryRequest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryRequestRequest $request, DeliveryRequest $deliveryRequest)
    {
                $data = $request->validate([
                    'delivery_id' => 'exists:deliveries,id',
                    'deliver_id' => 'exists:users,id',
                    'status' => 'string',
                ]);
        
                $deliveryRequest = DeliveryRequest::findOrFail($deliveryRequest);
                $deliveryRequest->update($data);
        
                return response()->json($deliveryRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeliveryRequest $deliveryRequest)
    {
               $deliveryRequest = DeliveryRequest::findOrFail($deliveryRequest);
               $deliveryRequest->delete();
       
               return response()->json(null, 204);
    }
}
