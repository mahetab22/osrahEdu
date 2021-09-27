<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{

    public function course()
    {
        return $this->belongsTo('App\Course', 'cousre_id');
    }

    public function levels()
    {
        return $this->belongsTo('App\Level', 'level_id');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Lesson', 'lesson_id');
    }
    public function questions()
    {
        return $this->hasMany('App\Question', 'exam_id');
    }

}
