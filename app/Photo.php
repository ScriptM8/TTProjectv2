<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function poster()
    {
        return $this->belongsTo('App\Poster');
    }
}
