<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Phiếu thu</title>
	<link href="../assets/pages/css/invoice.min.css" rel="stylesheet" type="text/css" />

	<link rel='stylesheet' type='text/css' href=" {{ asset('resources/views/invoice/css/invoices.css')}} " />
	<link rel='stylesheet' type='text/css' href=" {{ asset('resources/views/invoice/css/print.css')}} " media="print" />
	<script type='text/javascript' src=" {{ asset('resources/views/invoice/js/jquery-1.3.2.min.js')}} "></script>
	<script type='text/javascript' src=" {{ asset('resources/views/invoice/js/invoice.js')}} "></script>

</head>

<body>

	<div id="page-wrap">

		<div class="row invoice-logo">
        <div class="col-xs-6 invoice-logo-space">
            <img src="../assets/pages/media/invoice/walmart.png" class="img-responsive" alt="" /> </div>
        <div class="col-xs-6">
            <p> #5652256 / 28 Feb 2013
                <span class="muted"> Consectetuer adipiscing elit </span>
            </p>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-xs-4">
            <h3>Client:</h3>
            <ul class="list-unstyled">
                <li> John Doe </li>
                <li> Mr Nilson Otto </li>
                <li> FoodMaster Ltd </li>
                <li> Madrid </li>
                <li> Spain </li>
                <li> 1982 OOP </li>
            </ul>
            <li></li>
        </div>
        <div class="col-xs-4">
            <!-- <h3>About:</h3>
            <ul class="list-unstyled">
                <li> Drem psum dolor sit amet </li>
                <li> Laoreet dolore magna </li>
                <li> Consectetuer adipiscing elit </li>
                <li> Magna aliquam tincidunt erat volutpat </li>
                <li> Olor sit amet adipiscing eli </li>
                <li> Laoreet dolore magna </li>
            </ul> -->
        </div>
        <div class="col-xs-4 invoice-payment">
            <h3>Payment Details:</h3>
            <ul class="list-unstyled">
                <li>
                    <strong>V.A.T Reg #:</strong> 542554(DEMO)78 </li>
                <li>
                    <strong>Account Name:</strong> FoodMaster Ltd </li>
                <li>
                    <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
                <li>
                    <strong>Account Name:</strong> FoodMaster Ltd </li>
                <li>
                    <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
            </ul>
        </div>
    </div>
		
	<table class="table table-striped table-hover" id="items">
	
	  
	  <?php 
	  		function asVnd($value){
	  			return number_format($value,'0','','.')."đ";
	  		}
	  		$total = 0;
	   ?>
	   	<thead>
	        <tr>
	            <th> # </th>
	            <th> Item </th>
	            <th class="hidden-xs"> Description </th>
	            <th class="hidden-xs"> Quantity </th>
	            <th class="hidden-xs"> Unit Cost </th>
	            <th> Total </th>
	        </tr>
	    </thead>
	  <tr>
	      <th>Lớp</th>
	      <th>Miêu tả</th>
	      <th>Học phí</th>
	      <th>Số buổi</th>
	      <th>Tổng</th>
	  </tr>
<script type='text/javascript' src=" {{ asset('resources/views/invoice/js/invoice.js')}} "></script>

		  		<tr class="item-row">
		  			<td class="item-name"><div class="delete-wpr"><textarea></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		  			<td class="description"><textarea>Tiền học tháng </textarea></td>
		  			<td><textarea class="cost"></textarea></td>
				    <td><textarea class="qty"></textarea></td>
				    <td><span class="price"></span></td>
		  		</tr>

			  	<tr>
			      <td colspan="2" class="blank"> </td>
			      <td colspan="2" class="total-line">Tổng Học Phí</td>
			      <td class="total-value"><div id="subtotal"></div></td>
			      <input type="hidden" id="total" value="{{$total}}">
			  	</tr>
	  <th>Lý do nộp</th>	      
      <th>Số Tiền</th>
      
<script type='text/javascript' src=" {{ asset('resources/views/invoice/js/invoiceNonLesson.js')}} "></script>

	  <tr class="item-row">
		  			<td class="item-name"><div class="delete-wpr"><textarea></textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		  			<td class="description"><textarea>Tiền học tháng </textarea></td>
		  			<td><input type="number" class="cost"></td>
				    <td><textarea class="qty"></textarea></td>
				    <td><span class="price"></span></td>
		  		</tr>
	  	<tr id="hiderow">
	    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td></tr>
	    <tr>
      <td colspan="2" class="blank"> </td>
      <td colspan="2" class="total-line">Tổng Học Phí</td>
      <td class="total-value"><div id="subtotal"><?php echo asVnd($total); ?></div></td>
	  </tr>
	  <tr>

      <td colspan="2" class="blank"> </td>
      <td colspan="2" class="total-line">Total</td>
      <td class="total-value"><div id="total">$875.00</div></td>
	  </tr>
	  
	  
	  
	  
	  <tr>
	      <td colspan="2" class="blank"> </td>
	      <td colspan="2" class="total-line">Thanh Toán</td>

	      <td class="total-value"><textarea id="paid">0</textarea></td>
	  </tr>
	  <tr>
	      <td colspan="2" class="blank"> </td>
	      <td colspan="2" class="total-line balance">Số Dư</td>
	      <td class="total-value balance"><div class="due">0</div></td>
	  </tr>
	
	</table>
		
		<div id="terms">
		  <h5>Chú Ý</h5>
		  <textarea>...</textarea>
		</div>
	
	</div>
	
</body>

</html>