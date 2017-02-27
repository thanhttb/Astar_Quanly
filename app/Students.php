<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
protected  $table='students';
	protected $fillable=['id','parent_id','firstName','lastName','dob','gender','school','class','email','phone'];

	public $timestamps=false;
	public function parent()
	{
		return $this->belongsTo('App\Parents');
	}

    //
}
