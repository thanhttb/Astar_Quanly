<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Teachers;
use App\Students;
use App\Enrolls;
use App\Classes;
use App\Class_std;
use App\Lessons;
use App\Transactions;
use App\Attendances;
use App\Parents;
use App\Accounts;
use App\Transaction;
class EnrollController extends Controller
{
    //
    public function getResult(){
        $allTeachers = Teachers::all()->toArray();
        $allClasses = Classes::all()->toArray();
        return view('enroll/result',compact('allTeachers','allClasses'));
    }
     public function getFirstDay(){
        $allClasses = Classes::all()->toArray();
        if(is_null(Auth::user())){
            return view('auth.login');
        }
        return view('enroll/firstDay',compact('allClasses'));
    }
    public function saveDate(Request $request){
    	$datetime = Enrolls::findorfail($request->pk);
    	//echo $request->value;
    	$datetime->appointment = $request->value;
    	$datetime->save();
    	
    }
    public function saveTestInform(Request $request){
    	$datetime = Enrolls::findorfail($request->pk);
    	//echo $request->value;
    	$datetime->testInform = $request->value;
    	$datetime->save();
    	
    }
    public function saveShowUp(Request $request){
    	$datetime = Enrolls::findorfail($request->pk);
    	//echo $request->value;
    	$datetime->showUp = $request->value;
    	$datetime->save();
    	
    }
    public function saveTeacher(Request $request){
    	$teacher = Enrolls::findorfail($request->pk);
    	$teacher->teacher = $request->value;
    	$teacher->save();
    }

    public function saveResult(Request $request){
    	$result = Enrolls::findorfail($request->pk);
    	if($request->value == null){
            $result->result = '';
        }
        else $result->result = $request->value;
    	$result->save();
    }
    public function editResultInform(Request $request){
    	$result = Enrolls::findorfail($request->pk);
    	$result->resultInform = $request->value;
    	$result->save();
    }
    public function editDecision(Request $request){
    	$result = Enrolls::findorfail($request->pk);
    	$result->decision = $request->value;
    	$result->save();
    }
    public function editClass(Request $request){
        $officalClass = Enrolls::findorfail($request->pk);
        $officalClass->officalClass = $request->value;
        $officalClass->save();
    }
    public function editFirstDay(Request $request){
        $firstDay = Enrolls::findorfail($request->pk);
        $firstDay->firstDay = $request->value;
        $firstDay->save();
    }
    public function saveInform(Request $request){
        $inform = Enrolls::findorfail($request->pk);
        $inform->inform = $request->value;
        $inform->save();
    }
    public function editFirstDayShowUp(Request $request){
        /*
            1. Thêm account cho học sinh và phụ huynh
            2. Thêm vào lớp
            3. Thêm giao dịch tạm tính(ph>>hs) = Số buổi còn lại * tuition

        */
        $showUp = Enrolls::find($request->pk);
        $showUp->firstday_showup = $request->value;
        //Thêm Account cho ph hs nếu chưa tồn tại
        $student = Students::find($showUp->student_id);
        $parent = Parents::find($student->parent_id);
        if(is_null($student->acc_id)){
            $studAcc = new Accounts();
            $studAcc->name = $student->lastName." ".$student->firstName;
            $studAcc->dob = $student->dob;
            $studAcc->type = 1;
            $studAcc->balance = 0;
            $studAcc->save();
            $student->acc_id = $studAcc->id;
            $student->save();
        }
        if(is_null($parent->acc_id)){
            $parentAcc = new Accounts();
            $parentAcc->name = $parent->name;
            $parentAcc->dob = $student->dob;
            $parentAcc->type = 2;
            $parentAcc->balance = 0;
            $parentAcc->save();
            $parent->acc_id = $parentAcc->id;
            $parent->save();
        }
        //Xếp lớp nếu chưa có trong lớp
        $check = Class_std::where('student_id',$showUp->student_id)->where('class_id',$showUp->officalClass)->get()->toArray();
        if(count($check) == 0) {
            //Thêm vào lớp 
            $xl = new Class_std;
            $xl->student_id = $showUp->student_id;
            $xl->class_id = $showUp->officalClass;
            $xl->firstDay = $showUp->firstDay;
            $xl->save();
            $className = Classes::find($xl->class_id)->name;
            $balance = 0;
            //đếm số buổi học
            $lessons = Lessons::where('start_time','>=',$showUp->firstDay)->where('class_id',$showUp->officalClass)->get();
            if($lessons->count() != 0){
                //get tuition of class
                $tuition = Classes::find($showUp->officalClass)->tuition;
                $preTuition = array();
                //Thêm tag eg: #hp4#hp5 cho description
                
                $month = 0;
                foreach ($lessons as $k => $value) {
                    # code...
                    if($month != date('m',strtotime($value->start_time))){
                        $month = date('m',strtotime($value->start_time));
                        $preTuition[$month] = 0;
                    }
                    $preTuition[$month] += $tuition;
                }
                //Hạn đóng tiền
                $date = date('Y-m-d',strtotime($showUp->firstDay." +14 days"));
                foreach ($preTuition as $key => $value) {
                    # code...
                    $tag = "#".$className."#hp".$key;
                    $this->transfer($parent->acc_id, $student->acc_id , $value , $date, $tag);
                }
                
    
            }
            // foreach ($lessons as $key => $value) {
                # code...
                // $transaction = new Transactions();
                // $transaction->student_id = $showUp->student_id;
                // $transaction->parent_id = $showUp->parent_id;
                // $transaction->class_id = $showUp->officalClass;
                // $transaction->lesson_id = $value['id'];
                // $transaction->day = date('Y-m-d', strtotime('+2 week'));
                // $transaction->amount = -$value['tuition'];
                // $transaction->balance = $balance - $value['tuition'];
                // $balance -= $value['tuition'];
                // $transaction->user = Auth::user()->name;
                // $transaction->save();

                // $attendance = new Attendances();
                // $attendance->class_std_id = $xl->id;
                // $attendance->lesson_id = $value['id'];
                // $attendance->save();
            // }
        }
        
        //Thêm Transaction
        

        $showUp->save();


    }
}
