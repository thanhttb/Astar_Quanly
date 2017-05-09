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
        $teacher->receiveTime = date('Y-m-d'); 
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
    public function saveNote(Request $request){
        $note = Enrolls::findorfail($request->pk);
        if($note->value == null){
            $note->note = $request->value;
        }
        else $note->note = $request->value;
        $note->save();
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
        $showUp->save();
        }
    }
    //Lưu thông tin ghi danh mới
    public function newEnroll($student_id, $parent_id, $subject, $class, $app, $note){
        $enroll = new Enrolls();
        $enroll->student_id = $student_id;
        $enroll->parent_id = $parent_id;
        $enroll->receiver = Auth::user()->name;
        $enroll->subject = $subject;
        $enroll->class = $class;
        $enroll->appointment = empty($app)? NULL: date('Y-m-d h:i:m',strtotime($app));
        $enroll->note = $note;
        $enroll->save();
        return $enroll;
    }
    function post_enroll(Request $request){
        $this->validate($request, [
            'firstName'=>'required',
            'phone' => 'required',

            ]);
        echo "<pre>";
        print_r($request->toArray());

        //Check student exist in database
        $id = explode(' | ', $request->firstName)[0];
        if(is_numeric($id)){ //Student existed
            $parent_id = Students::find($id)->parent_id;
            foreach ($request->nguyenvong as $key => $value) {
                # code...
                $this->newEnroll($id, $parent_id, $value['subject'], $value['class'], $value['date'], $value['note']);
            }
            return redirect()->route('ktdv');
        }
        // CHECK IF PAREENT EXISTED IN DATABASE
        // Create new Student + ACCOUNT + ENROLL
        $parent_id = explode(' | ', $request->phone)[0];
        if(is_numeric($parent_id) && count(explode(' | ', $request->phone))>1){
            $newAccount = $this->newAccount($request->lastName. " ".$request->firstName,$request->dob, 1, 0);
            $newStudent = $this->newStudent($parent_id, $newAccount->id, $request->firstName, $request->lastName, $request->dob, $request->gender, $request->school,NULL,NULL,NULL);
            foreach ($request->nguyenvong as $key => $value) {
                # code...
                $this->newEnroll($newStudent->id, $parent_id, $value['subject'], $value['class'],$value['date'], $value['note']);
            }
            return redirect()->url('ktdv');
        }
        else{
            $newParentAccount = $this->newAccount($request->name, $request->phone, 2, 0);
            $newStudentAccount = $this->newAccount($request->lastName." ".$request->firstName, $request->dob, 1,0);
            $newParent = $this->newParent($newParentAccount->id, $request->name, $request->phone, $request->email,NULL,NULL);
            $newStudent = $this->newStudent($newParent->id, $newStudentAccount->id, $request->firstName, $request->lastName, $request->dob, $request->gender, $request->school, NULL, NULL,NULL);
            foreach ($request->nguyenvong as $key => $value) {
                # code...
                $this->newEnroll($newStudent->id, $newParent->id, $value['subject'], $value['class'],$value['date'], $value['note']);
            }
            return redirect()->url('ktdv');
        }

    }

    function getDashboard(){
        $thieuhoso = Students::where('school',NULL)->orWhere('dob',NULL)->count();
        $thieuhoso+= Parents::where('email',NULL)->count();
        $chuahenlich = Enrolls::where('appointment',NULL)->count();
        $chuathongbao = Enrolls::where('appointment','>',date('Y-m-d 00:00:00'))->where('appointment','<',date('Y-m-d 23:59:59'))->where('testInform',0)->count();
        $henlailich = Enrolls::where('appointment','<',date('Y-m-d 00:00:00'))->where('showUp',0)->where('appointment','>',date('Y-m-d h:i:m',strtotime('-2 months')))->count();
        $chuaguibai = Enrolls::where('teacher','0')->where('showUp',1)->count();
        $chuacoketqua = Enrolls::where('teacher','!=','0')->where('result',NULL)->count();
        $chuathongbaoketqua = Enrolls::where('result','!=',NULL)->where('resultInform',0)->count();
        $chuathongbaongayhoc = Enrolls::where('firstDay','!=',NULL)->where('inform',0)->count();
        $hochomnay = Enrolls::where('firstDay','>',date('Y-m-d 00:00:00'))->where('firstDay','<',date('Y-m-d 23:59:59'))->where('inform',0)->count();
        $cannhacthem = Enrolls::where('decision','Cân nhắc thêm')->count();
        $chomolop = Enrolls::where('decision','Chờ mở lớp')->count();
        return view('enroll.dashboard', compact('thieuhoso','chuahenlich','henlailich','chuathongbao','chuaguibai','chuacoketqua','chuathongbaoketqua'
            ,'chuathongbaongayhoc','hochomnay','cannhacthem','chomolop'));
    }
}
