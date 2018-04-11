<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
