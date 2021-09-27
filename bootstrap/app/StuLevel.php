<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StuLevel extends Model
{
    protected $table = 'stulevels';
    
    public function level()
    {
        return $this->hasMany('App\Level', 'level_id');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

}
