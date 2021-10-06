<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //



    public function course(){
        return $this->belongsTo('App\Course','course_id');
    }

    public function student_activity(){
        return $this->hasMany('App\StudentActivity','activity_id');
    }
}
