<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collage extends Model
{
  use SoftDeletes;
  public function user()
  {
      return $this->hasMany('App\User');
  }
}
