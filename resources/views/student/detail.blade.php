@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
	<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
            </div>
            <!-- /.col-lg-12 -->
            <?php
            include(app_path().'/xcrud/xcrud.php'); 
            include(app_path().'/xcrud/functions.php');
            echo Xcrud::load_css();
            echo Xcrud::load_js();
             function asVnd($value){
		        return number_format($value,'0','','.')."đ";
		    }
            ?>
        	<div class="row">
        		<span class="caption-subject bold uppercase"></span>
        		<div class="col-md-6">
        			<div class="portlet light bordered">
	                    <div class="portlet-title">
	                        <div class="caption font-dark">
	                            <i class="icon-settings font-dark"></i>
	                            <span class="caption-subject bold">Các lớp đang theo học</span>
	                        </div>
	                        <div class="tools"> </div>
	                    </div>
	                    <div class="portlet-body">
	                        <table class="table table-striped table-bordered table-hover dt-responsive" id="table" width="100%">
	                            <thead>
	                                <tr>
	                                    <th width="10%">Lớp</th>
	                                    <th width="20%">Ngày bắt đầu</th>
	                                    <th>Cân đối</th>
	                                    <th width="40%">Ghi chú</th>
	                                    <th width="5%">Thôi học</th>
	                                    <th width="5%">Chuyển lớp</th>
	                                    
	                                </tr>
	                            </thead>
	                            
	                            <tbody>
	                                @foreach($active_class as $class)
	                                    <tr>
	                                        <td>{{$class->name}}</td>
	                                        <td>{{$class->firstDay}}</td>
	                                        <td style="text-align: right;">{{asVnd(-$class->balance)}}</td>
	                                        <td>{{$class->note}}</td>
	                                        <td><a href="{{route('getDropout',$class->id)}}">Thôi học</a></td>
	                                        <td><a href="{{route('getSwitch',$class->id)}}">Chuyển lớp</a></td>
	                                    </tr>
	                                
	                                @endforeach
	                                
	                            </tbody>
	                        </table>    
	                    </div>
                </div> 
        		</div>
        		<div class="col-md-6">
        			<div class="portlet light bordered">
	                    <div class="portlet-title">
	                        <div class="caption font-dark">
	                            <i class="icon-settings font-dark"></i>
	                            <span class="caption-subject bold">Hồ sơ học sinh</span>
	                        </div>
	                        <div class="tools"> </div>
	                    </div>
	                    <div class="portlet-body">
	                        <table class="table table-striped table-bordered table-hover dt-responsive" id="" width="100%">
	                            <thead>
	                                <tr>
	                                    <th width="20%">Họ tên</th>
	                                    <th width="5%">Ngày sinh</th>
	                                    <th width="5%">Giới tính</th>
	                                    <th width="5%">Trường</th>  
	                                    
	                                </tr>
	                            </thead>
	                            	
	                            <tbody>
	                                <tr>
	                                	<td>{{$student->lastName." ".$student->firstName}}</td>
	                                	<td>{{$student->dob}}</td>
	                                	<td>{{$student->gender}}</td>
	                                	<td>{{$student->class}}</td>
	                                </tr>
	                                
	                            </tbody>
	                        </table>    
	                    </div>
                </div> 
        		</div>
        	</div>
            
                
            
        </div>
        <!-- /.row -->
    </div>
<!-- /#page-wrapper -->       
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/table-datatables-buttons.js')}}" type="text/javascript"></script>     
<script type="text/javascript">
    $(document).ready(function(){
        $("#hocsinh-0").addClass('open active');
        $("#hocsinh-1").addClass('open active');
    });
</script>
@endsection