@extends('layouts.master')
@section('content')
<?php 
    include(app_path().'/xcrud/xcrud.php');
    include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js(); 
 ?>
    <div class="portlet box yellow">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-comments"></i> Danh sách học bù</div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="javascript:;" id="load-hocbu" data-load="true" data-url="listHocBu" class="reload" data-original-title="" title=""> </a>
                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#lophoc-0").addClass('open active');
          $("#lophoc-3").addClass('open active');
        });
    </script>
@endsection