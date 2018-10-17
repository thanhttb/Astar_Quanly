@extends('layouts.master')
@section('content')
    <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>

    <?php
        include(app_path().'/xcrud/xcrud.php');
        include(app_path().'/xcrud/functions.php');
        echo Xcrud::load_css();
        echo Xcrud::load_js();
        
        $fd = Xcrud::get_instance();
<<<<<<< HEAD
        $fd->table('enrolls')->where('officalClass is not null')->where('firstday_showup = 0')->where('firstday_showup != -1');
=======
        $fd->table('enrolls')->where('officalClass is not null')->where('firstday_showup = 1')->where('firstday_showup != -1');
>>>>>>> master
        $fd->table_name('Học buổi đầu');
        $fd->order_by('firstDay');
        $fd->hide_button('add');
        $fd->join('student_id','students','id');
        $fd->relation('student_id','students','id',array('lastName','firstName'));
        //$fd->relation('officalClass','classes','id',array('name'));
        $fd->join('students.parent_id','parents','id');

        $fd->columns(array('student_id','parents.phone'
                            ,'subject','class','officalClass','firstDay','inform','firstday_showup','note'));
        $fd->label(array('student_id' => 'Họ tên học sinh', 'parents.phone' => 'SDT Phụ Huynh', 'subject' => 'Môn ĐK',
                            'class'=> 'Lớp'));   
         $fd->label(array('student_id' => 'Họ tên học sinh', 'parents.phone' => 'SDT Phụ Huynh', 'subject' => 'Môn ĐK',
                            'class'=> 'Lớp','receiver'=>'Người tiếp nhận','teacher' => 'Người chấm','result'=>'Kết quả',
                            'resultInform'=>'Thông báo kết quả','decision'=>'Quyết định','officalClass'=>'Xếp lớp','firstDay'=>'Buổi đầu','inform' => 'Thông báo phụ huynh','note'=>'Ghi chú','firstday_showup'=>'Đã đến học'));   
        //Highligt Học sinh kiểm tra hôm nay
        $today = date("Y-m-d h:i");       
        $tomorrow = new DateTime('tomorrow');
        $tomorrow = $tomorrow->format('Y-m-d h:i');
        $fd->highlight_row('firstDay','>',$today,'#ffb3b3');
        $fd->highlight_row('firstDay','>=',$tomorrow,'white');

        $fd->column_callback('officalClass','edit_class');
        $fd->column_callback('firstDay','add_firstDay');
        $fd->column_callback('inform','add_inform');
        $fd->column_callback('firstday_showup','add_firstDay_showUp');
        $fd->column_callback('note','add_note');
        $fd->button('getReminder/{enrolls.id}','Nhắc việc'); 
        $fd->unset_edit();
        $fd->unset_remove();
        $fd->create_action('deactive','deactive');
        $fd->create_action('active','active');       
        $fd->button('#', 'Lưu trữ', 'icon-close glyphicon glyphicon-remove', 'xcrud-action',
            array(  // set action vars to the button
                'data-task' => 'action',
                'data-action' => 'deactive',
                'data-primary' => '{id}'),
            array(  // set condition ( when button must be shown)
                'firstday_showup',
                '!=',
                '-1')
        );
        $fd->button('#', 'Hoạt động', 'icon-close glyphicon glyphicon-ok', 'xcrud-action',
            array(  // set action vars to the button
                'data-task' => 'action',
                'data-action' => 'active',
                'data-primary' => '{id}'),
            array(  // set condition ( when button must be shown)
                'firstday_showup',
                '=',
                '-1')
        );   
        echo $fd->render();
        //print_r($allClasses);
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
function editInline(){
    $.fn.editable.defaults.params = function (params){
                params._token = $("#_token").data("token");
                return params;
            };  
    var classes_src = [];
    
    <?php 
        foreach ($allClasses as $key => $value) {
            # code...
            echo 'classes_src.push({id : "'.$value['id']. '", text: "'.$value['name'].'"});';
        }
    ?>  
    $('.editClass').editable({
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
    $('.testInform').editable({     
        url : '{{route("editInform")}}',          
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
        url : '{{route("editFirstDayShowUp")}}',    
        value: 2,    
        source: [
          {value: 0, text: 'Chưa đến đến'},
          {value: 1, text: 'Đã đến học'}
          
        ],
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

}
$(document).ready(editInline());
window.onload = function(){
    jQuery(document).on("xcrudafterrequest",function(event,container){
        editInline();        
    });
    $('#ghidanh-0').addClass('open active');
    $('#ghidanh-0-4').addClass('open active');
}
    

</script>   

        
@endsection()