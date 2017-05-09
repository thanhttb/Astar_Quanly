@extends('layouts.master')
@section('content')
<div class="container-fluid">
	<div class="row">
		<?php 
			include(app_path().'/xcrud/xcrud.php');
			include(app_path().'/xcrud/functions.php');
	        echo Xcrud::load_css();
	        echo Xcrud::load_js();
	        $xcrud = Xcrud::get_instance();
		    $xcrud->table('discount');

		    $type = array('1' => 'Học sinh' , '2' => 'Lớp' ,'3' =>'Giáo viên' );
		    $xcrud->relation('from','accounts','id', array('type','name','dob')); 
		    $xcrud->relation('to','accounts','id', array('type','name','dob')); 

		    echo $xcrud->render('list');
		 ?>
		
	</div>
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

    jQuery(document).ready(function(){
    	$('#thuchi-0').addClass('open active');
    	$('#thuchi-5').addClass('open active');
    });
</script>

@endsection