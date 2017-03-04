@extends('layouts.general')
@section('content')
	<button onclick="Xcrud.modal('My modal','<h1>Hello World!</h1>')">Show modal</button>

	<?php
		require('C:\xampp\htdocs\quanly\resources\views\xcrud\xcrud.php');
                echo Xcrud::load_css();
                echo Xcrud::load_js();
                $today = date("Y-m-d");
                
                $ktdv = Xcrud::get_instance();
                $ktdv->table('enrolls')->or_where('appointment is null');
                $ktdv->or_where('testInform',0);	
                $ktdv->order_by('appointment');
                //$ktdv->modal('student_id');
                $ktdv->hide_button('add');
                $ktdv->join('student_id','students','id');
                $ktdv->join('students.parent_id','parents','id');
                $ktdv->columns(array('students.lastName','students.firstName','students.dob','parents.name','parents.phone'
                					,'subject','class','appointment','testInform','showUp','created_at','receiver'));

                //Highligt Học sinh kiểm tra hôm nay
                $tomorrow = new DateTime('tomorrow');
                $tomorrow = $tomorrow->format('Y-m-d');
                $ktdv->highlight_row('appointment','>',$today,'red');
                $ktdv->highlight_row('appointment','>=',$tomorrow,'white');
                $ktdv->modal('students.firstName, students.lastName');
                $ktdv->column_class('appointment','appointment');
                //
                //$ktdv->change_type('testInform','select','Đã đến kiểm tra');
                echo $ktdv->render();	




	  ?>
	  <script type="text/javascript">
	  	
	  </script>	
@endsection()