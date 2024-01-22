<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
               $data = $request->validate([
                'amount' => 'required|numeric',
                'paymentmode' => 'required|string',
                'client_id' => 'required|exists:users,id',
            ]);
    
            $transaction = Transaction::create($data);
    
            return response()->json($transaction, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction = Transaction::findOrFail($transaction);
        return response()->json($transaction);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
                $data = $request->validate([
                    'amount' => 'numeric',
                    'paymentmode' => 'string',
                    'client_id' => 'exists:users,id',
                ]);
                $transaction = Transaction::findOrFail($transaction);
                $transaction->update($data);
        
                return response()->json($transaction);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction = Transaction::findOrFail($transaction);
                $transaction->delete();
        
                return response()->json(null, 204);
    }
}
