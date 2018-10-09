
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
            $addnew = Xcrud::get_instance();
            $addnew->table('classes');
            $addnew->table_name('Thêm lớp');
            $addnew->label(array('id'=> 'ID','name'=>'Tên lớp','classes.teacher'=>'Giáo viên','classes.time'=>'Ngày học','classes.tuition'=>'Học phí','classes.numerator'=>'Sĩ số','classes.status'=>'Trạng thái','classes.base_id'=>'Cơ sở'));

            $addnew->change_type('classes.tuition','price','',['decimals' => 0,'separator'=>'.', 'suffix' => 'đ', 'point' => ',']);
            $addnew->column_class('classes.tuition','align-right'); 
            // $addnew->change_type('classes.time','multiselect','default_value',['1'=>'Thứ 2','2'=>'Thứ 3','3'=>'Thứ 4','4'=>'Thứ 5','5'=>'Thứ 6','6'=>'Thứ 7','7'=>'Chủ nhật']);
            $addnew->change_type('classes.status','select','default_value',['1'=>'Đang hoạt động','2'=>'Ngưng hoạt động']);
            // $addnew->change_type('startTime','time');
            // $addnew->pass_var('dob', date('Y-m-d'));
            // $addnew->pass_var('type', 3);
            $addnew->column_callback('classes.name','class_detail');
            echo $addnew->render("list");       
            
            // $list = Xcrud::get_instance();
            // $list->table('classes');
            // echo $list->render();
                
            ?>
        </div>
        <!-- /.row -->
    </div>
   <script type="text/javascript">
         $(document).ready(function() {
 
          $("#lophoc-0").addClass('open active');
          $("#lophoc-1").addClass('open active');
        });
   </script>
<!-- /#page-wrapper -->            
@endsection()
