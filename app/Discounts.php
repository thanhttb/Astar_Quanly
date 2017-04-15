<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    //
    protected $table = 'discount';
    protected $fillable = ['id','from','to','discount','type','start','expired','user','created_at','updated_at'];
    
}
