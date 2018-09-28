<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeeController extends Controller
{
    //
    protected function list_fee(){
    	return view('fee.list');
    }
}
