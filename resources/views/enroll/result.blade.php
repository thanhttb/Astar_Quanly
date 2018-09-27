@extends('layouts.master')
@section('content')
    <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>

<?php
	include(app_path().'/xcrud/xcrud.php');
	include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js();
    $today = date("Y-m-d h:i");
    
    $result = Xcrud::get_instance();
    $result->table('enrolls')->where('showUp = 1')->where('officalClass is NULL')->where('firstday_showup != -1');
    $result->table_name('Kết quả Kiểm tra đầu vào');
    $result->hide_button('add');
    $result->join('student_id','students','id');
    $result->relation('student_id','students','id',array('lastName','firstName'));
    $result->join('students.parent_id','parents','id');

    $result->columns(array('student_id','parents.phone'
    					,'subject','class','teacher','receiveTime','result','resultInform',
    					'decision','officalClass','firstDay','note','receiver'));

    $result->label(array('student_id' => 'Họ tên học sinh', 'parents.phone' => 'SDT Phụ Huynh', 'subject' => 'Môn ĐK',
                            'class'=> 'Lớp','receiver'=>'Người tiếp nhận','receiveTime'=>'Ngày gửi','teacher' => 'Người chấm','result'=>'Kết quả',
                            'resultInform'=>'Thông báo kết quả','decision'=>'Quyết định','officalClass'=>'Xếp lớp','firstDay'=>'Buổi đầu','note'=>'Ghi chú'));   
    $result->highlight_row('result','!=',null,'#c7e881');
    $result->highlight_row('resultInform','=',1,'white');
    $result->highlight('result','=',null,'#c9d2d6');
    $result->highlight('teacher','=','0','#c3fa00');

    $result->column_callback('teacher','add_edit_teacher');
   // $result->column_callback('receiveTime','add_edit_time');
    $result->column_callback('result','add_edit_result');

    $result->column_callback('resultInform','add_edit_informed');
    $result->column_callback('decision','add_edit_decision');
    $result->column_callback('officalClass','add_class');
    $result->column_callback('firstDay','add_firstDay');
    $result->column_callback('note','add_note');

    $result->unset_edit();
    $result->unset_remove();
    $result->button('getReminder/{enrolls.id}','Nhắc việc');

    $result->create_action('deactive','deactive');
    $result->create_action('active','active');       
    $result->button('#', 'Lưu trữ', 'icon-close glyphicon glyphicon-remove', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'deactive',
            'data-primary' => '{id}'),
        array(  // set condition ( when button must be shown)
            'firstday_showup',
            '!=',
            '-1')
    );
    $result->button('#', 'Hoạt động', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'active',
            'data-primary' => '{id}'),
        array(  // set condition ( when button must be shown)
            'firstday_showup',
            '=',
            '-1')
    );
    echo $result->render();
    
?>
<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- x-editable (bootstrap version) -->
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<link href="{{asset('public/datetimepicker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet"></link> 
<script src="{{asset('public/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>

<link href="{{ asset('select2-4.0.3/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"></link> 
<link href="{{ asset('select2-4.0.3/select2-bootstrap-css-master/docs/select2-bootstrap.css')}}" rel="stylesheet" type="text/css"></link> 

<script src="{{ asset('select2-4.0.3/dist/js/select2.full.js') }}"></script> 
 <script type="text/javascript">
 		function result(){
 			$.fn.editable.defaults.params = function (params){
                params._token = $("#_token").data("token");
                return params;
            };

            var teachers_src = [{id: '0', text: 'Chưa gửi bài' }];
            var classes_src = [{id: 0, text: 'Chưa xếp lớp' }];
            
            <?php 
            	foreach ($allTeachers as $key => $value) {
            		# code...
            		echo 'teachers_src.push({id : "'.$value['name']. '", text: "'.$value['name'].'"});';
            		
            	}
            	foreach ($allClasses as $key => $value) {
            		# code...
            		echo 'classes_src.push({id : "'.$value['id']. '", text: "'.$value['name'].'"});';
            	}
            ?>
            $('.teacher').editable({
                source: teachers_src,
                url:'{{route('saveTeacher')}}',
                success: function(response, newValue) {
		            if(!response.success) return Xcrud.reload();
		        }
		        
            });
           $('.result').editable({
           		url: '{{route('saveResult')}}',
           		row: 3,
           		placement: 'left',
           		success: function(response, newValue) {
		            if(!response.success) return Xcrud.reload();
		        }
           });
           $('.ghichu').editable({
           		url: '{{route('saveNote')}}',
           		row: 3,
           		placement: 'left',
           		success: function(response, newValue) {
		            if(!response.success) return Xcrud.reload();
		        }
           });
           $('.resultInform').editable({                
                url: '{{route('editResultInform')}}',
                value: 2,    
                source: [
                  {value: 0, text: 'Chưa thông báo'},
                  {value: 1, text: 'Đã thông báo'},
                  
                ],
                success: function(response, newValue) {
		            if(!response.success) return Xcrud.reload();
		        }             

            });
            $('.decision').editable({                
                url: '{{route('editDecision')}}',
                value: 3,    
                source: [
                  {value: 'Xếp lớp', text: 'Xếp lớp'},
                  {value: 'Chờ mở lớp', text: 'Chờ mở lớp'},
                  {value: 'Cân nhắc thêm', text: 'Cân nhắc thêm'}
                  
                ],
                success: function(response, newValue) {
		            if(!response.success) return Xcrud.reload();
		        }               

            });
            $('.officalClass').editable({
            	url: '{{route('editClass')}}',
            	source: classes_src,
            	success: function(response, newValue) {
		            if(!response.success) return Xcrud.reload();
		        }
            });
            $('.firstDay').editable({
		        url : '{{route("editFirstDay")}}',
		        type: 'datetime',
		        title: 'Select date',
		        placement: 'left',
		        format: 'yyyy-mm-dd hh:ii',    
		        viewformat: 'dd-mm-yyyy hh:ii',
		        datetimepicker: {
		                weekStart: 1
		           },
		        success: function(response, newValue) {
		            if(!response.success) return Xcrud.reload();
		        }	                     

		    });

 		}
	  	$(document).ready(result());
	  	window.onload = function(){
		    jQuery(document).on("xcrudafterrequest",function(event,container){
		        result();        
		    });
            $('#ghidanh-0').addClass('open active');
            $('#ghidanh-0-3').addClass('open active');
		}
</script>	
@endsection()