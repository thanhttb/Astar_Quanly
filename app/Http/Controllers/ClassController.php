<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;
use App\Transactions;
use App\Class_std;
use App\Lessons;
use App\Students;
use App\Classes;
use App\Parents;
use App\Discounts;
use App\Transaction;
use App\Accounts;

use Auth;
class ClassController extends Controller
{
    //
    function addNew(){
    	return view('class.addNew');
    }
    function listClass(){
    	$classes = Classes::all()->toArray();
    	foreach ($classes as $key => $value) {
    		# code...
    		$stdCount = Class_std::where('class_id',$value['id'])->count();
    		$thisClass = Classes::find($value['id']);
    		$thisClass->students = $stdCount;
    		$thisClass->save();
    	}
    	return view('class.list');
    }
    function classDetail($id){
        $class = Classes::find($id)->toArray();
        //Hoc sinh dang hoc
    	$students = Class_std::select('class_std.id as class_std_id','students.id as student_id','students.acc_id as student_acc','students.firstName','students.lastName','students.dob','parents.name','parents.phone','parents.acc_id as parent_acc')
                                ->join('students','students.id','=','class_std.student_id')
                                ->where('class_id', $id)->where('lastDay', null)
                                ->join('parents','parents.id','=','students.parent_id')
                                ->get()->toArray();
        //Toàn bộ học sinh (đang học và đã nghỉ)
        $studentsFull = Class_std::select('class_std.id as cs_id','firstDay','lastDay','note','firstName','lastName','dob','gender','class','school','students.email as std_email','students.phone as std_phone','name','parents.email as p_email','parents.phone as p_phone')
                                    ->where('class_id',$id)
                                    ->join('students','students.id','=','class_std.student_id')
                                    ->join('parents','parents.id','=','students.parent_id')
                                    ->get()->toArray(); 
        foreach ($students as $key => $value) {
            $discount = Discounts::where('from',$value['student_acc'])->where('to',$class['acc_id'])->where('type','discount')->get()->toArray();
            $students[$key]['discount'] = (empty($discount)) ? 0 : $discount[0]['discount'];

        }
        $teachers = Teachers::all()->toArray();

    	return view('class.detail',compact('class','students','studentsFull','id','teachers'));
    }
    function tb_hoc_phi($id, Request $request){
        $this->validate($request, [
            'tag'=>'required']);
        $class = Classes::find($id)->toArray();
        //Hoc sinh dang hoc
        $students = Class_std::select('class_std.id as class_std_id','students.id as student_id','students.acc_id as student_acc','students.firstName','students.lastName','students.dob','parents.name','parents.phone','parents.acc_id as parent_acc')
                                ->join('students','students.id','=','class_std.student_id')
                                ->where('class_id', $id)->where('lastDay', null)
                                ->join('parents','parents.id','=','students.parent_id')
                                ->get()->toArray();
        $output = $request->toArray();
        foreach ($students as $key => $value) {
            # code...
            $total = $output['total'.$value['student_id']];
            $tag = '#'.$class['name'].''.$output['tag'];
            if(!is_nan($total) && $total != 0){
                $this->transfer($value['parent_acc'], $value['student_acc'], $total, date('Y-m-d'), $tag);
            }
        }
        echo "<pre>";
        print_r($request->toArray());
    }
    function save_atd(Request $request){
        $atd = Attendances::find($request->pk);
        $atd->status = $request->value;
        $atd->save();
    }
    function addLesson($id){
    	$teachers = Teachers::all()->toArray();

    	return view('class.addLesson',compact('teachers','id'));
    }
    //Tạo ngày học, Chuyển khoản PH>>HS
    function postLesson(Request $request, $id){
         
    	foreach ($request->group as $key => $value) {
            $month = 0 ;// cho phan Tag       
            $lessonCount = 0;
            $class = Classes::find($id);
            $tag = '#'.$class->name.' ';
            echo $tag;
            $dueDate = '';
    		# code...
            // Số lần thêm ngày học +7 ngày
    		for($i=0 ; $i < $value['number']; $i++){
                //Tao ngay hoc
	    		$lesson = new Lessons();
	    		$lesson->class_id = $id;
	    		$lesson->teacher_id = $value['giaovien'];
	    		$ngayhoc = str_replace('-','',$value['ngayhoc']);
	    		$lesson->start_time = date('Y-m-d h:i:s',strtotime($ngayhoc."+".$i." week"));
	    		$lesson->end_time = date('Y-m-d h:i:s', strtotime($lesson->start_time. "+". $value['thoiluong']. "minutes"));
	    		$lesson->tuition = $value['tuition'];
	    		$lesson->save();
                echo date('m',strtotime($ngayhoc."+".$i." week"))." ";
                if(date('m',strtotime($ngayhoc."+".$i." week")) != $month){
                    $month = date('m',strtotime($ngayhoc."+".$i." week"));
                    $tag = $tag.' #hp'.$month.'';
                }
                $lessonCount++;
                $dueDate = date('Y/m/d',strtotime(str_replace('-','',$value['dueDate'])));
    		}  
            $studentInClass = Class_std::where('class_id',$id)->where('lastDay',null)->get();
                //Chuyen tien tu parent>>student = sobuoi * tuition *discount  
                //print_r($studentInClass);  
                foreach ($studentInClass as $k => $v) {
                    # code...
                    $student = Students::find($v->student_id);
                    $parAcc = Parents::find($student->parent_id)->acc_id;
                    $studAcc = $student->acc_id;
                    $preTuition = $lessonCount * $class->tuition;
                    $this->transfer($parAcc,$studAcc,$preTuition,$dueDate,$tag);
                }           
    	}
        echo "<br>";
        echo $tag;  echo "<br>";
        echo $lessonCount;
    	
        return redirect()->route('classDetail',$id);
    }
    function attendance(){
        $classes = Classes::all();
        $teachers = Teachers::all();
        return view('class.diemdanh',compact('classes','teachers'));
    }
    function post_attendance(Request $request){
        // echo "<pre>";
        // print_r($request->toArray());
        $this->validate($request,[
            'status1' => 'required',
            ]);
        $classId = $request->class;
        $class = Classes::find($classId)->toArray();
        //Hoc sinh dang hoc
        $students = Class_std::select('class_std.id as class_std_id','students.id as student_id','students.acc_id as student_acc','students.firstName','students.lastName','students.dob','parents.name','parents.phone','parents.acc_id as parent_acc')
                                ->join('students','students.id','=','class_std.student_id')
                                ->where('class_id', $classId)->where('lastDay', null)
                                ->join('parents','parents.id','=','students.parent_id')
                                ->get()->toArray();
        $request = $request->toArray();
        foreach ($students as $key => $student) {
            # code...
            $studentAccount = $student['student_acc'];
            $classAccount = $class['acc_id'];
            $amount = $class['tuition'];
            $description = '#status:'.$request['status'.$student['student_id']].
                            '#note:'.$request['note'.$student['student_id']].
                            '#mark:'.$request['result'.$student['student_id']].'#gv:'.$request['teacher'];
            $date = date('Y-m-d', strtotime($request['lesson']));
            $this->transfer($studentAccount, $classAccount, $amount,$date, $description );
            }

    }
    function tag_to_content($str){
        $explode = explode('#', $str);
        
        $content = array();
        foreach ($explode as $key => $value) {
            # code...
            $temp = explode(':',$value);
            if(!empty($temp[1]) || !empty($temp[0])){
                $content[$temp[0]]=$temp[1];
            }
        }
        return $content;

    }
    function search_student($classId){
        $class = Classes::find($classId)->toArray();
        //Hoc sinh dang hoc
        $students = Class_std::select('class_std.id as class_std_id','students.id as student_id','students.acc_id as student_acc','students.firstName','students.lastName','students.dob','parents.name','parents.phone','parents.acc_id as parent_acc')
                                ->join('students','students.id','=','class_std.student_id')
                                ->where('class_id', $classId)->where('lastDay', null)
                                ->join('parents','parents.id','=','students.parent_id')
                                ->get()->toArray();
        $thisMonth = date('m');
        $previousMonth = $thisMonth - 1;
        $allTransaction = Transaction::where('to',$class['acc_id'])->whereMonth('date','<=',$thisMonth)->whereMonth('date','>=',$previousMonth)
                                        ->orderBy('date')->get()->toArray();
        $allLesson = [];
        foreach ($allTransaction as $key => $value) {
            if(!in_array($value['date'], $allLesson)){
                array_push($allLesson, $value['date']);
            }
        }                                    
        foreach ($students as $key => $student) {
            # code...
            $transaction = Transaction::where('from',$student['student_acc'])->where('to',$class['acc_id'])
                                        ->whereMonth('date','<=',$thisMonth)->whereMonth('date','>=',$previousMonth)
                                        ->orderBy('date')->get()->toArray();
            

            foreach ($transaction as $k => $v) {
                # code...
                $transaction[$k]['description'] = $this->tag_to_content($v['description']);
            }
            $students[$key]['attendance'] = $transaction;

        }
        $teachers = Teachers::all();
        // echo "<pre>";
        // print_r($students);
         return view('class.danhsachHS',compact('students','teachers','allLesson'));
    }

    function edit_lesson($transactionId){
        $t = Transaction::find($transactionId);        
        $result = $t->toArray();
        $result['description'] = $this->tag_to_content($t->description);

        $student = Students::where('acc_id',$result['from'])->get()->toArray();
        $student = $student[0];
        $teacher = Teachers::find($result['description']['gv'])->toArray();
        $teacher = $teacher;
        $allTeacher = Teachers::all()->toArray();
        $trogiang = Teachers::where('type','trợ giảng')->get()->toArray();
        //         echo "<pre>";
        // print_r($result);
        return view('class.editModal',compact('result','student','teacher','trogiang','allTeacher'));
    }
    function save_lesson(Request $request, $transactionId){
        echo "<pre>";
        print_r($request->toArray());
        return \Response::json($request);
    }
}
