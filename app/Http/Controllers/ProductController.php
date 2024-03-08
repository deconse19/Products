<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $list = Product::when($request->search, function ($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->where('price', '>', 0)
                ->orWhere('description', "%{$search}%")
                ->orWhere('category', "%{$search}%");
        })->get();

        return response()->json($list);
    }

    public function add(AddProductRequest $request)
    {

        $list = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category

        ]);

        return response()->json([
            'message' => 'added',
            'data' => $list
        ]);
    }

    public function update(Request $request)
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
