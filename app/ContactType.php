<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    //
    protected $guarded=[];
    protected $table="contact_type";
    public function contacts(){
        return $this->hasMany('App\Contact','type_id');
    }
}
