<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    //
    protected $table = "fees";
    protected $fillable = ['id','account_id','amount','note'];
    public $timestamps = false;
}
