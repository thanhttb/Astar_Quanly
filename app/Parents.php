<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
	protected  $table='parents';
	protected $fillable=['id','name','phone','email','work','address'];

	public $timestamps=false;

}
