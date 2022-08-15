<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    //get data
    public function getProfil(Request $request){
        try{
            $user_id = $request->user()->id;
            $user = User::find($user_id);
            return response()->json(['status' =>'true', 'message'=>"User profile", 'data'=>$user]);
        }catch (\Exception $e) {
            return response()->json(['status'=>'false', 'message'=>$e->getMessage(), 'data'=>[]],500);
        }
    }
}
