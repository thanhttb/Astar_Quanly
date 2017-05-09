
<?php
Use App\Classes;
use App\Accounts;
use Illuminate\Http\Request;
use App\Http\Controllers\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){
	return view('enroll.ktdv');
});
Route::get('/general',function(){
	return view('layouts/general');
});
Route::get('/enroll',function(){
	return view('enroll/addNew');
});
Route::get('/ktdv',function(){
	return view('enroll/ktdv');
})->name('ktdv');
Route::get('/listEnroll',function(){
	return view('enroll/list');
});
Route::post('/postEnroll',['as'=>'postEnroll','uses'=>'EnrollController@post_enroll']);
Route::get('/result',['uses' => 'EnrollController@getResult']);
Route::get('/ngaydautiendihocmedatemdentruongemvuadivuakhoc',['uses' => 'EnrollController@getFirstDay']);
Route::post('/editDateTime',['as' => 'editDateTime', 'uses' => 'EnrollController@saveDate']);
Route::post('/editTestInform',['as' => 'editTestInform', 'uses' => 'EnrollController@saveTestInform']);
Route::post('/editShowUp',['as' => 'editShowUp', 'uses' => 'EnrollController@saveShowUp']);
Route::post('/saveTeacher',['as' => 'saveTeacher', 'uses' => 'EnrollController@saveTeacher']);
Route::get('/getTeacher',['as' => 'getTeacher', 'uses' => 'TeacherController@getTeachers']);
Route::get('/getAllTeacher',['as'=>'getAllTeacher', 'uses'=>'TeacherController@get_all']);
Route::post('/saveResult',['as' => 'saveResult', 'uses' => 'EnrollController@saveResult']);
Route::post('/saveNote',['as' => 'saveNote', 'uses' => 'EnrollController@saveNote']);

Route::post('/editResultInform',['as' => 'editResultInform', 'uses' => 'EnrollController@editResultInform']);
Route::post('/editDecision',['as' => 'editDecision', 'uses' => 'EnrollController@editDecision']);
Route::post('/editClass',['as' => 'editClass', 'uses' => 'EnrollController@editClass']);
Route::post('/editFirstDay',['as'=>'editFirstDay','uses' => 'EnrollController@editFirstDay']);
Route::post('/editInform',['as' => 'editInform', 'uses' => 'EnrollController@saveInform']);
Route::post('/editFirstDayShowUp',['as' => 'editFirstDayShowUp', 'uses' => 'EnrollController@editFirstDayShowUp']);


Route::get('profile',['as'=>'profile','uses'=>'fileController@profile']);
Route::post('avatar_store', 'UserController@storeAvatar');
Route::post('profile_store','UserController@storeProfile');

Route::get('addNewClass',['as'=>'addNewClass', 'uses'=>'ClassController@addNew']);


Route::get('/grid', function () {
    return view('grid');
});

Route::match(['get', 'post'], '/grid_data', "GridController@data");

Route::get('/scheduler', function () {
    return view('scheduler');
});

Route::match(['get', 'post'], '/scheduler_data', "SchedulerController@data");

Route::get('/gantt', function () {
    return view('gantt');
});

Route::match(['get', 'post'], '/gantt_data', "GanttController@data");

Route::get('/listClass',['as'=>'listClass','uses'=>'ClassController@listClass']);
Route::get('/addLesson/{id}',['as'=>'addLesson','uses'=>'ClassController@addLesson']);
Route::post('/postLesson/{id}',['as'=>'postLesson','uses'=>'ClassController@postLesson']);
Route::get('/classDetail/{id}',['as'=>'classDetail','uses'=>'ClassController@classDetail']);
Route::post('/saveAtd',['as'=>'saveAtd','uses'=>'ClassController@save_atd']);

Route::get('/transaction',['as'=>'transaction', 'uses'=>'TransactionController@getList']);
Route::post('/addTransaction/{id}',['as'=>'addTransaction','uses'=>'TransactionController@addTransaction']);

Route::get('/listStudent',['as'=>'listStudent','uses'=>'StudentController@get_list']);
Route::get('/detailStudent/{id}',['as'=>'detailStudent','uses'=>'StudentController@detail_student']);
Route::get('/transaction/{id}',['as'=>'transactionStudent','uses'=>'TransactionController@get_transaction_student']);
Route::get('/createInvoice',['as'=>'createInvoice','uses'=>'TransactionController@create_invoice']);

Route::get('/listTeacher',['as'=>'listTeacher','uses'=>'TeacherController@get_teachers']);
Route::get('/listTutor',['as'=>'listTutor','uses'=>'TeacherController@get_tutors']);
Route::get('/listUser',['as'=>'listUser','uses'=>'UserController@get_users']);


////////////////////////////////////////////////////////////////////
/////////////////TESSTTT CRUD//////////////////////////////////////
//////////////////////////////////////////////////////////////////
Route::get('/class/{class_id?}',function($class_id){
    $class = Classes::find($class_id);

    return Response::json($class);
});

Route::post('/class',function(Request $request){
    $class = Classes::create($request->all());

    return Response::json($class);
});

Route::put('/class/{id?}',function(Request $request,$id){
    $class = Classes::find($id);

    $class->name = $request->name;
    $class->teacher = $request->teacher;

    $class->save();
    return Response::json($class);
});

Route::delete('/class/{id}',function($id){
    		$class = Classes::destroy($id);


    return Response::json($class);
});
Route::get('/testcrud', function () {
    $classes = Classes::all();

    return View::make('crud')->with('class_list',$classes);
});
////////////////////////////////////////////////////////////////////
/////////////////TESSTTT CRUD//////////////////////////////////////
//////////////////////////////////////////////////////////////////

Route::get('/listAll',function(){
    return view('listAll');
});
Route::get('/searchAccount',['as'=>'searchAccount','uses'=>'AccountController@searchAccount']);
Route::get('/filterAcc',function(){    
    return view('filterAcc');
});
Route::get('/getTransaction/{id}',['as'=>'getTransaction', 'uses'=>'TransController@getTransaction']);
//DISCOUNT

Route::get('/getDiscount',function(){
    return view('transactions.discount');
});
Route::get('/selectAccount',['as'=>'selectAccount','uses'=>'TransController@selectAccount']);
Route::get('/dongtien/{id}',['as'=>'dongtien','uses'=>'TransController@dongtien']);
Route::get('/detailTuition/{id}',['as'=>'detailTuition','uses'=>'TransController@detailTuition']);
Route::get('/searchAccountParents',['as'=>'searchAccountParents','uses'=>'AccountController@searchAccountParents']);
Route::get('/allTransaction/{id}',['as'=>'allTransaction','uses'=>'TransController@allTransaction']);
Route::post('/recieve/{id}',['as'=>'recieve','uses'=>'TransController@recieve']);
Route::get('/uploadcsv',function(){
    return view('uploadCsv.upload');

});
Route::post('/uploadStudent',['as'=>'uploadStudent','uses'=>'StudentController@upload']);

//Phiếu thu
Route::get('/getReceipt',['as'=>'receipt','uses'=>'RecieptController@get_form']);
Route::post('/postReceipt',['as'=>'postReceipt','uses'=>'RecieptController@post_form']);
Route::get('/listReceipt',['as'=>'listReceipt','uses'=>'RecieptController@list_receipt']);
Route::get('/deleteLast',['as'=>'deleteLast','uses'=>'RecieptController@deleteLast']);

//Phiếu chi
Route::get('/getpayment',['as'=>'payment','uses'=>'PaymentController@get_form']);
Route::post('/postPayment',['as'=>'postPayment','uses'=>'PaymentController@post_form']);
Route::get('/listpayment',['as'=>'listpayment','uses'=>'PaymentController@list_payment']);
Route::get('/deleteLast',['as'=>'deleteLast','uses'=>'PaymentController@deleteLast']);

//Thông báo học phí
Route::post('/postTbHocPhi/{id}',['as'=>'/postTbHocPhi','uses'=>'ClassController@tb_hoc_phi']);
Route::post('/postThuHocPhi/{id}',['as'=>'/postThuHocPhi','uses'=>'TransController@thu_hoc_phi']);

//Điểm danh
Route::get('/attendance',['as'=>'attendance','uses'=>'ClassController@attendance']);
Route::post('/postAttendance',['as'=>'postAttendance','uses'=>'ClassController@post_attendance']);

Route::get('/getStudent/{id}',['as'=>'getStudent','uses'=>'ClassController@get_student']);
Route::get('/inPhieuThu/{request}/{newReceipt}',['as'=>'inPhieuThu','uses'=>'PaymentController@in_phieu_thu']);

Route::get('/searchStudent/{classId}',['as'=>'searchStudent','uses'=>'ClassController@search_student']);
Route::get('/getEditLesson/{transactionId}',['as'=>'getEditLesson','uses'=>'ClassController@edit_lesson']);
Route::post('/postEditLesson/{transactionId}',['as'=>'postEditLesson','uses'=>'ClassController@save_lesson']);
Route::get('/listHocBu',['as'=>'listHocBu','uses'=>'ClassController@get_hocbu']);
Route::get('/hocbu',function(){
    return view('class.listHocBu');
});
//EDIT HOC BU
    Route::post('/editHb',['as'=>'editHocBu','uses'=>'ClassController@edit_hocbu']);
    
//CSV
Route::get('/csvToClass',['as'=>'csvToClass','uses'=>'ClassController@csv_to_class']);
Route::get('/csvToTeacher',['as'=>'csvToTeacher','uses'=>'ClassController@csv_to_teacher']);
Route::get('/csvToStudent',['as'=>'csvToStudent','uses'=>'StudentController@csv_to_student']);
Route::get('/testBkper',function(){
    return view('testBkper');
});
Route::post('/addTransaction',['as'=>'addTransaction','uses'=>'TransController@addTransaction']);

//Chấm công
Route::get('/checkin',['as'=>'checkin','uses'=>'ShiftController@get_checkin']);
Route::post('/checkin',['as'=>'postCheckin','uses'=>'ShiftController@post_checkin']);
Route::get('/checkout',['as'=>'checkout','uses'=>'ShiftController@get_checkout']);
Route::post('/checkout',['as'=>'postCheckout','uses'=>'ShiftController@post_checkout']);

Route::get('/listShift',function(){
    return view('auth.listShift');
});
Route::get('/temp',['uses'=>'ClassController@temp']);


Auth::routes();
Route::resource('gcalendar', 'gCalendarController');
Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'gCalendarController@oauth']);
Route::get('cal.index',['as'=>'cal.index','uses'=>'gCalendarController@index']);

Route::get('/ketoan',function(){
    return view('/layouts.ketoan');
});
Route::get('/accountManagement',['as'=>'accountManagement','uses'=>'AccountController@list_account']);

Route::get('/searchStudent',['as'=>'searchStudents','uses'=>'StudentController@fetch_students']);
Route::get('/searchParent',['as'=>'searchParent','uses'=>'StudentController@fetch_parents']);

Route::get('/dashboard',['as'=>'dashboard','uses'=>'EnrollController@getDashboard']);