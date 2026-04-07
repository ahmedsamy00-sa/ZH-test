<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//order Routes
Route::get('order/',[OrderController::class,'index']);
Route::post('order/create/{id}',[OrderController::class,'store']);
Route::get('order/{id}',[OrderController::class,'show']);



//product Routes
Route::get('product/',[ProductController::class,'index']);
Route::post('product/create',[ProductController::class,'store']);
Route::get('product/{id}',[ProductController::class,'show']);


//user Routes
Route::get('getUsers/{id}',[UserController::class, 'getUsersForAdmin']);
Route::put('forget/{id}',[UserController::class,'forgetPassword']);
Route::put('reset/{id}',[UserController::class,'resetPassword']);
Route::post('verify/{id}',[UserController::class,'verify']);
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/',[UserController::class, 'index']);
