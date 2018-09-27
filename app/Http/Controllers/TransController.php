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
use App\Logs;
use App\Receipt;
use App\Periods;
use App\Report_Debts;
use App\Fees;
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
        $classes_info = array();
        $periods_info = array();
        if(array_key_exists('Classes', $data)){
            foreach ($data['Classes'] as $class_id => $tuition) {
                # code...
                $classes = Classes::find($class_id);
                $classes_info[$classes->id] = $classes->name;
                foreach ($tuition as $period => $value) {
                    $periods = Periods::find($period);
                    $periods_info[$periods->id] = $periods->name;
                    # code...
                }
            }
        }
       // echo "<pre>";
       // print_r($data);
       return view('transactions.tuitionDetail',compact('data','accountId','student','classes_info','periods_info'));
        //print_r($allTransaction);
    }
    function allTransaction($accountId){
        $account = Accounts::find($accountId);
        $debts = Accounts::where('name','Debt')->get()->toArray();
        // echo "<pre>";
        // print_r($debts);
        $allTransaction = Transaction::where('to',$accountId)->orderBy('created_at','DESC')->get();

        // echo "<pre>";
        // print_r($allTransaction->toArray());
        return view('transactions.allTransactionOfParent',compact('allTransaction','accountId','debts'));
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
            
            
        ]);    
        echo "<pre>";
        print_r($request->toArray());
        $logs = "";
        $receipt_description = "";
        //Thuc hien cac giao dich
        $total = 0;

/////////////Edit cac giao dich/////////////////   
        foreach ($request->khoanthu as $key => $value) {
            $find_debts = Report_Debts::where('class_id',$value['class_id'])->where('period_id', $value['periods_id'])->get()->toArray();
            $debts = Report_Debts::find($find_debts[0]['id']);
            $temp_amount = intval(trim(str_replace(' ', '', $value['amount']),'_'));
            $total += intval(trim(str_replace(' ', '', $value['amount']),'_'));
            //Cac transaction trong report
            $transactions = explode(',', $debts->debts);
            foreach ($transactions as $transaction) {
                # code...
                if($transaction == "") continue;
                else{
                    $check_transaction = Transaction::find($transaction);
                    if($check_transaction->to == $id){
                        if($temp_amount == 0) break;
                        if($temp_amount >= $check_transaction->amount){
                            $temp_amount -= $check_transaction->amount;
                            $logs .= $check_transaction->id.",";
                            $receipt_description .= $this->delimited_tag($check_transaction->description, 'note:')."|" .$check_transaction->amount."#";
                            // Cập nhật báo cáo chu kỳ (Tổng và chuỗi Giao dịch)
                            $debts->total -= $check_transaction->amount;
                            $debts->debts = str_replace(','.$transaction, '', $debts->debts);
                            $debts->save();
                            //Cập nhật giao dịch
                            $check_transaction->amount = 0;
                            $check_transaction->save();

                        }
                        else{
                            $check_transaction->amount -= $temp_amount;
                            $logs .= $check_transaction->id.",";
                            $check_transaction->save();
                            $receipt_description .= $this->delimited_tag($check_transaction->description, 'note:')." (thiếu $check_transaction->amount)|" .$temp_amount."#";
                            $temp_amount = 0;
                        }
                    }
                }
            }
            # code...
        }

////////Cap nhat balance STD va Debt        
        $student_acc = Accounts::find($id);
        $student_acc->balance -= $total;
        $student_acc->save();

        $check_debt = Accounts::where('name','Debt')->get()->toArray();
        $debt = Accounts::find($check_debt[0]['id']);
        $debt->balance += $total;
        $debt->save();

        //Phieu thu
        $new_receipt = new Receipt();
        $new_receipt->description = $receipt_description;
        $new_receipt->amount = $total;
        $new_receipt->receiver = $request->user;
        $new_receipt->account = $request->stuAcc;
        $new_receipt->type = $request->method;
        $new_receipt->save();

        //METHOD >> STD
        $method = Accounts::where('name',$request->method)->get()->toArray();
        $fee = Accounts::where('name','Fee')->get()->toArray();
        $check_fee = Fees::where('account_id',$method[0]['id'])->get()->toArray();
        if(!empty($check_fee)){
            $tranfer = $this->transfer($method[0]['id'], $request->stuAcc, $total*(100-$check_fee[0]['amount'])/100, date('Y-m-d'), "#thuhp#".$request->method);

            $tranfer_fee = $this->transfer($fee[0]['id'], $request->stuAcc, $total*$check_fee[0]['amount']/100, date('Y-m-d'), "#PhiNg#".$request->method);
            $logs .= $tranfer->id.",".$tranfer_fee->id.",";
            $tranfer->rel_id = $new_receipt->id;
            $tranfer->save();
            $tranfer_fee->rel_id = $new_receipt->id;
            $tranfer_fee->save();
        }
        else{
            $tranfer = $this->transfer($method[0]['id'], $request->stuAcc, $total, date('Y-m-d'), "#thuhp#".$request->method);
            $tranfer->rel_id = $new_receipt->id;
            $tranfer->save();
            $logs .= $tranfer->id.",";
        }
        //Logging
        $log_transaction = new Logs();
        $log_transaction->transactions = $logs;
        $log_transaction->save();
        // echo $logs;
        // echo "<br>";
        // echo $receipt_description;



       
        return redirect()->route('printReceipt',$new_receipt->id);
    }
    function addTransaction(Request $request){
        echo "<pre>";
        print_r($request->toArray());

    }
    function delimited_tag($str,$tag){
        $tags = explode('#', $str);
        foreach ($tags as $key => $value) {
            # code...
            if(strpos($value, $tag) !== false){
                return str_replace($tag, "", $value);

            }
        }
        return "";
    }
    function find_by_tag($tag){
        $transaction = Transaction::where('description','LIKE','%'.$tag.'%')->get;
        echo "<pre>";
        print_r($transaction->toArray());
    }

    //In 
    function print_receipt($id){
        $receipt = Receipt::find($id);
       $detail = explode('#', $receipt->description);
       $param = [];
       $account_name = Accounts::find($receipt->account)->name;
       foreach ($detail as $key => $value) {
           # code...
            if($value == "") continue;
            array_push($param, explode('|', $value));
       }
        return view('receipt.hocphi',compact('receipt','account_name','param'));
        // echo "<pre>";
        // print_r($request['request']);
    }
}