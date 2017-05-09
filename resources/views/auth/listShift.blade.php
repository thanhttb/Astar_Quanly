@extends('layouts.master')
@section('content')
<?php
    include(app_path().'/xcrud/xcrud.php');
    include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js(); ?>
<div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Danh sách</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>            
                <a href="javascript:;" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
           <?php
                $r = Xcrud::get_instance();
                $r->table('shift');
                $r->join('user_id','users','id');
                $r->table_name('Ca trực nhân viên');
                $r->order_by('checkin_time','desc');
                $r->columns('shift.id,users.name,checkin_time,checkin_note,checkout_time,checkout_note');
                $r->label(['users.name'=>'Nhân viên','checkin_time'=>'Giờ bắt đầu','checkin_note'=>'Ghi chú check-in','checkout_time'=>'Giờ kết thúc','checkout_note'=>'Ghi chú check-out']);
                // $r->subselect('Số ngày làm','SELECT COUNT(*) FROM shift WHERE orderNumber = {orderNumber}'); // insert as last column

                echo $r->render('list');

            ?>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#nhanvien-0").addClass('open active');
            $("#nhanvien-4").addClass('open active'); 
    });</script>
@endsection