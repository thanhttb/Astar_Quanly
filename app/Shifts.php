<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    //
    protected $table = "shift";
    protected $fillable = ['id','user_id','checkin_time','checkin_note','checkout_time','checkout_note'];
    public $timestamps = false;
}
