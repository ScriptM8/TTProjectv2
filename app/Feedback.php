<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public function author_user()
    {
        return $this->belongsTo('App\User', 'id', 'author_id');
    }
    public function target_user()
    {
        return $this->belongsTo('App\User', 'id', 'target_id');
    }
}
