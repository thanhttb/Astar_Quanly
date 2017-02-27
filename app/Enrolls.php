<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrolls extends Model
{
    protected  $table='enrolls';
	protected $fillable=['id','student_id','receiver','subject',
						'class','appointment','showUp','testInform',
						'teacher','receiveTime','result','resultInform',
						'decision','officalClass','firstDay','inform'];

	public $timestamps=true;
	public function student()
	{
		return $this->belongsTo('App\Students');
	}
}
