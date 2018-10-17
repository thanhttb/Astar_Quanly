<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes;
use App\Sessions;
use Response;
class SessionController extends Controller
{
    //
    function get_session_by_class($class_id){
    	return Sessions::where('class_id', $class_id)->get();
    }
    function edit_session($id, Request $request){
    	echo "<pre>";
    	print_r($request);
    	echo "<pre>";

    }
}
