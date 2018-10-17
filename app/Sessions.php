<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    //
    public $table = "sessions";
    protected $fillable = ['id','class_id','teacher_id','session_fee','session_date','session_in','session_out','documents','numerator','status'];
}
