<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public $fillable=['course_id','type','class_id'];
}
