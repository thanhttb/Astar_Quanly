@extends('layouts.master')
@section('content')
         <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
<?php
		include(app_path().'/xcrud/xcrud.php');
		include(app_path().'/xcrud/functions.php');
        echo Xcrud::load_css();
        echo Xcrud::load_js(); ?>


<div class="row">
<div class="col-md-12">
<div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="34500">1</span> VND
                    </div>
                    <div class="desc">Thực thu</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="90">1</span>% </div>
                    <div class="desc"> %Truy thu tháng 2-3 </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="21">1 </span> Hs
                    </div>
                    <div class="desc">Quá hạn</div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                <div class="visual">
                    <i class="fa fa-globe"></i>
                </div>
                <div class="details">
                    <div class="number"> 
                        <span data-counter="counterup" data-value="-5000000">-1</span> VND </div>
                    <div class="desc"> Top1 Quá hạn: Khánh Linh </div>
                </div>
            </a>
        </div>
    </div>	   
    <div class="portlet light portlet-fit portlet-datatable bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject font-dark sbold uppercase">Giao dịch tổng</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm active">
                        <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                    <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm">
                        <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                </div>
                <div class="btn-group">
                    <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                        <i class="fa fa-share"></i>
                        <span class="hidden-xs"> Tools </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;"> Export to Excel </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Export to CSV </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Export to XML </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="javascript:;"> Print Invoices </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <div class="table-actions-wrapper">
                    <span> </span>
                    <select class="table-group-action-input form-control input-inline input-small input-sm">
                        <option value="">Select...</option>
                        <option value="Cancel">Cancel</option>
                        <option value="Cancel">Hold</option>
                        <option value="Cancel">On Hold</option>
                        <option value="Close">Close</option>
                    </select>
                    <button class="btn btn-sm green table-group-action-submit">
                        <i class="fa fa-check"></i> Submit</button>
                </div>
                <table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>Thời hạn từ ngày:</td>
            <td>
            	<input type="text" id="min" name="min">
			</td>
        </tr>
        <tr>
            <td>Thời hạn đến ngày:</td>
            <td><input type="text" id="max" name="max"></td>
        </tr>
    </tbody></table><table id="transaction" class="display table-checkable" cellspacing="0" width="100%">
        <thead>
            <tr>
            	<th>Id</th>
                <th>Học sinh</th>
                <th>Ngày sinh</th>
                <th>Phụ huynh</th>
                <th>Lớp</th>
                <th>Ngày học</th>
                <th>Số tiền</th>
                <th>Balance</th>
                <th>Thời hạn</th>
                <th>Ghi chú</th>
                <th>Related</th>
                
                <th>Người tạo</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
            	<th>Id</th>
                <th>Học sinh</th>
                <th>Ngày sinh</th>
                <th>Phụ huynh</th>
                <th>Lớp</th>
                <th>Ngày học</th>               
                <th>Số tiền</th>
                <th>Balance</th>
                <th>Thời hạn</th>
                <th>Ghi chú</th>
                <th>Related</th>
                <th>Người tạo</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($allTransaction as $transaction)
            	@if($transaction['day'] < date('Y-m-d') && is_null($transaction['rel_id']))
            	<tr class="bg-red-intense">
            	@else
            	<tr>
            	@endif
            		<td>{{$transaction['id']}}</td>
            		<td>{{$transaction['studentInfo']['lastName']}} {{$transaction['studentInfo']['firstName']}}</td>
            		<td>{{$transaction['studentInfo']['dob']}}</td>
            		<td>{{$transaction['parentInfo']['name']}}</td>
            		<td>{{$transaction['classInfo']['name']}}</td>
            		<td>{{$transaction['lessonInfo']['start_time']}}</td>
            		<td>{{$transaction['amount']}}</td>
            		<td>{{$transaction['balance']}}</td>
            		<td>{{$transaction['day']}}</td>

            		<td>{{$transaction['note']}}</td>
            		<td>{{$transaction['rel_id']}}</td>
            		<td>{{$transaction['user']}}</td>
            	</tr>

            @endforeach
        </tbody>
    </table>

            </div>
        </div>
    </div>
    </div>
    </div>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	
	$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var dateMin = Date.parse($('#min').val());
        var dateMax = Date.parse($('#max').val());
        var date = Date.parse(data[7]) || 0; // use data for the age column
        if ( ( isNaN( dateMin ) && isNaN( dateMax ) ) ||
             ( isNaN( dateMin ) && date <= dateMax ) ||
             ( dateMin <= date   && isNaN( dateMax ) ) ||
             ( dateMin <= date   && date <= dateMax ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#transaction').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );
</script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/pages/scripts/table-datatables-ajax.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>

@endsection