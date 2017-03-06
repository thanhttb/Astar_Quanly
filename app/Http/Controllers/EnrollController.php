<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Enrolls;
class EnrollController extends Controller
{
    //
    public function saveDate(Request $request){
    	$datetime = Enrolls::findorfail($request->pk);
    	//echo $request->value;
    	$datetime->appointment = $request->value;
    	$datetime->save();
    	
    }
    public function saveTestInform(Request $request){
    	$datetime = Enrolls::findorfail($request->pk);
    	//echo $request->value;
    	$datetime->testInform = $request->value;
    	$datetime->save();
    	
    }
    public function saveShowUp(Request $request){
    	$datetime = Enrolls::findorfail($request->pk);
    	//echo $request->value;
    	$datetime->showUp = $request->value;
    	$datetime->save();
    	
    }
}
