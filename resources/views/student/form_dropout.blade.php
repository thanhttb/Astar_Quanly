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
    <div class="portlet box red-sunglo">
        <div class="portlet-title">
            <div class="caption font-blue-sunglo">
                <i class="icon-settings font-blue-sunglo"></i>
                <span class="caption-subject bold uppercase">Đơn xin thôi học</span>
            </div>

        </div>
        <div class="portlet-body form">
            <form role="form" method="POST" action="{{route('dropOut')}}">
                <div class="form-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Họ tên</label>
                            <div class="input-group">   
                            <span class="input-group-addon input-circle-left">
                                </span>                             
                                <input type="text" class="form-control input-circle-right" value="{{$student->lastName. ' '.$student->firstName}}" disabled> </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Ngày sinh</label>

                            <div class="input-group">
                                <span class="input-group-addon input-circle-left">
                                </span>
                                <input type="text" class="form-control input-circle-right" value="{{$student->dob}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Lớp đang theo học</label>
                            <div class="input-group">
                                <span class="input-group-addon input-circle-left">
                                </span>
                                <input type="text" class="form-control input-circle-right" value="{{$class->name}}" disabled> </div>
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
                <input type="hidden" name="student_id" value="{{$student->id}}">
                <input type="hidden" name="class_std_id" value="{{$id}}">


                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-actions">
                    <button type="submit" class="btn blue">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection