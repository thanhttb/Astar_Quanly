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
    $list->order_by('firstday_showup','DESC');
    $list->table_name('Danh sách tổng');
    $list->hide_button('add');
    $list->join('student_id','students','id');
    $list->relation('student_id','students','id',array('lastName','firstName'));
    $list->join('students.parent_id','parents','id');
    $list->relation('officalClass','classes','id',array('name'));
    $list->columns(array('student_id','parents.phone'
                        ,'subject','class','teacher','result','resultInform',
                        'decision','officalClass','firstDay','receiver')); 
    $list->label(array('student_id' => 'Họ tên học sinh', 'parents.phone' => 'SDT Phụ Huynh', 'subject' => 'Môn ĐK',
                            'class'=> 'Lớp','receiver'=>'Người tiếp nhận','teacher' => 'Người chấm','result'=>'Kết quả',
                            'resultInform'=>'Thông báo kết quả','decision'=>'Quyết định','officalClass'=>'Xếp lớp','firstDay'=>'Buổi đầu','inform' => 'Thông báo phụ huynh','firstday_showup'=>'Đã đến học'));   
    $list->unset_remove();
    $list->highlight_row('firstday_showup','=','-1','#c2d6d6'); 
    $list->create_action('deactive','deactive');
    $list->create_action('active','active');       
    $list->button('#', 'Lưu trữ', 'icon-close glyphicon glyphicon-remove', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'deactive',
            'data-primary' => '{id}'),
        array(  // set condition ( when button must be shown)
            'firstday_showup',
            '!=',
            '-1')
    );
    $list->button('#', 'Hoạt động', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'active',
            'data-primary' => '{id}'),
        array(  // set condition ( when button must be shown)
            'firstday_showup',
            '=',
            '-1')
    );
    echo $list->render();
    
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#ghidanh-0').addClass('open active');
        $('#ghidanh-0-5').addClass('open active');
    })

</script> 
@endsection()