<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    //
    protected $table = 'result';
    protected $fillable = ['id','cls_std_id','score','comment','period'];
    public $timestamps = false;
}
