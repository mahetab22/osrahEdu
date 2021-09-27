<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson', 'level_id');
    }

    public function exam()
    {
        return $this->hasOne('App\Exam', 'level_id');
    }

}
