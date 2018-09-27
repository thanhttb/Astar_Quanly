<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeriodsController extends Controller
{
    //
    public function editPeriod(){
    	return view('period.edit_period');
    }
}
