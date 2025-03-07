<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function posters()
    {
        return $this->hasMany('App\Poster');
    }

    public function recived_feedbacks()
    {
        return $this->hasMany('App\Feedbacks', 'target_id');
    }

    public function posted_feedbacks()
    {
        return $this->hasMany('App\Feedbacks', 'author_id');
    }

    public function isAdmin()
    {
        return ($this->role == 1);
    }
}
