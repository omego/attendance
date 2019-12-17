<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;
//use App\Group;

class GlobalScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
     public function apply(Builder $builder, Model $model)
     {

      if (app()->runningInConsole()) {
        return;
          }

      if (Auth::hasUser())
      {
          if (Auth::user()->hasRole('admin')) {
              $builder;
          }
          else 
          {
              $builder->where('college_id', Auth::user()->college_id);
              
          }
      }
      else
      {
        $builder;
      }
     }
}
