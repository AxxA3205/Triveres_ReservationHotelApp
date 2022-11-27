<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function register(Request $request)
   {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string'
    ]);

    $user = new User([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'user'
    ]);

    $user->save();

    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'message' => 'User baru telah dibuat',
        'access_token' => $token
    ], 201);
   }

   public function login(Request $request)
   {
       $fields = $request->validate([
           'email' => 'required|string',
           'password' => 'required|string'
       ]);

       // check email
       $user = User::where('email', $fields['email'])->first();

       // check password
       if (!$user || !Hash::check($fields['password'], $user->password)){
           return response([
               'message' => 'unauthorized'
           ], 401);
       }

       $token = $user->createToken('authToken')->plainTextToken;

       return response()->json([
        'message' => 'User berhasil log in',
        'access_token' => $token

       ], 200);
           
       return response($response, 201);
   }

   public function logout(Request $request) 
   {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'User berhasil log out'
    ], 200);
   }
}
