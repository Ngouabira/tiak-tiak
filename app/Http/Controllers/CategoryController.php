<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::all();
       $data = [
              'status' => 200,
              'categories' => $categories,
       ];
         return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();
        $category = new Category();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        $category->restaurant_id = $validated['restaurant_id'];
        $category->save();

        $data = [
            'status' => 200,
            'message' => 'Category created successfully!',
            'category' => $category,
        ];
        return response()->json($data);
        

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        $data = [
            'status' => 200,
            'category' => $category,
        ];
        return response()->json($data);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        $category->restaurant_id = $validated['restaurant_id'];
        $category->save();

        $data = [
            'status' => 200,
            'message' => 'Category updated successfully!',
            'category' => $category,
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        $data = [
            'status' => 200,
            'message' => 'Category deleted successfully!',
        ];
        return response()->json($data);
    }
}
