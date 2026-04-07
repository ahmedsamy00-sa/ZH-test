<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with(['user', 'products'])->get();
        return response()->json($orders, 200);
    }

    public function store(Request $request,$id)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
        'user_id' => $id,
            'total_price' => 0
        ]);

        $total = 0;
        foreach($request->products as $item){
            $product = Product::find($item['product_id']);
            $order->products()->attach($product->id, [
                'quantity' => $item['quantity']
            ]);
            $total += $product->price * $item['quantity'];
        }

        $order->update(['total_price' => $total]);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order->load('products')
        ], 201);
    }

    public function show($id)
    {
        $order = Order::with(['user', 'products'])->find($id);
        if(!$order) return response()->json(['message' => 'Order not found'], 404);

        return response()->json($order, 200);
    }


    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Order $order)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Order $order)
    // {
    //     //
    // }
}
