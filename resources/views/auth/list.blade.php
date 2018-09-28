
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
            
            $listUser = Xcrud::get_instance();
            $listUser->table('accounts');
            $listUser->join('accounts.id','employees','acc_id');
            $listUser->table_name('Danh sách nhân viên');
            $listUser->columns(array('employees.name', 'employees.gender','employees.dob','employees.quequan','employees.hokhau','employees.sdt','employees.diachi','employees.honnhan','employees.masothue','employees.cmt_id','employees.cmt_ngaycap','employees.cmt_noicap','employees.dt_hocvi','employees.dt_loaitotnghiep','employees.nh_chutaikhoan','employees.nh_sothe','employees.nh_stk','employees.nh_ten','employees.nh_chinhanh','employees.hs_giaykhaisinh','employees.hs_cmt','employees.hs_khamsuckhoe','employees.hs_thpt','employees.hs_daihoc','employees.hs_bangdiem','employees.hs_khac','employees.hs_hokhau','employees.hs_hopdongld','employees.hs_4anh','employees.hs_soyeulylich','employees.hs_donxinviec','employees.hs_bantuthuat','employees.hs_solaodong','employees.hs_camket'));
            $listUser->fields('employees.name, accounts.name, employees.gender,employees.dob,employees.quequan,employees.hokhau,employees.sdt,employees.diachi,employees.honnhan,employees.masothue,employees.cmt_id,employees.cmt_ngaycap,employees.cmt_noicap,employees.dt_hocvi,employees.dt_loaitotnghiep,employees.nh_chutaikhoan,employees.nh_sothe,employees.nh_stk,employees.nh_ten,employees.nh_chinhanh,employees.hs_giaykhaisinh,employees.hs_cmt,employees.hs_khamsuckhoe, employees.hs_thpt,employees.hs_daihoc,employees.hs_bangdiem,employees.hs_khac,employees.hs_hokhau,employees.hs_hopdongld,employees.hs_4anh,employees.hs_soyeulylich,employees.hs_donxinviec,employees.hs_bantuthuat,employees.hs_solaodong,employees.hs_camket');
            $listUser->label(array('employees.name'=>'Họ vào tên','employees.gender'=>'Giới tính','accounts.dob'=>'Ngày sinh'));
            $listUser->column_class('employees.name','fixed');
            $listUser->highlight('employees.hs_giaykhaisinh,employees.hs_cmt,employees.hs_khamsuckhoe, employees.hs_thpt,employees.hs_daihoc,employees.hs_bangdiem,employees.hs_khac,employees.hs_hokhau,employees.hs_hopdongld,employees.hs_4anh,employees.hs_soyeulylich,employees.hs_donxinviec,employees.hs_bantuthuat,employees.hs_solaodong,employees.hs_camket','=','0','#ed496f');


            $listUser->column_callback('name','teacher_detail');
            echo $listUser->render('list');

                
            ?>
        </div>
        <!-- /.row -->
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#nhanvien-3").addClass('open active')
    });

    </script>
<!-- /#page-wrapper -->            
@endsection()