<!doctype html>
<?php  
    function moneyval($value){
    	$formated = str_replace('-', '', str_replace(' ', '', $value));
    	$money = intval(str_replace('_', '', $formated));
    	return $money;
    }
    function asVnd($value){
    	return number_format(moneyval($value),'0','','.')."đ";
    }

 ?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Thông báo học phí</title>
		<link rel="license" href="http://www.opensource.org/licenses/mit-license/">
	</head>
	<body style="font-size: 14px;">
		<link rel="stylesheet" href="{{asset('resources/views/print/style.css')}}">
		<script src="{{asset('resources/views/print/script.js')}}"></script>
		<header>
			
			<span><img alt="" src="{{asset('resources/views/invoice/logoAstar.png')}}"></span>
			<address>
				<p style="font-size: 18px; ">TRUNG TÂM BỒI DƯỠNG VĂN HÓA A-STAR</p>
				<p>Địa chỉ: Nhà 5 ngõ 3 phố Phạm Tuấn Tài, Dịch Vọng Hậu, Cầu Giấy, HN</p>
				<p>Website: www.astar.edu.vn • Email: info@astar.edu.vn</p>
				<p>Điện thoại: 024.73063868 • Di động: 091.635.5518</p>
			</address>			
		</header>
		<h1 id="tbhp">Thông báo học phí</h1>
		<article>
			<table class="info">
				<tr>
					<td style="text-align: left;">
						Học sinh: <span contenteditable ><p id="name">{{$request->lastName}} {{$request->firstName}}</p></span>			
					</td>
					<td style="text-align: center;">
						Ngày sinh: <span contenteditable><p  id="dob">{{(empty($request->dob) ? "": date('d/m/Y',strtotime($request->dob)))}}</p></span>
					</td>
					<td style="text-align: right;"> 						
						<span contenteditable id="class">Lớp {{$request->class}}</span>
					</td>
				</tr>
			
			</table>
			
			<!-- <table class="meta">
				<tr>
					<th><span>Phiếu thu #</span></th>
					<td><span contenteditable></span></td>
				</tr>
				<tr>
					<th><span>Ngày</span></th>
					<td><span contenteditable id="date"></span></td>
				</tr>
				<tr>
					<th><span>Số tiền</span></th>
					<td><span id="prefix" ></span><span></span></td>
				</tr>
			</table> -->
			<table class="inventory" width="50%">
				<thead>
					<tr>
						<th width="50%"><span contenteditable>Nội dung</span></th>
						<th width="50%"><span>Số tiền</span></th>

					</tr>
				</thead>
				<tbody>

				@foreach($periods as $p)
				<?php 
						$p = $p->toArray();
						$r = $request->toArray();
						// echo "<pre>";
						// print_r($r);

					 ?>
					@if(array_key_exists('p'.$p['id'], $r))
						<tr>
							<td>Học phí {{$p[*'name']}}</td>
							<td>{{asVnd($r['p'.$p['id']])}}</td>
						</tr>
					@endif
				@endforeach
						
					
				</tbody>
			</table>
			<p style="font-size: 14px; margin-bottom: 5px;">
				Đề nghị CMHS nộp tiền Học phí cho con <span contenteditable style="font-weight:bold;">trước ngày 14/04/2017</span> tại VP Trung tâm hoặc chuyển khoản.
				Trong trường hợp HS không hoàn thành học phí đúng thời hạn, Trung tâm có thể cho học sinh tạm nghỉ học.								
				</p>
			<table class="note">
				<tr><td style="font-weight: bold;">1903 1379 488 688</td></tr>
				<tr><td>Nguyễn Quyết Thắng - Phan Việt Anh</td> </tr>
				<tr><td>Techcombank, Chi nhánh Hoàng Cầu</td></tr>
				<tr><td colspan="2">Nội dung chuyển tiền: đề nghị ghi rõ '<span contenteditable style="font-weight:bold;">Học phí , {{$request->lastName." ".$request->firstName}}, lớp {{$request->class}}</span>' </td></tr>


			</table>
			
		</article>
		
		

	</body>

</html>