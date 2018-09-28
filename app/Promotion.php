<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $table = 'promotions';
    protected $fillable = ['id','input','from_week','to_week'];
    public $timestamps = false;

}
