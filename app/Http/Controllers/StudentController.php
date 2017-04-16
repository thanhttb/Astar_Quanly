<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;
use App\Parents;
use App\Transactions;
use App\Class_std;
use App\Attendances;
use App\Lessons;
use App\Students;
use App\Classes;
use App\Accounts;
use Auth;
class StudentController extends Controller
{
    //
    function get_list(){
    	$students = Students::select('students.id as std_id','firstName','lastName','dob','gender','school','class','students.email as std_email'
    							,'students.phone as std_phone','parents.name','parents.phone as p_phone','parents.email as p_email','parents.work')
    						->join('parents','parents.id','=','students.parent_id')->get();

    	return view ('student.list',compact('students'));	
    }
    function detail_student($id){
    	//Các lớp đang học
    	$classLearning = Class_std::select('class_std.id as cls_std_id','class_id','student_id','firstDay','lastDay','note','discount','classes.name')
    								->leftjoin('classes','classes.id','=','class_std.class_id')
    								->where('student_id',$id)->get()->toArray();
    	//Truong hop chua hoc lop nao

    	if(empty($classLearning)) {

    		return view('enroll/list');	    		
    	}
    	$thisMonth = 0;
    	foreach ($classLearning as $key => $value) {
    		//echo $value->class_id;
    		//Tat ca diem danh cua hoc sinh 1 va lop value
    		$atd = Attendances::where('class_std_id',$value['cls_std_id'])->join('lessons','lessons.id','=','attendances.lesson_id')
								->join('teachers','teachers.id','=','lessons.teacher_id')
							  	->select('attendances.id as atd_id','attendances.status','attendances.note','lessons.id as l_id','lessons.teacher_id','lessons.start_time','lessons.end_time','lessons.tuition','teachers.name')
							  	->orderBy('start_time','DESC')->get()->toArray();

    		$classLearning[$key]['atd']= $atd;

    		//Tim tong hoc phi cua moi lop
    		$thisMonth = date('m',strtotime($atd[0]['start_time']));
	        $monthInPeriod = ($thisMonth %2 ==0)? $thisMonth +1 : $thisMonth-1;
	        $thisYear = date('Y');
	       	$period = min($thisMonth, $monthInPeriod). " - " .max($thisMonth, $monthInPeriod);
		
			$tuitionBeforeDiscount = 0;	
			$lesson_count=0;    		
			//DISCOUNT									
    		
    		
    		foreach ($atd as $k => $v) {
    			# code...
    			$month = date('m',strtotime($v['start_time']));
    			if($month == $thisMonth || $month == $monthInPeriod){
    				$lesson_count++;
    				$tuitionBeforeDiscount+=$v['tuition'];
    			}
    		}
    		$classLearning[$key]['lessonCount'] = $lesson_count;
    		$classLearning[$key]['netTuition'] = $tuitionBeforeDiscount;
    		$lastBalance = Transactions::where('student_id',$id)->where('class_id', $classLearning[$key]['class_id'])
    									->whereYear('day',$thisYear)->whereMonth('day','<',min($thisMonth, $monthInPeriod))->where('rel_id', NULL)
    									->sum('amount');
    		$classLearning[$key]['lastBalance'] = $lastBalance;

			$tuitionAfterDiscount = Transactions::where('student_id',$id)->where('class_id',$classLearning[$key]['class_id'])
											    ->whereMonth('day','>=', min($thisMonth, $monthInPeriod))
					                            ->whereMonth('day','<=',max($thisMonth, $monthInPeriod))
					                            ->whereYear('day',$thisYear)
												->whereIn('type',['-1','-2','2'])->sum('amount');
			$classLearning[$key]['tuitionAfterDiscount'] = $tuitionAfterDiscount + $lastBalance;
		    if($key == 0){
                $classLearning[$key]['otherFee'] = Transactions::where('student_id',$id)
                                                            ->whereMonth('day','>=', min($thisMonth, $monthInPeriod))
                                                            ->whereMonth('day','<=',max($thisMonth, $monthInPeriod))
                                                            ->whereYear('day',$thisYear)
                                                            ->whereIn('type',['-2','2'])->sum('amount');
            }
            else $classLearning[$key]['otherFee'] = 0;
		    $classLearning[$key]['recieved'] = Transactions::where('student_id',$id)
														    ->whereMonth('day','>=', min($thisMonth, $monthInPeriod))
								                            ->whereMonth('day','<=',max($thisMonth, $monthInPeriod))
								                            ->whereYear('day',$thisYear)
								                            ->where('type','1')->sum('amount');

			$classLearning[$key]['balance'] = Transactions::where('student_id',$id)
								    						->orderBy('id','DESC')->first()->balance;

    	}

    	// echo "<pre>";
    	// print_r($classLearning);
		//GIAO DỊCH TỔNG
    	$stdTransaction = Transactions::where('student_id',$id)->get()->toArray();
    	foreach ($stdTransaction as $key => $value) {
    		# code...

    		$studentInfo = Students::find($id)->toArray();
    		$parentInfo = Parents::find($studentInfo['parent_id'])->toArray();
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

    	$student = Students::find($id);
    	$parent  = Parents::find($student->parent_id);

    	//Điểm danh tổng
    	//Tìm các lớp hs đang học

    	return view('transactions.listByStudent', compact('stdTransaction','id','student','parent','classLearning','period'));
    }
    
    function addAccount($studentId, $parentId){
        $student = Students::find($studentId);
        $parent = Parents::find($parentId);
        //Tạo Account cho student và parent     
        $studAccount = new Accounts();
        $parentAccount = new Accounts();
        $studAccount->name = $student->lastName." ".$student->firstName;
        $studAccount->dob = $student->dob;
        $studAccount->type = 1;
        $parentAccount->name = $parent->name;
        $parentAccount->dob = $student->dob;
        $parentAccount->type = 2;
        $studAccount->save();
        $parentAccount->save();
        //Cập nhật account id vào student và parent
        $parent->acc_id = $parentAccount->id;
        $student->acc_id = $studAccount->id;
        $parent->save();
        $student->save();
    }
}
