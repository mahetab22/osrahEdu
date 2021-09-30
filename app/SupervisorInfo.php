<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupervisorInfo extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }
    public function courses(){
        return $this->hasMany('App\Supervisor_Course','supervisor_id');
    }
}
