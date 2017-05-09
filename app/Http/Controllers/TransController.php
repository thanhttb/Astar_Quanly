<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Accounts;
use App\Class_std;
use App\Lessons;
use App\Parents;
use App\Students;
use App\Classes;
use Respons;
use App\Receipt;
use Auth;
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
    function selectAccount(){
        return view('transactions.selectAccount');
    }
    function dongtien($accountId){
        $account = Accounts::find($accountId);
        //check if student
        if($account->type == 1){
            $student = Students::where('acc_id',$accountId)->get()->toArray();
            $parent = Parents::find($student[0]['parent_id']);
            $students = Students::where('parent_id',$parent->id)->get()->toArray();
            $accountId = $parent->acc_id;
        }
        else{
            $parent = Parents::where('acc_id',$accountId)->get()->toArray();
            $students = Students::where('parent_id',$parent[0]['id'])->get()->toArray();
        }
        return view('transactions.dongtien',compact('accountId','students'));
    }
    function detailTuition($accountId){
        $account = Accounts::find($accountId);
        //Check if Student 
        $student = Students::where('acc_id',$accountId)->get()->toArray();
       $data = $this->tuition_detail($accountId);       //echo "<pre>";
       return view('transactions.tuitionDetail',compact('data','accountId','student'));
        //print_r($allTransaction);
    }
    function allTransaction($accountId){
        $account = Accounts::find($accountId);
        //Check if Student 
        if($account->type == 1){
            $student = Students::where('acc_id',$accountId)->get()->toArray();
            $parent = Parents::find($student[0]['parent_id']);
            $accountId = $parent->acc_id;
        }
        $allTransaction = Transaction::where('from',$accountId)->orWhere('to',$accountId)->get();
        return view('transactions.allTransactionOfParent',compact('allTransaction','accountId'));
    }
    function recieve(Request $request, $id){
        $account = Accounts::find($id);
        if($account->type == 1){
            $student = Students::where('acc_id',$id)->get()->toArray();
            $parent = Parents::find($student[0]['parent_id']);
            $id = $parent->acc_id;
        }
        $receipt = new Receipt();
        $receipt->save();
        $request = $request->toArray();
        // echo "<pre>";
        // print_r($request);
        if(!is_null($request['total'])){
            for($i =0; $i < $request['count']; $i++){
                $amount = abs(intval($request['amount'.$i]));
                //echo $amount." ".$request['tag'.$i];  
                $this->transfer($request['method'],$id,$amount,date('Y/m/d'),$request['tag'.$i], $receipt->id);

            }
        }
        else{
            for($i =0; $i < $request['count']; $i++){
                if(!is_null($request['money'.$i])){
                    $formated = str_replace(' ', '', $request['money'.$i]);
                    $money = intval(str_replace('_', '', $formated));
                    //Transfer "PAYEMENT METHOD">>"PARENT"
                    $this->transfer($request['method'],$id,$money,date('Y/m/d'),$request['tag'.$i], $receipt->id);
                }
            }
        }
        if (!empty($request['otherFee'])) {
               # code...
            $this->transfer($request['method'],$id, abs(intval($request['otherFee'])), date('Y/m/d'), "#phuphi");
           }   
        return view('invoice.index',compact('receipt','request','student'));
        //Tiền học 
        
        //Phụ phí

    }
    function thu_hoc_phi(Request $request, $id){
        $this->validate($request, [
            'student' => 'required',
            'khoanthu' => 'required',
            'method' => 'required',
            
        ]);        
        //Chuyển khoản  PAR >> STD
        //Tim tai khoan cua phuong thuc thanh toan
        $method_acc = Accounts::where('name',$request->method)->get()->toArray()[0]['id'];
        $parent_acc = $request->parentAcc;
        //Hoc phi
        for($name = 0; $name < $request->count  ; $name++) {
            # code...            
            $amount = intval(trim(str_replace(' ', '', $request->khoanthu[0]['amount'.$name]),'_'));
            $tag = "#hs".$request->stuAcc."#".$request->khoanthu[0]['class'.$name]."#hp";

            $this->transfer($method_acc,$parent_acc,$amount,date('Y-m-d'),$tag);        
        }
        //phuphi
        if(array_key_exists('otherFeeAmount', $request->khoanthu[0])){
            $tag ="#hs".$request->stuAcc."#phuphi";
            $amount = intval(trim(str_replace(' ', '', $request->khoanthu[0]['otherFeeAmount']),'_')); 
            $this->transfer($method_acc,$parent_acc,$amount,date('Y-m-d'),$tag);   
        }
        // echo "<pre>";
        // print_r($request->toArray());

        //Phiếu thu
        $maxId = Receipt::max('id');
        $lastRecieve = Receipt::find($maxId);
        $total = 0; $description = '';
        $newReceipt = new Receipt();
        $newReceipt->account = $request->student;
        //Chuẩn hóa phiếu thu
        $khoanthu = array();
        for($name = 0; $name < $request->count ; $name++) {
            # code...            
            $description = $description." | ".$request->khoanthu[0]['note'.$name]. ": ".trim(str_replace(' ', '', $request->khoanthu[0]['amount'.$name]),'_')."đ";
            $total += intval(trim(str_replace(' ', '', $request->khoanthu[0]['amount'.$name]),'_'));     
            //Chuan hoa phieu thu
            $khoanthu[$name]['note']=$request->khoanthu[0]['note'.$name];
            $khoanthu[$name]['amount']=$request->khoanthu[0]['amount'.$name];       
        }
        if(array_key_exists('otherFeeAmount', $request->khoanthu[0])){
            $description = $description."|".$request->khoanthu[0]['otherFeeNote']. ": ".trim(str_replace(' ', '', $request->khoanthu[0]['otherFeeAmount']),'_')."đ";
            $total += intval(trim(str_replace(' ', '', $request->khoanthu[0]['otherFeeAmount']),'_'));
            //chuan hoa pphieu thu
            $khoanthu[$request->count]['note']= $request->khoanthu[0]['otherFeeNote'];
            $khoanthu[$request->count]['amount']= $request->khoanthu[0]['otherFeeAmount'];
        }

        $newReceipt->description = $description;
        $newReceipt->amount = $total;
        $newReceipt->type = $request->method;
        $newReceipt->receiver = (empty($request->user)) ? Auth::user()->name : $request->user;
        $newReceipt->created_at = (empty($request->date)) ? date('Y-m-d h:i:m') : date('Y-m-d h:i:m', strtotime($request->date));
        $request->khoanthu = $khoanthu;
        $newReceipt->id = $maxId;
        // echo "<pre>";
        // print_r($lastRecieve);
        if($newReceipt->account != $lastRecieve->account || $newReceipt->description!=$lastRecieve->description){
            $newReceipt->id = $maxId+1;
            $newReceipt->save();
        }
        return view('receipt.index',compact('request','newReceipt'));
    }
    function addTransaction(Request $request){
        echo "<pre>";
        print_r($request->toArray());

    }
}