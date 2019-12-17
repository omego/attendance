<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $guarded = ['id'];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function college()
    {
        return $this->belongsTo('App\College');
    }
    
    public function user()
    {
        return $this->belongsToMany('App\User','block_user', 'block_id','user_id');
    }
}