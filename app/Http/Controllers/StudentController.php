<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Teachers;
use App\Parents;
use App\Transaction;
use App\Class_std;
use App\Attendances;
use App\Lessons;
use App\Students;
use App\Classes;
use App\Accounts;
use App\Results;
use App\Report_Debts;
use App\Periods;
use Auth;
use Response;
class StudentController extends Controller
{
    //

    public function new_student($parent_id, $acc_id, $fName, $lName, $dob, $gender, $school, $class, $email, $phone){
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
    function get_list(){
        
        //Các periods còn đang dư nợ
        $debts = Report_Debts::where('total','>',0)->join('periods','period_id','=','periods.id')->select('period_id','periods.name')->groupby('period_id')->get();
        // echo "<pre>";
        // print_r($debts->toArray());
        $classes = Classes::where('id','>','-1')->get()->toArray();
        foreach ($classes as $key => $class) {
            # code...
            $classes[$key]['detail'] = array();
            $class_std = Class_std::where('class_id', $class['id'])->get()->toArray();

            foreach ($class_std as $k => $student) {
                # code...
                $students = Students::where('students.id',$student['student_id'])->select('students.id as std_id','students.acc_id as std_acc','firstName','lastName','dob','gender','school','class','students.email as std_email','students.phone as std_phone','parents.id as parent_id','parents.name as name','parents.phone as p_phone','parents.email as p_email','parents.work as work')->join('parents','parents.id','=','students.parent_id')->get()->toArray();

                $students['result'] = Results::where('cls_std_id', $student['id'])->get()->toArray(); 
                $students['count'] = Class_std::where('student_id',$students[0]['std_id'])->count() ;            

                foreach ($debts as $d => $value) {
                    # code...
                    $students['tuition'][$value->period_id] = 0;
                    $student_debt = Report_Debts::where('period_id',$value->period_id)->where('class_id', $class['id'])->get()->toArray();
                    if(!empty($student_debt)){
                        $transactions = explode(',', $student_debt[0]['debts']);
                        foreach ($transactions as $t) {
                            $transaction  = Transaction::find($t);
                            if(!empty($transaction)){
                                              
                                if($transaction->to == $students[0]['std_acc']){
                                    $students['tuition'][$value->period_id] += $transaction->amount;
                                }
                            }
                            # code...
                        }
                    }
                }
                array_push($classes[$key]['detail'], $students);                
            }         
            
        }
        // echo "<pre>";         
        // print_r($classes[0]['detail']);
        return view('student.list',compact('classes','debts'));
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
    function upload(Request $request){
        if(Input::hasFile('csv')){
            $file = Input::file('csv');
            $file->move(public_path().'/csv/', $file->getClientOriginalName());
            $input = fopen(public_path().'/csv/'.$file->getClientOriginalName(), 'r');
                while(($data = fgetcsv($input,1000,"*")) !== FALSE){
                    echo "<pre>";
                    print_r($data)  ;
                }   
        }

    }
    function csv_to_student(){
        $std = Students::where('gender','Nam')->delete();
        $parent = Parents::where('address','')->delete();
        $account = Accounts::where('type',1)->orWhere('type',2)->delete();
        $std_cl = Class_std::where('student_id','!=',NULL)->delete();
        $input = fopen("public/csv/students.csv", "r");
        $classId = 0;
        if($input !== FALSE){
            while(($data = fgetcsv($input, 10000, "|")) !== FALSE){
                //Xu ly du lieu
                $checkStudent = Students::where('firstName',$data[2])->where('lastName',$data[1])->where('dob', date('Y-m-d',strtotime(str_replace('/', '.', $data[3]))))->get()->toArray();

                $checkClass = Classes::where('name',$data[5])->get()->toArray();
                if(empty($checkClass)){
                    echo $data[5]." ";
                }
                if($data[5] != ""){
                    $classId = $checkClass[0]['id'];
                }
                //Chuẩn hóa số điện thoại
                $data[8] = str_replace(' ', '', $data[8]);
                if(strpos($data[8], '0') !== 0 && $data[8] != '#'){
                    $data[8] = '0'.$data[8];                    
                } 
                //
                $acc_std = 0;
                $acc_par = 0;
                if(!empty($checkStudent)){ //HS đã có trong csdl
                    $studentId = $checkStudent[0]['id'];                    
                    $this->addToClass($studentId, $classId, '01.06.2017', '',0);
                    $acc_std = $checkStudent[0]['acc_id'];
                    $acc_par = Parents::find($checkStudent[0]['parent_id'])->acc_id;
                }
                else{
                    $stdAccId = $this->newAccount($data[1].' '.$data[2], str_replace('/', '.', $data[3]), 1, 0)->id;
                    $checkParent = Parents::where('phone',$data[9])->get()->toArray();
                    $studentId = 0;
                    $parentId = 0;
                    // Phụ huynh đã có trong csdl
                    if(!empty($checkParent)){
                        $parentId = $checkParent[0]['id'];
                        $student = $this->newStudent($parentId, $stdAccId, $data[2], $data[1], date('Y-m-d',strtotime(str_replace('/', '.', $data[3]))), 'Nam', $data[4],'#','#','#');
                        $studentId = $student->id;
                        $acc_std = $student->acc_id;
                        $acc_par = $checkParent[0]['acc_id'];
                    }
                    else{
                        $acc_par = $this->newAccount($data[7], $data[8], 2, 0)->id;
                        $parent = $this->newParent($acc_par, $data[7], $data[8],$data[9],'','');
                        $parentId = $parent->id;
                        $student = $this->newStudent($parentId, $stdAccId, $data[2], $data[1], date('Y-m-d',strtotime(str_replace('/', '.', $data[3]))), 'Nam', $data[4],'#', '#','#');
                        $studentId = $student->id;
                        $acc_std = $student->acc_id;
                    }
                    $class_std = $this->addToClass($studentId, $classId, '01.06.2017', '',0);

                    //Nhập học phí
                    if($data[10] != "" || $data[11]!=""){
                        if($data[10] != ""){
                             $tuition67 = intval(str_replace(',', '', $data[10]));
                             $this->transfer($acc_par, $acc_std, $tuition67, '01.06.2017', '#hs'.$studentId.'#'.$data[5].'#hp06#hp07');
                        }                       
                        $tuition89 = intval(str_replace(',', '', $data[11]));
                        $this->transfer($acc_par, $acc_std, $tuition89, '01.08.2017', '#hs'.$studentId.'#'.$data[5].'#hp08#hp09');
                    }
                    //Nhập điểm
                    if($data[13] != ""){
                        $score = new Results;
                        $score->cls_std_id= $class_std->id;
                        $score->comment = $data[13];
                        $score->period = "6-7";
                        if($data[12] != ""){
                            $score->score = $data[12];
                        }
                        $score->save();
                        echo "Success ";
                    }
                    

                }
           }    
        }    
    }
    function fetch_students(Request $request){
        $request = $request->toArray();
        $s = Students::where('lastName','LIKE','%'.$request['query'].'%')->orWhere('firstName','LIKE','%'.$request['query'].'%')->get();
        
        $result = [];
        foreach ($s as $key => $value) {
            # code...
            $p = Parents::find($value->parent_id);
            $name = $value->lastName." | ".$value->firstName." | ".date('d-m-Y',strtotime($value->dob)) ;
            $bod = date('d-m-Y',strtotime($value->dob));
            $arr = ['name'=>$name, 'dob'=>$bod, 'id'=>$value->id,'school'=>$value->school,'parentName'=>$p->name,'parentPhone'=>$p->phone,'parentEmail'=>$p->email];
            array_push($result, $arr);
        }
        return \Response::json($result);
    }
    function fetch_parents(Request $request){
        $request = $request->toArray();
        $s = Parents::where('phone','LIKE','%'.$request['query'].'%')->get();
        $result = [];
        foreach ($s as $key => $value) {
            # code...
            $name = $value->id." | ".$value->name." | ".$value->phone. " | ".$value->email;
            
            array_push($result, $name);
        }
        return \Response::json($result);
    }

    function detail_student($id){
        //Các lớp đang học:
        $student = Students::find($id);
        $active_class = Class_std::select('class_std.id', 'class_std.student_id', 'class_std.class_id','firstDay','lastDay','note','classes.name','students.firstName','students.lastName','students.dob','students.parent_id','students.acc_id')->where('student_id', $id)->where('lastday',NULL)->join('classes','class_id','=','classes.id')->join('students','student_id','=','students.id')->get();
        foreach ($active_class as $key => $value) {
            # code...
            $parent = Parents::find($value->parent_id);
            // Số tiền còn lại trong tk Phụ huynh, học sinh
            $transaction_in = Transaction::where('to',$parent->acc_id)->where('description','LIKE','%hs'.$value->acc_id.'%')->where('description','LIKE','%'.$value->name.'%')->where('description','LIKE','%#hp%')->sum('amount');
            $transaction_out = Transaction::where('from',$value->acc_id)->where('description','LIKE','%hs'.$value->acc_id.'%')->where('description','LIKE','%'.$value->name.'%')->sum('amount');
            $active_class[$key]['balance'] = $transaction_out - $transaction_in;
        }
        // echo "<pre>";
        // print_r($active_class->toArray());
        return view('student.detail',compact('active_class','student'));
    }

    //Thôi học
    function drop_out(Request $request){
        $this->validate($request, [
            'confirmed'=>'required',
            'note' =>' required'
            ]);
        $class_std = Class_std::find($request->class_std_id);
        $class_std->lastDay = date('Y-m-d h:i:m', strtotime($request->lastDay));
        $class_std->note = $request->note;
        $class_std->save();
        return redirect(route('detailStudent',$class_std->student_id));
    }

    function switch_class(Request $request){
        $this->validate($request, [
            'confirmed'=>'required',
            'note' =>' required',
            'to'=>'required'
            ]);
        $class_std = Class_std::find($request->class_std_id);
        $class_std->class_id = $request->to;
        $class_std->note = $request->note;
        $class_std->save();
        return redirect(route('detailStudent',$class_std->student_id));
    }

    function get_form_dropout($id){
        $data = Class_std::find($id);
        $student = Students::find($data->student_id);
        $class = Classes::find($data->class_id);
        return view('student.form_dropout',compact('id','data','student','class'));

    }
    function get_form_switch($id){
        $allClasses = Classes::all();
        $data = Class_std::find($id);
        $class = Classes::find($data->class_id);
        $student = Students::find($data->student_id);
        return view('student.form_switch', compact('id','data','student','class','allClasses'));
    }
}
