<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TraderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//admin
Route::middleware(['auth:sanctum'])->group(function(){
    Route::patch('trader/confirm/{id}',[AdminController::class,'AdminConfirm']);
});

//trader
Route::get('trader/',[TraderController::class,'index']);
Route::get('trader/deliveries/{id}',[TraderController::class,'getAllStoreDeliveries']);
Route::get('trader/orders/{id}',[TraderController::class,'getAllStoreOrders']);
Route::get('trader/products/{id}',[TraderController::class,'getAllStoreOrders']);
Route::post('trader/add/',[TraderController::class,'addTrader']);
Route::post('trader/upload/',[TraderController::class,'addProductForTrader']);



//Delivery
Route::get('deliver/',[DeliveryController::class,'index']);
Route::post('deliver/create/',[DeliveryController::class,'store']);



//categories
Route::get('category/', [CategoryController::class, "index"]);
Route::get('category/{id}', [CategoryController::class, "show"]);
Route::post('category/create', [CategoryController::class, "store"]);


//notifications
Route::get('notify/', [NotificationController::class, 'allNotifications']);


//order Routes
Route::get('order/',[OrderController::class,'index']);
Route::get('order/{id}',[OrderController::class,'show']);
Route::post('order/create/{id}',[OrderController::class,'store']);



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
Route::get('/',[UserController::class, 'index']);
Route::get('user/orders',[UserController::class, 'getUserOrders']);
Route::get('/user/deliveries',[UserController::class, 'getUserDeliveries']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


