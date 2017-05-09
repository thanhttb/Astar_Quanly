@extends('layouts.master')
@section('content')
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
<link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}">
<?php
		include(app_path().'/xcrud/xcrud.php');
		include(app_path().'/xcrud/functions.php');
        echo Xcrud::load_css();
        echo Xcrud::load_js(); 
        $ngayhoc = Xcrud::get_instance();
        $ngayhoc->table('lessons')->where('class_id ='.$id);
        $ngayhoc->relation('class_id','classes','id','name');
        $ngayhoc->relation('teacher_id','teachers','id','name');
        ?>

<div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-purple-soft"></i>
            <span class="caption-subject font-purple-soft bold uppercase">{{$class['name']}}</span>
            <span class="caption-subject font-purple-soft bold uppercase">Thầy: {{$class['teacher']}}</span>
        </div>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-cloud-upload"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-wrench"></i>
            </a>
            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                <i class="icon-trash"></i>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <ul class="nav nav-tabs">

            <li class="active">
                <a href="#tab_1_1" data-toggle="tab"> Danh sách HS </a>
            </li>
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Hoạt động
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="#tab_1_3" tabindex="-1" data-toggle="tab"> Thêm ngày học </a>
                    </li>
                    <li>
                        <a href="#tab_1_4" tabindex="-1" data-toggle="tab"> Danh sách ngày học </a>
                    </li>
                    <li>
                        <a href="#tab_1_5" tabindex="-1" data-toggle="tab">Định tính tiền học</a>
                    </li>
                    <li>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane fade" id="tab_1_1">
            <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Danh Sách Học Sinh</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover responsive" id="students">
                            <thead>
                                <tr>
                                    <th>Họ đệm</th>
                                    <th>Tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th>Lớp</th>
                                    <th>Trường</th>
                                    <th>Phụ hunh</th>
                                    <th>Điện thoại PH</th>
                                    <th>Email PH</th>
                                    <th>Ngày vào học</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach($studentsFull as $std)
                                    @if(is_null($std['lastDay']))
                                    <tr>
                                    @else
                                    <tr style="text-decoration: line-through;">
                                    @endif
                                        <td>{{$std['lastName']}}</td>
                                        <td>{{$std['firstName']}}</td>
                                        <td>{{$std['dob']}}</td>
                                        <td>{{$std['std_phone']}}</td>
                                        <td>{{$std['std_email']}}</td>
                                        <td>{{$std['class']}}</td>
                                        <td>{{$std['school']}}</td>
                                        <td style="background: #e8d2b4;">{{$std['name']}}</td>
                                        <td style="background: #e8d2b4;">{{$std['p_phone']}}</td>
                                        <td style="background: #e8d2b4;">{{$std['p_email']}}</td>
                                        <td>{{date('d/m/Y',strtotime($std['firstDay']))}}</td>
                                        <td>{{$std['note']}}</td>
                                    </tr>

                                @endforeach   
                            </tbody>
                        </table>
                    </div></div>
            </div>
            <div class="tab-pane fade" id="tab_1_3">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Thêm ngày học</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                    <form class="mt-repeater form-horizontal" method="POST" action="{!! URL::route('postLesson',$id)!!}" >
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div data-repeater-list="group">
                            <div data-repeater-item class="mt-repeater-item">
                                <!-- jQuery Repeater Container -->
                                <div class="mt-repeater-input">
                                    <label class="control-label">Ngày học</label>
                                    <br/>
                                    <input type="text" name="ngayhoc" class="form-control date form_datetime"  /> </div>
                                 <div class="mt-repeater-input">
                                    <label class="control-label">Thời lượng</label>
                                    <br/>
                                    <input type="number" name="thoiluong" class="form-control" placeholder="Phút" /> </div>   
                                <div class="mt-repeater-input">
                                    <label class="control-label">Giáo viên</label>
                                    <br/>
                                    <select class="basic-single form-control" name="giaovien" style="width: 200px;" >
                                      @foreach($teachers as $tec)
                                        <option value="{!!$tec['id']!!}">{!!$tec['name']!!}</option>

                                      @endforeach
                                    </select> 
                                </div>
                                <div class="mt-repeater-input">
                                    <label class="control-label">Hạn đóng tiền</label>
                                    <br/>
                                    <input type="text" name="dueDate" class="form-control date-picker"  /> 
                                </div>
                                
                                <div class="mt-repeater-input mt-repeater-textarea">
                                    <label class="control-label">Học phí</label>
                                    <br/>
                                <input type="number" class="input-group form-control form-control-inline" name="tuition">
            
                                </div>
                                <div class="mt-repeater-input">
                                    <label class="control-label">Số lần thêm</label>
                                    <br/>
                                    <input type="number" class="input-group form-control form-control-inline" name="number" max="5" min="1">
                                </div>
                                
                                <div class="mt-repeater-input">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                        <i class="fa fa-close"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                            <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add" id="add">
                            <i class="fa fa-plus"></i> Add</a>
                            <input class="btn btn-success" type="submit" value="Thêm Ngày Học" >

                    </form>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade" id="tab_1_4">
                <div class="portlet light bordered">
                   
                    <div class="portlet-body">
                        <?php 
                            echo $ngayhoc->render();
                         ?>
                    </div>
                </div>
        </div> 
        <div class="tab-pane fade open" id="tab_1_5">
            <div class="portlet light bordered">
                <!-- <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Horizontal Form</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                    </div>
                </div> -->
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form" action={{url('postTbHocPhi/'.$class['id'])}} method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Nội dung</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sticky-note-o"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="eg: #Lớp#hp03" name="tag"> 
                                    </div>
                                </div>  
                                <div class="form-group col-md-3">
                                    <label>Tiền học</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <input type="text" class="form-control tuition" placeholder="400.000" id="tuition" value={{$class['tuition']}}> 
                                    </div>
                                </div>  
                                <div class="form-group col-md-2">
                                    <label>Số buổi</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-hand-spock-o"></i>
                                        </span>
                                        <input type="text" class="form-control lesson" id="lesson" placeholder="3"> 
                                    </div>
                                </div>  
                                <div class="form-group col-md-3">
                                    <label>Tổng tiền</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <input type="text" class="form-control total" placeholder="" id="total"> 
                                    </div>
                                </div>  
                            </div>
                            
                        </div>
                        <div class="porlet-body">
                            <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead class="flip-content">
                                    <tr>
                                        <th width="20%"> Họ Tên </th>
                                        <th width="10%"> Ngày sinh </th>
                                        <th width="10%"> Học phí </th>
                                        <th width="10%"> Số buổi </th>
                                        <th class="numeric"> Miễn giảm </th>
                                        <th class="numeric"> Tổng tiền </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$student['lastName'].' '.$student['firstName']}}</td>
                                            <td>{{date('d/m/Y',strtotime($student['dob']))}}</td>
                                            <td>
                                                <div class="input-group input-small">
                                                        <input type="text" class="form-control input-small each-tuition" 
                                                        id= tuition{{$student['student_id']}} placeholder="400.000" value={{$class['tuition']}}>     
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-small">
                                                        <input type="text" class="form-control input-small each-lesson" id= lesson{{$student['student_id']}} name=lesson{{$student['student_id']}}>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-hand-spock-o"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td id= discount{{$student['student_id']}}>{{$student['discount']}}</td>
                                            <td>
                                                <div class="input-group input-small">
                                                        <input type="text" class="form-control input-small each-total" id= total{{$student['student_id']}} name=total{{$student['student_id']}}>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            
                        </div>                                          
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                    <button type="button" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
       
        <div class="clearfix margin-bottom-20"> </div>
        
    </div>
            
    
</div>

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript">

$.fn.editable.defaults.params = function (params){
                params._token = $("#_token").data("token");
                return params;
            };
$('#tuition').change(function(){
    var tuition = parseInt($('#tuition').val());
    var lesson = parseInt($('#lesson').val());
    $('.total').val(tuition * lesson);
    $('.each-tuition').val(tuition);
    <?php 
        foreach ($students as $std) {        
            echo "var discount = parseInt($('#discount".$std['student_id']."').html());";
            echo "$('#total".$std['student_id']."').val((tuition*lesson*(100-discount))/100);";
        }
    ?>

});   
// $('#each-tuition').change(function(){
//     var std
// });
$('#lesson').change(function(){
    var tuition = parseInt($('#tuition').val());
    var lesson = parseInt($('#lesson').val());
    $('.total').val(tuition * lesson);
    <?php 
        foreach ($students as $std) {
            # code...
            echo "$('#lesson".$std['student_id']."').val($('#lesson').val());";
            echo "var discount = parseInt($('#discount".$std['student_id']."').html());";
            echo "$('#total".$std['student_id']."').val((tuition*lesson*(100-discount))/100);";
        }

    ?>
     
});
$('.each-lesson, .each-tuition').change(function(){
    <?php 
        foreach ($students as $std) {
            # code...
            echo "var tuition = parseInt($('#tuition".$std['student_id']."').val());";
            echo "var lesson = parseInt($('#lesson".$std['student_id']."').val());";
            echo "var discount = parseInt($('#discount".$std['student_id']."').html());";
            echo "$('#total".$std['student_id']."').val((tuition*lesson*(100-discount))/100);";
        }
     ?>
});

$(document).ready(function(){
    $('.atd').editable({     
        url : '{{route("saveAtd")}}',
        source: [
          {value: 'x', text: 'x'},
          {value: 'p', text: 'p'},
          {value: 'kp', text: 'kp'}
        ],
        success: function(response, newValue) {
        }             

    });
    $('.note').editable({
        emptytext: "",
        type: 'textarea'

    }); 
    $('#lophoc-1').addClass('open acitve'); 
     
});


</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
 <link href="{{ asset('select2-4.0.3/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"></link> 

<script src="{{ asset('select2-4.0.3/dist/js/select2.full.js') }}"></script> 
<script src="{{asset('assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>        <!-- END PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/pages/scripts/table-datatables-buttons.js')}}" type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/form-repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
@endsection