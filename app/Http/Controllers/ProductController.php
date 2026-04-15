<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $products = Product::with(['category', 'offer'])->get();

    $mapped = $products->map(function ($product) {

        return [
            'id' => $product->id,
            'name' => $product->name,
            'desc' => $product->desc,
            'price' => $product->price,
            'stoke' => $product->stoke,

            'category' => $product->category,

            'offer' => $product->offer ? [
                'name' => $product->offer->name,
                'desc' => $product->offer->desc,
                'discount' => $product->offer->discount,
                'limit' => $product->offer->limit,
            ] : null,
        ];
    });

    return response()->json($mapped, 200);
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:20',
        'desc' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stoke'=> 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id'
    ]);
    $product = Product::create([
        'name' => $request->name,
        'desc' => $request->desc,
        'price' => $request->price,      
        'stoke'=> $request->stoke,
        'category_id' => $request->category_id
    ]); 

    return response()->json([
        'message' => "Product added successfully",
        'product' => $product
    ], 201);
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product, $id)
    {
        $product = Product::find($id);
        if(!$product) return response()->json(["message"=>"Invalid Id"], 401);
        return response()->json($product, 200);
    }


    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Product $product)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Product $product)
    // {
    //     //
    // }
}
