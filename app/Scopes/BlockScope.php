<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;
//use App\Group;

class BlockScope implements Scope
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
       if (Auth::hasUser()) {
         $user = Auth::user();
         $user_college = $user->college;
         if ($user_college){
           $user_college_id= $user_college->id;
           if ($user->hasPermissionTo('attendance sheet')){
             $fullTableName = $model->getTable(); // blocks table
             $builder->join('block_user as b', $fullTableName.'.id', '=', 'b.block_id')
                    ->join('users', 'b.user_id', '=', 'users.id')
                    ->where('users.college_id','=', $user_college_id)
                    ->select('blocks.id','blocks.block_title');
           }
           else {
             $builder;
           }
         }
         else {
           $builder;
         }
       }
     }
}
