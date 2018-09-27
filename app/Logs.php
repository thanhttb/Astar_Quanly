<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    //
    protected $table = "transaction_logs";
    protected $fillable = ['id','transactions'];
}
