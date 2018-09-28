@extends('layouts.master')
@section('content')
<?php 
  include(app_path().'/xcrud/xcrud.php'); 
  include(app_path().'/xcrud/functions.php');
  echo Xcrud::load_css();
  echo Xcrud::load_js();
 ?>
         <link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
         <link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}">
 <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Thêm ngày học</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"> </a>
                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                <a href="javascript:;" class="reload"> </a>
                                <a href="javascript:;" class="remove"> </a>
                            </div>
                        </div>
 <div class="portlet-body form">
    <div class="form-body">
        <div class="form-group">
          <form class="mt-repeater form-horizontal" method="POST" action="{!! URL::route('postLesson',$id)!!}" >
            <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div data-repeater-list="group">
                    <div data-repeater-item class="mt-repeater-item">
                        <!-- jQuery Repeater Container -->
                        <div class="mt-repeater-input">
                            <label class="control-label">Ngày giờ học</label>
                            <br/>
                            <input type="text" name="ngayhoc" class="form-control date form_datetime"  /> </div>
                         <div class="mt-repeater-input">
                            <label class="control-label">Ngày tan học</label>
                            <br/>
                            <input type="text" name="tanhoc" class="form-control date form_datetime"  /> </div>   
                        <div class="mt-repeater-input">
                            <label class="control-label">Giáo viên</label>
                            <br/>
                            <select class="basic-single" name="giaovien" style="width: 200px;" >
                              @foreach($teachers as $tec)
                                <option value="{!!$tec['id']!!}">{!!$tec['name']!!}</option>

                              @endforeach
                            </select> 
                        </div>
                        <div class="mt-repeater-input">
                            <label class="control-label">Hạn đóng tiền</label>
                            <br/>
                            <input type="text" name="dueDate" class="form-control date form_datetime"  /> 
                        </div>
                        
                        <div class="mt-repeater-input mt-repeater-textarea">
                            <label class="control-label">Học phí</label>
                            <br/>
                        <input type="number" class="input-group form-control form-control-inline" name="tuition">
    
                        </div>
                        <div class="mt-repeater-input mt-radio-inline">
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
</div>

<script type="text/javascript">
$(document).ready(function() {
  $(".basic-single").select2();
  
});
</script>

        
        <link href="{{ asset('select2-4.0.3/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"></link> 
        <link href="{{ asset('select2-4.0.3/select2-bootstrap-css-master/docs/select2-bootstrap.css')}}" rel="stylesheet" type="text/css"></link> 

        <script src="{{ asset('select2-4.0.3/dist/js/select2.full.js') }}"></script> 
        <script src="{{asset('assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/form-repeater.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/components-date-time-pickers.min.js')}}" type="text/javascript"></script>
@endsection