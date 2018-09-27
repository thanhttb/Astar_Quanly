<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use App\Payment;
use Auth;
use View;
use DB;
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
    function group_by_day(){
        $receipt = Receipt::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as amount'), DB::raw('type'))->groupBy(DB::raw('DATE(created_at)'))->groupBy(DB::raw('type'))->orderBy('created_at', 'DESC')->get();
        $payment = Payment::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as amount'), DB::raw('type'))->groupBy(DB::raw('DATE(created_at)'))->groupBy(DB::raw('type'))->orderBy('created_at', 'DESC')->get();
        // echo "<pre>";
        // print_r($receipt->toArray());
        $checkDate = 0;
        $rc = array();
        foreach ($receipt as $key => $value) {
            //Construct
            if($value->date != $checkDate){
                $rc[$value->date]['r_cash']=0;
                $rc[$value->date]['r_vcb']=0;
                $rc[$value->date]['r_tcb']=0;
                $rc[$value->date]['p_cash']=0;
                $rc[$value->date]['p_vcb']=0;
                $rc[$value->date]['p_tcb']=0;
                $checkDate = $value->date;
            }
            # code...
            if($value->type == "cash"|| $value->type == 'CASH'){                
                $rc[$value->date]['r_cash'] = $value->amount;
            }
            if($value->type == "vcb"|| $value->type == 'VCB'){
                $rc[$value->date]['r_vcb'] = $value->amount;
            }
            if($value->type == "tcb"|| $value->type == 'TCB'){
                $rc[$value->date]['r_tcb'] = $value->amount;
            }             
        }

       
        // echo "<pre>";
        // print_r($payment->toArray());
        $checkDate = 0;
        foreach ($payment as $key => $value) {
            if(!array_key_exists($value->date, $rc)){
                $rc[$value->date]['r_cash']=0;
                $rc[$value->date]['r_vcb']=0;
                $rc[$value->date]['r_tcb']=0;
                $rc[$value->date]['p_cash']=0;
                $rc[$value->date]['p_vcb']=0;
                $rc[$value->date]['p_tcb']=0;
            }           
            if($value->type == "cash"|| $value->type == 'CASH'){                
                $rc[$value->date]['p_cash'] = $value->amount;
            }
            if($value->type == "vcb"|| $value->type == 'VCB'){
                $rc[$value->date]['p_vcb'] = $value->amount;
            }
            if($value->type == "tcb"|| $value->type == 'TCB'){
                $rc[$value->date]['p_tcb'] = $value->amount;
            }             
        }
        // echo "<pre>";
        // print_r($rc);
        return view('receipt.list',compact('rc'));
    }
}
