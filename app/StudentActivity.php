<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentActivity extends Model
{
    //

    public function student(){
        return $this->belongsTo('App\User','student_id');
    }

    public function activity(){
        return $this->belongsTo('App\Activity','activity_id');
    }
}
