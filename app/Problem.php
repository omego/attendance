<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Problem extends Model
{
  use SoftDeletes;
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function college()
  {
      return $this->belongsTo('App\College');
  }

  public static function boot()
  {
    parent::boot();

    static::addGlobalScope(new Scopes\GlobalScope);
  }
}
