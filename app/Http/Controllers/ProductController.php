<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $data = [
               'status' => 200,
               'products' => $products,
        ];
          return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $product = new Product();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->restaurant_id = $validated['restaurant_id'];
        $product->save();

        $data = [
            'status' => 200,
            'message' => 'Product created successfully!',
            'product' => $product,
        ];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        $data = [
            'status' => 200,
            'product' => $product,
        ];
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->restaurant_id = $validated['restaurant_id'];
        $product->save();

        $data = [
            'status' => 200,
            'message' => 'Product updated successfully!',
            'product' => $product,
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        $data = [
            'status' => 200,
            'message' => 'Product deleted successfully!',
        ];
        return response()->json($data);
    }
}
