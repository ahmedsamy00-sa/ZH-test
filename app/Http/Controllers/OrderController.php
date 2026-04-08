<?php

namespace App\Http\Controllers;

use App\Notifications\OrderCreated;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with(['user', 'products'])->get();
        return response()->json($orders, 200);
    }

public function store(Request $request, $id)
{
    $request->validate([
        'products' => 'required|array',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
    ]);
    
    $total = 0;
    foreach ($request->products as $item) {
        $product = Product::find($item['product_id']);
        $total += $product->price * $item['quantity'];
    }
        
    $order = Order::create([
        'user_id' => $id,
        'totalPrice'=> $total
    ]);
    foreach ($request->products as $item) {
        $order->products()->attach($item['product_id'], [
            'quantity' => $item['quantity']
        ]);
    }
    
    $user = User::find($id);

    if ($user) {
        $user->notify(new OrderCreated($order));
    }

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
