<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    //
    protected  $table='classes';
	protected $fillable=['id','name','teacher','day','startTime','endTime','students','cs_id','tuition'];

	public $timestamps=false;
}
