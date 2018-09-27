<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />
<ul class="nav nav-tabs">

<li class="active">
    <a href="#tab_1_1" data-toggle="tab" aria-expanded="false">Điểm danh</a>
</li>
<li class="dropdown">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> Hoạt động
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu" role="menu">
        <li class="">
            <a href="#tab_1_3" tabindex="-1" data-toggle="tab" aria-expanded="false"> Danh sách điểm danh </a>
        </li>
        <li class="">
            <a href="#tab_1_4" tabindex="-1" data-toggle="tab" aria-expanded="false"> Danh sách xếp học bù </a>
        </li>    
    </ul>
</li>
</ul>
<div style="height:22px"></div>
<div class="tab-content">
    <div class="tab-pane active open" id="tab_1_1">
        @foreach($students as $student)
        <div class="row">
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder=".col-md-3" disabled value="{{$student['lastName']}} {{$student['firstName']}}">  </div>
            <div class="col-md-1">
                <input type="text" class="form-control" placeholder="" value="{{date('d-m-Y',strtotime($student['dob']))}}" disabled> </div>
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder="" value="{{$student['phone']}}" disabled> </div>
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder="" value="{{$student['email']}}" disabled> </div>
            <div class="col-md-2">
                <div class="form-group">                    
                    <div class="mt-radio-inline">
                        <label class="mt-radio">
                            <input type="radio" name="status{{$student['student_id']}}" id="x-{{$student['student_id']}}" value="x" checked> X
                            <span></span>
                        </label>
                        <label class="mt-radio">
                            <input type="radio" name="status{{$student['student_id']}}" id="p-{{$student['student_id']}}" value="p"> P
                            <span></span>
                        </label>
                        <label class="mt-radio">
                            <input type="radio" name="status{{$student['student_id']}}" id="kp-{{$student['student_id']}}" value="kp" > KP
                            <span></span>
                        </label>
                    </div>
                </div>
              </div>
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder="Lý do nghỉ (Nếu có)" name="note{{$student['student_id']}}"> </div>
            <div class="col-md-1">
                <input type="text" class="form-control" placeholder="Kết quả học tập(nếu có)" name="result{{$student['student_id']}}">
            </div>
        </div>
        @endforeach
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn green">Submit</button>
                    <button type="button" class="btn default">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id = "tab_1_3">
        <table class="table table-striped table-bordered table-hover" width="50%">
            <thead>
                <tr>
                    <th> Họ tên </th>
                    <th> Ngày sinh </th>
                    <th> SĐT liên hệ</th>
                    @foreach($allLesson as $lesson)
                        <th>{{date('d-m',strtotime($lesson))}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                
                @foreach($students as $student)
                <?php $dateIndex = 0; ?>
                    <tr>
                        <td>{{$student['lastName']." ".$student['firstName']}}</td>
                        <td>{{$student['dob']}}</td>
                        <td>{{$student['phone']}}</td>
                        @foreach($student['attendance'] as $atd)
                            @if($atd['date'] === $allLesson[$dateIndex])
                                <td><a href="#" class="get-edit" data-value= {{$atd['id']}}>{{$atd['description']['status']}}</a></td>                                
                            @else
                                <td></td>
                            @endif
                            <?php $dateIndex++; ?>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>
<a  id="ajax-edit" data-url="" data-toggle="modal"></a>
<div id="ajax-modal" class="modal fade" tabindex="-1"> </div>

<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
<script type="text/javascript">
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
$(document).ready(function(){
    UIExtendedModals.init();
})
jQuery('.get-edit').click(function(){
    console.log($(this).data('value'));
    $('#ajax-edit').attr('data-url','getEditLesson/'+$(this).data('value'));    
    $('#ajax-edit')[0].click();
})


</script>