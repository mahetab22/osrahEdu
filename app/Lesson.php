<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Lesson extends Model
{
    use SoftDeletes;
    public function getTitleAttribute()
    {
            if ( app()->getLocale() =='ar')
                return $this->title_ar;
            else
                return $this->title_en;
    }
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
