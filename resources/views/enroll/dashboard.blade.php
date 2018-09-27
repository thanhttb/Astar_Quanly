@extends('layouts.master')
@section('content')
<?php 
	include(app_path().'/xcrud/xcrud.php');
	include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js();

 ?>
<div class="row widget-row">
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Thiếu hồ sơ học sinh</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green icon-bulb"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Trường hợp</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$thieuhoso}}">{{$thieuhoso}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Chưa hẹn lịch KTĐV</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-layers"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Học sinh</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$chuahenlich}}">{{$chuahenlich}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Kiểm tra hôm nay</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Học sinh</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$chuahenlich}}">{{$chuahenlich}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Hẹn lại lịch KTDV</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Học sinh</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$henlailich}}">{{$henlailich}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
</div>
<div class="row widget-row">
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Chưa gửi bài</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green icon-bulb"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Bài thi</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$chuaguibai}}">{{$chuaguibai}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Chưa có kết quả</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-layers"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Bài thi</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$chuacoketqua}}">{{$chuacoketqua}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Chưa thông báo kết quả</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Trường hợp</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$chuathongbaoketqua}}">{{$chuathongbaoketqua}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-3">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">Học buổi đầu hôm nay</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Học sinh</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$hochomnay}}">{{$hochomnay}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
</div>
<div class="row widget-row">
    <div class="col-md-6">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">CÂN NHẮC THÊM</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green icon-bulb"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Trường hợp</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$cannhacthem}}">{{$cannhacthem}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-6">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">CHỞ MỞ LỚP</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-layers"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">Học sinh</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$chomolop}}">{{$chomolop}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    
</div>
@endsection