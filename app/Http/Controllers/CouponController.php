<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = coupon::with('product')->get();
        $data = $coupons->map(function ($coupon) {
            return [
                'id'=>$coupon->id,
                'code'=>$coupon->code,
                'discount'=>$coupon->discount,
                'expires_at'=>$coupon->expires_at,
                'products'=>$coupon->products
            ];
        });
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
        'discount' => 'required|numeric|min:0|max:100',
        'code'=>'required|string',
        'exp' => 'required|date|after:now'
        ]);
        $coupon = coupon::create([
            'product_id' => $id,
            'code'=> $request->code,
            'discount'=>$request->discount,
            'expires_at'=>$request->exp
        ]);
        return response()->json($coupon, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(coupon $coupon)
    {
        //
    }
}
