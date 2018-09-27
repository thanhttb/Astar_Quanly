<?php 
	$input = fopen('inputlong.csv', 'r');
 ?>
 <!DOCTYPE>
 <html>
 <head class="no-print">
 	<title>Testing</title>
 	<meta charset="utf-8">
 		  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
<style >
	body {
		  background: rgb(204,204,204); 
		}
		page {
		  background: white;
		  display: block;
		  margin: 10 auto;
		  margin-bottom: 0.5cm;
		  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
		}
		.container-fluid{
			 padding-right: 40px;
		  	padding-left: 40px;
		  	position: relative;
		}
		page[size="A4"], .container-fluid {  
		  width: 21cm;
		  height: 29.7cm; 

		}
		@media print {
		  body, page {
		    margin: 0;
		    box-shadow: 0;
		  }
		}
	.vertical-center {
	    vertical-align: middle !important;
	    align: center !important; 
	}
	  #table{
	    max-height: 29cm;
	    width:100%;
	    font-size: 10;
	  }
	  #table td{
	    width: auto;
	    overflow: hidden;
	    word-wrap: break-word;
	    padding: 3;
	  }


	#logo{
		float:left;
		width: 70px;
		padding-top: 10;
		padding-bottom: 10;
		max-width: 80;
	}
	#header h3{
		font-family: 'Verdana';
		font-weight: bold;
		color: #0085c8;
		float:left;
		margin: 0;
		padding: 10;


	}
	#header h4{
		font-family: 'Verdana';
		color: #0085c8;
		float:left;
		margin:0;padding: 10;
	}
	@page { size: auto;  margin: 10mm; }

	#table thead{
		background-color: #007dc1;
	}
	#table th{
		color: white;
		text-align: center;
		text-transform: uppercase;

	}
	.dac-biet{
		background-88color: #ffedb9;

	}
	#right-header{
		width: 200px;
		padding: 0;
		float: right;
	}
	#img-right-header{
		float: right;
	}
	#footer{
	    margin-left: -40;
	    bottom:0;
	    position: absolute;
	}
</style>
 <body id="body">
 <page size="A4">
		<div class="container-fluid">
 		
 		<div class="row" id="header" style="width: 107.6%;">
 			<div class="col-md-1" style="padding-top: 65">
	 			<img src="unilever.png" id="logo">
	 		</div>
			<div class="col-md-7"  style="padding-top: 65; padding-right:0;"> 				
 				<h3>CHƯƠNG TRÌNH KHUYẾN MÃI</h3><br>
				<h4>Tuần 14 tháng 8</h4>	
 			</div>
 			<div class="col-md-4" style="max-height: 200px; padding-right: 0;">
 				<img src="header_right.jpg" style="float: right; width: 110%">
 			</div>	
		</div>
 		<?php
 			function init($array){
 				if(empty($array)){
 					$array = [];
 				}
 				return $array;
 			}
 			$priority = ['HAIR','Hair','ORAL','Oral','Skin','SKIN','Sc','SC','DEO','Deo'];
    		$name = [ "HAIR" => "CHĂM SÓC TÓC",
    					"Hair" => "CHĂM SÓC TÓC",
    					"Oral" => "CHĂM SÓC RĂNG MIỆNG",
    					"ORAL" => "CHĂM SÓC RĂNG MIỆNG",
    					"SKIN" => "CHĂM SÓC DA",
    					"Skin" => "CHĂM SÓC DA",
    					"SC" => "CHĂM SÓC CƠ THỂ",
    					"DEO" => "NGĂN MÙI",
    					"Deo" => "NGĂN MÙI"];
    		$color = ["HAIR" => '#fed47f',
    					"ORAL" => "#5e9cd3",
    					"SKIN" => "#72ac4d",
    					"SC" => "#fd7f7c",
    					"DEO" => "#a6a6a6",
    					"Hair" => '#fed47f',
    					"Oral" => "#5e9cd3",
    					"Skin" => "#72ac4d",
    					"SC" => "#fd7f7c",
    					"Deo" => "#a6a6a6"];
    		$cat = [];
    		$brand = [];
    		$type = [];
    		$line = [];
    		$kc = [];
    		$count = array();
    		$temp = '';
    		while($data = fgetcsv($input,10000,',')){
    			// echo "<pre>";
    			// print_r($data);

    			if(empty($cat[$data[0]])){
    				$cat[$data[0]] = [];
    			}
    			if(empty($cat[$data[0]][$data[1]])){
    				$cat[$data[0]][$data[1]] = [];
    			}
    			if(empty($cat[$data[0]][$data[1]][$data[3]])){
    				$cat[$data[0]][$data[1]][$data[3]] = [];
    			}
    			if(empty($cat[$data[0]][$data[1]][$data[3]][$data[4]])){
    				$cat[$data[0]][$data[1]][$data[3]][$data[4]] = [];
    			}
    			if(empty($cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]])){
    				$cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]] = [];    				
    			}
    			if(empty($cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]][$data[6]])){
    				$cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]][$data[6]] = '';
    			}
    			$cat[$data[0]][$data[1]][$data[3]][$data[4]][$data[5]][$data[6]] .= $data[8]."-";
    			
    		}   		
    		// echo "<pre>";
    		// print_r($cat['HAIR']['Dove']);
			function count_recursive($arr){
				$leaves = 0;
				array_walk_recursive($arr, function ($leaves) use (&$leaves) {
				  $leaves++;
				});
				return $leaves;
			}
    		$body = '';
    		$i = 0;
    		foreach ($priority as $v) {
    			# code...
    			if(!empty($cat[$v])){
    				$brand = $cat[$v];
    				$c = $v;
    			}
    			else { continue; }

    			# code...

    			
        		$body .= "<td rowspan='".count_recursive($brand)."' style='text-align: center; background-color: ".$color[$c]."; color:black; font-weight:bold;' class='vertical-center'>{$name[$c]}</td>\r\n";
        		foreach ($brand as $b => $t) {
        			# code...
        			if(array_search($b, array_keys($brand)) > 0){
        				$body.= "<tr>";
        			}
        			if(file_exists(str_replace('/','',$b).".png")){
	        			
	        			if(count_recursive($t) == 1){
	        				$body .= "<td rowspan='".count_recursive($t)."' style='align: center;' class='vertical-center'><img style='max-width: 40px' src='".str_replace('/','',$b).".png'></td>\r\n";
	        			}
	        			else{
	        				$body .= "<td rowspan='".count_recursive($t)."' style='align: center;' class='vertical-center'><img style='max-width: 50px' src='".str_replace('/','',$b).".png'></td>\r\n";
	        			}
        			}

        			else{
        				if(strpos($b, 'ĐẶC BIỆT')  !== false){
	        				$b = str_replace('ĐẶC BIỆT', '<strong> ĐẶC BIỆT</strong>', $b);
	        			} 
	        			$body .= "<td rowspan='".count_recursive($t)."' style='align: center;' class='vertical-center'>{$b}</td>\r\n";

        			}          						
        				foreach ($t as $type => $line) {
        					# code...
        					if(array_search($type, array_keys($t)) > 0){
        						$body .="<tr>";
        					}
        					$body .="<td rowspan='".count_recursive($line)."'>{$type}</td>\r\n";
        						foreach ($line as $l => $kc) {
        							# code...
        							if(array_search($l, array_keys($line)) > 0){
		        						$body .="<tr>";
		        					}
		        					$body .="<td rowspan='".count_recursive($kc)."'>{$l}</td>\r\n";
		        						foreach ($kc as $kichco => $ct) {
		        							# code...
		        							if(array_search($kichco, array_keys($kc)) > 0){
				        						$body .="<tr>";
				        					}
				        					if(strlen($kichco) > 20){
				        						$body .="<td rowspan='".count_recursive($ct)."' style='font-size: 7;'>{$kichco}</td>\r\n";
				        					}
				        					else{
				        						$body .="<td rowspan='".count_recursive($ct)."'>{$kichco}</td>\r\n";
				        					}
				        					foreach ($ct as $chuongtrinh => $td) {
				        						# code...
				        						if(array_search($chuongtrinh, array_keys($ct)) > 0){
					        						$body .="<tr>";
					        					}
					        					$body .="<td>{$chuongtrinh}</td>\r\n";
					        					$body .="<td>".substr($td, 0, strlen($td)-1)."</td>\r\n";
					        					$body .= "</tr>\r\n";
				        					}

		        						}
        						}
        				}
        			
        		}

    		}
    	?>
    	<div class="row">
	 		<div class="col-md-12">
	 			<table class="table table-bordered" id="table">
	 				<thead>
	 					<th width="7%">Ngành</th>
	 					<th width="9%">Nhãn hàng</th>
	 					<th width="10%">Loại</th>
	 					<th width="10%">Dòng sản phẩm</th>
	 					<th width="15%">Kích cỡ</th>
	 					<th>Chương trình</th>
	 					<th width="3%">Tương đương</th>
	 				</thead>
	 				<tbody>
					    <?php echo $body; ?>

					</tbody>
	 			</table>
	 		</div>
    	</div>
 		<div class="row" id="footer">
 			<div class="col-md-4" style="max-height: 200px; padding: 0;">
 				<img src="footer_left.jpg" style="float: left; width: 400%">
 			</div>
 		</div>
 </page>

 	
<!--  	</div>
 	<button id="convert">
Convert to image
</button>
 	<div id="result">
 		
 	</div> -->
 </body>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript" src="html2canvas.js"></script>
	<script type="text/javascript">
		// function convertToImage() {
		//   var resultDiv = document.getElementById("result");
		//   html2canvas(document.getElementById("table"), {
		//     onrendered: function(canvas) {
		//        var img = canvas.toDataURL("image/png");
		//        img.download = 'z.png';
		//        result.innerHTML = '<img src="'+img+'"/>';

		//     }
		//   });
		// }

		// //click event
		// var convertBtn = document.getElementById("convert");
		// convertBtn.addEventListener('click', convertToImage);

	</script>
 </html>