@extends('layouts.master')
@section('content')
         <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<?php
	include(app_path().'/xcrud/xcrud.php');
	include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js();
    function asVnd($value){
        return number_format($value,'0','','.')."đ";
    }
    $total = 0;
?>
<select class="form-control acc" id="accSelect">
     
                  <option  selected="">Chọn Tài Khoản</option>
                </select>
<div class="row">
    <div class="col-md-12">
        <div class="portlet">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Load On Demand </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                    <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                    <a href="javascript:;" data-url="" class="reload" data-original-title="" title=""> </a>
                    <a href="javascript:;" class="fullscreen" data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body portlet-empty"></div>
                    </div>
    </div>


<link href="http://select2.github.io/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://select2.github.io/dist/js/select2.full.js"></script>



<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/portlet-ajax.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->

<script type="text/javascript">
    $('#accSelect').select2({              
          ajax: {
            url: '/astar/searchAccountParents',
            type: "GET",    
            dataType: 'json',
            delay : 250,
            data: function (params) {

                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name +" "+ item.dob,
                            id: item.id
                        }
                    })
                };
            }                  
         }
        });
    $('#accSelect').on( 'select2:select', function (e) {
        $("a").attr("data-url", "/astar/dongtien/"+$('#accSelect').val());
    });

</script>
@endsection