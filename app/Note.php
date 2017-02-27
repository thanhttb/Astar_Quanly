<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected  $table='note';
	protected $fillable=['id','user','table','record_id','content'];
	
	public $timestamps=true;
}
