<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'payment';
    protected $fillable = ['id','account','description','amount','type','receiver'];

}
