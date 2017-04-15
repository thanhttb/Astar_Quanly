
@extends('layouts.master')
@section('content')
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
            
            $listTeacher = Xcrud::get_instance();
            $listTeacher->table('accounts')->where('type',$type);
            $listTeacher->join('accounts.id','teachers','acc_id');

            if($type == 4) $listTeacher->table_name('Danh sách Giáo viên');
            if($type == 5) $listTeacher->table_name('Danh sách Trợ giảng');
            $listTeacher->columns(array('teachers.name', 'teachers.gender','accounts.dob','teachers.school','teachers.phone','teachers.email','teachers.bank_account','teachers.rank'));
            $listTeacher->fields('teachers.name, accounts.name, teachers.gender,accounts.dob, teachers.school,teachers.phone,teachers.email,teachers.bank_account,teachers.rank');
            $listTeacher->label(array('name'=>'Tên tài khoản','teachers.name'=>'Họ vào tên','teachers.gender'=>'Giới tính','accounts.dob'=>'Ngày sinh','teachers.school'=>'Nơi công tác',
                                    'teachers.phone'=>'Số điện thoại','teachers.bank_account'=>'TK ngân hàng', 'teachers.rank' => 'Hệ số lương'));
            
            $listTeacher->pass_var('dob', date('Y-m-d'));
            $listTeacher->pass_var('type', $type);
            $listTeacher->pass_var('balance', 0);
            $listTeacher->column_callback('name','teacher_detail');
            echo $listTeacher->render('list');

                
            ?>
        </div>
        <!-- /.row -->
    </div>
<!-- /#page-wrapper -->            
@endsection()