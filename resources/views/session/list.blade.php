@extends('layouts.master')
@section('content')

<?php
                        include(app_path().'/xcrud/xcrud.php'); 
            include(app_path().'/xcrud/functions.php');
            echo Xcrud::load_css();
            echo Xcrud::load_js();
            ?>
     @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container" ng-controller="class-controller">
    	<div class="portlet box red-sunglo">
	        <div class="portlet-title">
	            <div class="caption font-blue-sunglo">
	                <i class="icon-settings font-blue-sunglo"></i>
	                <span class="caption-subject bold uppercase">QUẢN LÝ CA HỌC</span>
	            </div>

	        </div>
	        <div class="portlet-body form">
	            <form role="form" method="POST" action="{{route('dropOut')}}">
	                <div class="form-body">
	                	<div class="row">
	                		<div class="form-group">
	                			<label>Chọn lớp</label>
	                			<select class="form-control" ng-model="selected_class" ng-options="class.name for class in classes track by class.id">
	                				<option value=""></option>
	                			</select>
	                		</div>
	                	</div>
	                	<div >
	                		
	                	</div>
	                    <div class="row">
	                        <div class="form-group col-md-6">
	                            <label>Họ tên</label>
	                            <input type="text" class="form-control" value="" disabled>                          
	                                
	                        </div>
	                        <div class="form-group col-md-6">
	                            <label>Ngày sinh</label>

	                            <div class="input-group">
	                                <span class="input-group-addon input-circle-left">
	                                </span>
	                                <input type="text" class="form-control input-circle-right" value="" disabled>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="form-group col-md-3">
	                            <label>Lớp đang theo học</label>
	                            <div class="input-group">
	                                <span class="input-group-addon input-circle-left">
	                                </span>
	                                <input type="text" class="form-control input-circle-right" value="" disabled> </div>
	                        </div>
	                        <div class="form-group col-md-3">
	                            <label>Ngày áp dụng</label>
	                            <div class="input-group">
	                                <span class="input-group-addon input-circle-left">
	                                </span>
	                                <input type="date" class="form-control input-circle-right" name="lastDay"> </div>
	                        </div>
	                        <div class="form-group col-md-6">
	                            <label>Lý do xin nghỉ</label>

	                            <div class="input-group">
	                                <span class="input-group-addon input-circle-left">
	                                    <i class="fa fa-clock-o"></i>
	                                </span>
	                                <input type="text" class="form-control input-circle-right" name="note">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <div class="mt-checkbox-list">
	                            <label class="mt-checkbox"> Xác nhận
	                                <input type="checkbox" value="1" name="confirmed">
	                                <span></span>
	                            </label>
	                            
	                        </div>
	                    </div>
	               


	                <input type="hidden" name="_token" value="{{csrf_token()}}">
	                <div class="form-actions">
	                    <button type="submit" class="btn blue">Submit</button>
	                </div>
	            </form>
	        </div>
	    </div>
    </div>
@endsection
@section('angular')

<script type="text/javascript" src="{{asset('angular/controllers/ClassController.js')}}"></script>

@endsection
