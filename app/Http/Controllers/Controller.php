<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Accounts;
use App\Transaction;
use App\Discounts;
use Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function transfer($fromAcc, $toAcc, $amount, $date, $description){
    	//Check discount
   		$discountValue = 0;
   		$formated_date = date('Y/m/d',strtotime($date));
    	$discount = Discounts::where('from',$fromAcc)->where('to',$toAcc)->where('start','<=',$formated_date)->where('expired','>=',$formated_date)->get()->toArray();
    	if(!empty($discount)){
    		if($discount['type'] == 'discount' ){
    		$amount = $amount/100*(100-$discount->discount);
    	}
    	if($discount['type'] == 'voucher'){
    		$amount -= $discount->discount;
    	}
    	}
    	//Create transaction
    	$transaction = new Transaction();
    	$transaction->from = $fromAcc;
    	$transaction->to = $toAcc;
    	$transaction->amount = $amount;
    	$transaction->date = $date;
    	$transaction->description = $description;
    	$transaction->user = Auth::user()->name;
    	$transaction->save();

    	//Update Balance
    	$from = Accounts::find($fromAcc);
    	$to = Accounts::find($toAcc);
    	$from->balance -= $amount;
    	$to->balance += $amount;
    	$from->save();
    	$to->save();
    }
}
