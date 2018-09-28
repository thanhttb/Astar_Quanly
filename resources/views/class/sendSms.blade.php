<?php 
function asVnd($value){
            return number_format($value,'0','','.');
        }   ?>
<form method="GET" action="#" id="modal-form">
<input type="hidden" name="_token" value="{{csrf_token()}}">
<div id="ajax-modal" class="modal fade in" tabindex="-1" style="display: block; margin-top: -289.25px; " aria-hidden="false"><div class="modal-header" style="background: white;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">SMS Gateway</h4>
</div>

<div class="modal-body" style="background: white;">
    <div class="row">   
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">Họ tên học sinh
                </label>
                <div class="col-md-9">
                    <div class="input-icon">
                        <i class="fa fa-phone"></i>
                        <input name="student" type="text" class="form-control" placeholder="{{$request['amp;lastName']}} {{$request['amp;firstName']}}" value=""> </div>
                </div>  
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Số tiền cần đóng</label>
                <div class="col-md-9">
                    <div class="input-icon">
                        <i class="fa fa-bell-o"></i>
                        <input name="amount" type="text" class="form-control" placeholder="" value="{{asVnd($request['amp;lastBalance']+$request['amp;otherFee']+$request['amp;tuition'])}}">                       
                        </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Số điện thoại phụ huynh</label>
                <div class="col-md-9">
                    <div class="input-icon">
                        <i class="fa fa-phone"></i>
                        <input name="phone" type="text" class="form-control" placeholder="" value="{{$request['amp;phone']}}"> </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            
            <div class="form-group">
                <label class="col-md-3 control-label">Nội dung</label>
                <div class="col-md-9">
                    <div class="input-icon">
                        <i class="fa fa-bell-o"></i>                       
                        <textarea rows="4" name="content" class="form-control" placeholder="[TB ASTAR] Kinh gui PHHS TT BDVH A-star xin thong bao dia diem thi thu lan 2: chieu T7 (06/05) thi mon Van va Anh tai P602, so 1 Hoang Dao Thuy (toa nha cong nghe thong tin). Ngay CN (07/05) tat ca cac mon thi tai TT Astar, so 29 ngo 23 Do Quang."></textarea> </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
<div class="modal-footer" style="background: white;">
    <button type="button" class="btn default" data-dismiss="modal">Đóng</button>
    <button type="button" class="btn blue" id="submit">Gửi</button>
</div>

</div>
</form>
<script type="text/javascript">
    $('#submit').click(function(){
        $.ajaxSetup({
            header:{
                'X-CSRF-TOKEN' : $('input[name = "_token"]').attr('value')
            }
        })
        $.ajax({
            type: 'GET',
            url: "{{route('sendMessage')}}",
            data: $('#modal-form').serialize(),
            dataType: "json",
            success: function(data){
                console.log('thanhcong');
            },
            error: function(data){
                 console.log('that bai');
            }
        })
        
    })
</script>