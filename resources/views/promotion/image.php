<!DOCTYPE html>
<html>
<head>
	<title> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="">
	#clock1, #clock2, #clock3{
		   background-image:url('');
		   background-size:contain;
		   background-position: center;
       		background-repeat: no-repeat;
		   border: 1px solid #bbb;
		   width: 33vw;
    		height: 33vw;
			}
</style>
<body>
	<div class="row"> 
			<div id='clock1' class="col-md-4">
				<input type='file' id='getval1' name="background-image" onchange="readURL(event)" /><br/><br/>
			</div>
			
			<div id='clock2' class="col-md-4">
				<input type='file' id='getval2' name="background-image" onchange="readURL(event)" /><br/><br/>
			</div>
			
			<div id='clock3' class="col-md-4">
				<input type='file' id='getval3' name="background-image" onchange="readURL(event)" /><br/><br/>
			</div>
	</div>
</body>

<script>
	function readURL(event){
		 var getImagePath = URL.createObjectURL(event.target.files[0]);
		 $('#clock1').css('background-image', 'url(' + getImagePath + ')');
		 $('#clock2').css('background-image', 'url(' + getImagePath + ')');
		 $('#clock3').css('background-image', 'url(' + getImagePath + ')');
		}
</script>
</html>