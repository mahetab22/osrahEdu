<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

    public function getTitleAttribute()
    {
            if ( app()->getLocale() =='ar')
                return $this->title_ar;
            else
                return $this->title_en;
    }
}
