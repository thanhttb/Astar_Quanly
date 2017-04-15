<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>General View</title>
		<meta name="description" content="Astar Quan Ly" />
		<meta name="keywords" content="Astar" />
		<meta name="author" content="ThanhTran" />
		<link rel="stylesheet" type="text/css" href="{{ asset('public/css/component.css')}}" />
		<script src="{{asset('public/js/modernizr.custom.js')}}"></script>
		<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- x-editable (bootstrap version) -->
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
		<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    	<link href="{{asset('public/datetimepicker/css/bootstrap-datetimepicker.css')}}" rel="stylesheet"></link> 
        <script src="{{asset('public/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>

        <link href="{{ asset('select2-4.0.3/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"></link> 
        <link href="{{ asset('select2-4.0.3/select2-bootstrap-css-master/docs/select2-bootstrap.css')}}" rel="stylesheet" type="text/css"></link> 

		<script src="{{ asset('select2-4.0.3/dist/js/select2.full.js') }}"></script> 
			

 
    </head>
	<body class="cbp-spmenu-push">
		
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">

                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw"></i><b>GHI DANH</b><span class="fa arrow"></span></a>
                            
                            <ul class="nav nav-second-level">
                              
                                <li>
                                    <a href="{{ url('/enroll') }}"> Ghi danh nhanh <span class="fa arrow"></span> </a>
                                </li>
                                <li><a href="#">Ghi danh bổ sung</a></li>    
                                <li>
                                    <a href="{{ url ('/ktdv') }}">1. Kiểm tra đầu vào</a>
                                </li>
                               <li>
                                    <a href="{{url ('/result') }}">2. Kết quả kiểm tra</a>
                                </li>
                                <li>
                                    <a href="{{url ('/ngaydautiendihocmedatemdentruongemvuadivuakhoc')}}">3. Thông báo buổi học</a>
                                </li>
                                <li>
                                	<a href="#">Danh sách tổng hợp </a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                    </ul>

                <!-- /.sidebar-collapse -->
            </div>
		
		</nav>
		
		<div class="top-nav" style="width: 95%;">
			<header class="clearfix">                
				<span class="main">
				@if(!Auth::guest())
				<button id="showLeftPush"><i id="menu" class="glyphicon glyphicon-menu-right"></i></button>
				@endif
				A-STAR EDUCATION CENTER
							@if (Auth::guest())
		                    <li style="list-style: none; display: inline-block; float: right; margin-top: 25px;"><a href="{{ route('login') }}">Login</a></li>
		                    @else

							<li class="dropdown" style="list-style: none; display: inline-block; float: right; margin-top: 25px;">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret" style = "display: inline-block;"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                </span>
				
				<nav>
					
				</nav>						
		
		<script src="{{asset('public/js/classie.js')}}"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				
				showLeftPush = document.getElementById( 'showLeftPush' ),
				showRightPush = document.getElementById( 'showRightPush' ),
				body = document.body;
			
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};

			function disableOther( button ) {
					
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
				
			}			
		</script>	
	    <script src="{{ asset('public/js/app.js') }}"></script>	
	    <script>
					$(document).ready(function(){
					    $("button").click(function(){
					        $("#menu").toggleClass("glyphicon glyphicon-menu-right").toggleClass("glyphicon glyphicon-menu-left");
					    });
					});
		</script>


    
	</header>
			
	</div>
	<div class="container">
				
	</div>
		@yield('content')
		@endif



	</body>	
</html>
