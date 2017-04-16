<?php
	// include(app_path().'/xcrud/xcrud.php');
	// include(app_path().'/xcrud/functions.php');
 //    echo Xcrud::load_css();
 //    echo Xcrud::load_js();
    function asVnd($value){
        return number_format($value,'0','','.')."  VND";
    }
    $total = 0;
    $count =0;
?>
<form action="{{url('recieve/'.$accountId)}}" method="POST" >
<table class="table table-condensed table-hover">
    <thead>
        <tr>         
            <th> Miêu tả </th>
            <th width="40%"> Số Tiền </th>

        </tr>
    </thead>
    <tbody>
        
        <input type="hidden" name="_token" value="{{csrf_token()}}" >
        <input type="hidden" name="studentAccount" value={{$data['stdAcc']}} >
        @foreach($data as $class => $months)
        	@if(is_array($months))
        		@foreach($months as $month => $amount)
	        		<tr>
	        			<td>Lớp {{$class}}: Học phí tháng {{$month}} </td>
	        			<td>
			        		<input class="form-control mask_currency" type="text" placeholder={{asVnd($amount)}} name= money{{$count}} />
			        		<input type="hidden" name=tag{{$count}} value= #{{$class }}#hp{{($month<10)? ('0'.$month): $month}} >
			        		<input type="hidden" name=amount{{$count}} value={{$amount}}>
			        	</td>
			        	<?php $count++; ?>
	        		</tr>
	        	@endforeach
        	@endif
        @endforeach
        <input type="hidden" name="count" value={{$count}}>
        
        	<tr>
	        	<td>Phụ Phí</td>
	        	<td>
	        		<input class="form-control mask_currency" type="text" placeholder={{asVnd($data['otherFee'])}}  name='otherFee' />
	        		<input type="hidden" name="otherFee" value={{$data['otherFee']}}>
	        	</td>
	        </tr> 	
     
	           
        <tr>
        	<td>Phương thức TT</td>
        	<td>
        		<select class="form-control" name="method">
        			<option value="8" selected="">Tiền mặt</option>
        			<option value="9">VCB</option>
        			<option value="10">TCB</option>
        			<option value="11">Voucher</option>
        		</select>
        	</td>
        </tr>
        <tr>

        	<td><input type="Submit" value="Đóng tiền + In phiếu thu"></td>
        	<td>
        		<input class="form-control mask_currency"  type="text" placeholder={{asVnd($data['total'])}} name="total" />
        	</td>
        </tr>
    </tbody>
</table>
        </form>

<script src="{{asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/pages/scripts/form-input-mask.js')}}" type="text/javascript"></script>
