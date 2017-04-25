<form method="PUT" action="#" id="modal-form">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" id="transactionId" value="{{$result['id']}}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Sửa ngày học: {{$result['date']}}</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <h4>{{$student['lastName'].' '.$student['firstName']}}</h4>
                <div class="form-group">
                    <label class="col-md-3 control-label">Giáo viên</label>
                    <div class="col-md-9">
                        <select class="form-control select2">
                            <option selected value="{{$teacher['id']}}">{{$teacher['name']}}</option>
                            @foreach($allTeacher as $t)
                                <option value={{$teacher['id']}}>{{$t['name']}}</option>
                                
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Trạng thái</label>
                    <div class="col-md-9">
                        <div class="mt-radio-inline">
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios25" value="x" checked=""> X
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios26" value="p" checked=""> P
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios27" value="kp" > XP
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Ghi chú</label>
                    <div class="col-md-9">
                        <div class="input-icon">
                            <i class="fa fa-bell-o"></i>
                            <input name="note" type="text" class="form-control" placeholder="{{$result['description']['note']}}" value="{{$result['description']['note']}}"> </div>
                    </div>
                </div>
               <div class="form-group">
                    <label class="col-md-3 control-label">Ghi chú</label>
                    <div class="col-md-9">
                        <div class="input-icon">
                            <i class="fa fa-bell-o"></i>
                            <input name="mark" type="text" class="form-control" placeholder="{{$result['description']['mark']}}" value="{{$result['description']['mark']}}"> </div>
                    </div>
                </div>
                @if($result['description']['status'] === 'p')
                    <h4>Xếp lịch học bù</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hẹn ngày</label>
                        <div class="col-md-9">
                            <div class="input-icon">
                                <i class="fa fa-bell-o"></i>
                                <input type="text" class="form-control form_datetime" placeholder="" name="hb_date"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-3 control-label">Giáo viên</label>
                        <div class="col-md-9">
                            <select class="form-control select2" name="hb_trogiang">
                                @foreach($trogiang as $tg)
                                    <option value='{{$tg['id']}}'>{{$tg['name']}}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Nội dung</label>
                        <div class="col-md-9">
                            <div class="input-icon">
                                <i class="fa fa-bell-o"></i>
                                <input type="text" class="form-control" placeholder="" name="hb_content"> </div>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn default" data-dismiss="modal">Đóng</button>
        <button type="button" id="submit" class="btn blue">Lưu thay đổi</button>
    </div>
</form>
<link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}">


<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>        <!-- END PAGE LEVEL PLUGINS -->

<script src="{{asset('assets/pages/scripts/components-select2.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
            autoclose: true,
            isRTL: App.isRTL(),
            format: "dd/mm/yyyy - hh:ii",
            pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
        });
    $('#submit').click(function(){
        $.ajaxSetup({
            header:{
                'X-CSRF-TOKEN' : $('input[name = "_token"]').attr('value')
            }
        })
        $.ajax({
            type: 'PUT',
            url: '/astar/postEditLesson/'+ $('#transactionId').val(),
            data: $('#modal-form').serialize(),
            success: function(data){
                console.log(data);
            },
            error: function(data){

            }
        })
    })
</script>