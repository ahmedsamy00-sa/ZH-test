<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delivery = Delivery::all();
        return response()->json($delivery, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'order_id' => 'required|exists:orders,id',
        'address' => 'required|string'
    ]);

    $order = Order::find($request->order_id);

    if (!$order) {
        return response()->json([
            'message' => 'Order not found'
        ], 404);
    }

    $delivery = Delivery::create([
        'user_id' => $request->user_id,
        'order_id' => $request->order_id,
        'address' => $request->address,
        'DeliveryStatus' => 'shipped'
    ]);

    $order->update([
        'OrderStatus' => 'ready'
    ]);

    return response()->json([
        'message' => 'Delivery created and order updated successfully',
        'delivery' => $delivery,
        'order' => $order
    ], 201);
}



//     /**
//      * Display the specified resource.
//      */
//     public function show(Delivery $delivery)
//     {
//         //
//     }



//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Delivery $delivery)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Delivery $delivery)
//     {
//         //
//     }
}
