<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::all();
        return response()->json($deliveries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryRequest $request)
    {
        $data = $request->validate([
            'receiver_name' => 'required|string',
            'receiver_phone' => 'required|string',
            'startposition' => 'required|string',
            'endposition' => 'required|string',
            'distance' => 'required|numeric',
            'amount' => 'required|numeric',
            'status' => 'string',
            'accepteddate' => 'date',
            'comment' => 'nullable|string',
            'note' => 'nullable|integer',
            'startdate' => 'date',
            'enddate' => 'date',
            'client_id' => 'required|exists:users,id',
            'deliver_id' => 'nullable|exists:users,id',
        ]);

        
        $delivery = Delivery::create($data);

        return response()->json($delivery, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        $delivery = Delivery::findOrFail($delivery);
        return response()->json($delivery);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        $data = $request->validate([
            'receiver_name' => 'string',
            'receiver_phone' => 'string',
            'startposition' => 'string',
            'endposition' => 'string',
            'distance' => 'numeric',
            'amount' => 'numeric',
            'status' => 'string',
            'accepteddate' => 'date',
            'comment' => 'nullable|string',
            'note' => 'nullable|integer',
            'startdate' => 'date',
            'enddate' => 'date',
            'client_id' => 'exists:users,id',
            'deliver_id' => 'nullable|exists:users,id',
        ]);

    
        $delivery = Delivery::findOrFail($delivery);
        $delivery->update($data);

        return response()->json($delivery);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $delivery = Delivery::findOrFail($delivery);
        $delivery->delete();

        return response()->json(null, 204);
    }
}
