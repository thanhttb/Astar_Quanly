<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>One Page Promotion Optimizer</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta content="One Page Promotion Optimizer" name="description">
        <meta content="TranThanh" name="author">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css">
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('assets/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css">
        <link href="{{asset('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css">
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{asset('assets/layouts/layout4/css/layout.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/layouts/layout4/css/themes/default.min.css')}}" rel="stylesheet" type="text/css" id="style_color">
        <link href="{{asset('assets/layouts/layout4/css/custom.min.css')}}" rel="stylesheet" type="text/css">
        <!-- END THEME LAYOUT STYLES -->
		<link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('assets/global/plugins/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/dropzone/basic.min.css')}}" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="favicon.ico"> 
        <style type="text/css">
        	.full-height{
        		padding: 0 !important;
        		height : 100vh;
        		background: white;
        		
        	}
        	.btn.green:not(.btn-outline) {
			    color: #FFF;
			    background-color: #0b85c8 !important;
			    border-color: #32c5d2;
			}
			.input-medium {
		    width: 250px!important;
		}
			.input-large {
		    		width: 311px!important;
				}
			.btn.default:not(.btn-outline) {
    				color:  #0b85c8 !important; }
    		#div-footer{
    			text-align: center;
    		}
        	#footer{
        		clear: both;
        		text-align: center;
				width: 60px;
				position: absolute;
    			bottom: 4px;
				display: block;
				margin: auto;
				left:18%;
			}
			#logo{
        		clear: both;
        		padding-left: 16%;
				width: 700px;
				padding-top: 10%;
				padding-bottom: 10;
				max-width: 300;
				display: block;
				
			}
			#upload{
				padding-top: 10%;
			}
			.scroller{
				height: 100% !important;
			}
			#navi{
				display: inline-block;
				margin: auto;
				text-align: center;
				float: left;
			}
			.portlet-title{
				text-align: center;
			}
			#left{
				background-image: url(https://secure.aadcdn.microsoftonline-p.com/dbd5a2dd-uymyxxfhpwrbckvwvlxle8radh6vkzaj7cwkqpqixg/appbranding/y2tibtckspdiuxwdfhw-aqaika5xxfufyw7tdmgfq68/0/heroillustration?ts=635673344126516270);
				background-repeat: no-repeat;
			}
			#bg{
				width: 150vh;
				height: 100vh;
			}
			#submit{
				text-align: center;
			}
        </style>

        </head>
<body>

<div class="col-md-2 full-height">
	<img src="https://secure.aadcdn.microsoftonline-p.com/dbd5a2dd-uymyxxfhpwrbckvwvlxle8radh6vkzaj7cwkqpqixg/appbranding/y2tibtckspdiuxwdfhw-aqaika5xxfufyw7tdmgfq68/0/heroillustration?ts=635673344126516270" id="bg">
</div>
<div class="col-md-8 full-height">
                            <!-- BEGIN Portlet PORTLET-->
    
    <img src="resources/views/promotion/Uppo.png" id="logo">

    <div class="portlet light" id="upload">
    		<div class="row" style="padding-bottom: 20px">
					    	<div class="col-md-2">  </div>
					    	<div class="col-md-8">
					    			 <div class="portlet-title tabbable-line">            
            <ul class="nav nav-tabs" id="navi">
            	<li class="active">
                    <a href="#portlet_tab1" data-toggle="tab"> Bảng promotion </a>
                </li>
                <li>
                    <a href="#portlet_tab2" data-toggle="tab"> Hình ảnh promotion </a>
                </li>
                
            </ul>
        </div>
					    	 </div>
                        	<div class="col-md-2"> </div>
                        </div>
       
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab1">
                    <div class="scroller" style="height: 200px;">
                        <form action="{{route('post_promotion')}}" method="POST"  enctype="multipart/form-data" id="myform">						  
						    <input type="hidden" name="_token" value="{{csrf_token()}}">

						    <div class="form-group row">
						    	<div class="col-md-2">  </div>
						    	<div class="col-md-8">
						    			<div class="row"> 
						    					<label class="control-label col-md-3"> ĐỘI BÁN HÀNG </label>
		                            	<div class="col-md-7">
		                            		<select class="form-control"> 
		                            				<option>PC</option>
		                            				<option>HCF</option>
		                            				<option>MIC</option>
		                            		</select>
		                            	</div>
						    			 </div>
						    	 </div>
                            	<div class="col-md-2"> </div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-md-2">  </div>
						    	<div class="col-md-8">
						    			<div class="row"> 
						    					<label class="control-label col-md-3"> THỜI GIAN </label>
                            	<div class="col-md-7">
                            		<input type="text" name="time" class="form-control">
                            	</div>
						    			 </div>
						    	 </div>
                            	<div class="col-md-2"> </div>


                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-2">  </div>
						    	<div class="col-md-8">
						    			<div class="row"> 
						    					<label class="control-label col-md-3" >ĐẦU VÀO</label>
                                <div class="col-md-7">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
	                                        <div class="input-group input-large">
	                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
	                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
	                                                <span class="fileinput-filename"> </span>
	                                            </div>
	                                            <span class="input-group-addon btn default btn-file">
	                                                <span class="fileinput-new"> Chọn file </span>
	                                                <span class="fileinput-exists"> Thay đổi </span>
	                                                <input type="hidden"><input type="file" name="table-promo"> </span>
	                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Xóa </a>
	                                        </div>
	                                    </div>
	                                </div>
						    			 </div>
						    	 </div>
                            	<div class="col-md-2"> </div>

                            </div>
                            <div class="form-actions">
                                <div class="row" id="submit">
                                    <div>
                                        <a href="javascript:;" onclick="document.getElementById('myform').submit()" class="btn green">
                                            <i class="fa fa-check"></i> Submit</a>
                                    </div>
                                </div>
                            </div>
						</form>
						
                    </div>
                    
                </div>
                <div class="tab-pane" id="portlet_tab2">
                    <div class="scroller" style="height: 200px;">
                    	<div class="row">
                    	<div class="col-md-2"></div>
                        <div class="col-md-8">                            
                            <form action="{{route('pre_process')}}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                              Select images: <input type="file" name="img[]" multiple>
                              <input type="submit">
                            </form>                           
                        </div>
                        <div class="col-md-2"></div>

                    </div>
                    <!-- The blueimp Gallery widget -->
                    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                        <div class="slides"> </div>
                        <h3 class="title"></h3>
                        <a class="prev">  </a>
                        <a class="next">  </a>
                        <a class="close white"> </a>
                        <a class="play-pause"> </a>
                        <ol class="indicator"> </ol>
                    </div>
                    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
                    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-upload fade">
                            <td>
                                <span class="preview"></span>
                            </td>
                            <td>
                                <p class="name">{%=file.name%}</p>
                                <strong class="error text-danger label label-danger"></strong>
                            </td>
                            
                            <td> {% if (!i && !o.options.autoUpload) { %}
                                 {% } %} {% if (!i) { %}
                                <button class="btn red cancel">
                                    <i class="fa fa-ban"></i>
                                    <span>Cancel</span>
                                </button> {% } %} </td>
                        </tr> {% } %} </script>
                    <!-- The template to display files available for download -->
                    <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <tr class="template-download fade">
                            <td>
                                <span class="preview"> {% if (file.thumbnailUrl) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                                        <img src="{%=file.thumbnailUrl%}">
                                    </a> {% } %} </span>
                            </td>
                            <td>
                                <p class="name"> {% if (file.url) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                                    <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                                <div>
                                    <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
                            
                            <td> {% if (file.deleteUrl) { %}
                                <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                    <i class="fa fa-trash-o"></i>
                                    <span>Delete</span>
                                </button>
                                <input type="checkbox" name="delete" value="1" class="toggle"> {% } else { %}
                                <button class="btn yellow cancel btn-sm">
                                    <i class="fa fa-ban"></i>
                                    <span>Cancel</span>
                                </button> {% } %} </td>
                        </tr> {% } %} </script>
                     
                    </div>
                </div>
                
            </div>

        </div>
    </div>
    <div id="div-footer"> 
    		<img src="resources/views/promotion/unilever.png" id="footer">
    </div>
</div>
<div class="col-md-2 full-height">
	<img src="https://secure.aadcdn.microsoftonline-p.com/dbd5a2dd-uymyxxfhpwrbckvwvlxle8radh6vkzaj7cwkqpqixg/appbranding/y2tibtckspdiuxwdfhw-aqaika5xxfufyw7tdmgfq68/0/heroillustration?ts=635673344126516270" id="bg">
</div>
 <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('assets/layouts/layout4/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/layout4/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
         <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/fancybox/source/jquery.fancybox.pack.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/form-fileupload.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>		

</body>
</html>