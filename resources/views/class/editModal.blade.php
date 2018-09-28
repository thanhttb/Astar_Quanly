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
                        <select class="form-control select2" name="gv">
                            <option selected value="{{$teacher['id']}}">{{$teacher['name']}}</option>
                            @foreach($allTeacher as $t)
                                <option value={{$t['id']}}>{{$t['name']}}</option>
                                
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Trạng thái</label>
                    <div class="col-md-9">
                        <div class="mt-radio-inline">
                            <label class="mt-radio">
                                @if($result['description']['status'] == 'x')
                                    <input type="radio" name="optionsRadios" id="optionsRadios25" value="x" checked=""> X
                                @else
                                    <input type="radio" name="optionsRadios" id="optionsRadios25" value="x"> X
                                @endif
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                @if($result['description']['status'] == 'p')
                                    <input type="radio" name="optionsRadios" id="optionsRadios26" value="p" checked=""> P
                                @else
                                    <input type="radio" name="optionsRadios" id="optionsRadios26" value="p"> P
                                @endif
                                <span></span>
                            </label>
                            <label class="mt-radio">
                                @if($result['description']['status'] == 'kp')
                                    <input type="radio" name="optionsRadios" id="optionsRadios27" value="kp" checked=""> KP
                                @else
                                    <input type="radio" name="optionsRadios" id="optionsRadios27" value="kp"> KP
                                @endif
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
                    <label class="col-md-3 control-label">Kết quả học tập</label>
                    <div class="col-md-9">
                        <div class="input-icon">
                            <i class="fa fa-bell-o"></i>
                            <input name="mark" type="text" class="form-control" placeholder="{{$result['description']['mark']}}" value="{{$result['description']['mark']}}"> </div>
                    </div>
                </div>
                @if($result['description']['status'] === 'p')
                <h4>Xếp lịch học bù</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Trạng thái</label>
                        <div class="col-md-9">
                            <div class="mt-radio-inline">
                                <label class="mt-radio">
                                    @if($result['description']['hb_status'] == 'Từ chối')
                                        <input type="radio" name="hb_status" id="hb1" value="Từ chối" checked=""> Từ chối

                                    @else
                                        <input type="radio" name="hb_status" id="hb1" value="Từ chối"> Từ chối
                                    @endif
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    @if($result['description']['hb_status'] == 'Đã xếp lịch')
                                        <input type="radio" name="hb_status" id="hb2" value="Đã xếp lịch" checked=""> Đã xếp lịch
                                    @else
                                        <input type="radio" name="hb_status" id="hb2" value="Đã xếp lịch"> Đã xếp lịch
                                    @endif
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    @if($result['description']['hb_status'] == 'Chưa xếp lịch')
                                        <input type="radio" name="hb_status" id="hb2" value="Chưa xếp lịch" checked=""> Chưa xếp lịch
                                    @else
                                        <input type="radio" name="hb_status" id="hb2" value="Chưa xếp lịch"> Chưa xếp lịch
                                    @endif
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    @if($result['description']['hb_status'] == 'Đã học bù')
                                        <input type="radio" name="hb_status" id="hb2" value="Đã học bù" checked=""> Đã học bù
                                    @else
                                        <input type="radio" name="hb_status" id="hb2" value="Đã học bù"> Đã học bù
                                    @endif
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Hẹn ngày</label>
                        <div class="col-md-9">
                            <div class="input-icon">
                                <i class="fa fa-bell-o"></i>
                                <input type="text" class="form-control form_datetime" placeholder="" name="hb_date" value="{{$result['description']['hb_date']}}"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="col-md-3 control-label">Giáo viên</label>
                        <div class="col-md-9">
                            <select class="form-control select2" name="hb_trogiang">
                                    <option value="{{$result['description']['hb_trogiang']}}">{{$trogiang}}</option>
                                @foreach($allTrogiang as $tg)
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
                                <input type="text" class="form-control" placeholder="" name="hb_content" value="{{$result['description']['hb_content']}}"> </div>
                        </div>
                    </div>
                @endif

            </div>
<!--                             <?php echo "<pre>";
                print_r($result); ?> -->
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="cancel" class="btn default" data-dismiss="modal">Đóng</button>
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
            type: 'POST',
            url: '/astar/postEditLesson/'+ $('#transactionId').val(),
            data: $('#modal-form').serialize(),
            dataType: "json",
            success: function(data){
                $('#cancel')[0].click();
                $('#load-student')[0].click();                
            },
            error: function(data){
                 console.log('that bai');
            }
        })
        
    })
</script>