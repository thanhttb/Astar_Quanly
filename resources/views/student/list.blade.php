
@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css"> 
.table-scrollable{
    height: 1000px;
    overflow: scroll;
}
</style>
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
                    <div class="portlet-body scrollable">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="ds-hocsinh" width="100%">
                            <thead>
                                <tr>
                                    <th width="15%">Họ tên</th>
                                    <th width="5%">Ngày sinh</th>
                                    <th width="5%">Trường</th>
                                    <th>Họ tên phụ huynh</th>
                                    <th>SĐT PH</th>
                                    <th>Email PH</th>
                                    <th>Lớp</th>
                                    @foreach($debts as $periods)
                                    <th>{{$periods['name']}}</th>
                                    @endforeach
                                    <th>Điểm KTĐK</th>
                                    <th>Nhận xét</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th width="15%">Họ tên</th>
                                    <th width="5%">Ngày sinh</th>
                                    <th width="5%">Trường</th>
                                    <th>Họ tên phụ huynh</th>
                                    <th>SĐT PH</th>
                                    <th>Email PH</th>
                                    <th>Lớp</th>
                                    @foreach($debts as $periods)
                                    <th>{{$periods['name']}}</th>
                                    @endforeach
                                    <th>Điểm KTĐK</th>
                                    <th>Nhận xét</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($classes as $key => $class)
                                    @foreach($class['detail'] as $k => $students)

                                        <tr <?php if($students['count'] > '1') echo "style = 'background-color: #bcf442;'"; ?>>
                                            <td>{{$students[0]['lastName']." ".$students[0]['firstName']}}</td>
                                            <td>{{$students[0]['dob']}}</td>
                                            <td>{{$students[0]['school']}}</td>                                            
                                            <td>{{$students[0]['name']}}</td>
                                            <td>{{$students[0]['p_phone']}}</td>
                                            <td>{{$students[0]['p_email']}}</td>
                                            <td>{{$class['name']}}</td>
                                             @foreach($debts as $periods)
                                                <td>{{$students['tuition'][$periods['period_id']]}}</td>
                                             @endforeach
                                            <td><?php print_r(empty($students['result'][0]) ? '': $students['result'][0]['score'])  ?></td>
                                            <td><?php print_r(empty($students['result'][0]) ? '': $students['result'][0]['comment'])  ?></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                
                            </tbody>
                        </table>    
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
<script src="{{ asset('assets/pages/scripts/student.js')}}" type="text/javascript"></script>     
<script type="text/javascript">
    $(document).ready(function(){
        $("#hocsinh-0").addClass('open active');
        $("#hocsinh-1").addClass('open active');
    });
</script>
@endsection