<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $table = 'tag';
    protected $fillable = 'id, name';
    public $timestamps = false;
    public function account(){
    	return $this->belongToMany('App\Accounts','acc_tag','tag_id','accounts_id');
    }
}
