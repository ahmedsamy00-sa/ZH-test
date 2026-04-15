<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\Trader;
use App\Models\Product;
use Illuminate\Http\Request;

class TraderController extends Controller
{
    public function getAllTraders()
    {
        $trader = Trader::all();
        return response()->json($trader, 200);
    }

    public function getAllStoreDeliveries($id){
        $delivery = Delivery::with('order')->where('trader_id', $id)->get();
        return response()->json($delivery, 200);
    }
    public function getAllStoreOrders($id){
    $orders = Order::where('trader_id', $id)->get();
        return response()->json($orders, 200);
    }
    public function getAllStoreProducts($id){
    $products = Product::where('trader_id', $id)->get();
        return response()->json($products, 200);
    }


    public function addTrader(Request $request)
    {
        $request->validate([
            'name'=> 'required|string'
        ]);
        
        $trader = Trader::create([
            'name'=> $request->name
        ]);

        return response()->json(['message'=>'A new trader created', $trader], 200);
    }


    public function addProductForTrader(Request $request){
        $request->validate([
        'name' => 'required|string|max:20',
        'desc' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stoke'=> 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'trader_id'=>'required|exists:traders,id'
    ]);

    $product = Product::create([
        'name' => $request->name,
        'desc' => $request->desc,
        'price' => $request->price,
        'stoke'=> $request->stoke,
        'category_id' => $request->category_id,
        'trader_id'=> $request->trader_id
    ]); 

    return response()->json([
        'message' => "Request has been uploaded and waiting for admin confirmation",
        'product' => $product
    ], 201);
    }



//     /**
//      * Display the specified resource.
//      */
//     public function show(Trader $trader)
//     {
//         //
//     }


//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Trader $trader)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Trader $trader)
//     {
//         //
//     }
}
