<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $table = "receipt";
    protected $fillable = ['id','account','description','amount','type','receiver'];
}
