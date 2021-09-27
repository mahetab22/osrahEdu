<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{

    public function course()
    {
        return $this->belongsTo('App\Course', 'cousre_id');
    }
    public function supervisorcertificates()
	{
	    return $this->hasMany('App\User','super_id');
	}
    
    public function user()
	{
	    return $this->hasOne('App\User','user_id');
	}

}
