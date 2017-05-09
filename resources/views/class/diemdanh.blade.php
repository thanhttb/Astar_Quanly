 @extends('layouts.master')
@section('content')
<?php 
	include(app_path().'/xcrud/xcrud.php');
	include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js(); 
 ?>
<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<div class="portlet light bordered">
        <div class="portlet-body form">
            <form class="form-horizontal" role="form" action="{{url('postAttendance')}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-body">
                    <div class="col-md-12">
                        <div class="form-group col-md-3">
                            <label>Chọn Lớp</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-sticky-note-o"></i>
                                </span>
                                <select id="class" class="form-control input-lg select2" name="class" >
                                        @foreach($classes as $class)
                                        	<option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach        
                                </select>
                            </div>
                        </div>  
                        <div class="form-group col-md-3">
                            <label>Chọn ngày học</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                </span>
                                <input type="text" class="form-control tuition date-picker" name="lesson" value="{{date('d-m-Y')}}"> 
                            </div>
                        </div>  
                        <div class="form-group col-md-3">
                            <label>Giáo viên</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-hand-spock-o"></i>
                                </span>
                                <select id="teacher" class="form-control input-lg select2" name="teacher">
                                        @foreach($teachers as $teacher)
                                        	<option value="{{$teacher->id}}">{{$teacher->name. "|". $teacher->school}}</option>
                                        @endforeach        
                                </select>
                            </div>
                        </div>  
                        <div class="form-group col-md-3">
                            <label>Ghi chú</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-money"></i>
                                </span>
                                <input type="text" class="form-control total" placeholder="" id="total" name="note"> 
                            </div>
                        </div>  
                    </div>
                    
                </div>
                <div class="porlet-body">
                     <div class="portlet light" id="diemdanh">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-paper-plane font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">Điểm danh </span>
                                <span class="caption-helper"></span>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                <a href="javascript:;" id="load-student" data-load="true" data-url="" class="reload" data-original-title="" title=""> </a>
                                <a href="javascript:;" class="fullscreen" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                        
                           </div>
                    </div>    
                    
                    
                </div>                                          
                
            </form>
        </div>
    </div>
<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/components-select2.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function() {
        $('.date-picker').datepicker({
                rtl: App.isRTL(),
                orientation: "left",
                autoclose: true,
                format: 'd-m-yyyy'
            });
          $("#lophoc-0").addClass('open active');
         $("#lophoc-2").addClass('open active');
    });
    

	var PortletAjax = function () {
	        var handlePortletAjax = function () {
                //custom portlet reload handler
                $('#diemdanh .portlet-title a.reload').click(function(e){
                   
                })
            }
            return {
                //main function to initiate the module
                init: function () {
                    handlePortletAjax();
                }

            };
	    }();
	    $('#class').on( 'select2:select', function (e) {

	        $("#load-student").attr("data-url", "/astar/searchStudent/"+$('#class').val());
	        PortletAjax.init();
        	$('#load-student')[0].click();

	    });
</script>



@endsection