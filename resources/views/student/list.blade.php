
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
            ?>
            <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Danh sách học sinh</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%">Họ đệm</th>
                                    <th width="5%">Tên</th>
                                    <th width="5%">Ngày sinh</th>
                                    <th width="5%">Giới tính</th>
                                    <th width="5%">Trường</th>
                                    <th>Lớp</th>
                                    <th>Email HS</th>
                                    <th>SĐT HS</th>
                                    <th>Họ tên phụ huynh</th>
                                    <th>SĐT PH</th>
                                    <th>Email PH</th>
                                    <th>Nơi công tác</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th width="10%">Họ đệm</th>
                                    <th width="5%">Tên</th>
                                    <th width="5%">Ngày sinh</th>
                                    <th width="5%">Giới tính</th>
                                    <th width="20%">Trường</th>
                                    <th width="5%">Lớp</th>
                                    <th>Email HS</th>
                                    <th>SĐT HS</th>
                                    <th>Họ tên phụ huynh</th>
                                    <th>SĐT PH</th>
                                    <th>Email PH</th>
                                    <th>Nơi công tác</th>
                                    
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($students as $std)
                                    <tr>
                                        <td><a href="{{route('detailStudent',$std->std_id)}}">{{$std->lastName}}</a></td>
                                        <td>{{$std->firstName}}</td>
                                        <td>{{is_null($std->dob)? "0" : date('d/m/Y',strtotime($std->dob))}}</td>
                                        <td>{{$std->gender}}</td>
                                        <td>{{$std->school}}</td>
                                        <td>{{$std->class}}</td>
                                        <td>{{$std->std_email}}</td>
                                        <td>{{$std->std_phone}}</td>
                                        <td>{{$std->name}}</td>
                                        <td>{{$std->p_phone}}</td>
                                        <td>{{$std->p_email}}</td>
                                        <td>{{$std->work}}</td>
                                    </tr>
                                
                                @endforeach
                                
                            </tbody>
                        </table>    
                    </div>
                </div> 
            
                
            ?>
        </div>
        <!-- /.row -->
    </div>
<!-- /#page-wrapper -->       
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/table-datatables-buttons.js')}}" type="text/javascript"></script>     
@endsection