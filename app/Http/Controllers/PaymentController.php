<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Auth;
use View;
class PaymentController extends Controller
{
    //
    function get_form(){
    	return view('transactions.formphieuchi');
    }
    function post_form(Request $request){
        $this->validate($request, [
            'student' => 'required',
            'khoanchi' => 'required',
            'method' => 'required',
        ]);  

        $maxId = Payment::max('id');
        $lastPayment = Payment::find($maxId);
        $total = 0; $description = '';
        $newPayment = new Payment();
        $newPayment->account = $request->student;
        foreach ($request->khoanchi as $key => $value) {
            # code...            
            $description = $description." | ".$value['note']. ": ".trim(str_replace(' ', '', $value['amount']),'_')."đ";
            $total += intval(trim(str_replace(' ', '', $value['amount']),'_'));            
        }
        $newPayment->description = $description;
        $newPayment->amount = $total;
        $newPayment->type = $request->method;
        $newPayment->receiver = (empty($request->user)) ? Auth::user()->name : $request->user;
        $newPayment->created_at = (empty($request->date)) ? date('Y-m-d h:i:m') : date('Y-m-d h:i:m', strtotime($request->date));
        $newPayment->id = $maxId;
        if(is_null($lastPayment)){
        	$newPayment->id = $maxId+1;
	        $newPayment->save();
        }
        else{
        	if($newPayment->account != $lastPayment->account && $newPayment->description!=$lastPayment->description){
	        	$newPayment->id = $maxId+1;
	            $newPayment->save();
	        }
        }
        // echo "<pre>";
        // print_r($request->toArray());
        return View::make('payment.index',compact('request','newPayment'));
    }
}
