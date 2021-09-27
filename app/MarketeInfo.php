<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketeInfo extends Model
{
    //
    protected $guarded=[];
    protected $table='markete_infos';
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}

