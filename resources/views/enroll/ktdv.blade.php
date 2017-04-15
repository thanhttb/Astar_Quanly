@extends('layouts.master')
@section('content')
    <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>

	<?php
		include(app_path().'/xcrud/xcrud.php');
		include(app_path().'/xcrud/functions.php');
        echo Xcrud::load_css();
        echo Xcrud::load_js();
        $today = date("Y-m-d 00:00");
        
        $ktdv = Xcrud::get_instance();
        $ktdv->table('enrolls')->where('showUp = 0');
        $ktdv->table_name('Kiểm tra đầu vào');
        $ktdv->order_by('appointment');
        
        $ktdv->hide_button('add');
        $ktdv->join('student_id','students','id');
        $ktdv->relation('student_id','students','id',array('lastName','firstName'));
        $ktdv->join('students.parent_id','parents','id');

        $ktdv->columns(array('student_id','parents.phone'
        					,'subject','class','appointment','testInform','showUp','created_at','receiver'));
        $ktdv->label(array('student_id' => 'Họ tên học sinh', 'parents.phone' => 'SDT Phụ Huynh', 'subject' => 'Môn ĐK',
                            'class'=> 'Lớp', 'appointment' => 'Ngày Kiểm tra', 'testInform' => 'Thông báo lịch KT', 'showUp'=>'Đến KT',
                            'created_at'=>'Ngày tiếp nhận', 'receiver'=>'Người tiếp nhận'));   
        
        //Highligt Học sinh kiểm tra hôm nay
        $tomorrow = new DateTime('tomorrow');
        $tomorrow = $tomorrow->format('Y-m-d 00:00');
        $ktdv->highlight_row('appointment','<',$today,'#d5ff80');
        $ktdv->highlight_row('showUp','=','1', 'white');
        $ktdv->highlight_row('appointment','=',null,'white');
        $ktdv->highlight_row('appointment','>',$today,'#ffb3b3');
        $ktdv->highlight_row('appointment','>=',$tomorrow,'white');


       // $ktdv->hightlight_row()
        $ktdv->unset_edit();
        $ktdv->unset_remove();
        $ktdv->column_callback('appointment','add_appointment');
        $ktdv->column_callback('testInform','add_testInform');
        $ktdv->column_callback('showUp','add_showUp');    
	  ?>
    <div style="background: white;
 ">
        <?php echo $ktdv->render(); ?>


    </div>>     

                <!-- x-editable (bootstrap version) -->
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<link href="{{asset('public/datetimepicker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet"></link> 
<script src="{{asset('public/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
<script type="text/javascript">
function editInline(){
    $.fn.editable.defaults.params = function (params){
                params._token = $("#_token").data("token");
                return params;
            };    
    $('.appointment').editable({
        url : '{{route("editDateTime")}}',
        type: 'datetime',
        title: 'Select date',
        placement: 'right',
        format: 'yyyy-mm-dd hh:ii',    
        viewformat: 'dd-mm-yyyy hh:ii',
        datetimepicker: {
                weekStart: 1
           },
        success: function(response, newValue) {
            if(!response.success) return Xcrud.reload();
        }
                     

    });
    $('.testInform').editable({     
        url : '{{route("editTestInform")}}',          
        value: 2,    
        source: [
          {value: 0, text: 'Chưa thông báo'},
          {value: 1, text: 'Đã thông báo'}
        
        ],
        success: function(response, newValue) {
            if(!response.success) return Xcrud.reload();
        }          

    });
    $('.showUp').editable({     
        url : '{{route("editShowUp")}}',    
        value: 2,    
        source: [
          {value: 0, text: 'Chưa đến thi'},
          {value: 1, text: 'Đã đến thi'}
          
        ],
        success: function(response, newValue) {
            if(!response.success) return Xcrud.reload();
        }             

    });
}
$(document).ready(editInline());
window.onload = function(){
    jQuery(document).on("xcrudafterrequest",function(event,container){
        editInline();        
    });
}
    

</script>	

        
@endsection()