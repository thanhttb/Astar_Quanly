<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    //
    protected  $table='lessons';
	protected $fillable=['id','class_id','teacher_id','start_time','end_time','tuition'];

	public $timestamps=false;
}
