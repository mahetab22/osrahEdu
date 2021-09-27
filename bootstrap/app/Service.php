<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    public function course()
    {
        return $this->hasMany('App\Course');
    }

    public function supervisorinfo()
    {
        return $this->hasMany('App\SupervisorInfo','service_id');
    }
}
