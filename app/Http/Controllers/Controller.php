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
use App\Teachers;
use App\Transactions;
use App\Class_std;
use App\Attendances;
use App\Lessons;
use App\Students;
use App\Classes;
use App\Parents;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function tuition_detail($stdAcc){
        $tuition_detail = array();
        $student = Students::where('acc_id',$stdAcc)->get()->toArray();
        $parent = Parents::find($student[0]['parent_id']);
        $parentAccount = $parent->acc_id;
        $class_std = Class_std::where('student_id',$student[0]['id'])->get()->toArray();
        //Hoc phi
        foreach ($class_std as $key => $value) {
            // # code...
            $class = Classes::find($value['class_id']);            
            $eachMonth = 0;
            $negative = Transaction::where('from',$parentAccount)->where('description','LIKE','%#'.$class->name.'%')
                            ->where('description','LIKE','%#hp%')->where('to',$stdAcc)
                            ->sum('amount');
            $positive = Transaction::where('to', $parentAccount)->where('description','LIKE','%#'.$class->name.'%')
                        ->where('description','LIKE','%#hp%')->where('description','LIKE','%hs'.$stdAcc.'%')
                        ->sum('amount');
            if($positive - $negative != 0){
                $tuition_detail['class'][$class->name] = $positive - $negative;
            }

        }
        //Phu phi
        $otherPositive = Transaction::where('to',$parentAccount)->where('description','NOT LIKE', '%hp%')->sum('amount');
        $otherNegative = Transaction::where('from' ,$parentAccount)->where('description','NOT LIKE', '%hp%')->where('description','LIKE','%hs'.$stdAcc.'%')->sum('amount');
        if($otherPositive - $otherNegative != 0){
            $tuition_detail['otherFee'] = $otherPositive - $otherNegative;
        }
        else $tuition_detail['otherFee'] = 0;
        $tuition_detail['stdAcc'] = $stdAcc;
        $tuition_detail['parentAcc'] = $parentAccount;
        // echo "<pre>";
        // print_r($tuition_detail);
        return $tuition_detail;
    }
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
    	return $transaction;
    }
    protected function newStudent($parent_id, $acc_id, $fName, $lName, $dob, $gender, $school, $class, $email, $phone){
    	$student = new Students();
    	$student->parent_id = $parent_id;
    	$student->acc_id = $acc_id;
    	$student->lastName = $lName;
    	$student->firstname = $fName;
    	$student->dob = date('Y-m-d', strtotime($dob));
    	$student->gender = $gender;
    	$student->school = $school;
    	$student->email = $email;
    	$student->phone = $phone;
    	$student->save();
    	return $student;
    }
    protected function newAccount($name, $dob, $type, $balance){
        $newAcc = new Accounts();
        $newAcc->name = $name;
        $newAcc->dob = $dob;
        $newAcc->type = $type;
        $newAcc->balance = $balance;
        $newAcc->save();
        return $newAcc;
    }
    protected function newParent($acc_id, $name, $phone, $email, $work, $add){
    	$newParent = new Parents();
    	$newParent->acc_id = $acc_id;
    	$newParent->name = $name;
    	$newParent->phone = $phone; 
    	$newParent->email = $email;
    	$newParent->work = $work;
    	$newParent->address= $add;
    	$newParent->save();
    	return $newParent;
    }
    //
}
