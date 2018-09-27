
<div class="row">

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
        <div class="portlet-body form">
            <form class="form-horizontal" role="form" action={{url('/postThuHocPhi/'.$data['stdAcc'])}} method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="form-body">
                    <div class="col-md-12 form-group">                        
                        <label class="control-label">Học sinh</label>
                        <input type="text" name="student" class="form-control" placeholder="Nhập tên học sinh" value="{{$student[0]['lastName']." ".$student[0]['firstName']}}">
                        <input type="hidden" name="stuAcc" value="{{$data['stdAcc']}}">

                   </div>
                    <div class="col-md-12 form-group mt-repeater">
                            <div data-repeater-list="khoanthu">
                               <!--  Hoc phi -->
                               <?php $name = 0; ?>
                               @if(array_key_exists("Classes", $data))

                               @foreach($data['Classes'] as $class => $tuitions)
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <h4 style="text-decoration: underline;"> {{$classes_info[$class]}} </h4>          
                                        </div>                              
                                    </div>
                                    @foreach($tuitions as $periods => $amounts) 
                                        @if($amounts == 0) 
                                        @else
                                        <div data-repeater-item class="mt-repeater-item">
                                            <div class="row mt-repeater-row">
                                                <input type="hidden" name="class_id" value="{{$class}}">
                                                <input type="hidden" name="periods_id" value="{{$periods}}">
                                                <div class="col-md-7">
                                                    <label class="control-label">Diễn giải</label>
                                                    <input type="text" placeholder="" class="form-control " name="note" value="Học phí {{$periods_info[$periods]}}" /> </div>

                                                <div class="col-md-5">
                                                    <label class="control-label">Số tiền</label>                                                 

                                                    
                                                    <input type="text" placeholder="VND" class="form-control mask_currency" name="amount" value="{{$amounts}}" /> 
                                                </div>                                    
                                            </div>
                                        </div>
                                       @endif

                                    @endforeach 
                               @endforeach
                               @endif
                            </div>
                                    
                           
                            <input type="hidden" name="count" value="{{$name}}">               
                    <div class="form-group">
                        <label class="col-md-3 control-label">Phương thức</label>
                        <div class="col-md-9">
                            <div class="mt-radio-list">
                                <label class="mt-radio mt-radio-outline">
                                    <input type="radio" name="method" id="vcb" value="VCB" > Chuyển khoản (VCB)
                                    <span></span>
                                </label>
                                <label class="mt-radio mt-radio-outline">
                                    <input type="radio" name="method" id="tcb" value="TCB" > Chuyển khoản (TCB)
                                    <span></span>
                                </label>
                                <label class="mt-radio mt-radio-outline">
                                    <input type="radio" name="method" id="cash" value="CASH" checked=""> Thu trực tiếp
                                    <span></span>
                                </label>
                                <label class="mt-radio mt-radio-outline">
                                    <input type="radio" name="method" id="voucher" value="VOUCHER"> Voucher
                                    <span></span>
                                </label>
                                <label class="mt-radio mt-radio-outline">
                                    <input type="radio" name="method" id="quetthe" value="quetthe"> Quẹt thẻ (VCB)
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Người lập</label>
                        <div class="col-md-9">
                            <input type="text" name="user" class="form-control input-inline input-medium"  value= {{Auth::user()->name}} >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ngày lập</label>
                        <div class="col-md-9">
                            <input type="text" name="date"  id="mask_date" class="form-control input-inline input-medium" value = {{date('d/m/Y')}} >
                        </div>
                    </div>
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
        });

</script>
