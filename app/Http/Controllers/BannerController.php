<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\Offer;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = banner::with('offer')->get();
        $data = $banners->map(function ($banner) {
            return [
                'id'=>$banner->id,
                'title'=>$banner->title,
                'offer'=>$banner->offer
            ];
        });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $offer_id = Offer::findOrFail($id);
        $request->validate([
            'title' =>'required|string',
        ]);

        $banner = banner::create([
            'title'=>$request->title,
            'offer_id'=>$id
        ]);
        return response()->json([
        'message' => "banner added successfully",
        'banner' => $banner
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(banner $banner)
    {
        //
    }
}
