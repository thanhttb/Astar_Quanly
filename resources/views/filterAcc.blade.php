@extends('layouts.master')
@section('content')
	<?php
    include(app_path().'/xcrud/xcrud.php');
    include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js();?>
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
    

	<div class="portlet light portlet-fit portlet-datatable bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-green"></i>
                <span class="caption-subject font-green sbold uppercase">GIAO DỊCH CỦA
                	<select class="form-control acc" id="accSelect">
	 
					  <option  selected="">Chọn Tài Khoản</option>
					</select>
                </span> 

            </div>
            <div class="actions">
                <div class="btn-group btn-group-devided" data-toggle="buttons">
                    <label class="btn btn-transparent green btn-outline btn-outline btn-circle btn-sm active">
                        <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                    <label class="btn btn-transparent blue btn-outline btn-circle btn-sm">
                        <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                </div>
                <div class="btn-group">
                    <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                        <i class="fa fa-share"></i>
                        <span class="hidden-xs"> Tools </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:;"> Export to Excel </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Export to CSV </a>
                        </li>
                        <li>
                            <a href="javascript:;"> Export to XML </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="javascript:;"> Print Invoices </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-container">
                <div class="table-actions-wrapper">
                    <span> </span>
                    <select class="form-control input-inline input-small input-sm" id="test">
                        <option value="0">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <button class="btn btn-sm btn-default table-group-action-submit">
                        <i class="fa fa-check"></i> Submit</button>
                </div>
                <table class="table table-striped table-bordered table-hover table-checkable" id="transaction">
                    <thead>
                        <tr role="row" class="heading">
                            <th width="2%">
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" id="select-all" />
                                    <span></span>
                                </label>
                            </th>
                            <th width="5%"> Id&nbsp;# </th>                            
                            <th width="15%"> From </th>
                            <th width="15%"> To </th>
                            <th width="15%"> Date </th>
                            <th width="10%"> Amount </th>
                            <th width="15%"> Description</th>
                            <th width="10%"> Status </th>
                            <th width="10%"> Actions </th>
                        </tr>
                        <tr role="row" class="filter">
                            <td> </td>
                            <td>
                                <input type="text" class="form-control form-filter input-sm" name="id" id="id"> </td>
                            
                            <td>
                                <select name="from" class="form-control form-filter input-sm accwithoutdob" id="accFrom"></select>
                            </td>    
                            <td><select name="to" class="form-control form-filter input-sm accwithoutdob" id="accTo"></td>
                                
                            <td>
                                <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_date_from" placeholder="From" id="fini">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control form-filter input-sm" readonly name="order_date_to" placeholder="To" id="ffin">
                                    <span class="input-group-btn">
                                        <button class="btn btn-sm default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="margin-bottom-5">
                                    <input type="text" class="form-control form-filter input-sm" name="order_base_price_from" placeholder="From" /> </div>

                            <td>
                                <div class="margin-bottom-5">
                                    <input type="text" class="form-control form-filter input-sm margin-bottom-5 clearfix" name="order_purchase_price_from" placeholder="From" /> </div>
                            <td>
                                <select name="order_status" class="form-control form-filter input-sm" id="status">
                                    <option value="">Select...</option>
                                    <option value="1">Lựa Chọn 1</option>
			                        <option value="2">Lựa Chọn 2</option>
			                        <option value="3">Lựa Chọn 3</option>
			                        <option value="4">Lựa Chọn 4</option>
                                </select>
                            </td>
                            <td>
                                <div class="margin-bottom-5">
                                    <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                        <i class="fa fa-search"></i> Search</button>
                                </div>
                                <button class="btn btn-sm btn-default filter-cancel">
                                    <i class="fa fa-times"></i> Reset</button>
                            </td>
                        </tr>
                    </thead>
                    <tfoot>
                    	<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery(document).ready(function(){
        $('#thuchi-0').addClass('open active');
        $('#thuchi-2').addClass('open active');
    });
    });
</script>
<link href="http://select2.github.io/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://select2.github.io/dist/js/select2.full.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>	
<script src="{{asset('assets/pages/scripts/ecommerce-orders.js')}}" type="text/javascript"></script>@endsection