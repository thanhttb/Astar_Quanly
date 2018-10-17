
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
Route::get('send','MailController@send');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function(){
	return view('enroll.ktdv');
});

//Tiếp nhận học sinh
Route::get('/enroll',['uses'=>'EnrollController@add_new']);
Route::get('/ktdv',function(){return view('enroll/ktdv');})->name('ktdv');
Route::get('/listEnroll',function(){return view('enroll/list');});
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
//REMINDER 
Route::get('/getReminder/{id}',['as'=>'getReminder','uses'=>'EnrollController@get_reminder']);
Route::get('/getFormReminder',['as'=>'getFormReminder','uses'=>'EnrollController@get_form_reminder']);
Route::post('/getReminder/postFormReminder/{id}',['as'=>'postFormReminder','uses'=>'EnrollController@post_form_reminder']);
Route::get('/getReminder/getHistory/{id}',['as'=>'getHistory','uses'=>'EnrollController@get_history']);
Route::post('/getReminder/doneReminder/{id}',['as'=>'doneReminder','uses'=>'EnrollController@done_by']);
Route::get('/today-task',['as'=>'todayTask','uses'=>'EnrollController@today_task']);
//PROFILE USERS
Route::get('profile',['as'=>'profile','uses'=>'fileController@profile']);
Route::post('avatar_store', 'UserController@storeAvatar');
Route::post('profile_store','UserController@storeProfile');
Route::post('change_password',['as'=>'change_password','uses'=> 'UserController@change_password']);

//CRUD LỚP HỌC
Route::get('addNewClass',['as'=>'addNewClass', 'uses'=>'ClassController@addNew']);
Route::get('/listClass',['as'=>'listClass','uses'=>'ClassController@listClass']);
Route::get('/classDetail/{id}',['as'=>'classDetail','uses'=>'ClassController@classDetail']);
 



Route::get('/sessions',['as'=>'sessions','uses'=>'ClassController@list_sessions']);
Route::get('/allClasses',['as'=>'allClasses', 'uses' => 'ClassController@all_classes']);

Route::get('/listStudent',['as'=>'listStudent','uses'=>'StudentController@get_list']);
Route::get('/detailStudent/{id}',['as'=>'detailStudent','uses'=>'StudentController@detail_student']);


//CA HOC
Route::get('/getSession/{class_id}',['as'=>'getSession', 'uses'=>'SessionController@get_session_by_class']);
Route::post('/editSession/{id}',['as'=>'editSession','uses'=>'SessionController@edit_session']);
//NHÂN VIÊN 
Route::get('/listTeacher',['as'=>'listTeacher','uses'=>'TeacherController@get_teachers']);
Route::get('/listTutor',['as'=>'listTutor','uses'=>'TeacherController@get_tutors']);
Route::get('/listUser',['as'=>'listUser','uses'=>'UserController@get_users']);


//TRANSACTION - ACCOUNT
Route::get('/searchAccount',['as'=>'searchAccount','uses'=>'AccountController@searchAccount']);
Route::get('/filterAcc',function(){  
    return view('filterAcc');

});
Route::get('/getTransaction/{id}',['as'=>'getTransaction', 'uses'=>'TransController@getTransaction']);
//DISCOUNT

Route::get('/getDiscount',function(){
    return view('transactions.discount');
});
// ĐÓNG HỌC PHÍ
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
Route::get('/groupbyDay',['as'=>'groupbyday','uses'=>'RecieptController@group_by_day']);//Phiếu chi
Route::get('/getpayment',['as'=>'payment','uses'=>'PaymentController@get_form']);
Route::post('/postPayment',['as'=>'postPayment','uses'=>'PaymentController@post_form']);
Route::get('/listpayment',['as'=>'listpayment','uses'=>'PaymentController@list_payment']);
Route::get('/deleteLast',['as'=>'deleteLast','uses'=>'PaymentController@deleteLast']);

//Thông báo học phí
Route::get('/getTbHocPhi',['as'=>'getTbHocPhi','uses'=>'ClassController@get_tb_hocphi']);
Route::get('/printHp',['as'=>'printHp','uses'=>'ClassController@print_hp']);
Route::get('/sendSms',['as'=>'sendSms','uses'=>'ClassController@send_sms']);
Route::get('/truythu',['as'=>'truythu','uses'=>'ClassController@truy_thu']);
//ThuHocphi
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


Route::get('/getTransaction/{id}',['as'=>'getTransaction', 'uses'=>'TransController@getTransaction']);
//DISCOUNT

Route::get('/getDiscount',function(){
    return view('transactions.discount');
});
// ĐÓNG HỌC PHÍ
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
Route::get('/groupbyDay',['as'=>'groupbyday','uses'=>'RecieptController@group_by_day']);//Phiếu chi
Route::get('/getpayment',['as'=>'payment','uses'=>'PaymentController@get_form']);
Route::post('/postPayment',['as'=>'postPayment','uses'=>'PaymentController@post_form']);
Route::get('/listpayment',['as'=>'listpayment','uses'=>'PaymentController@list_payment']);
Route::get('/deleteLast',['as'=>'deleteLast','uses'=>'PaymentController@deleteLast']);

//Thông báo học phí
Route::get('/getTbHocPhi',['as'=>'getTbHocPhi','uses'=>'ClassController@get_tb_hocphi']);
Route::get('/printHp',['as'=>'printHp','uses'=>'ClassController@print_hp']);
Route::get('/sendSms',['as'=>'sendSms','uses'=>'ClassController@send_sms']);
Route::get('/truythu',['as'=>'truythu','uses'=>'ClassController@truy_thu']);
//ThuHocphi
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



Route::get('/accountManagement',['as'=>'accountManagement','uses'=>'AccountController@list_account']);

Route::get('/searchStudent',['as'=>'searchStudents','uses'=>'StudentController@fetch_students']);
Route::get('/searchParent',['as'=>'searchParent','uses'=>'StudentController@fetch_parents']);
//TEST
Route::get('/dashboard',['as'=>'dashboard','uses'=>'EnrollController@getDashboard']);
Route::get('/testEmail',['as'=>'testEmail','uses'=>'ClassController@test_email']);
Route::get('/findByTag/{tag}',['as'=>'findByTag','uses'=>'TransController@find_by_tag']);
Route::get('/printReceipt/{id}',['as'=>'printReceipt','uses'=>'TransController@print_receipt']);
Route::get('/sendMessage',['as'=>'sendMessage','uses'=>'ClassController@send_message']);

Route::post('/dropOut',['as'=>'dropOut','uses'=>'StudentController@drop_out']);
Route::post('/switchClass',['as'=>'switchClass','uses'=>'StudentController@switch_class']);
Route::get('/getDropout/{id}',['as'=>'getDropout','uses'=>'StudentController@get_form_dropout']);
Route::get('/getSwitch/{id}',['as'=>'getSwitch','uses'=>'StudentController@get_form_switch']);

//Nhap lieu
Route::get('/csvToClasses',['as'=>'csvToClasses','uses'=>'ClassController@csv_to_classes']);

//Period

Route::get('/editPeriod',['as'=>'editPeriod','uses'=>'PeriodsController@editPeriod']);
/*KẾ TOÁN*/
Route::get('promotion',['as'=>'promotion','uses'=>'UniController@get_form']);
Route::post('post_promotion',['as'=>'post_promotion','uses'=>'UniController@post_promotion']);
Route::post('pre_process',['as'=>'pre_process','uses'=>'UniController@post_pre_process']);
Route::group(['prefix'=>'ketoan'],function(){
    Route::any('/',function(){
        echo "/";
    });
    Route::post('newAccount',['as'=>'newAccount','uses'=>'AccountController@add_new']);
    Route::post('editAccount/{id}',['as'=>'editAccount', 'uses'=>'AccountController@edit_account']);
    Route::get('getEdit/{id}',['as'=>'getEdit','uses'=>'AccountController@get_edit']);
    Route::get('/listAccount',['as'=>'listAccount','uses'=>'AccountController@view_list']);
    Route::get('/allAccount',['as'=>'allAccount','uses'=>'AccountController@list_account']);
    //Form tạo group mới
    Route::get('group',['as'=>'group','uses'=>'AccountController@get_group']);
    //
    Route::post('batch',['as'=>'batch','uses'=>'AccountController@get_batch']);
    //Danh sach toan bo group
    Route::get('/allGroup',['as'=>'allGroup','uses'=>'AccountController@list_group']);
    // Tạo group mới, đồng thời thêm acc vào group đó
    // Request: {name: "tên group mới", accounts: []}
    Route::post('group',['as'=>'group','uses'=>'AccountController@post_group']);

    // Thêm acc vào group đã có
    // Request: {groupsToAdd: [], groupsToRemove: [], ids: []}
    Route::post('batch',['as'=>'batch','uses'=>'AccountController@post_batch']);

    //Thay đổi, chỉnh sửa transaction
    //Request: {{status: "SAVED", amount: 123123, informedDateValue: 20170503, creditAccId: "5689792285114368",…}
    Route::post('transaction',['as'=>'editTransaction','uses'=>'AccountController@post_transaction']);
    //REST FILTER
    Route::get('transaction/{filter}',['as'=>'transaction','uses'=>'AccountController@get_transaction']);
    Route::get('/listAllTransaction',function(){ return view('listAll'); });
    Route::get('/listGroup',function(){
        return view('account.listGroup');
    });
    Route::get('/listFee',['as'=>'listFee','uses'=>'FeeController@list_fee']);


});