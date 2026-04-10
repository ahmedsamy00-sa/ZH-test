<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Product;
use App\Models\Trader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json($user, 200);
    }

    public function getUserOrders($id){
        $orders = Order::where('user_id',$id)->get();
        return response()->json($orders, 200);
        
    }
    public function getUserDeliveries($id){
        $deliveries = Delivery::where('user_id',$id)->get();
        return response()->json($deliveries, 200);
    }


    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'user registered successfully',
            'data' => $user,
            "Token"=>$token], 201);
    }


    public function login(LoginRequest $request){

        if(!Auth::attempt($request->only('phone','password'))){
            return response()->json(['message'=>"Invalid Credentials", 401]);
        }
        $user = User::where('phone', $request->phone)->FirstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            "message"=>"user logged in successfully", 
            "user"=>$user, 
            "Token"=>$token,
            201]);
    }

    public function forgetPassword(Request $request, $id ){
        $user = User::find($id);
        if(!$user){
            return response()->json(['message'=>'user not found'], 404);
        }
        $request->validate([
            'email'=> 'required|email',
        ]);

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->save();

        return response()->json([
        'message' => 'OTP generated successfully',
        'otp' => $otp 
    ]);
    }

    public function verify(Request $request, $id){
        $user = User::find($id);
        $request->validate([
            'email'=>'required|email|',
            "OTP"=>'required|integer'
        ]);
        $user->password = Hash::make($request->newPassword);
        $user->save();
        return response()->json(['message' => 'Password reset successfully'], 200);
    }

    public function resetPassword(Request $request, $id){
        $user = User::find($id);
        $request->validate([
            'oldPassword'=>'required|string|min:8',
            'newPassword'=>'required|string|min:8'
        ]);

        if(!Hash::check($request->oldPassword, $user->password)){
        return response()->json(['message' => 'Old password is incorrect'], 401);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();
        return response()->json(['message' => 'Password reset successfully'], 200);

    }

public function getUsersForAdmin($id){
        $user = User::find($id);

    if(!$user){
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    if($user->role !== 'admin'){
        return response()->json(['message'=>'Unauthorized'], 403);
    }

    $users = User::all();

    return response()->json([
        'message' => 'Users retrieved successfully',
        'users' => $users
    ], 200);        
}

}