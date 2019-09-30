<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $guarded = ['id'];


  public static function boot()
  {
    parent::boot();

    static::addGlobalScope(new Scopes\BlockScope);
  }
}