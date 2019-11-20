<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class College extends Model
{
  use SoftDeletes;
  public function user()
  {
      return $this->hasMany('App\User','college_id');
  }
}
