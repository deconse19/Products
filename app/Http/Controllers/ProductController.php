<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\FindProductRequest;
use App\Http\Requests\UpdateProductRequest;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Search for products
     *
     * @param FindProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(FindProductRequest $request)
    {

        $list = Product::when($request->search, function ($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->where('price', '>', 0)
                ->orWhere('description', "%{$search}%");
        })->get();

        return response()->json($list);
    }

    /**
     * Adds a new product to the database
     *
     * @param AddProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(AddProductRequest $request)
    {

        $list = Product::create($request->validated());

        return response()->json([
            'message' => 'added',
            'data' => $list
        ]);
    }
    /**
     * Updates an existing product in the database
     *
     * @param UpdateProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(UpdateProductRequest $request)
    {

        $list = Product::find($request->id);
        $list->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category

        ]);
        return response()->json([
            'message' => 'updated',
            'data' => $list
        ], 200);
    }
}
