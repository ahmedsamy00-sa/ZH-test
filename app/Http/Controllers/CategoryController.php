<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json($category, 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'string|max:20|required',
        ]);
        $category = Category::create([
            'name'=>$request->name,
        ]); 

        return response()->json(['message'=>"category added"], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, $id)
    {
        $category = Category::find($id);
        if(!$category) return response()->json(["message"=>"Invalid Id"], 401);
        return response()->json($category, 200);
    }



    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Category $category)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Category $category)
    // {
    //     //
    // }
}
