<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor_Course extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }
    public function supervisor()
    {
        return $this->belongsTo('App\User', 'supervisor_id');
    }

}
