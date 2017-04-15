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
            
            <li>
                <a href="#tab_1_1" class="active" data-toggle="tab"> Điểm danh </a>
            </li>
            <li>
                <a href="#tab_1_2" data-toggle="tab"> Danh sách HS </a>
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
                        <a href="#tab_1_5" tabindex="-1" data-toggle="tab">Xếp lịch học bù</a>
                    </li>
                    <li>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="tab_1_1">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Điểm danh</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="table" width="70%">
                            <thead>
                                <tr>
                                    <th width="25%">Họ tên học sinh</th>
                                    <th width="5%"> Ngày sinh </th>
                                    <th width="5%"> Số đt Phụ huynh</th>
                                    @foreach($lessons as $key => $value)
                                        <th width="3%">{{date('d/m',strtotime($value['start_time']))}}</th>
                                    @endforeach
                                    <th width="40px">x</th>
                                    <th width="40px">kp</th>
                                    <th width="40px">p</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Họ tên học sinh</th>
                                    <th> Ngày sinh </th>
                                    <th> Số đt Phụ huynh</th>
                                    @foreach($lessons as $key => $value)
                                        <th width="3%">{{date('d/m',strtotime($value['start_time']))}}</th>
                                    @endforeach
                                    <th>x</th>
                                    <th>kp</th>
                                    <th>p</th>
                                    
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($students as $std)
                                    <tr>
                                        <td>{{$std['lastName']}} {{$std['firstName']}}</td>
                                        <td>{{date('d/m/Y',strtotime($std['dob']))}}</td>
                                        <td>{{$std['phone']}}</td>
                                        @foreach($lessons as $l)
                                            <td>
                                            @foreach($atd[$l['id']] as $data)
                                                @if($data['class_std_id'] == $std['class_std_id'])
                                                    <a href="#" class="atd" data-type="select" data-pk="{{$data['id']}}" data-title="Select options">{{$data['status']}}</a> 
                                                    <i class= "i"></i>
                                                    <!-- @if($data['status']=='kp' || $data['status'] =='p')
                                                        <span><i data-pk="{{$data['id']}}"  data-title="Ghi chú" class="note fa fa-bookmark" style="padding: 0px; border:0px; margin:0px"></i></span>
                                                    @endif -->
                                                @endif
                                            @endforeach
                                            </td>
                                        @endforeach
                                        <td>{{$total[$std['class_std_id']]['x']}}</td>
                                        <td>{{$total[$std['class_std_id']]['kp']}}</td>
                                        <td>{{$total[$std['class_std_id']]['p']}}</td>

                                    </tr>
                                @endforeach

                                
                                </tbody>
                        </table>    
                    </div>
                </div>                              
            </div>
            <div class="tab-pane fade" id="tab_1_2">
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
                                    <input type="number" class="input-group form-control form-control-inline" name="number">
                                </div>
                                
                                <div class="mt-repeater-input">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                        <i class="fa fa-close"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                            <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add" id="add">
                            <i class="fa fa-plus"></i> Add</a>
                            <input class="btn btn-success" type="submit" value="Thêm Ngày Học">

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