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
}