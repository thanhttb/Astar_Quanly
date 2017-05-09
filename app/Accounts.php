<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    //
    protected $table = 'accounts';
    protected $fillable = ['id','name','dob','type','balance'];
    public $timestamps = false;
    public function tag(){
    	return $this->belongsToMany('App\Tag','acc_tag','accounts_id','tag_id');
    }
}
