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
    return view('login');
})->name('/');

Route::post('login','LoginController@login')->name('login');

Route::get('logout','LoginController@logout')->name('logout');

Route::get('createaccount',function(){
	return view('createaccount');
})->name('createaccount');

Route::post('addaccount','ExcuteAccount@insertData')->name('addaccount')->middleware('checkimfor');

Route::get('admin',function(){
	return view('admin');
})->name('admin');

Route::get('employeepage',function(){
	return view('employeepage');
})->name('employeepage');

Route::get('profile',function(){
	return view('profile');
})->name('profile');
