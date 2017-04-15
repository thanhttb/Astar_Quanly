<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;
use App\Transactions;
use App\Class_std;
use App\Attendances;
use App\Lessons;
use App\Students;
use App\Parents;
use App\Classes;
use Auth;
use Response;
class TransactionController extends Controller
{
    //
    function getList(){
    	$allTransaction = Transactions::all()->toArray();
    	$percentageAllTime = 0;


    	foreach ($allTransaction as $key => $value) {
    		# code...
    		$studentInfo = Students::findorfail($value['student_id'])->toArray();
    		$parentInfo = Parents::findorfail($studentInfo['parent_id'])->toArray();
    		$lessonInfo = Lessons::findorfail($value['lesson_id']);
    		$classInfo = Classes::findorfail($value['class_id']);
    		$allTransaction[$key]['studentInfo'] = $studentInfo;
    		$allTransaction[$key]['parentInfo'] = $parentInfo;
    		$allTransaction[$key]['classInfo'] = $classInfo;
    		$allTransaction[$key]['lessonInfo'] = $lessonInfo;
    		$allTransaction[$key]['lessonInfo']['start_time'] = date('Y/m/d',strtotime($allTransaction[$key]['lessonInfo']['start_time']));
    		$fomat = date('d-m-Y',strtotime($allTransaction[$key]['created_at']));
    		$allTransaction[$key]['created_at'] = $fomat;
    		if(!is_null($allTransaction[$key]['day'])){
    			$allTransaction[$key]['day'] = date('Y/m/d',strtotime($allTransaction[$key]['day']));
    		}
    		if(!is_null($allTransaction[$key]['studentInfo']['dob']) && $allTransaction[$key]['studentInfo']['dob'] != '0000-00-00'){
    			$allTransaction[$key]['studentInfo']['dob'] = date('d/m/Y',strtotime($allTransaction[$key]['studentInfo']['dob']));
    		}

    	}
    	return view('transactions.list', compact('allTransaction'));


    }
    function get_transaction_student($id){
    	$stdTransaction = Transactions::where('student_id',$id)->get()->toArray();
    	foreach ($stdTransaction as $key => $value) {
    		# code...
    		$studentInfo = Students::findorfail($id)->toArray();
    		$parentInfo = Parents::findorfail($studentInfo['parent_id'])->toArray();
    		$lessonInfo = Lessons::find($value['lesson_id']);
    		$classInfo = Classes::find($value['class_id']);
    		$stdTransaction[$key]['studentInfo'] = $studentInfo;
    		$stdTransaction[$key]['parentInfo'] = $parentInfo;
    		$stdTransaction[$key]['classInfo'] = $classInfo;
    		$stdTransaction[$key]['lessonInfo'] = $lessonInfo;
    		if(!is_null($stdTransaction[$key]['lessonInfo']['start_time'])){
    			$stdTransaction[$key]['lessonInfo']['start_time'] = date('Y/m/d',strtotime($stdTransaction[$key]['lessonInfo']['start_time']));
    		}
    		$stdTransaction[$key]['lessonInfo']['start_time'] = date('Y/m/d',strtotime($stdTransaction[$key]['lessonInfo']['start_time']));
    		$fomat = date('Y/m/d',strtotime($stdTransaction[$key]['created_at']));
    		$stdTransaction[$key]['created_at'] = $fomat;
    		if(!is_null($stdTransaction[$key]['day'])){
    			$stdTransaction[$key]['day'] = date('Y/m/d',strtotime($stdTransaction[$key]['day']));
    		}
    		if(!is_null($stdTransaction[$key]['studentInfo']['dob'])){
    			$stdTransaction[$key]['studentInfo']['dob'] = date('d/m/Y',strtotime($stdTransaction[$key]['studentInfo']['dob']));
    		}


    	}
    	return view('transactions.listByStudent', compact('stdTransaction','id'));

    }
    function create_invoice(){

    	
    	return(view('invoice.index'));
    }
    function addTransaction(Request $request, $id){
        $transaction = new Transactions();
        $transaction->student_id = $id;
        $parent_id = Students::find($id)->parent_id;
        $transaction->parent_id = $parent_id;
        $transaction->amount = $request->amount;
        $transaction->note = $request->note;

        //find last balance
        $lastBalance = Transactions::where('student_id', $id)->orderBy('id','desc')->first();
        $balance = $lastBalance->balance;

        $transaction->balance = $balance + $request->amount;
        $transaction->day =  $request->day;
        $transaction->type = $request->type;
        $transaction->user = Auth::user()->name;
        $transaction->save();

        return Response::json($transaction);
    }
}
