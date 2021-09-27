<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function level()
    {
        return $this->belongsTo('App\Level', 'level_id');
    }

    public function exam()
    {
        return $this->hasOne('App\Exam', 'lesson_id');
    }
    
    public function qeuestions()
    {
        return $this->hasMany('App\Question', 'lesson_id');
    }
}
