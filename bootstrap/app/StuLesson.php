<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StuLesson extends Model
{
    protected $table = 'stulessons';

    public function lesson()
    {
        return $this->hasMany('App\Lesson', 'lesson_id');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
