<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
    	$students = Students::select('students.id as std_id','firstName','lastName','dob','gender','school','class','students.email as std_email'
    							,'students.phone as std_phone','parents.name','parents.phone as p_phone','parents.email as p_email','parents.work')
    						->join('parents','parents.id','=','students.parent_id')->get();

    	return view ('student.list',compact('students'));	
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
        $parent = Parents::where('work',NULL)->delete();
        $account = Accounts::where('type',1)->orWhere('type',2)->delete();
        $std_cl = Class_std::where('student_id','!=',NULL)->delete();
        $input = fopen("csv/students.csv", "r");
                        $count = 0;
        if($input !== FALSE){
            while(($data = fgetcsv($input, 10000, "|")) !== FALSE){
                // $dob = (empty($data[2])) ? NULL : date('Y-m-d',strtotime($data[2]));
                // $checkS = Students::where('lastName',$data[0])->where('firstName',$data[1])->where('dob',$dob)->get()->toArray();
                // if(empty($checkS)){
                //     $count++;
                //     echo "<pre>";
                //     print_r($data);
                // }


                // //Create student's account 
                $newStudentAcc = new Accounts();
                $newStudentAcc->name = $data[0].' '.$data[1];
                $newStudentAcc->dob = $data[2];
                $newStudentAcc->type = 1;
                $newStudentAcc->cat = 'asset';
                $newStudentAcc->save();

                $newStudent = new Students();
                $newStudent->lastName = $data[0];
                $newStudent->firstName = $data[1];
                $newStudent->dob = (!empty($data[2]))? date('Y-m-d',strtotime($data[2])):null;
                $newStudent->school = $data[4];
                $newStudent->class = $data[5];
                $newStudent->phone = $data[7];
                $newStudent->email = $data[6];
                $newStudent->acc_id = $newStudentAcc->id;
                //Check if parent existed
                $checkParent = Parents::where('phone','LIKE','%'.$data[9].'%')->get()->toArray();
                $checkStudent = Students::where('lastName',$data[0])->where('firstName',$data[1])->where('school',$data[4])->get()->toArray();
                if(empty($checkParent)){
                    $newParent = new Parents();

                    $newParentAcc = new Accounts();
                    $newParentAcc->name = $data[8];
                    $newParentAcc->dob = $data[9];
                    $newParentAcc->type = 2;
                    $newParentAcc->cat = 'asset';
                    $newParentAcc->save();

                    $newParent->name = $data[8];
                    $newParent->phone = $data[9];
                    $newParent->email = $data[10];
                    $newParent->acc_id = $newParentAcc->id;
                    $newParent->save();
                    $newStudent->parent_id = $newParent->id;
                    $newStudent->save();
                }
                else{
                    if(!empty($checkStudent)){
                        echo "<pre>";
                        print_r($data);
                        echo $checkStudent[0]['id'];
                        continue;
                    }
                    else{
                        $newStudent->parent_id = $checkParent[0]['id'];
                        $newStudent->save();
                    }
                }

                //Them vao lop
                $classes = explode(',', $data[13]);
                foreach ($classes as $key => $class) {
                    # code...
                    $findClass = Classes::where('name',$class)->get()->toArray();

                    //da nghi hoc 
                    if(empty($findClass)){
                        $dClass = trim(str_replace('(N)', '', $class));
                        $dropedClass = Classes::where('name',$dClass)->get()->toArray();
                        if(!empty($dropedClass)){
                            $class_std = new Class_std();
                            $class_std->class_id = $dropedClass[0]['id'];
                            $class_std->student_id = $newStudent->id;
                            $class_std->firstDay = date('Y-m-d');
                            $class_std->lastDay = date('Y-m-d');
                            $class_std->note = $data[12];
                            $class_std->save();
                        }
                        
                        else echo $dClass."-".$data[9];
                    }
                    else{
                        $class_std = new Class_std();
                        $class_std->class_id = $findClass[0]['id'];
                        $class_std->student_id = $newStudent->id;
                        $class_std->firstDay = date('Y-m-d');
                        $class_std->note = $data[12];
                        //Nghi han
                        if($data[13] == 'N'){
                            $class_std->lastDay = date('Y-m-d');
                        }
                        $class_std->save();
                    }
                }
            }
            echo $count;
        }    
    }
    function fetch_students(Request $request){
    	$request = $request->toArray();
    	$s = Students::where('lastName','LIKE','%'.$request['query'].'%')->orWhere('firstName','LIKE','%'.$request['query'].'%')->get();
    	$result = [];
    	foreach ($s as $key => $value) {
    		# code...
    		$name = $value->lastName." ".$value->firstName." - ".date('d-m-Y',strtotime($value->dob)) ;
    		$bod = date('d-m-Y',strtotime($value->dob));
    		$arr = ['name'=>$name, 'dob'=>$bod, 'id'=>$value->id,'school'=>$value->school];
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
    		$name = $value->id." | ".$value->name." | ".$value->phone;
    		
    		array_push($result, $name);
    	}
    	return \Response::json($result);
    }
}
