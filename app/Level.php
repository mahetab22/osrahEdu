<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;
    public function getTitleAttribute()
    {
            if ( app()->getLocale() =='ar')
                return $this->title_ar;
            else
                return $this->title_en;
    }
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
