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
}
