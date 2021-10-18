<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StuExam extends Model
{
    //
    public function answers(){
        return $this->hasMany('App\ExamStuAch','stu_exam_id');
    }
    public function exam(){
       return $this->belongsTo('App\Exam','exam_id'); 
    }
}
