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

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('blocks', 'BlockController');
Route::post('blocks', 'AttendanceSheetController@store')->name('attendancesheets.store');

// Reports
Route::resource('exports','ExportController');
Route::post('exports/download','ExportController@downloadExport');