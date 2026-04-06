<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
