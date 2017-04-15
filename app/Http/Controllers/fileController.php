<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Files;
use Illuminate\Support\Facades\Input;
class fileController extends Controller
{
    //
    function profile(){
    	return view('Auth.profile');
    }
    function store(){
    	
    	return "data saved";


    }
}
