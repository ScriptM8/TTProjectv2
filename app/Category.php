<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posters()
    {
        return $this->hasMany('App\Poster', 'category_id');
    }
}
