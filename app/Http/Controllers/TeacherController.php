<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teachers;

class TeacherController extends Controller
{
    //
    function get_teachers(){
    	$type = '4';
    	return view('teacher.listTeacher',compact('type'));
    }
    function get_tutors(){
    	$type = '5';
    	return view('teacher.listTeacher',compact('type'));
    }
}
