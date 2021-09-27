<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StudStreaming;

class Streaming extends Model
{

    public $fillable=['class_id','waiting_room','created_at','start_time','topic','course_id','presenter_url','password','course_id','duration','stud_id','join_url','super_id','flag','status','host_video','mute_upon_entry','participant_video','join_before_host','auto_recording','agenda'];

    public function course()
    {
        return $this->hasMany('App\Course');
    }

    public function supervisor()
    {
        return $this->belongsTo('App\User','super_id');
    }
    public function stud_stream(){

        return $this->hasMany(StudStreaming::class);
    }


}
