<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periods extends Model
{
    //
    protected $table = 'periods';
    protected $fillable = ['id','name','months','year'];
    public $timestamps = false;
    
}
