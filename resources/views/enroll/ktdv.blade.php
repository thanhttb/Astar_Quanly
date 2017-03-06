@extends('layouts.general')
@section('content')
	<button onclick="Xcrud.modal('My modal','<h1>Hello World!</h1>')">Show modal</button>
    <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>

	<?php
		include(app_path().'\xcrud\xcrud.php');
		include(app_path().'\xcrud\functions.php');
                echo Xcrud::load_css();
                echo Xcrud::load_js();
                $today = date("Y-m-d h:i");
                
                $ktdv = Xcrud::get_instance();
                $ktdv->table('enrolls')->or_where('appointment is null');
                $ktdv->or_where('testInform',0);	
                $ktdv->order_by('appointment');
                //$ktdv->modal('student_id');
                $ktdv->hide_button('add');
                $ktdv->join('student_id','students','id');
                $ktdv->relation('student_id','students','id',array('lastName','firstName'));
                $ktdv->join('students.parent_id','parents','id');
                $ktdv->columns(array('student_id','parents.phone'
                					,'subject','class','appointment','testInform','showUp','created_at','receiver'));

                //Highligt Học sinh kiểm tra hôm nay
                $tomorrow = new DateTime('tomorrow');
                $tomorrow = $tomorrow->format('Y-m-d h:i');
                $ktdv->highlight_row('appointment','>',$today,'#ffb3b3');
                $ktdv->highlight_row('appointment','>=',$tomorrow,'white');

                $ktdv->column_callback('appointment','add_user_icon');
                //$ktdv->column_callback('class','add_modal');
                $ktdv->column_callback('testInform','add_testInform');
                $ktdv->column_callback('showUp','add_showUp');    
                //
                //$ktdv->change_type('testInform','select','Đã đến kiểm tra');
                echo $ktdv->render();	



	  ?>
                      

        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- x-editable (bootstrap version) -->
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    	<link href="{{asset('public/datetimepicker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet"></link> 
        <script src="{{asset('public/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
        <script type="text/javascript">
	  	$(document).ready(function() {
         // $.fn.editable.defaults.mode = 'inline';

            $.fn.editable.defaults.params = function (params){
                params._token = $("#_token").data("token");
                return params;
            };

    
            $('.appointment').editable({
                type: 'datetime',
                title: 'Select date',
                placement: 'right',
                format: 'yyyy-mm-dd hh:ii',    
                viewformat: 'dd/mm/yyyy hh:ii',
                datetimepicker: {
                        weekStart: 1
                   },
                url: '{{route('editDateTime')}}'             

            });
            $('.testInform').editable({                
                url: '{{route('editTestInform')}}',
                value: 2,    
                source: [
                  {value: 0, text: 'Chưa thông báo'},
                  {value: 1, text: 'Đã thông báo'},
                  
                ]             

            });
            $('.showUp').editable({                
                url: '{{route('editShowUp')}}',
                value: 2,    
                source: [
                  {value: 0, text: 'Chưa đến thi'},
                  {value: 1, text: 'Đã đến thi'},
                  
                ]             

            });
    });
	  	</script>	
        
@endsection()