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
}