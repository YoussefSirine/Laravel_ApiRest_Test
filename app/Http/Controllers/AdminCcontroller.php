<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCcontroller extends Controller
{
    public function remove(Request $request, $id){
        $user = User::find($id);
        $user->delete();

        return response()->json($user); 
    }

    public function softdelete(Request $request, $id){
        User::where('id', $id)->delete();
        $request->session()->flash('message', 'Deleted Successfully');
        return response()->json($request);
    }

    public function trashed(Request $request, $id){
        User::onlyTrashed()->find($id)->restore();
        return 'User restored';
    }


}
