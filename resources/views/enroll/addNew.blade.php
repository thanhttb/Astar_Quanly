
@extends('layouts.general')
@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
            </div>
            <!-- /.col-lg-12 -->
            <?php
            require('C:\xampp\htdocs\quanly\resources\views\xcrud\xcrud.php');
                //echo Xcrud::load_css();
                echo Xcrud::load_js();
                $addnew = Xcrud::get_instance();
                $addnew->table('enrolls');
                
                echo $addnew->render("create");
            ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>



<!-- /#page-wrapper -->            
@endsection()