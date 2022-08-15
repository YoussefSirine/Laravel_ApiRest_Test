<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthCcontroller extends Controller
{
    
    public function register(Request $request){
        //this is for validation
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //store user in database
        $user = User :: create([
            'name' => $attr['name'],
            'email' => $attr['email'],
            'role' => 2,
            'password' => bcrypt($attr['password']), 
        ]);

        //result with api token in response
        $token = $user->createToken('API Token')->plainTextToken;
        $code = 200; 

        return response()->json([
            'status' => 'Success',
            'message' => 'successfull registred',
            'data' => $token,
        ],$code);  
    }

    public function login(Request $request){
        //this is for validation
        $attr = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8', 
        ]);

        if(!Auth::attempt($attr)){
            return $this->error('Credentials not match', 401);
        }
           
        //result with api token in response
        $token = auth()->user()->createToken('API Token')->plainTextToken;
        $code = 200; 

        return response()->json([
            'status' => 'Success',
            'message' => 'successfull registred',
            'data' => $token,
        ],$code);  
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'Token Revoked',
        ],$code);
    }
}
