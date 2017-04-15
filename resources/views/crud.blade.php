DOCTYPE <!DOCTYPE html>
<html>
<head>
	<title>Test Crud Ajax</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
	<div class="container-narrow">
		<h2>AJAX TESTING</h2>
		<button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Add new</button>
		<div>
			<table class="table">
				<thead>
					<tr>
						<th>Class</th>
						<th>Teacher</th>
						<th>Start</th>
						<th>End</th>
						<th></th>
					</tr>
				
				</thead>
				<tbody id="class-list" name="class-list">
					
						@foreach($class_list as $class)
						<tr id="class{{$class['id']}}">
							<td>{{$class['name']}}</td>
							<td>{{$class['teacher']}}</td>
							<td>{{$class['start_time']}}</td>
							<td>{{$class['end-time']}}</td>
							<td>
	                            <button class="btn btn-warning btn-xs btn-detail open-modal" value="{{$class['id']}}">Edit</button>
	                            <button class="btn btn-danger btn-xs btn-delete delete-class" value="{{$class['id']}}">Delete</button>
	                        </td>
	                    </tr>

					@endforeach
					
				</tbody>
			</table>
		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Class Editor</h4>
            </div>
            <div class="modal-body">
                <form id="frmTasks" name="frmTasks" class="form-horizontal" novalidate="">

                    <div class="form-group error">
                        <label for="inputClass" class="col-sm-3 control-label">Class</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control has-error" id="class" name="class" placeholder="Class" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Teacher</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="teacher" name="teacher" placeholder="Teacher" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="add">Save changes</button>
                <input type="hidden" id="class_id" name="class_id" value="0">
            </div>
		</div>

	</div>
	<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

    var url = "/astar/class";

    $('#class-list').on("click",".open-modal",function(){
    	var class_id = $(this).val();

        $.get(url + '/' + class_id, function (data) {
            //success data
            console.log(data);
            $('#class_id').val(data.id);
            $('#class').val(data.name);
            $('#teacher').val(data.teacher);
            $('#btn-save').val("update");

            $('#myModal').modal('show');
        }) 	
    });
    // $('.open-modal').click(function(){
    //     var class_id = $(this).val();

    //     $.get(url + '/' + class_id, function (data) {
    //         //success data
    //         console.log(dataType	tg dbhbbj mngyvfna);
    //         $('#class_id').val(data.id);
    //         $('#class').val(data.name);
    //         $('#teacher').val(data.teacher);
    //         $('#btn-save').val("update");

    //         $('#myModal').modal('show');
    //     }) 
    // });

    //display modal form for creating new task
    $('#btn-add').click(function(){
        $('#btn-save').val("add");
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('show');
    });

    //delete task and remove it from list
    $('.delete-class').click(function(){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        var class_id = $(this).val();

        $.ajax({

            type: "DELETE",
            url: url + '/' + class_id,
            success: function (data) {
                console.log(data);

                $("#class" + class_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //create new task / update existing task
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault(); 

        var formData = {
            name: $('#class').val(),
            teacher: $('#teacher').val(),
        }

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();

        var type = "POST"; //for creating new resource
        var class_id = $('#class_id').val();
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + class_id;
        }

        console.log(formData);

        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);

                var row = '<tr id="class' + data.id + '"><td>' + data.name + '</td><td>' + data.teacher + '</td><td>' + data.start_time + '</td><td>'+data.end_time+ '</td>';
                row += '<td><button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '">Edit</button>';
                row += '<button class="btn btn-danger btn-xs btn-delete delete-class" value="' + data.id + '">Delete</button></td></tr>';

                if (state == "add"){ //if user added a new record
                    $('#class-list').append(row);
                }else{ //if user updated an existing record

                    $("#class" + class_id).replaceWith( row );
                }

                $('#frmTasks').trigger("reset");

                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});


</script>
</body>
</html>
