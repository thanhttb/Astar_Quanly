@extends('layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
    .money{
        text-align: right;
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
            
            function asVnd($value){
                return number_format($value,'0','','.');
            }             
            ?>

            <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Danh sách thu chi theo ngày</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="4" style="text-align: center;">Phiếu thu</th>  
                                    <th colspan="4" style="text-align: center;">Phiếu chi</th>

                                </tr>
                                <tr>
                                    <th>Ngày</th>
                                    <th>Tiền mặt</th>
                                    <th>Vietcombank</th>
                                    <th>Techcombank</th>
                                    <th>Tổng</th>
                                    <th>Tiền mặt</th>
                                    <th>Vietcombank</th>
                                    <th>Techcombank</th>
                                    <th>Tổng</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th colspan="4" style="text-align: center;">PHIẾU THU</th>  
                                    <th colspan="4" style="text-align: center;">PHIẾU CHI</th>

                                </tr>
                                <tr>
                                    <th>Ngày</th>
                                    <th>Tiền mặt</th>
                                    <th>Vietcombank</th>
                                    <th>Techcombank</th>
                                    <th>Tổng</th>                                    
                                    <th>Tiền mặt</th>
                                    <th>Vietcombank</th>
                                    <th>Techcombank</th>
                                    <th>Tổng</th>

                                </tr>
                            </tfoot>
                            <tbody style="font-weight: normal;">
                                @foreach($rc as $key => $value)
                                    <tr>
                                        <td>{{date('d/m/Y',strtotime($key))}}</td>
                                        <td class="money" id="r_cash">{{asVnd($value['r_cash'])}}</td>
                                        <td  class="money" id="r_vcb">{{asVnd($value['r_vcb'])}}</td>
                                        <td class="money" id="r_tcb">{{asVnd($value['r_tcb'])}}</td>
                                        <td class="money" id="r_tong">{{asVnd($value['r_cash'] + $value['r_vcb'] + $value['r_tcb'])}}</td>
                                        <td class="money" id="p_cash">{{asVnd($value['p_cash'])}}</td>
                                        <td class="money" id="p_vcb">{{asVnd($value['p_vcb'])}}</td>
                                        <td class="money" id="p_tcb">{{asVnd($value['p_tcb'])}}</td>
                                        <td class="money" id="p_total">{{asVnd($value['p_vcb'] + $value['p_cash'] + $value['p_tcb'])}}</td>
                                    </tr>
                                                                    
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
<script src="{{ asset('assets/pages/scripts/table-datatables-buttons.js')}}" type="text/javascript"></script>     
<script type="text/javascript">
    $(document).ready(function(){
        $("#thuchi-0").addClass('open active');
        $("#thuchi-6").addClass('open active');
    });

</script>
@endsection
