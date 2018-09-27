@extends('layouts.master')
@section('content')
         <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/fancybox/source/jquery.fancybox.css')}}" rel="stylesheet" type="text/css">
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
<link href="{{asset('assets/pages/css/search.min.css')}}" rel="stylesheet" type="text/css">

<div class="search-page search-content-2">
    <div class="search-bar bordered" style="margin:0px;">
        <select id="acc-search" class="col-md-12">
            <option>Tìm kiếm</option>
        </select>
    </div>
    
    <div class="portlet bordered">
            <div class="portlet-title">
                <!-- <div class="caption">
                    <i class="fa fa-gift"></i></div> -->
                <div class="tools">
                    <a id="load-all" href="javascript:;" data-load="true" data-url="" class="reload" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="portlet-body portlet-empty">
                
            </div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->

<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
<script type="text/javascript">

    $('#acc-search').select2({              
          ajax: {
            url: '{{url('/searchAccountParents')}}',
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

    var PortletAjax = function () {

        var handlePortletAjax = function () {
                //custom portlet reload handler
                $('#my_portlet .portlet-title a.reload').click(function(e){
                    e.preventDefault();  // prevent default event
                    e.stopPropagation(); // stop event handling here(cancel the default reload handler)
                    // do here some custom work:
                    App.alert({
                        'type': 'danger', 
                        'icon': 'warning',
                        'message': 'Custom reload handler!',
                        'container': $('#my_portlet .portlet-body') 
                    });
                })
            }

            return {
                //main function to initiate the module
                init: function () {
                    handlePortletAjax();
                }

            };

    }();
    $('#acc-search').on( 'select2:select', function (e) {
        $("#load-all").attr("data-url", "{{url('/dongtien')}}/"+$('#acc-search').val());
        PortletAjax.init();
        $('#load-all')[0].click();
    });
    jQuery(document).ready(function(){
        $('#thuchi-0').addClass('open active');
        $('#thuchi-1').addClass('open active');
    });
</script>
@endsection