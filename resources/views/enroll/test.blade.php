<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>  

    <!-- x-editable (bootstrap version) -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
                <a id="pUpdate" href="#">200</a>
<script type="text/javascript">
	  	$(document).ready(function() {
    //toggle `popup` / `inline` mode
    
    $('#pUpdate').editable({
        type: 'text',
        title: 'Select date',
        placement: 'right',
        url: '#',
        pk:2
        
	
        /*
        //uncomment these lines to send data on server
        pk: 1
        ,url: '/post'
        */
    });
});

	  	</script>	