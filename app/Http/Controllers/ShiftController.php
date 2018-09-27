<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shifts;
use Auth;
use App\User;
class ShiftController extends Controller
{
    //
    function get_checkin(){
    	return view('auth.checkin');
    }
    function post_checkin(Request $request){
    	$this->validate($request,[
    		'confirmed'=>'required'
    		]);
    	$shift = new Shifts();
    	$shift->user_id = Auth::user()->id;
    	$shift->checkin_time = date('Y-m-d h:i:m');
    	$shift->checkin_note = $request->note;
    	$shift->save();
    	$user = Auth::user();
    	$user->online = '1';
    	$user->save();
    	return redirect()->route('listClass');

    }
    function get_checkout(){
    	return view('auth.checkout');
    }
    function post_checkout(Request $request){
    	$this->validate($request,[
    		'confirmed'=>'required'
    		]);
    	$shift = Shifts::where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
    	$shift->checkout_time = date('Y-m-d h:i:m');
    	$shift->checkout_note = $request->note;
    	$shift->save();
    	$user = Auth::user();
    	$user->online = '0';
    	$user->save();
    	return redirect()->route('listClass');

    }
}
