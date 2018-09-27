<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    //
    protected $table = 'groups';
    protected $fillable = ['id','name','created_at','updated_at'];

    public function accounts(){
    	return $this->belongsToMany('App\Accounts');
    }
    public $timestamps = false;
   
}
