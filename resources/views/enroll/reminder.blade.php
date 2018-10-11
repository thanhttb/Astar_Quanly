@extends('layouts.master')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}">

<div class=" portlet" ng-controller="reminder-controller">
	<div class="col-md-6">
		<div class="portlet light bordered">

			<div class="portlet-title">
		        <div class="caption">
		            <span class="caption-subject font-purple-soft bold uppercase">Thông tin hồ sơ</span>
		        </div>	        
		    </div>
		    <div class="portlet-body">  
		    	<div class="row">
		    		<div class="col-md-6">
		    			<label>Họ tên: </label> <span>{{$student->fistName." ".$student->lastName}}</span>
		    			<br>
		    			<label>Ngày sinh: </label> <span> {{isset($student->dob) ? date('d-m-Y',strtotime($student->dob)) : ""}}</span>
		    			<br>
		    			<label>Trường: </label> <span> {{$student->school}}</span>

		    		</div>
		    		<div class="col-md-6">
		    			<label>Phụ huynh: </label> <span>{{$parent->name}}</span>
		    			<br>
		    			<label>Số điện thoại: </label> <span>{{$parent->phone}}</span>
		    			<br>


		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-6">
		    			<label> Nguyện vọng:</label><span>{{$enroll->subject}}</span>
		    		</div>
		    	</div>

	    	</div>	
			

	    </div>
		<div class="portlet light bordered">
		    <div class="portlet-title">
		        <div class="caption">
		            <span class="caption-subject font-purple-soft bold uppercase">Nhắc việc</span>
		        </div>
		        <div class="actions">
		            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
		                <i class="icon-cloud-upload"></i>
		            </a>
		            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
		                <i class="icon-wrench"></i>
		            </a>
		            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
		                <i class="icon-trash"></i>
		            </a>
		        </div>
		    </div>
		    <div class="portlet-body">  
		    	<form name="frmReminder" class="form-horizontal">

					<div class="form-group">
						<label class="col-sm-3 control-label">Nhập nội dung</label>
						<div class="col-sm-9">
							<textarea class="form-control" id="content" name="content" placeholder="Vui lòng nhập nội dung" ng-model="reminder.content" ng-required="true" style="resize: vertical;"></textarea>
							<span id="helpBlock2" class="help-block" ng-show="frmReminder.content.$error.required">Vui lòng nhập nội dung</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Ngày nhắc việc</label>
						<div class="col-sm-9">
							<input type="date" class="form-control" id="deadline" name="deadline" placeholder="Vui lòng nhập ngày" ng-model="reminder.deadline" ng-required="true" ng-model-options="{timezone:'UTC'}"/>
							<span id="helpBlock2" class="help-block" ng-show="frmReminder.deadline.$error.required">Vui lòng nhập ngày</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" >Trạng thái</label>
						<div class="mt-radio-inline col-sm-9">
		                    <label class="mt-radio">
		                        <input type="radio" name="optionsRadios" id="optionsRadios4" value="Chưa hoàn thành" ng-model="reminder.status"> Chưa hoàn thành
		                        <span></span>
		                    </label>
		                    <label class="mt-radio">
		                        <input type="radio" name="optionsRadios" id="optionsRadios5" value="Đã hoàn thành" ng-model="reminder.status" ng-required="true"> Đã hoàn thành 
		                        <span></span>
		                    </label>
		                </div>
					</div>				


					<div class="modal-footer">
						<button type="button" class="btn btn-primary" ng-disabled="frmReminder.$invalid" ng-click="save()">Lưu</button>
					 </div>
				</form>
				

		    </div>
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="portlet light bordered">

	    <div class="portlet-title">
	        <div class="caption">
	            <span class="caption-subject font-purple-soft bold uppercase">Lịch sử nhắc việc</span>
	        </div>
	        <div class="actions">
	            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                <i class="icon-cloud-upload"></i>
	            </a>
	            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                <i class="icon-wrench"></i>
	            </a>
	            <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
	                <i class="icon-trash"></i>
	            </a>
	        </div>
	    </div>

	    <div class="portlet-body">  
	    	
	    	<div class="timeline">
                <!-- TIMELINE ITEM -->
                <div class="timeline-item" ng-repeat="history in histories">
                    <div class="timeline-badge">
                        <img class="timeline-badge-userpic" src="@{{'/./astar/public/avatar/'+ history.avatar}}"> </div>
                    <div class="timeline-body">
                        <div class="timeline-body-arrow"> </div>
                        <div class="timeline-body-head">
                            <div class="timeline-body-head-caption">
                                <a href="javascript:;" class="timeline-body-title font-blue-madison" ng-bind="history.username"></a>
                                <span class="timeline-body-time font-grey-cascade" >ghi chú ngày @{{history.due_date | date: 'dd-MM-yyyy'}}</span>
                            </div>
                            <div class="timeline-body-head-actions">
                                <div class="btn-group">

                                    <button type="button" class="btn purple mt-ladda-btn ladda-button btn-outline btn-circle" data-style="slide-left" data-spinner-color="#333" ng-show="history.status == 'Chưa hoàn thành'" ng-click = "done(	.id)">
                                        <span class="ladda-label">Đã hoàn thành</span>
                                    <span class="ladda-spinner"></span></button>                                    
                                </div>
                            </div>
                        </div>
                        <div class="timeline-body-content">
                            <span class="font-grey-cascade">" @{{history.content}} "</span>
                            <br> <br>
                            <span class="font-grey-cascade" style="text-align: right;" ng-show="history.status == 'Đã hoàn thành'">Đã hoàn thành bởi @{{history.done_by}}</span>
                        </div>
                    </div>
                </div>
                <!-- END TIMELINE ITEM -->
            
            </div>

	    	
	    </div>
		</div>
	</div>
	
</div>

@endsection

@section('jquery')
<script src="{{asset('assets/global/plugins/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('assets/global/plugins/chosen.css')}}">
<link rel="image_src" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen-sprite.png">
<script type="text/javascript">
	$(document).ready(function(){
		$('#ghidanh-0').addClass('open active');
	    $('#ghidanh-0-2').addClass('open active');
	});
	<?php 
		echo "var id = ".$id.";";
		echo "console.log(id)";
	 ?>
</script>

@endsection
@section('angular')

<script type="text/javascript" src="{{asset('angular/controllers/ReminderController.js')}}"></script>

@endsection
