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
use App\Employees;
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
            $tag = '#hs'.$value['student_acc'].'#'.$class['name'].''.$output['tag'];
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
        // $this->validate($request,[
        //     'status1' => 'required',
        //     ]);
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
            $description = '#status$'.$request['status'.$student['student_id']].
                            '#note$'.$request['note'.$student['student_id']].
                            '#mark$'.$request['result'.$student['student_id']].'#gv$'.$request['teacher'];
            $description = $description.'#hb_status$'.'#hb_date$'.'#hb_trogiang$'.'#hb_content$';
            $date = date('Y-m-d', strtotime($request['lesson']));
            $this->transfer($studentAccount, $classAccount, $amount,$date, $description );
            }

    }
    function tag_to_content($str){
        $explode = explode('#', $str);
        
        $content = array();
        foreach ($explode as $key => $value) {
            # code...
            $temp = explode('$',$value);
            if(!empty($temp[1]) || !empty($temp[0])){
                $content[$temp[0]]=$temp[1];
            }
        }
        // echo "<pre>"    ;
        // print_r($content);
        return $content;

    }
    function search_student($classId){
        $class = Classes::find($classId)->toArray();
        //Hoc sinh dang hoc
        $students = Class_std::select('class_std.id as class_std_id','students.id as student_id','students.acc_id as student_acc','students.firstName','students.lastName','students.dob','parents.name','parents.phone','parents.email','parents.acc_id as parent_acc')
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
        $allTrogiang = Teachers::where('type','trợ giảng')->get()->toArray();
        $trogiang = Teachers::where('id',$result['description']['hb_trogiang'])->get()->toArray();
        $trogiang = (empty($trogiang))? '':$trogiang[0]['name'];
        //         echo "<pre>";
        // print_r($result);
        return view('class.editModal',compact('result','student','teacher','allTrogiang','trogiang','allTeacher'));
    }
    function save_lesson(Request $request, $transactionId){
        $request = $request->toArray();
        $transaction = Transaction::find($transactionId);
        $description = '#status$'.$request['optionsRadios'].
                        '#note$'.$request['note'].
                        '#mark$'.$request['mark'].'#gv$'.$request['gv'];
        //Không phép và Có mặt (Không học bù)
        if(empty($request['hb_status'])){
            $description = $description.'#hb_status$'.'#hb_date$'.'#hb_trogiang$'.'#hb_content$';
            $transaction->description = $description;
            $transaction->save();
        }
        else{
            $description = $description.'#hb_status$'.$request['hb_status'].'#hb_date$'.$request['hb_date'].
                                        '#hb_trogiang$'.$request['hb_trogiang'].'#hb_content$'.$request['hb_content'];
            $transaction->description = $description;
            $transaction->save();
        }
        
        return \Response::json($request);
    }

    function get_hocbu(){
        $allHocBu = Transaction::where('description','LIKE','%#status$p%')->orderBy('date','ASC')->get()->toArray();
        $result = array();
        foreach ($allHocBu as $k => $v) {
            //THONG TIN GIAO VIEN
            $allTeachers = Teachers::all()->toArray();
            //THONG TIN HOC SINH _ PHU HUYNH
            $student = Students::where('acc_id', $v['from'])->get()->toArray();
            $studentInfo = [$student[0]['firstName'], $student[0]['lastName'], $student[0]['dob']];
            $parent = Parents::where('id',$student[0]['id'])->get()->toArray();
            array_push($studentInfo, $parent[0]['phone']);
            array_push($studentInfo, $v['from']);

            //THONG TIN LOP HOC
            $class = Classes::where('acc_id',$v['to'])->get()->toArray();
            $classInfo = [$class[0]['name']];
            array_push($classInfo, $v['to']);


            $v['to'] = $classInfo;
            $v['from'] = $studentInfo;
            # code...
            $description = $this->tag_to_content($v['description']);

            $tg = Teachers::where('id',$description['hb_trogiang'])->get()->toArray();
            $tgInfo = (empty($tg))?['']:[$tg[0]['name']];
            array_push($tgInfo, $description['hb_trogiang']);
            $description['hb_trogiang'] = $tgInfo;

            // echo "<pre>";
            // print_r($description);
            // Chuẩn hóa ngày
            $description['hb_date'] = str_replace('/', '-', str_replace(' - ',  ' ', $description['hb_date']));

            if ($description['hb_status'] == 'Đã xếp lịch' &&
            strpos($v['description'], 'Đã học bù') == FALSE &&
            date('Y-m-d',strtotime($description['hb_date'])) >= date('Y-m-d',strtotime('tomorrow'))) {
                // echo date('Y-m-d',strtotime($description['hb_date']))."<br>";
                // echo date('Y-m-d',strtotime('tomorrow'));
                # code...
                $v['description'] = $description;
                $v['label'] = 'daxeplich';
                array_unshift($result, $v);
                continue;
            }
            if($description['hb_status'] == 'Chưa xếp lịch' ||
                $description['hb_status'] == ''){
                $v['description'] = $description;
                $v['label'] = 'chuaXepLich';
                array_unshift($result, $v);
                continue;
            }
            if($description['hb_status'] =='Đã xếp lịch' &&
            strpos($v['description'], 'Đã học bù') == FALSE &&
            date('Y-m-d',strtotime($description['hb_date'])) === date('Y-m-d')){
                $v['description'] = $description;
                $v['label'] = 'nhaclichhoc';
                array_unshift($result, $v);
                continue;
            }
            if($description['hb_status'] =='Đã xếp lịch' &&
            strpos($v['description'], 'Đã học bù') == FALSE &&
            date('Y-m-d',strtotime($description['hb_date'])) < date('Y-m-d')){
                $v['description'] = $description;
                $v['label'] = 'qualichhoc';
                array_unshift($result, $v);
                continue;
            }
            if(strpos($v['description'], 'Đã học bù') !== FALSE){
                $v['description'] = $description;
                $v['label'] = 'daHocBu';
                array_push($result, $v);
                continue;
            }
            if($description['hb_status'] == 'Từ chối'){
                $v['description'] = $description;
                $v['label'] = 'tuChoi';
                array_push($result, $v);
                continue;
            }
        }
        // echo "<pre>";
        // print_r($result);
        return view('class.tableHocBu',compact('result','allTeachers'));
    }
    function edit_hocbu(Request $request){
        echo "<pre>";
                print_r($request->toArray());
        $transaction = Transaction::find($request->pk);
        $description = $this->tag_to_content($transaction->description);
        $oldValue = '#'.$request->name.'$'.$description[$request->name];
        if($request->name == "hb_date"){
            $formatted_date = date('d-m-Y h:i',strtotime($request->value));
            $newValue = '#hb_date$'.str_replace(' ', ' - ', $formatted_date);
        }
        else{
            
            $newValue = '#'.$request->name.'$'.$request->value;
            
        }        
        $transaction->description = str_replace($oldValue, $newValue, $transaction->description);
        $transaction->save();
    }
    function csv_to_class(){
        $input = fopen("csv/class.csv", "r");
        if($input !== FALSE){       
            while(($data = fgetcsv($input,1000,"|")) !== FALSE){
                $class = Classes::where('name','=',$data[0])->first();
                $class->students = $data[6];
                echo "<pre>";
                print_r($class->toArray());
                $class->save();

            }
        }    
        else
            echo "failed";
    }
    function temp(){
        $teacher = Teachers::all();
        foreach ($teacher as $key => $value) {
            # code...
            $t = Teachers::find($value->id);
            $t->type = 'Giáo viên';
            $t->save();
        }
    }
    function csv_to_teacher(){
        $input = fopen("csv/teacher.csv", "r");
        if($input !== FALSE){
            while(($data = fgetcsv($input, 10000, "|")) !== FALSE){
                echo "<pre>";
                print_r($data);
                echo date('Y-m-d',strtotime($data[2]));
                $teacher = new Teachers();
                $teacher->name = $data[0]." ".$data[1];
                $teacher->gender = 'Nữ';
                $teacher->dob = date('Y-m-d',strtotime($data[2]));
                $teacher->type = 'Trợ giảng';
                $teacher->quequan = $data[3];
                $teacher->hokhau = $data[4];
                $teacher->sdt = $data[5];
                $teacher->email = $data[6];
                $teacher->diachi = $data[7];
                $teacher->honnhan = $data[8];
                $teacher->cmt_id = $data[10];
                $teacher->cmt_ngaycap = $data[11];
                $teacher->cmt_noicap = $data[12];
                $teacher->dt_hocvi = $data[16];
                $teacher->dt_loaitotnghiep = $data[17];
                $teacher->nh_chutaikhoan = $data[18];
                $teacher->nh_sothe = $data[19];
                $teacher->nh_stk = $data[20];
                $teacher->nh_ten = $data[21];
                $teacher->nh_chinhanh = $data[22];
                
                $teacher->hs_giaykhaisinh = ($data[23] == 'có') ? 1:0;
                $teacher->hs_cmt = ($data[24] == 'có') ? 1:0;
                $teacher->hs_khamsuckhoe = ($data[25] == 'có') ? 1:0;
                $teacher->hs_thpt = ($data[26] == 'có') ? 1:0;
                $teacher->hs_daihoc = ($data[27] == 'có') ? 1:0;
                $teacher->hs_bangdiem = ($data[28] == 'có') ? 1:0;
                $teacher->hs_khac = $data[29];
                $teacher->hs_hokhau = ($data[30] == 'có') ? 1:0;
                $teacher->hs_hopdongld = ($data[31] == 'có') ? 1:0;
                $teacher->hs_4anh = ($data[32] == 'có') ? 1:0;
                $teacher->hs_soyeulylich = ($data[33] == 'có') ? 1:0;
                $teacher->hs_donxinviec = ($data[34] == 'có') ? 1:0;
                $teacher->hs_bantuthuat = ($data[35] == 'có') ? 1:0;
                $teacher->hs_solaodong = ($data[36] == 'có') ? 1:0;
                $teacher->hs_camket = ($data[37] == 'có') ? 1:0;

                $account = new Accounts();
                $account->name = $teacher->name;
                $account->dob = $teacher->dob;
                $account->type = 4;
                $account->balance = 0;
                $account->cat = 'outgoing';
                $account->save();

                $teacher->acc_id = $account->id;
                $teacher->save();

            }
        }
    }
}


