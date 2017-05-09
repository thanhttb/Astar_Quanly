<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use App\Accounts;
use App\Transaction;
use App\Parents;
use App\Students;

class AccountController extends Controller
{
    
    function searchAccount(Request $request){
    	$term = $request->term;
    	if(empty($term)){
    		return \Response::json([]);
    	}
    	else{
    		$acc = Accounts::where('name','LIKE','%'.$term.'%')->get()->toArray();
    		return \Response::json($acc);
    	}
    }
    function searchAccountParents(Request $request){
        if(empty($request->term)){
            return \Response::json([]);
        }
        else{
            $resultAccount = array();
            $resultAccount = Accounts::where('name','LIKE','%'.$request->term.'%')->where('type',1)->get()->toArray();
            $parent = Parents::where('phone','LIKE','%'.$request->term.'%')->get()->toArray();
            foreach ($parent as $key => $value) {
                # code...
                $parentAcc = Accounts::find($value['acc_id'])->toArray();
                array_push($resultAccount, $parentAcc);
            }

            return \Response::json($resultAccount);
        }
    }
    function list_account(){

    }
}
