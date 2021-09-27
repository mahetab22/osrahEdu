<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudStreaming extends Model
{
    public $fillable=['class_id','attendee_url','stud_id','course_id','stream_id'];
protected $table = 'studstreamings';
    public function course()
    {
        return $this->hasMany('App\Course');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\User','super_id');
    }
    
    public function stud()
    {
        return $this->belongsTo('App\User','stud_id');
    }

    
}
