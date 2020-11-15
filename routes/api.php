<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::resource('blocks', 'BlockController');
// Route::resource('attendancesheets', 'AttendanceSheetController');
// Route::apiResource('blocks', 'API\BlockController');
Route::get('blocks', 'API\BlockController@index');
Route::post('blocks', 'API\BlockController@store');
Route::get('blocks/user/{userEmail}', 'API\BlockController@userBlockName');

Route::get('attendance', 'API\AttendanceSheetController@index');
Route::post('attendance', 'API\AttendanceSheetController@store');

Route::get('attendance/latest/{email_id}','API\AttendanceSheetController@StudentLastAttendance');

Route::get('attendance/user/{email_id}','API\AttendanceSheetController@StudentAttendance');

// Route::apiResource('attendance', 'API\AttendanceSheetController');

Route::middleware('auth:api')->group( function () {
    // Route::resource('attendance', 'API\AttendanceSheetController');
});


