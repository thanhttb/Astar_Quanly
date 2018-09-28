
@extends('layouts.ketoan')
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
            
            $group = Xcrud::get_instance();
            $group->table('groups');
            $group->table_name('Quản lý nhóm');
            $group->fields('name,accounts_name');
            $group->columns('name,accounts_name');            
            $group->fk_relation('accounts_name','groups.id','accounts_groups','groups_id','accounts_id','accounts','id',array('name','dob'));
            echo $group->render();
            
                
            ?>
        </div>
        <!-- /.row -->
    </div>
    <link href="http://select2.github.io/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://select2.github.io/dist/js/select2.full.js"></script>
   <script type="text/javascript">
        window.onload = function(){
            jQuery(document).on("xcrudafterrequest",function(event,container){
            if (container) {
                jQuery(container).find("select").select2();
            } else {
                jQuery(".xcrud").find("select").select2();
            }
        })};

         $(document).ready(function() {
 
          $("#account-0").addClass('open active');
          $("#account-2").addClass('open active');
        });
   </script>
<!-- /#page-wrapper -->            
@endsection()
