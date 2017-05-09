@extends('layouts.master')
@section('content')
<!-- Page Content -->
       
<!-- /.col-lg-12 -->
<?php
include(app_path().'/xcrud/xcrud.php'); 
include(app_path().'/xcrud/functions.php');
echo Xcrud::load_css();
echo Xcrud::load_js();
?>
 @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-lg-12">
    <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-speech font-green"></i>
                    <span class="caption-subject bold font-green uppercase">Ghi danh học sinh</span>
                </div>                
            </div>
            <div class="portlet-body">
                <form role="form" action="{{url('/postEnroll')}}" method="POST">
                    <input type="hidden" name="_token" value= "{{csrf_token()}}">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="bold font-red">THÔNG TIN HỌC SINH</label>
                            <div class="form-group" id="studentName">
                                <label class="control-label">Tên học sinh*</label>

                                <input type="text" id="student-search" placeholder="Nhập tên" class="form-control typeahead" name="firstName"> </div>
                            <div class="form-group">
                                <label class="control-label">Họ đệm*</label>
                                <input type="text" placeholder="Nhập họ đệm" class="form-control" name="lastName"> </div>
                            
                            <div class="form-group">
                                <label class="control-label">Ngày sinh</label>
                                <input type="text" placeholder="Ngày sinh" class="form-control date-picker" name="dob" id="dob"> </div>
                            <div class="form-group">
                                <label class="control-label">Giới tính</label>
                                <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="gender" id="optionsRadios4" value="Nam" checked=""> Nam
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="gender" id="optionsRadios5" value="Nữ"> Nữ
                                    <span></span>
                                </label>                        
                            </div></div>
                            
                            <div class="form-group">
                                <label class="control-label">Trường</label>
                                <input type="text" placeholder="Trường đang học" class="form-control" name="school"> </div>
                            <div class="form-group">
                                <label class="control-label">Họ tên phụ huynh</label>
                                <input type="text" placeholder="Họ và tên" class="form-control" name="name"> </div>
                            <div class="form-group">
                                <label class="control-label">Số điện thoại phụ huynh*</label>
                                <input id="parent-search" type="text" placeholder="+84" class="form-control" name="phone"> </div>
                            <div class="form-group">
                                <label class="control-label">Email phụ huynh</label>
                                <input type="email" placeholder="Email" class="form-control" name="email"> </div>
                        </div>
                        <div class="col-md-8">
                            <label class="bold font-red">NGUYỆN VỌNG ĐẦU VÀO</label>
                    <div class="form-group mt-repeater">
                        <div data-repeater-list="nguyenvong">
                            <div data-repeater-item="" class="mt-repeater-item">                           
                                <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">Môn học*</label>
                                            <input type="text" name="subject" placeholder="Toán Chuyên, Anh Chuyên..." class="form-control mt-repeater-input-inline">                                      
                                        </div>
                                        <div class="col-md-2">
                                            <label class="control-label">Khối lớp*</label>
                                            <input type="number" name="class" placeholder="" class="form-control mt-repeater-input-inline">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Hẹn ngày KT*</label>
                                            <input type="text" name="date" placeholder="" class="form-control mt-repeater-input-inline timepicker-no-seconds">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Ghi chú</label>
                                            <textarea name="note" class="form-control" rows="3" placeholder="Ghi chú ghi danh"></textarea>
                                        </div>

                                        <div class="col-md-1">
                                            <a href="javascript:;" data-repeater-delete="" class="btn btn-danger mt-repeater-delete">
                                                        <i class="fa fa-close"></i> </a>        
                                        </div>                     
                                    </div>                               
                            </div>
                        </div>
                        <a href="javascript:;" data-repeater-create="" class="btn btn-success mt-repeater-add">
                            <i class="fa fa-plus"></i> Thêm nguyện vọng </a>
                        </div>
                    </div>

                    
                    </div>
                    <div class="margin-top-10">
                        <button class="btn green" type="submit">Ghi danh</button>
                    </div>
                </form>
            </div>
        </div>
        
</div>
<link href="{{asset('assets/global/plugins/typeahead/typeahead.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>        <!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/form-repeater.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-date-time-pickers.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<!-- /#page-wrapper -->   
<script type="text/javascript">
    function initTypeahead(id, u){
        $(id).typeahead({
          source: function(query, process){
            $.ajax({
                url: u,
                method: "GET",
                data: "query= "+ query,
                dataType: "json",
                success: function(data){
                    if(id === '#student-search'){
                        var show =$.map(data, function (item) {
                            return item.id +" | "+item.name + " | "+ item.school;                            
                        });
                        var dob = $.map(data, function (item) {
                            return item.dob;                            
                        });
                        
                        return process(show);
                    }
                    return process(data);
                }
            })
          }
          
        });
    }
    $(document).ready(function(){
        $('#ghidanh-0').addClass('open active');
        $('#ghidanh-0-1').addClass('open active');
        initTypeahead('#student-search',"{{url('/searchStudent')}}");
        initTypeahead('#parent-search',"{{url('/searchParent')}}");        
    })    


</script>   

@endsection()