<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TraderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//contact
Route::get('contact/',[ContactController::class,'index']);
Route::post('contact/add/{id}',[ContactController::class,'store']);

//banner
Route::get('banner/',[BannerController::class,'index']);
Route::post('banner/add/{id}',[BannerController::class,'store']);

//Coupon
Route::get('coupon/',[CouponController::class,'index']);
Route::post('coupon/create/{id}',[CouponController::class,'store']);


//conversation
Route::get('conv/',[ConversationController::class,'index']);
Route::post('conv/create/{id}',[ConversationController::class,'store']);


//messages
Route::get('message',[MessagesController::class,'index']);
Route::get('message/{id}',[MessagesController::class,'show']);
Route::post('message/add/{id}',[MessagesController::class,'store']);



//admin
Route::middleware(['auth:sanctum'])->group(function(){
    Route::patch('trader/confirm/{id}',[AdminController::class,'AdminConfirm']);
});

//trader
Route::get('trader/',[TraderController::class,'getAllTraders']);
Route::get('trader/deliveries/{id}',[TraderController::class,'getAllStoreDeliveries']);
Route::get('trader/orders/{id}',[TraderController::class,'getAllStoreOrders']);
Route::get('trader/products/{id}',[TraderController::class,'getAllStoreProducts']);
Route::post('trader/add/',[TraderController::class,'addTrader']);
Route::post('trader/upload/',[TraderController::class,'addProductForTrader']);



//Delivery
Route::get('deliver/',[DeliveryController::class,'index']);
Route::post('deliver/create/',[DeliveryController::class,'store']);



//categories
Route::get('category/', [CategoryController::class, "index"]);
Route::get('category/{id}', [CategoryController::class, "show"]);
Route::post('category/create', [CategoryController::class, "store"]);


//offers
Route::get('offer/', [OfferController::class, "index"]);
Route::get('offer/discounts/{id}', [OfferController::class, "getDiscountedProducts"]);
Route::post('offer/create/{id}',[OfferController::class, "store"]);


//notifications
Route::get('notify/', [NotificationController::class, 'allNotifications']);


//order Routes
Route::get('order/',[OrderController::class,'index']);
Route::get('order/{id}',[OrderController::class,'show']);
Route::post('order/create/{id}',[OrderController::class,'store']);



//product Routes
Route::get('product/',[ProductController::class,'index']);
Route::get('product/{id}',[ProductController::class,'show']);
Route::post('product/create',[ProductController::class,'store']);



//user Routes
Route::get('getUsers/{id}',[UserController::class, 'getUsersForAdmin']);
Route::put('forget/{id}',[UserController::class,'forgetPassword']);
Route::put('reset/{id}',[UserController::class,'resetPassword']);
Route::post('verify/{id}',[UserController::class,'verify']);
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('/',[UserController::class, 'index']);
Route::get('user/orders/{id}',[UserController::class, 'getUserOrders']);
Route::get('/user/deliveries/{id}',[UserController::class, 'getUserDeliveries']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


