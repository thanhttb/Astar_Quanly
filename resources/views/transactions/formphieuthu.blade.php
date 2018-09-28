@extends('layouts.master')
@section('content')
<?php
    include(app_path().'/xcrud/xcrud.php');
    include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js(); ?>
<div class="col-md-6 ">

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- BEGIN SAMPLE FORM PORTLET-->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-bank font-dark"></i>
                <span class="caption-subject font-dark sbold uppercase">Phiếu Thu</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal" role="form" action={{url('/postReceipt')}} method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-body">
                    <!-- <div class="col-md-12 form-group">                        
                            <label class="control-label">From</label>
                            <input type="text" name="from" class="form-control" placeholder="From" id="from">
                       </div> -->
                    <div class="col-md-12 form-group">                        
                        <label class="control-label">To</label>
                        <input type="text" name="student" class="form-control" placeholder="Nhập tên học sinh" id="to">
                   </div>
                    <div class="col-md-12 form-group mt-repeater">
                        <div data-repeater-list="khoanthu">
                            <div data-repeater-item class="mt-repeater-item">
                                <div class="row mt-repeater-row">
                                    <div class="col-md-7">
                                        <label class="control-label">Diễn giải</label>
                                        <input type="text" placeholder="" class="form-control " name="note" /> </div>
                                    <div class="col-md-4">
                                        <label class="control-label">Số tiền</label>
                                        <input type="text" placeholder="VND" class="form-control mask_currency" name="amount" /> </div>

                                    <div class="col-md-1">
                                        <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                            <i class="fa fa-close"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add" id="add-khoan-thu">
                            <i class="fa fa-plus"></i>Thêm khoản thu</a>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Phương thức</label>
                        <div class="col-md-9">
                            <div class="mt-radio-list">
                                <label class="mt-radio mt-radio-outline">
                                    <input type="radio" name="method" id="vcb" value="vcb" checked=""> Chuyển khoản (VCB)
                                    <span></span>
                                </label>
                                <label class="mt-radio mt-radio-outline">
                                    <input type="radio" name="method" id="tcb" value="tcb" checked=""> Chuyển khoản (TCB)
                                    <span></span>
                                </label>
                                <label class="mt-radio mt-radio-outline">
                                    <input type="radio" name="method" id="cash" value="cash" checked=""> Thu trực tiếp
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Người lập</label>
                        <div class="col-md-9">
                            <input type="text" name="user" class="form-control input-inline input-medium" placeholder= "{{Auth::user()->name}}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ngày lập</label>
                        <div class="col-md-9">
                            <input type="text" name="date"  id="mask_date" class="form-control input-inline input-medium" placeholder = "{{date('d/m/Y')}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green" id="submit">Submit</button>
                            <button type="button" class="btn default">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<div class="col-md-6">
    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Danh sách</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>            
                <a href="javascript:;" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
            <ul class="nav nav-tabs">            
                <li>
                    <a href="#tab_1_1" data-toggle="tab"> Danh sách trong ngày </a>
                </li>
                <li>
                    <a href="#tab_1_2" data-toggle="tab"> Danh sách tổng</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" id="tab_1_1">
                    <div class="portlet light bordered">                
                            <div class="portlet-body">
                                <?php
                                    $r = Xcrud::get_instance();
                                    $r->table('receipt')->where('created_at >',date('Y-m-d 00:00:00'))->where('created_at <',date('Y-m-d 23:59:59'));
                                    $r->table_name('Phiếu thu ngày hôm nay');
                                    $r->order_by('created_at','desc');
                                    $r->columns('id,account,description,amount,type,receiver,created_at');
                                    $r->label(['id'=>'#','account'=>'Người nộp','description'=>'Diễn giải','amount'=>'Số tiền','type'=>'Loại','receiver'=>'Người nhận','created_at'=>'Ngày nhận']);
                                    $r->sum('amount');
                                    $r->change_type('amount','price','0');
                                    if(Auth::user()->permission < 2){
                                        $r->disabled('amount,type,receiver','edit');
                                        $r->unset_remove();

                                    }
                                    $r->hide_button('add');
                                    echo $r->render('list');
                                    ?>
                            </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tab_1_2">
                    <div class="portlet light bordered">                
                        <div class="portlet-body">
                            <?php
                                    $r = Xcrud::get_instance();
                                    $r->table('receipt');
                                    $r->table_name('Tổng');
                                    $r->order_by('created_at','desc');
                                    $r->columns('id,account,description,amount,type,receiver,created_at');
                                    $r->label(['id'=>'#','account'=>'Người nộp','description'=>'Diễn giải','amount'=>'Số tiền','type'=>'Loại','receiver'=>'Người nhận','created_at'=>'Ngày nhận']);
                                    $r->sum('amount');
                                    $r->change_type('amount','price');
                                    if(Auth::user()->permission < 2){
                                        $r->disabled('amount,type,receiver','edit');
                                        $r->unset_remove();

                                    }
                                    $r->hide_button('add');
                                    echo $r->render('list');

                                ?>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

</div>

<script src="{{asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>

<!-- <script src="{{asset('assets/pages/scripts/form-input-mask.js')}}" type="text/javascript"></script>
 -->
<script src="{{asset('assets/global/plugins/jquery-repeater/jquery.repeater.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    var Phieuthu = function () {

        return {
            //main function to initiate the module
            init: function () {
                $('.mt-repeater').each(function(){
                    $(this).repeater({
                        show: function () {
                            $(this).slideDown();
                            $('.date-picker').datepicker({
                                rtl: App.isRTL(),
                                orientation: "left",
                                autoclose: true
                            });
                            $(".mask_currency").inputmask('999 999 999', {
                                numericInput: true
                            });
                        },

                        hide: function (deleteElement) {
                            if(confirm('Are you sure you want to delete this element?')) {
                                $(this).slideUp(deleteElement);
                            }
                        },
                        ready: function(){
                            $(".mask_currency").inputmask('999 999 999', {
                                numericInput: true
                            }); 

                        }


                    });
                });
            }

        };

    }();
    jQuery(document).ready(function() {
            Phieuthu.init();
            var count = 0;
            $('#add-khoan-thu').click(function(){
                count++;
            });
            $('.mt-repeater-delete').click(function(){
                count--;
            });
            $('#submit').click(function(){
                for (var i = 0; i <= count; i++) {

                    var description = "[name = 'khoanthu["+i+"][note]']";
                    var amount = "[name = 'khoanthu["+i+"][amount]']";
                    var m = $(amount).val().replace(/_/g,'');
                    m = m.replace(/ /g,'');
                    console.log(m);
                    var text = $('#from').val() +' '+ $('#to').val()+' '+$(description).val()+ ' '+ m;

                    $.post("https://app.bkper.com/hooks/agtzfmJrcGVyLWhyZHITCxIGTGVkZ2VyGICAgObr8LgKDA/c68qvjj1muefesv9valjk71bfo",
                        {
                       "text":text,
                       "user_name":"Thành"
                    });
                };
            });
            $('#thuchi-0').addClass('open active');
            $('#thuchi-3').addClass('open active');
        });

</script>
@endsection