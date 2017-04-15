
@extends('layouts.master')
@section('content')
	<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
            </div>
            <!-- /.col-lg-12 -->
            <?php
            include(app_path().'\xcrud\xcrud.php'); 
            include(app_path().'\xcrud\functions.php');
            echo Xcrud::load_css();
            echo Xcrud::load_js();
            
            $listUser = Xcrud::get_instance();
            $listUser->table('users');
            $listUser->table_name('Danh sách Nhân viên');
            $listUser->columns(array('name', 'email','phone','address'));
            
            
            $listUser->column_callback('name','profile');
            echo $listUser->render();

                
            ?>
        </div>
        <!-- /.row -->
    </div>
<!-- /#page-wrapper -->            
@endsection()