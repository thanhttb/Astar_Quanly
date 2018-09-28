@extends('layouts.ketoan')
@section('content')

<link rel="stylesheet" type="text/css" href="{{asset('/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}">
<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<style type="text/css">
	table td{
		vertical-align:middle !important;
	}
	.selected{
		background: #adebeb;
	}
/*	.tag{
		background: #fdeec4;
	    border: 1px solid #fce199;
	    border-left: 3px solid #fce199;
	}
	.tag a{
		border-radius: 2px;
	    font-size: 100%;
	    font-weight: lighter;
	    padding: 1px 5px;
	    margin-left: 5px;
	    margin-right: 3px;
	    text-decoration: none;
	}*/
</style>
<div class="portlet light bordered" ng-controller="account-controller">

    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-purple-soft bold uppercase">Danh sách tài khoản</span>
        </div>

        <div class="actions">

        	<button class="btn blue" type="button" ng-click="showModal('add')">Thêm mới tài khoản</button>
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
    	
    	<table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th width="2%"> 
                    	<div class="mt-checkbox-inline" style="padding: 0px">
							<label class="mt-checkbox">
							    <input type="checkbox" name="checkbox" id="optionsRadios4" value="option1" ng-click="checkAll()" ng-checked= "checked">
							    <span></span>
							</label>
						</div>  
                    </th>
                    <th width="5%"> Sửa </th>
                    <th> Số tài khoản </th>
                    <th> Tên tài khoản </th>
                    <th> Miêu tả </th>
                    <th> Nhóm </th>
                    <th style="text-align: right;"> Cân đối </th>
                </tr>
            </thead>
            <tbody>                                                
                <tr ng-click="rowClicked(account)" ng-repeat="account in allAccount | testing: filter_name " ng-class= "{selected : account.selected}">
                 	<td>
                 		<div class="mt-checkbox-inline" style="padding: 0px">
							<label class="mt-checkbox">
							    <input type="checkbox" name="checkbox" ng-checked="account.selected">
							    <span></span>
							</label>
						</div> 
                 	</td>
                    <td><button class="btn btn-default" ng-click="showModal('edit',account.id); $event.stopPropagation();"><i class="fa fa-edit"></i></button></td>
                    <td>@{{account.id}}</td>
                    <td>@{{account.name}}</td>
                    <td>@{{account.dob}}</td>
                    <td>
                    	<span class="tag" ng-repeat="group in account.groups "> <a href="" ng-click="group_filter(group.name); $event.stopPropagation;">@{{group.name + " "}}</a>  </span> 
                    </td>
                    <td style="text-align: right;">@{{account.balance | currency: "":0 }}</td>
                </tr>
            </tbody>
        </table>
        <pagination 
		  ng-model="currentPage"
		  total-items="todos.length"
		  max-size="maxSize"  
		  boundary-links="true">
		</pagination>
    	<!-- Modal -->
		<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@{{frmTitle}}</h4>
			  </div>
			  <div class="modal-body">
				<form name="frmAccount" class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Tên tài khoản</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" name="name" placeholder="Vui lòng nhập tên tài khoản" ng-model="account.name" ng-bind="getEdit.name" ng-required="true"/>
							<span id="helpBlock2" class="help-block" ng-show="frmAccount.name.$error.required">Vui lòng nhập tên</span>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label" >Thông tin tài khoản</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="age" name="age" placeholder="Vui lòng nhập thông tin" ng-model="account.dob" >
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label" >Kiểu tài khoản</label>
						<div class="mt-radio-inline col-sm-9">
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios4" value="incoming" ng-model="account.cat"> Incoming
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios5" value="asset" ng-model="account.cat"> Asset
                                <span></span>
                            </label>
                            <label class="mt-radio mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios6" value="liability" ng-model="account.cat"> Liability
                                <span></span>
                            </label>
                            <label class="mt-radio mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios7" value="outgoing" ng-model="account.cat"> Outgoing
                                <span></span>
                            </label>
                        </div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Loại tài khoản</label>
						<div class="col-sm-9">
							<select id="type" class="form-control" ng-model="account.type" style="width: 100% !important" ng-required="true"> 
								<option value="1" ng-selected= "account.type == 1"> Học sinh </option>
								<option value="2" ng-selected= "account.type == 2"> Phụ huynh </option>
								<option value="3" ng-selected= "account.type == 3"> Lớp </option>
								<option value="4" ng-selected= "account.type == 4"> Giáo viên/Trợ giảng </option>
								<option value="6" ng-selected= "account.type == 6"> Nhân viên </option>
								<option value="5" ng-selected= "account.type == 5"> Phương thức thanh toán(Cash, Vcb, Tcb ...) </option>
																<option value="7" ng-selected="account.type == 7">Khác</option>

							</select>
						</div>
					</div>		

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Nhóm Tài khoản</label>
						<div class="col-sm-9">
							<select chosen multiple id="groupSelect" value="account.groups" class="groupSelect form-control"  ng-model="account.groups" ng-options="group.name for group in allGroups" style="width: 100% !important; height:100% !important;">
							</select>
						</div>
					</div>			
					
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-primary" ng-disabled="frmAccount.$invalid" ng-click="save(state, id)">Lưu</button>
			  </div>
			</div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
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
	 $(document).ready(function() {

	  $("#account-0").addClass('open active');
	  $("#account-1").addClass('open active');
	});
   </script>
@endsection
@section('angular')
<script type="text/javascript" src="{{asset('angular/lib/angular.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/global/plugins/angular-chosen.js')}}"></script>

<script type="text/javascript" src="{{asset('angular/app.js')}}"></script>
<script type="text/javascript" src="{{asset('angular/controllers/AccountController.js')}}"></script>

@endsection
