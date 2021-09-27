<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stusubscriptioncourse extends Model
{

protected $table = 'stusubscriptioncourse';
    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
