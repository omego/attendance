<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasRoles, HasApiTokens;

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

    public function blocks()
    {
      return $this->belongsToMany('App\Block','block_user', 'user_id', 'block_id');
    }

    public function group()
    {
        return $this->belongsToMany('App\Group','group_user', 'user_id', 'group_id');
    }

    public function collage()
    {
      return $this->belongsTo('App\Collage');
    }
}
