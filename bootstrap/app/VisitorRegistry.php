<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorRegistry extends Model
{
    protected $table = 'visitor_registry';

    public $fillable=['ip'];
}
