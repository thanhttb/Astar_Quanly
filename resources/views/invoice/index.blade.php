<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Phiếu thu</title>
		
	</head>
	<?php  
        function moneyval($value){
        	$formated = str_replace('-', '', str_replace(' ', '', $value));
        	$money = intval(str_replace('_', '', $formated));
        	return $money;
        }
        function asVnd($value){
        	return number_format(moneyval($value),'0','','.')."đ";
        }
        $total = 0;
        function convert_number_to_words($number) {
 
		$hyphen      = ' ';
		$conjunction = '  ';
		$separator   = ' ';
		$negative    = 'âm ';
		$decimal     = ' phẩy ';
		$dictionary  = array(
		0                   => 'Không',
		1                   => 'Một',
		2                   => 'Hai',
		3                   => 'Ba',
		4                   => 'Bốn',
		5                   => 'Năm',
		6                   => 'Sáu',
		7                   => 'Bảy',
		8                   => 'Tám',
		9                   => 'Chín',
		10                  => 'Mười',
		11                  => 'Mười một',
		12                  => 'Mười hai',
		13                  => 'Mười ba',
		14                  => 'Mười bốn',
		15                  => 'Mười năm',
		16                  => 'Mười sáu',
		17                  => 'Mười bảy',
		18                  => 'Mười tám',
		19                  => 'Mười chín',
		20                  => 'Hai mươi',
		30                  => 'Ba mươi',
		40                  => 'Bốn mươi',
		50                  => 'Năm mươi',
		60                  => 'Sáu mươi',
		70                  => 'Bảy mươi',
		80                  => 'Tám mươi',
		90                  => 'Chín mươi',
		100                 => 'trăm',
		1000                => 'ngàn',
		1000000             => 'triệu',
		1000000000          => 'tỷ',
		1000000000000       => 'nghìn tỷ',
		1000000000000000    => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
		);
		 
		if (!is_numeric($number)) {
				return false;
		}
		 
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
		// overflow
			trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
		);
		return false;
		}
		 
		if ($number < 0) {
				return $negative . convert_number_to_words(abs($number));
		}
		 
		$string = $fraction = null;
		 
		if (strpos($number, '.') !== false) {
				list($number, $fraction) = explode('.', $number);
		}
		 
		switch (true) {
				case $number < 21:
				$string = $dictionary[$number];
				break;
				case $number < 100:
			$tens   = ((int) ($number / 10)) * 10;
			$units  = $number % 10;
			$string = $dictionary[$tens];
			if ($units) {
					$string .= $hyphen . $dictionary[$units];
			}
			break;
		case $number < 1000:
		$hundreds  = $number / 100;
		$remainder = $number % 100;
		$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		if ($remainder) {
		$string .= $conjunction . convert_number_to_words($remainder);
		}
		break;
		default:
		$baseUnit = pow(1000, floor(log($number, 1000)));
		$numBaseUnits = (int) ($number / $baseUnit);
		$remainder = $number % $baseUnit;
		$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
		if ($remainder) {
		$string .= $remainder < 100 ? $conjunction : $separator;
		$string .= convert_number_to_words($remainder);
		}
		break;
		}
		 
		if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
		$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
		}
		 
		return $string;
		}
     ?>

	<body>
		<link rel="stylesheet" href="{{asset('resources/views/receipt/style.css')}}">
		<script src="{{asset('resources/views/receipt/script.js')}}"></script>
		<header>
			<h1>PHIẾU THU</h1>
			<span><img alt="" src="{{asset('resources/views/receipt/logoAstar.png')}}"></span>
			<address>
				<p>Trung tâm bồi dưỡng văn hóa A-STAR</p>
				<p>29 NGÕ 23 PHỐ ĐỖ QUANG,TRUNG HÒA, CẦU GIẤY, HÀ NỘI</p>
				<p>091.635.5518 - 043.568.1888</p>
			</address>
			
		</header>
		<article>
			<h1>Recipient</h1>
			<address contenteditable>
				<p>Học sinh: <br>Tên học sinh</p>
			</address>
			<table class="meta">
				<tr>
					<th><span>Phiếu thu #</span></th>
					<td><span contenteditable>{{$receipt->id}}</span></td>
				</tr>
				<tr>
					<th><span>Ngày</span></th>
					<td><span contenteditable id="date">{{date('d/m/Y')}}</span></td>
				</tr>
				<tr>
					<th><span>Số tiền</span></th>
					<td><span id="prefix" ></span><span>0</span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span contenteditable>Diễn giải</span></th>

						<th><span contenteditable>Thành tiền</span></th>
						<th><span contenteditable>Ghi chú</span></th>
					</tr>
				</thead>
				<tbody>
					@for($i =0; $i < $request['count']; $i++)
					    <?php $diengiai ='Lớp '.str_replace('hp', 'học phí tháng ', str_replace('#',' ',$request['tag'.$i]));
					    	$total += is_null($request['total'])? moneyval($request['money'.$i]): moneyval($request['amount'.$i]);
					     ?>
						<tr>
							<td><span contenteditable>{{$diengiai}}</span></td>
							<td>{{is_null($request['total'])? asVnd($request['money'.$i]): asVnd($request['amount'.$i])}}</td>
							<td><span contenteditable></span></td>

						</tr>
					@endfor
					@if($request['otherFee'] != 0)
						<tr>
							<td> <span contenteditable>Phụ phí</span></td>
							<td>{{asVnd($request['otherFee'])}}</td>
						</tr>
					@endif
				</tbody>
			</table>
			<table class="balance">
				<tr>
					<th><span contenteditable>Tổng tiền(bằng số)</span></th>
					<td><span>{{asVnd($total)}}</span></td>
				</tr>
				<tr>
					<th><span>Tổng tiền (bằng chữ)</span></th>
					<td>
						{{convert_number_to_words($total)}} đồng
					</td>
				</tr>
				
				</tr>
			</table>
		</article>

		<div>
			<table >
				<thead>
					<th>Người nộp tiền</th>
					<th>Người lập phiếu</th>
					<th>Thủ quỹ</th>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td>{{Auth::user()->name}}</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
		<span style="display:inline-block; height: 200px;"></span>
		<aside>
			<h1><span contenteditable>GHI CHÚ</span></h1>
			<div contenteditable>
				<p>Thêm ghi chú, nếu không xóa đi
				Chuyển Khoản || Thu trực tiếp ?
				</p>
			</div>
		</aside>
	</body>
</html>