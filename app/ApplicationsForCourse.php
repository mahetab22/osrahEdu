<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationsForCourse extends Model
{
    //
    public function course(){
        return $this->belongsTo('App\Course','course_id');
    }

    public function student_app(){
        return $this->hasMany('App\StudentApp','app_id');
    }
}
