<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use App\Group;

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
          //$userGroups = Auth::user()->group;
      //$userGroups = Auth::user()->group;
      //   foreach ($userGroups as $userGroup) {
      //     $userGroupIDs[] =  $userGroup->id;
      //   };
      // if (Auth::user()->hasRole('admin')) {
      //   $builder;
      // }
  //     elseif (Auth::user()->hasPermissionTo('view college students')) {
  //    $builder->whereIn('college_id', $userGroupIDs);
  //  } else {
  //   $builder->where('id', Auth::user()->id);
  // }
  }
}
