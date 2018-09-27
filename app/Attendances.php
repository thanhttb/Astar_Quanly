<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    //
    protected  $table='attendances';
	protected $fillable=['id','class_std_id','lesson_id'];

	public $timestamps=false;
}
