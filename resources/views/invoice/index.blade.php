<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Phiếu thu</title>
		
	</head>
	
	<body>
		<link rel="stylesheet" href="{{asset('resources/views/invoice/style.css')}}">
		<script src="{{asset('resources/views/invoice/script.js')}}"></script>
		<header>
			<h1>PHIẾU THU</h1>
			<span><img alt="" src="{{asset('resources/views/invoice/logoAstar.png')}}"></span>
			<address>
				<p>A-STAR EDUCATION CENTER</p>
				<p>29 NGÕ 23 PHỐ ĐỖ QUANG<br>TRUNG HÒA, CẦU GIẤY, HÀ NỘI</p>
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
					<td><span contenteditable>101138</span></td>
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
						<th><span contenteditable>Lớp</span></th>
						<th><span contenteditable>Miêu tả</span></th>
						<th><span contenteditable>Học phí</span></th>
						<th><span contenteditable>Số buổi</span></th>
						<th><span contenteditable>Tổng</span></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
			<a class="add">+</a>
			<table class="balance">
				<tr>
					<th><span contenteditable>Số tiền cần đóng</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Số tiền thu</span></th>
					<td><span data-prefix>$</span><span contenteditable>0.00</span></td>
				</tr>
				<tr>
					<th><span contenteditable>Tiền thừa</span></th>
					<td><span data-prefix>$</span><span>600.00</span></td>
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