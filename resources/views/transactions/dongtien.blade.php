@extends('layouts.master')
@section('content')
         <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<?php
	include(app_path().'/xcrud/xcrud.php');
	include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js();
    function asVnd($value){
        return number_format($value,'0','','.')."đ";
    }
    $total = 0;
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet box purple">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cogs"></i>Hồ sơ học sinh</div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body" style="display: block;">
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="width:300 !important"> Họ đệm </th>
                            <th scope="col"> Tên </th>
                            <th scope="col"> Ngày sinh </th>
                            <th scope="col"> Giới tính </th>
                            <th scope="col"> Trường </th>
                            <th scope="col"> Lớp </th>
                            <th scope="col"> Email </th>
                            <th scope="col"> Điện thoại </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                        </tr>
                    </tbody>
                </table>
                <div style="height: 10px;"></div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col" style="width:300 !important"> Họ tên phụ huynh </th>
                            <th scope="col"> Số điện thoại </th>
                            <th scope="col"> Email </th>
                            <th scope="col"> Nơi công tác </th>
                            <th scope="col"> Địa chỉ </th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                                        
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box red-sunglo">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Điểm danh & Thu học phí</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body">
                <p>
                    <strong>Kết quả học tập định kỳ tháng 2</strong>
                    <br>Tổng kết: 4/10
                    <br>Nhận xét: Thông minh nhưng lười học + hay nói chuyện riêng. Cần thông báo cho phụ huynh! </p>
                
                    
                <div class="row">
                    <div class="col-md-6">
                        <div class="portlet box red">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Điểm danh tổng </div>
                                <ul class="nav nav-tabs">
                                     <li>
                                        <a href="#portlet_tab_1" data-toggle="tab" aria-expanded="false">{{111}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN Portlet PORTLET-->
                        <div class="portlet solid grey-cascade">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Học phí tháng</div>
                                <div class="actions">
                                    <a href="javascript:;" class="btn default btn-sm">
                                        <i class="fa fa-pencil icon-black"></i> Edit </a>
                                    <div class="btn-group">
                                        <a class="btn btn-sm red" href="javascript:;" data-toggle="dropdown">
                                            <i class="fa fa-user"></i> User
                                            <i class="fa fa-angle-down "></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-pencil"></i> Edit </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-trash-o"></i> Delete </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <i class="fa fa-ban"></i> Ban </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;"> Make admin </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body"> 
                                <table class="table table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr class="heading">
                                            <th>Lớp</th>
                                            <th>Số ca học</th>
                                            <th>Học phí</th> 
                                            <th>Discount</th>
                                            <th>Số dư kỳ trước</th>     
                                            <th>Phụ phí</th>                                                  
                                            <th>Cần đóng</th>
                                            <th>Đã đóng</th>
                                            <th>Số dư kỳ này</th>
                                        </tr>
                                    </thead>                                                
                                    <tbody>
                                           
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- END GRID PORTLET-->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>

</div>
<div class="row">

<div class="col-md-12">
    <!-- END GRID PORTLET-->

    <div class="portlet light portlet-fit portlet-datatable bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-dark"></i>
                <span class="caption-subject font-dark sbold uppercase">Giao dịch của em {{$stdTransaction[0]['studentInfo']['lastName']}} {{$stdTransaction[0]['studentInfo']['firstName']}}</span>
            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Thêm giao dịch</button>
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
                	<input type="text" id="min" name="min" class="form-control datepicker">
    			</td>
            </tr>
            <tr>
                <td>Thời hạn đến ngày:</td>
                <td><input type="text" id="max" name="max" class="form-control datepicker"></td>
            </tr>
        </tbody>
    </table>
    <form action="#" method="POST" >
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <table id="transaction" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr class="heading">
                <th width="2%" class="th-header-center"><input name="select_all" value="1" id="select-all" type="checkbox" /></th>
                <th width="9%">ID</th>                    
                <th width="5%">LỚP</th>
                <th width="8%">NGÀY HỌC</th>               
                <th width="11%">SỐ TIỀN</th>
                <th width="11%">BALANCE</th>
                <th width="8%">THỜI HẠN</th>
                <th width="20%">GHI CHÚ</th>
                <th width="10%">Related</th>
                <th width="8%">NGÀY TẠO</th>
                <th width="7%">NGƯỜI TẠO</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
        <tbody id="body-transaction">
           
            
        </tbody>
    </table>  
    </form>
    

            </div>
        </div>
    </div>
    </div>
    </div>

<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Thêm giao dịch</h4>
    </div>
    <div class="modal-body">
        <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">
            <input type="hidden" id="student_id" value="{{$id}}">
            <div class="form-group error">
                <label for="inputClass" class="col-sm-3 control-label">Nội dung</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control has-error" id="note" name="note" placeholder="Nội dung giao dịch" value="">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Số tiền</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="vnđ" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Thời hạn(Nếu có)</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control datepicker" id="day" name="day" placeholder="Thời hạn" value="">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Loại</label>
                <div class="col-sm-9">
                    <select id="type" class="form-control" name="type">
                        <option value="2">Học bổng</option>
                        <option value="-2">Phụ phí</option>
                        <option value="1">Thu tiền học</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save" value="add">Thêm giao dịch</button>
        <input type="hidden" id="class_id" name="class_id" value="0">
    </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />

<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>

<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>

<script type="text/javascript">
	
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {

        var dateMin = Date.parse($('#min').val());
        var dateMax = Date.parse($('#max').val());
        var date = Date.parse(data[3]) || 0; // use data for the age column
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
    var diemdanh = $('#atd1').DataTable({

    });
    var diemdanh = $('#atd2').DataTable({

    });
    var diemdanh = $('#atd3').DataTable({

    });

    var table = $('#transaction').DataTable({
        'order': [1, 'asc'],
        "columnDefs": [ {
          "targets": 0,
          "searchable": false,
          'orderable':false,
          'className': 'dt-body-center'
        } ],
        buttons: [
            { extend: 'print', className: 'btn dark btn-outline' },
            { extend: 'copy', className: 'btn red btn-outline' },
            { extend: 'pdf', className: 'btn green btn-outline' },
            { extend: 'excel', className: 'btn yellow btn-outline ' },
            { extend: 'csv', className: 'btn purple btn-outline ' },
            { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
        ],
        "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[/$,đ.]/g , '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 4 ).footer() ).html(
                'Sum: '+pageTotal +'vnd' +' ('+ total +'vnd total)'
            );
        }
    });
     
    // Event listener to the two range filtering inputs to redraw on input
    
    $('#select-all').on('click', function(){
          // Check/uncheck all checkboxes in the table
          var rows = table.rows({ 'search': 'applied' }).nodes();
          $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });
    $('#example tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
    $('#transaction tbody').on( 'click', 'tr', function () {
    });
    $('.datepicker').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true
    });

    $('#min, #max').keyup( function() {
        table.draw();
    });


    //ADD TRANSACTION
    //URL FOR AJAX

    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('show');
    });

    $('#btn-save').click(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 
        var formData = {
            note: $('#note').val(),
            amount: $('#amount').val(),
            day: $('#day').val(),
            type: $('#type').val()
        };
        var id = $('#student_id').val();
        var my_url = '/astar/addTransaction/' + id;
        var state = "add";
        console.log(my_url);
        $.ajax({

            type: 'POST',
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var row = '<tr id="transaction' + data.id + '"><td></td><td>'+ data.id + '</td><td></td><td></td><td>' + data.amount + '</td><td>'+data.balance+ '</td><td>' + data.day + '</td><td>' +data.note + '</td><td>' + data.rel_id+ '</td><td>' + data.created_at + '</td><td>' + data.user + '/td';
                

                if (state == "add"){ //if user added a new record
                    $('#body-transaction').append(row);
                }
                $('#frmTasks').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    });

});


</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->

<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->


@endsection