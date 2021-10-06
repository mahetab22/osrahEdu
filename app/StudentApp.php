<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentApp extends Model
{
    //
    public function student(){
        return $this->belongsTo('App\User','student_id');
    }

    public function app(){
        return $this->belongsTo('App\ApplicationsForCourse','app_id');
    }
}
