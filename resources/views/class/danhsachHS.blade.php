@foreach($students as $student)
	<form role="form">
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder=".col-md-3" disabled value="{{$student['lastName']}} {{$student['firstName']}}">  </div>
            <div class="col-md-2">
                <input type="text" class="form-control" placeholder=".col-md-2" value="{{$student['dob']}}"> </div>
            <div class="col-md-4">
                <div class="form-group">
		            
		            <div class="mt-radio-inline">
		                <label class="mt-radio">
		                    <input type="radio" name="{{$student['student_id']}}" id="x-{{$student['student_id']}}" value="x" checked> X
		                    <span></span>
		                </label>
		                <label class="mt-radio">
		                    <input type="radio" name="{{$student['student_id']}}" id="p-{{$student['student_id']}}" value="p"> P
		                    <span></span>
		                </label>
		                <label class="mt-radio">
		                    <input type="radio" name="{{$student['student_id']}}" id="kp-{{$student['student_id']}}" value="kp" > KP
		                    <span></span>
		                </label>
		            </div>
		        </div>
		      </div>
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder=".col-md-2"> </div>
        </div>
    </form>
@endforeach