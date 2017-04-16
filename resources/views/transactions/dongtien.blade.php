
    <div class="col-md-6">
    <!-- BEGIN Portlet PORTLET-->
    @foreach($students as $std)
    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>{{$std['lastName']." ".$std['firstName']}}</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" data-load="true" data-url="{{url('/detailTuition/'.$std['acc_id'])}}" class="reload"> </a>
                <a href="javascript:;" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body portlet-empty"> </div>
    </div>
    @endforeach
    <!-- END Portlet PORTLET-->
</div>
<div class="col-md-6">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Giao dich </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" data-load="true" data-url="{{url('/allTransaction/'.$accountId)}}" class="reload"> </a>
                <a href="javascript:;" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body portlet-empty"> </div>
    </div>
    <!-- END Portlet PORTLET-->
</div>
