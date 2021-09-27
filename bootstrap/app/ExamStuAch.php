<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamStuAch extends Model
{
    public function exam()
    {
        return $this->hasMany('App\Exam', 'exam_id');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function qeuestions()
    {
        return $this->hasMany('App\Question');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
