<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function supervisorinfo()
    {
        return $this->hasOne('App\SupervisorInfo', 'user_id');
    }

    public function supervisorcourses()
    {
        return $this->hasMany('App\Supervisor_Course', 'supervisor_id');
    }

    public function supervisorexams()
    {
        return $this->hasMany('App\Exam', 'user_id');
    }

    public function stusubscriptioncourses()
    {
        return $this->hasMany('App\StuSubscriptionCourse', 'user_id');
    }

    public function stulevels()
    {
        return $this->hasMany('App\StuLevel', 'user_id');
    }

    public function stulessons()
    {
        return $this->hasMany('App\StuLesson', 'user_id');
    }

    public function supervisorachievements()
    {
        return $this->hasMany('App\SupervisorAchievement', 'user_id')->orderBy('type','asc');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'user_id')->where('commentORmassage',0);
    }

    public function streaming()
    {
        return $this->hasOne('App\Streaming','super_id');
    }

   public function marketer(){
       return $this->hasOne('App\MarketeInfo','user_id');
   }

   public function Role(){
       return $this->belongsTo('App\UserRole','role_id');
   }
   public function getIsAdminAttribute(){
    return $this->role_id == 1;
     }

     public function apps(){
         return $this->hasMany('App\StudentApp','student_id');
     }
     public function activities(){
        return $this->hasMany('App\StudentActivity','student_id');
    }
}
