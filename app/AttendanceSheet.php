<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceSheet extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
    return $this->belongsTo('App\User');
    }
    public function block()
    {
    return $this->belongsTo('App\Block');
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