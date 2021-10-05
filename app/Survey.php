<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //
    public function user(){
        return $this->BelongsTo('App\User','user_id');
    }
    public function Course(){
        return $this->belongsTo('App\Course','course_id');
    }
    public function getCourseRateAttribute(){
        $x=$this->course;
        if($x==3){
            $m="ممتاز";
        }elseif($x==2){
            $m="جيد جدا";
        }elseif($x==1){
            $m="متوسط";
        }else{
            $m="مقبول";
        }
        return $m;
    }
    public function getSiteRateAttribute(){
        $x=$this->site;
        if($x==3){
            $m="ممتاز";
        }elseif($x==2){
            $m="جيد جدا";
        }elseif($x==1){
            $m="متوسط";
        }else{
            $m="مقبول";
        }
        return $m;
    }
    public function getTeacherRateAttribute(){
        $x=$this->teacher;
        if($x==3){
            $m="ممتاز";
        }elseif($x==2){
            $m="جيد جدا";
        }elseif($x==1){
            $m="متوسط";
        }else{
            $m="مقبول";
        }
        return $m;
    }
}
