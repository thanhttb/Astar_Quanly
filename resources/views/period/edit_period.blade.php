
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
            $addnew->table('periods');
            $addnew->table_name('Thêm chu kỳ');
            $addnew->fields('id, name, months, year');

            $addnew->label(array('id'=>'id', 'name'=>'Tên chu kỳ','months'=>'Tháng','year'=>'Năm'));
            $addnew->change_type('months','multiselect','default_value',['1'=>'Tháng 1','2'=>'Tháng 2','3'=>'Tháng 3','4'=>'Tháng 4','5'=>'Tháng 5','6'=>'Tháng 6','7'=>'Tháng 7', '8'=>'Tháng 8','9'=>'Tháng 9','10'=>'Tháng 10','11'=>'Tháng 11','12'=>'Tháng 12']);
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