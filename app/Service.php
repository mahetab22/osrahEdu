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
    public function getTitleAttribute()
    {
            if ( app()->getLocale() =='ar')
                return $this->title_ar;
            else
                return $this->title_en;
    }
}
