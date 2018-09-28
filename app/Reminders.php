<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    //
    protected $table = 'enroll_reminder';
    protected $fillable = ['id','enrolls_id','content','user','status','due_date','done_by'];
    public function enrolls(){
    	return $this->belongsTo('App\Enrolls');
    }
}
