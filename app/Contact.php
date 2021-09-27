<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    public function type(){
        return $this->belongsTo('App\ContactType','type_id');
    }
}
