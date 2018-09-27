<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = 'transaction';
    protected $fillable = ['id','from','to','amount','rel_id','date','description','user','created_at','updated_at'];
   
}
