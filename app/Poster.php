<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
