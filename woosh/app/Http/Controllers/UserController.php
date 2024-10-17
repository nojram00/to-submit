<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password'))){
            return \response(['message' => __('auth.failed')]);
        }

        $token = \auth()->user()->createToken('client');

        return \response()->json([
            'token' => $token->plainTextToken
        ]);
    }

    public function register(Request $request){

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return \response()->noContent();
    }
}
