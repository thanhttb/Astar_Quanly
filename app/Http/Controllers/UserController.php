<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
class UserController extends Controller
{
    //
    function storeAvatar(Request $request){
    	$user = Auth::user();
    	if(Input::hasFile('image')){
    		$file = Input::file('image');
    		$file->move(public_path().'/avatar/', $file->getClientOriginalName());

    		$user->avatar = $file->getClientOriginalName();
    	}
    	$user->save();
    	return view('auth.profile');
    }
    function storeProfile(Request $request){
    	$user = Auth::user();
    	$user->name = $request->name;
    	$user->phone = $request->phone;
    	$user->address = $request->address;
    	$user->save();
    	return view('auth.profile');
    }
    function get_users(){
        return view('auth.list');
    }
}
