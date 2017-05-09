<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use Auth;
use View;
class RecieptController extends Controller
{
    //
    function get_form(){
    	return view('transactions.formphieuthu');
    }
    function post_form(Request $request){
        $this->validate($request, [
            'student' => 'required',
            'khoanthu' => 'required',
            'method' => 'required',
        ]);  

        $maxId = Receipt::max('id');
        $lastRecieve = Receipt::find($maxId);
        $total = 0; $description = '';
        $newReceipt = new Receipt();
        $newReceipt->account = $request->student;
        foreach ($request->khoanthu as $key => $value) {
            # code...            
            $description = $description." | ".$value['note']. ": ".trim(str_replace(' ', '', $value['amount']),'_')."đ";
            $total += intval(trim(str_replace(' ', '', $value['amount']),'_'));            
        }
        $newReceipt->description = $description;
        $newReceipt->amount = $total;
        $newReceipt->type = $request->method;
        $newReceipt->receiver = (empty($request->user)) ? Auth::user()->name : $request->user;
        $newReceipt->created_at = (empty($request->date)) ? date('Y-m-d h:i:m') : date('Y-m-d h:i:m', strtotime($request->date));
        $newReceipt->id = $maxId;
        // echo "<pre>";
        // print_r($lastRecieve);
        if($newReceipt->account != $lastRecieve->account || $newReceipt->description!=$lastRecieve->description){
            $newReceipt->id = $maxId+1;
            $newReceipt->save();
        }
        return View::make('receipt.index',compact('request','newReceipt'));
    }
    function in_phieu_thu($request, $newReceipt){
        return view('receipt.index',compact('request','newReceipt'));
    }
    function list_receipt(){
        return view('receipt.listReceipt');
    }
    function deleteLast(){
        $lastRecieve = Receipt::orderby('id','DESC')->limit(1)->delete();
		return redirect()->route('listClass');
	}
}
