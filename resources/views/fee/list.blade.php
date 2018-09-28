
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
            $addnew->table('fees');
            $addnew->table_name('Thêm phí');
            $addnew->relation('account_id','accounts','id', array('type','name','dob')); 
            echo $addnew->render("list");    	
            
                
            ?>
        </div>

<script type="text/javascript">
$(document).ready(function() {
  
  $("#lophoc-0").addClass('open active');
  $("#lophoc-4").addClass('open active');
});
</script>

                   
@endsection()