<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_Debts extends Model
{
    //
    protected $table = "report_debt";
    protected $fillable = ['id','period_id','class_id','debts','total'];
    public $timestamps = false;
}
