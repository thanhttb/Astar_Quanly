<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    //
    protected  $table='files';
	protected $fillable=['id','title','name','size','type'];
	
	public $timestamps=true;
}
