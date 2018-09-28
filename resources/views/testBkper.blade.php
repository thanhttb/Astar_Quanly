<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
	include(app_path().'/xcrud/xcrud.php');
	include(app_path().'/xcrud/functions.php');
    echo Xcrud::load_css();
    echo Xcrud::load_js(); 
 ?>
<a href="#" data-url='https://app.bkper.com/hooks/agtzfmJrcGVyLWhyZHITCxIGTGVkZ2VyGICAgObr8LgKDA/c68qvjj1muefesv9valjk71bfo' id="bk">test</a>

<script type="text/javascript">
	$(document).ready(function(){
		$('#bk').click(function(){
			$.post("https://app.bkper.com/api/books/agtzfmJrcGVyLWhyZHITCxIGTGVkZ2VyGICAgObr8LgKDA/accounts",
			{"type":"LIABILITY","description":"123","name":"sadf"},
	        function(data,status){
	            alert("Data: " + data + "\nStatus: " + status);
	        });
		})
	})

</script>
</body>
</html>