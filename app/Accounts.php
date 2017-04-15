<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    //
    protected $table = 'accounts';
    protected $fillable = ['id','name','dob','type','balance'];
    public $timestamps = false;

}
