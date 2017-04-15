<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_std extends Model
{
    //
    protected  $table='class_std';
	protected $fillable=['id','class_id','student_id','firstDay','lastDay'];

	public $timestamps=false;
}
