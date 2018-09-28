@extends('layouts.master')
@section('content')
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
<link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}">

<?php
		include(app_path().'/xcrud/xcrud.php');
		include(app_path().'/xcrud/functions.php');
        echo Xcrud::load_css();
        echo Xcrud::load_js(); 
        $ngayhoc = Xcrud::get_instance();
        $ngayhoc->table('lessons')->where('class_id ='.$id);
        $ngayhoc->relation('class_id','classes','id','name');
        $ngayhoc->relation('teacher_id','teachers','id','name');

        function asVnd($value){
            return number_format($value,'0','','.');
        }     
?>

<div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-social-dribbble font-purple-soft"></i>
            <span class="caption-subject font-purple-soft bold uppercase">{{$class['name']}}</span>
            <span class="caption-subject font-purple-soft bold uppercase">Thầy: {{$class['teacher']}}</span>
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
        <ul class="nav nav-tabs">

            <li class="active">
                <a href="#tab_1_1" data-toggle="tab"> Danh sách HS </a>
            </li>
            <li class="">
                <a href="#tab_1_2" data-toggle="tab"> Định tính tiền học </a>
            </li>
            <li class="">
                <a href="#tab_1_3" data-toggle="tab"> Thông báo học phí </a>
            </li>
            <li >
                <a href="#tab_1_4" data-toggle="tab"> Danh sách thiếu Học Phí </a>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane active" id="tab_1_1">
            <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">Danh Sách Học Sinh</span>
                        </div>
                        <div class="tools"> </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover responsive" id="students">
                            <thead>
                                <tr>
                                    <th>Họ đệm</th>
                                    <th>Tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Điện thoại</th>
                                    <th>Email</th>
                                    <th>Lớp</th>
                                    <th>Trường</th>
                                    <th>Phụ hunh</th>
                                    <th>Điện thoại PH</th>
                                    <th>Email PH</th>
                                    <th>Ngày vào học</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                @foreach($studentsFull as $std)
                                    @if(is_null($std['lastDay']))
                                    <tr>
                                    @else
                                    <tr style="text-decoration: line-through;">
                                    @endif
                                        <td>{{$std['lastName']}}</td>
                                        <td>{{$std['firstName']}}</td>
                                        <td>{{$std['dob']}}</td>
                                        <td>{{$std['std_phone']}}</td>
                                        <td>{{$std['std_email']}}</td>
                                        <td>{{$std['class']}}</td>
                                        <td>{{$std['school']}}</td>
                                        <td style="background: #e8d2b4;">{{$std['name']}}</td>
                                        <td style="background: #e8d2b4;">{{$std['p_phone']}}</td>
                                        <td style="background: #e8d2b4;">{{$std['p_email']}}</td>
                                        <td>{{date('d/m/Y',strtotime($std['firstDay']))}}</td>
                                        <td>{{$std['note']}}</td>
                                    </tr>

                                @endforeach   
                            </tbody>
                        </table>
                    </div></div>
            </div>

        <div class="tab-pane fade open" id="tab_1_2">
            <div class="portlet light bordered">
                <!-- <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Horizontal Form</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                            <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                        </div>
                    </div>
                </div> -->
                <div class="portlet-body form">
                    <form class="form-horizontal" role="form" action={{url('postTbHocPhi/'.$class['id'])}} method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-body">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label>Chọn kỳ *</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sticky-note-o"></i>
                                        </span>
                                        <select class="form-control" name="period">
                                            <option selected=""></option>
                                            @foreach( $all_periods as $period)
                                                <option value="{{$period->id}}">{{$period->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group col-md-2">
                                    <label>Loại phí *</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sticky-note-o"></i>
                                        </span>
                                        <select class="form-control" name="type">
                                            <option selected="" value="1">Học phí</option>
                                            <option value="2"> Phụ phí </option>
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group col-md-2">
                                    <label>Số tiền</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <input type="number" min="0" class="form-control tuition" placeholder="400.000" id="tuition" value={{$class['tuition']}}> 
                                    </div>
                                </div>  
                                <div class="form-group col-md-2">
                                    <label>Số lượng</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-hand-spock-o"></i>
                                        </span>
                                        <input type="number" min="0" class="form-control lesson" id="lesson" placeholder="3"> 
                                    </div>
                                </div>  
                                <div class="form-group col-md-2">
                                    <label>Tổng tiền</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-money"></i>
                                        </span>
                                        <input type="number" min="0" class="form-control total" placeholder="" id="total"> 
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                     <label>Ghi chú</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-sticky-note-o"></i>
                                        </span>
                                        <input class="form-control" name="note"> 
                                    </div>
                                </div>  
                            </div>
                            
                        </div>
                        <div class="porlet-body">
                            <table class="table table-bordered table-striped table-condensed flip-content ">
                                <thead class="flip-content">
                                    <tr>
                                        <th width="10%"> Họ Tên </th>
                                        <th width="10%"> Ngày sinh </th>
                                        <th width="10%"> Học phí </th>
                                        <th width="10%"> Số buổi </th>
                                        <th class="numeric" width="10%"> Miễn giảm </th>
                                        <th class="numeric"> Tổng tiền </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$student['lastName'].' '.$student['firstName']}}</td>
                                            <td>{{empty($student['dob'])?'':date('d/m/Y',strtotime($student['dob']))}}</td>
                                            <td>
                                                <div class="input-group input-small">
                                                        <input type="number" min="0" class="form-control input-small each-tuition" 
                                                        id= tuition{{$student['student_id']}} placeholder="400.000" value={{$class['tuition']}}>     
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group input-small">
                                                        <input type="number" min="0" class="form-control input-small each-lesson" id= lesson{{$student['student_id']}} name=lesson{{$student['student_id']}}>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-hand-spock-o"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td><input type="number" min="0" max="100" class="form-control input-small each-discount"  id= discount{{$student['student_id']}} value="{{$student['discount']}}"></td>
                                            <td>
                                                <div class="input-group input-small">
                                                        <input type="text" class="form-control input-small each-total" id= total{{$student['student_id']}} name=total{{$student['student_id']}}>
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-money"></i>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            
                        </div>                                          
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">Submit</button>
                                    <button type="button" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tab_1_3">
            <div class="portlet light bordered">
                <div class="portlet body">
                    <table class="table table-striped table-bordered table-hover dt-responsive" id="table" width="100%">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Số điện thoại</th>
                            @foreach($periods as $period)
                                <th>{{$period['name']}}</th>
                            @endforeach
                            <th width="5%">Truy thu</th>

                        </tr>
                    </thead>
                    
                    <tbody style="font-weight: normal;">
                        @foreach($students as $value)
                        <?php echo "<pre>";
                        print_r($value); ?>
                        <tr>
                            <td>{{$value['lastName']}} {{$value['firstName']}}</td>
                            <td>{{empty($value['dob']? "s ": date('d/m/Y', strtotime($value['dob'])))}}</td>
                            <td>{{$value['phone']}}</td>
                            @foreach($periods as $period)
                                <td>{{$value['p'.$period['id']]}}</td>
                            @endforeach
                            <td>
                                <div class="btn-group" style="margin: auto;">
                                    <button  class="red dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{route('printHp',$value)}}"> In thông báo </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="get-edit" data-value="{{$value['firstName']}}" >SMS</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"> Email </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;"> Gọi điện </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>  
                        @endforeach                
                    </tbody>
                </table>
                </div>
                
            </div>
        </div>
        <div class="tab-pane fade" id="tab_1_4">
            <div>
                <table class="table table-striped table-bordered table-hover dt-responsive" id="table" width="100%">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Số điện thoại</th>
                            <th>Tổng</th>

                        </tr>
                    </thead>
                    
                    <tbody style="font-weight: normal;">
                        @foreach($students as $value)
                        
                        @endforeach                
                    </tbody>
                </table>

            </div>
        </div>
        <div class="clearfix margin-bottom-20"> </div>
        
    </div>
            

    
</div>
<a  id="ajax-edit" data-url="" data-toggle="modal"></a>
<div id="ajax-modal" class="modal fade" tabindex="-1"> </div>

<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript">


$.fn.editable.defaults.params = function (params){
    params._token = $("#_token").data("token");
    return params;
};
$('#tuition').change(function(){
    var tuition = parseInt($('#tuition').val());
    var lesson = parseInt($('#lesson').val());
    $('.total').val(tuition * lesson);
    $('.each-tuition').val(tuition);
    <?php 
        foreach ($students as $std) {        
            echo "var discount = parseInt($('#discount".$std['student_id']."').val());";
            echo "$('#total".$std['student_id']."').val((tuition*lesson*(100-discount))/100);";
        }
    ?>

});   
// $('#each-tuition').change(function(){
//     var std
// });
$('#lesson').change(function(){
    var tuition = parseInt($('#tuition').val());
    var lesson = parseInt($('#lesson').val());
    $('.total').val(tuition * lesson);
    <?php 
        foreach ($students as $std) {
            # code...
            echo "$('#lesson".$std['student_id']."').val($('#lesson').val());";
            echo "var discount = parseInt($('#discount".$std['student_id']."').val());";
            echo "$('#total".$std['student_id']."').val((tuition*lesson*(100-discount))/100);";
        }

    ?>
     
});
$('.each-lesson, .each-tuition, .each-discount').change(function(){
    <?php 
        foreach ($students as $std) {
            # code...
            echo "var tuition = parseInt($('#tuition".$std['student_id']."').val());";
            echo "var lesson = parseInt($('#lesson".$std['student_id']."').val());";
            echo "var discount = parseInt($('#discount".$std['student_id']."').val());";
            echo "$('#total".$std['student_id']."').val((tuition*lesson*(100-discount))/100);";
        }
     ?>
});
 var UIExtendedModals = function () {    
    return {
        //main function to initiate the module
        init: function () {
        
            // general settings
            $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
              '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                '<div class="progress progress-striped active">' +
                  '<div class="progress-bar" style="width: 100%;"></div>' +
                '</div>' +
              '</div>';

            $.fn.modalmanager.defaults.resize = true;

            //dynamic demo:
            $('.dynamic .demo').click(function(){
              var tmpl = [
                // tabindex is required for focus
                '<div class="modal hide fade" tabindex="-1">',
                  '<div class="modal-header">',
                    '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
                    '<h4 class="modal-title">Modal header</h4>', 
                  '</div>',
                  '<div class="modal-body">',
                    '<p>Test</p>',
                  '</div>',
                  '<div class="modal-footer">',
                    '<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>',
                    '<a href="#" class="btn btn-primary">Save changes</a>',
                  '</div>',
                '</div>'
              ].join('');
              
              $(tmpl).modal();
            });

            //ajax demo:
            var $modal = $('#ajax-modal');

            $('#ajax-edit').on('click', function(){
              // create the backdrop and wait for next modal to be triggered
              $('body').modalmanager('loading');
              var el = $(this);

              setTimeout(function(){
                  $modal.load(el.attr('data-url'), '', function(){
                  $modal.modal();
                });
              }, 1000);
            });

            $modal.on('click', '.update', function(){
              $modal.modal('loading');
              setTimeout(function(){
                $modal
                  .modal('loading')
                  .find('.modal-body')
                    .prepend('<div class="alert alert-info fade in">' +
                      'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '</div>');
              }, 1000);
            });
        }

    };

}();
jQuery('.get-edit').click(function(){
    console.log($(this).data('value'));
    $('#ajax-edit').attr('data-url',"{{route('sendSms',$value)}}");    
    $('#ajax-edit')[0].click();
})
$(document).ready(function(){
    UIExtendedModals.init();

   
    $('#lophoc-1').addClass('open acitve'); 
    $('#students').DataTable({
        'ordering': false
    });
    $('#table').dataTable({
            fixed_header:true,
            buttons: [
                { extend: 'print', className: 'btn dark btn-outline' },
                { extend: 'copy', className: 'btn red btn-outline' },
                { extend: 'excel', className: 'btn yellow btn-outline ' },
                { extend: 'colvis', className: 'btn dark btn-outline', text: 'Columns'}
            ],
            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: {
                details: {                   
                }
            },
            "ordering": false,
            //"ordering": false, disable column ordering 
            //"paging": false, disable pagination

            // "order": [
            //     [0, 'asc']
            // ],
            
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 100,
            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
        });
 
});


</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<link href="{{ asset('select2-4.0.3/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"></link> 
<script src="{{ asset('select2-4.0.3/dist/js/select2.full.js') }}"></script> 
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>      

@endsection