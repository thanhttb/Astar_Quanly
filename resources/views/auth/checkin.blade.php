@extends('layouts.master')
@section('content')
	<?php
            include(app_path().'\xcrud\xcrud.php'); 
            include(app_path().'\xcrud\functions.php');
            echo Xcrud::load_css();
            echo Xcrud::load_js();
            ?>
     @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>Bạn chưa sẵn sàng!</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption font-red-sunglo">
                <i class="icon-settings font-red-sunglo"></i>
                <span class="caption-subject bold uppercase">Check in</span>
            </div>
            <!-- <div class="actions">
                <div class="btn-group">
                    <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-pencil"></i> Edit </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-trash-o"></i> Delete </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-ban"></i> Ban </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="javascript:;"> Make admin </a>
                        </li>
                    </ul>
                </div>
            </div> -->
        </div>
        <div class="portlet-body form">
            <form role="form" method="POST" action="{{route('postCheckin')}}">
                <div class="form-body">
                    <div class="form-group">
                        <label>Bây giờ là</label>
                        <div class="input-group">
                            <span class="input-group-addon input-circle-left">
                                <i class="fa fa-clock-o"></i>
                            </span>
                            <input type="text" class="form-control input-circle-right" placeholder="{{ date('d-m h:i:m')}}" disabled> </div>
                    </div>
                    <div class="form-group">
                        <label>Bạn có điều gì muốn nói với anh Việt Anh?</label>
                        <div class="input-group">
                            <span class="input-group-addon input-circle-left">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input type="text" name="note" class="form-control input-circle-right" placeholder="Hãy nói"> </div>
                    </div>
                    <div class="form-group">
                        <div class="mt-checkbox-list">
                            <label class="mt-checkbox"> Bạn đã sẵn sàng làm việc ?
                                <input type="checkbox" value="1" name="confirmed">
                                <span></span>
                            </label>
                            
                        </div>
                    </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-actions">
                    <button type="submit" class="btn blue">Check-in</button>
                </div>
            </form>
        </div>
    </div>
@endsection