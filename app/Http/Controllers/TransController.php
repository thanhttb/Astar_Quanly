<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Accounts;
use Respons;
class TransController extends Controller
{
    //
    function getTransaction($id){
    	$q = Transaction::where('from',$id)->orWhere('to',$id)->get();
    	$transaction = ['data'=>[], 'draw'=> 1, 'recordsFiltered'=>178, 'recordsTotal' => 178];
    	foreach ($q as $key => $value) {
    		# code...
    		$from = Accounts::find($value->from)->name;
    		$to = Accounts::find($value->to)->name;
    		$eachTransaction = ['<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value->id.'"/><span></span></label>'
    							,$value->id,$from,$to,date('Y/m/d',strtotime($value->date)),$value->amount,$value->description,$value->status,''];
    		array_push($transaction['data'], $eachTransaction);
    	}
    	return \Response::json($transaction);
    }
}
