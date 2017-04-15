@extends('layouts.master')
@section('content')
    <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>

<?php
	include(app_path().'/xcrud/xcrud.php');
	include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js();
    $today = date("Y-m-d h:i");
    $list = Xcrud::get_instance();
    $list->table('enrolls');
    $list->table_name('Danh sách tổng');
    $list->hide_button('add');
    $list->join('student_id','students','id');
    $list->relation('student_id','students','id',array('lastName','firstName'));
    $list->join('students.parent_id','parents','id');
    $list->columns(array('student_id','parents.phone'
                        ,'subject','class','teacher','result','resultInform',
                        'decision','officalClass','firstDay','receiver')); 
     $list->label(array('student_id' => 'Họ tên học sinh', 'parents.phone' => 'SDT Phụ Huynh', 'subject' => 'Môn ĐK',
                            'class'=> 'Lớp','receiver'=>'Người tiếp nhận','teacher' => 'Người chấm','result'=>'Kết quả',
                            'resultInform'=>'Thông báo kết quả','decision'=>'Quyết định','officalClass'=>'Xếp lớp','firstDay'=>'Buổi đầu','inform' => 'Thông báo phụ huynh','firstday_showup'=>'Đã đến học'));   
      
    echo $list->render();
    
?>
@endsection()