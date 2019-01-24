<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::group(['middleware' => ['role:admin']], function () {
  Route::resource('blocks', 'BlockController');

  // Export
  Route::resource('exports','ExportController');
  Route::post('exports/download','ExportController@downloadExport');

  //Users route
  Route::resource('users','UserController');
  // assign user to a group
  Route::post('users/addUserGroup','UserController@addUserGroup');
  Route::get('users/removeUserGroup/{user_id}/{group_id}','\App\Http\Controllers\UserController@removeUserGroup');

  //Groups Routes
  Route::resource('group','GroupController');

  Route::resource('permissions','PermissionController');
  Route::resource('roles','RoleController');

  Route::post('users/addRole','\App\Http\Controllers\UserController@addRole');
  Route::get('users/removeRole/{role}/{user_id}','\App\Http\Controllers\UserController@revokeRole');

  // Add Permission to a user
  Route::post('users/addPermission','\App\Http\Controllers\UserController@addPermission');
  Route::get('users/removePermission/{permission}/{user_id}','\App\Http\Controllers\UserController@revokePermission');

   //roles has permissions Routes

  Route::post('roles/addPermission','\App\Http\Controllers\RoleController@addPermission');
  Route::get('roles/removePermission/{permission}/{role_id}','\App\Http\Controllers\RoleController@revokePermission');

// });

Route::get('/home', 'HomeController@index')->name('home');

Route::post('blocks', 'AttendanceSheetController@store')->name('attendancesheets.store');
