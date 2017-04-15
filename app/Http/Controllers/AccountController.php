<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use App\Accounts;
use App\Transaction;
class AccountController extends Controller
{
    //
    function searchAccount(Request $request){
    	$term = $request->term;
    	if(empty($term)){
    		return \Response::json([]);
    	}
    	else{
    		$acc = Accounts::where('name','LIKE',$term.'%')->get();
    		return \Response::json($acc);
    	}
    }
}
