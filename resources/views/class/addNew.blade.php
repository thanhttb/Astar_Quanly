
@extends('layouts.master')
@section('content')
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
            $addnew = Xcrud::get_instance();
            $addnew->table('accounts');
            $addnew->table_name('Thêm lớp');
            $addnew->join('accounts.id','classes','acc_id');
            $addnew->fields('classes.name, accounts.name , classes.class,classes.teacher,classes.day,classes.startTime,classes.endTime,classes.tuition');
            $addnew->columns('classes.name , classes.class,classes.teacher,classes.day,classes.startTime,classes.endTime,classes.tuition, accounts.dob, accounts.balance');
            $addnew->label(array('dob'=>'Ngày mở lớp','classes.name'=>'Tên lớp','accounts.name' => 'Tên tài khoản lớp','classes.class'=>'Khối','classes.teacher'=>'Giáo viên','classes.day'=>'Ngày học','classes.startTime'=>'Giờ bắt đầu','classes.endTime'=>'Giờ kết thúc','classes.tuition'=>'Học phí'));
            $addnew->pass_var('dob', date('Y-m-d'));
            $addnew->pass_var('type', 3);
            $addnew->pass_var('balance', 0);
            echo $addnew->render("list");    	
            
                
            ?>
        </div>
                   
@endsection()