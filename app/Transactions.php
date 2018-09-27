<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    //
    protected  $table='transactions';
	protected $fillable=['id','student_id','parent_id','class_id','lesson_id','day','amount','balance','rel_id','note','user','type'];

	public $timestamps=true;
}
