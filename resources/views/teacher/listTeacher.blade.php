
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

            
            $listTeacher->columns(array('teachers.name', 'teachers.gender','accounts.dob','teachers.quequan','teachers.hokhau','teachers.sdt','teachers.diachi','teachers.honnhan','teachers.masothue','teachers.cmt_id','teachers.cmt_ngaycap','teachers.cmt_noicap','teachers.dt_hocvi','teachers.dt_loaitotnghiep','teachers.nh_chutaikhoan','teachers.nh_sothe','teachers.nh_stk','teachers.nh_ten','teachers.nh_chinhanh','teachers.hs_giaykhaisinh','teachers.hs_cmt','teachers.hs_khamsuckhoe','teachers.hs_thpt','teachers.hs_daihoc','teachers.hs_bangdiem','teachers.hs_khac','teachers.hs_hokhau','teachers.hs_hopdongld','teachers.hs_4anh','teachers.hs_soyeulylich','teachers.hs_donxinviec','teachers.hs_bantuthuat','teachers.hs_solaodong','teachers.hs_camket'));
            $listTeacher->fields('teachers.name, accounts.name, teachers.gender,accounts.dob,teachers.quequan,teachers.hokhau,teachers.sdt,teachers.diachi,teachers.honnhan,teachers.masothue,teachers.cmt_id,teachers.cmt_ngaycap,teachers.cmt_noicap,teachers.dt_hocvi,teachers.dt_loaitotnghiep,teachers.nh_chutaikhoan,teachers.nh_sothe,teachers.nh_stk,teachers.nh_ten,teachers.nh_chinhanh,teachers.hs_giaykhaisinh,teachers.hs_cmt,teachers.hs_khamsuckhoe, teachers.hs_thpt,teachers.hs_daihoc,teachers.hs_bangdiem,teachers.hs_khac,teachers.hs_hokhau,teachers.hs_hopdongld,teachers.hs_4anh,teachers.hs_soyeulylich,teachers.hs_donxinviec,teachers.hs_bantuthuat,teachers.hs_solaodong,teachers.hs_camket');
            $listTeacher->label(array('teachers.name'=>'Họ vào tên','teachers.gender'=>'Giới tính','accounts.dob'=>'Ngày sinh'));
            $listTeacher->column_class('teachers.name','fixed');
            $listTeacher->highlight('teachers.hs_giaykhaisinh,teachers.hs_cmt,teachers.hs_khamsuckhoe, teachers.hs_thpt,teachers.hs_daihoc,teachers.hs_bangdiem,teachers.hs_khac,teachers.hs_hokhau,teachers.hs_hopdongld,teachers.hs_4anh,teachers.hs_soyeulylich,teachers.hs_donxinviec,teachers.hs_bantuthuat,teachers.hs_solaodong,teachers.hs_camket','=','0','#ed496f');

            $listTeacher->pass_var('type', $type);
            $listTeacher->column_callback('name','teacher_detail');
            echo $listTeacher->render('list');

                
            ?>
        </div>
        <!-- /.row -->
    </div>
<!-- /#page-wrapper -->  
<script type="text/javascript">
    $(document).ready(function(){
        $("#nhanvien-0").addClass('open active');
   
         
    });
</script>          
@endsection()