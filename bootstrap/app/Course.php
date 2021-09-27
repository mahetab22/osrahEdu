<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Course extends Model
{
    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function streaming()
	{
	    return $this->hasOne('App\Streaming','course_id')->Where('status','1')->orderBy('id','desc');
	}

    public function studstreaming()
	{
	  // return $this->hasOne('App\StudStreaming','course_id')->orderBy('id','desc');
	   return $this->hasOne('App\StudStreaming','course_id')->Where('stud_id',Auth::user()->id)->orderBy('id','desc');
	}

    public function streamings()
	{
	    return $this->hasMany('App\Streaming','course_id')->Where('status','1')->orderBy('id','desc');
	}

    public function streamings_zoom()
    {
        return $this->hasMany('App\Streaming','course_id')->Where('status','waiting')->where('flag',1)->orderBy('id','desc');
    }

    public function supervisorcourses()
	{
	    return $this->hasOne('App\Supervisor_Course','course_id');
	}

    public function certificate()
    {
        return $this->hasOne('App\Certificate', 'course_id')->Where('user_id',Auth::user()->id)->orderBy('id','desc');
    }
    
    public function publiccertificates()
    {
        return $this->hasMany('App\Certificate', 'course_id');
    }

    public function levels()
    {
        return $this->hasMany('App\Level', 'course_id');
    }

    public function publicexam()
    {
        return $this->hasOne('App\Exam', 'course_id')->where('publicexam',1)->orderBy('id','desc');
    }

    public function exam()
    {
        return $this->hasOne('App\Exam', 'course_id')->where('publicexam',0)->orderBy('id','desc');
    }
    
    public function exams()
    {
        return $this->hasMany('App\Exam', 'course_id');
    }

    public function supervisorcourse()
    {
        return $this->hasOne('App\Supervisor_Course','course_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'course_id');
    }

    public function examcodes()
    {
        return $this->hasMany('App\ExamCode', 'course_id');
    }
 
    public function discounts()
    {
        return $this->hasMany('App\Discount', 'course_id');
    }
       
    public function subscriptioncourses()
    {
        return $this->hasMany('App\StuSubscriptionCourse', 'course_id');
    }
}
