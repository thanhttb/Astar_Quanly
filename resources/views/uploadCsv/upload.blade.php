@extends('layouts.master')
@section('content')
	<table width="600">
	<form action="{{url('/uploadStudent')}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<tr>
	<td width="20%">Select file</td>
	<td width="80%"><input type="file" name="csv" id="csv" /></td>
	</tr>

	<tr>
	<td>Submit</td>
	<td><input type="submit" name="submit" /></td>
	</tr>

	</form>
	</table>
@endsection