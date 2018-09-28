
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

	.square {
	    float:left;
	    position: relative;
	    width: 30%;
	    padding-bottom : 30%; /* = width for a 1:1 aspect ratio */
	    margin:1.66%;
	    background-color:white;
	    overflow:hidden;

	}

	.content {
	    position:absolute;
	    height:100%; /* = 100% - 2*5% padding */
	    width:100%; /* = 100% - 2*5% padding */

	    
	}
	.table{
	    display:table;
	    width:100%;
	    height:100%;
	    	    position: absolute;

	}
	.table-cell{
	    display:table-cell;
	    vertical-align:middle;
	}
	/*  For list */
	ul{
	    text-align:left;
	    margin:5% 0 0;
	    padding:0;
	    list-style-position:inside;
	}
	li{
	    margin: 0 0 0 5%;
	    padding:0;
	}


	/*  For responsive images */

	.content .rs{
	    width:auto;
	    height:auto;
	    max-height:100%;
	    max-width:116%;
	}
	/*  For responsive images as background */

	.bg{
	    background-position:center center;
	    background-repeat:no-repeat;
	    background-size:cover; /* you change this to "contain" if you don't want the images to be cropped */
	    color:#fff;
	}

	
	/*  following just for the demo */


	body {
	    font-size:20px;
	    font-family: 'Lato',verdana, sans-serif;
	    color: black;
	    text-align:center;
	    background:#ECECEC;

	}
	p{
	    margin:0;
	    padding:0;
	    text-align:left;
	}

	.numbers{
	    font-weight:900;
	    font-size:100px;
	}

	#bottom {
	    clear:both;
	    margin:0 1.66%;
	    width:89.68%;
	    padding: 3.5%;
	    background-color:#1E1E1E;
	    color: #fff;
	}
	#bottom p{
	    text-align:center;
	    line-height:2em;
	}
	#bottom a{
	    color: #000;
	    text-decoration:none;
	    border:1px solid #000;
	    padding:10px 20px 12px;
	    line-height:70px;
	    background:#ccc;
	    
	    -webkit-border-radius: 5px;
	    -moz-border-radius: 5px;
	    border-radius: 5px;
	}

	#bottom a:hover{
	    background:#ECECEC;
	    border:1px solid #fff;
	}
	.text{
		position: relative;
		bottom: 0;
	}
	
</style>
 <body id="body">
 <page size="A4">
		<div class="container-fluid">
 		
 		<div class="row" id="header" style="width: 107.6%;">
 			<div class="col-md-1" style="padding-top: 65">
	 			<img src="resources/views/promotion/unilever.png" id="logo">
	 		</div>
			<div class="col-md-7"  style="padding-top: 65; padding-right:0;"> 				
 				<h3>CHƯƠNG TRÌNH KHUYẾN MÃI</h3><br>
 			</div>
 			<div class="col-md-4" style="max-height: 200px; padding-right: 0;">
 				<img src="resources/views/promotion/header_right.jpg" style="float: right; width: 110%">
 			</div>	
		</div>
 		
    	@foreach($image_name as $img)
    		<div class="square">
		   <div class="content">
		        <div class="table">
		            <div class="table-cell">
		                <img class="rs" src="public/promotion/img/{{$img}}"/>
		                <p class="text">Chú Thích Hình Ảnh</p>
		            </div>
		        </div>
		    </div>
		</div>
    	@endforeach
		

 		<div class="row" id="footer">
 			<div class="col-md-4" style="max-height: 200px; padding: 0;">
 				<img src="resources/views/promotion/footer_left.png" style="float: left; width: 400%">
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