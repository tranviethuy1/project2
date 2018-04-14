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

// employee Route
Route::get('/', function () {
    return view('login');
})->name('/');

Route::post('login','LoginController@login')->name('login');

Route::get('logout','LoginController@logout')->name('logout');

Route::get('createaccount',function(){
	return view('createaccount');
})->name('createaccount');

Route::post('addaccount','ExcuteAccount@insertData')->name('addaccount')->middleware('checkimfor');

Route::get('employeepage',function(){
	return view('employeepage');
})->name('employeepage')->middleware('checklogin');

Route::get('employeepage/{id}/{name}',function($id,$name){
	return redirect('employeepage')->with('values',['id'=>$id,'name'=>$name]);
})->name('employeeback');

Route::get('profile/{id}','ExcuteAccount@getDataUser')->name('profile');

Route::get('updateprofile/{id}','ExcuteAccount@getDataUser2Update')->name('updateprofile');

Route::get('updateprofile/{id}/{error}','ExcuteAccount@getDataUser2Update')->name('updateprofile');

Route::get('updateprofile/{id}/{error}','ExcuteAccount@showError')->name('back2updateprofile');

Route::post('excuteupdate/{id}','ExcuteAccount@excuteUpdateFile')->name('excuteupdate')->middleware('checkbeforeupdate');

Route::get('changepass/{id}/{email}/{alert}',function($id,$email,$alert){
	return view('changepass')->with(['id'=>$id,'email'=>$email,'alert'=>$alert]);
})->name('changepassfail');

Route::get('changepass/{id}','ExcuteAccount@changePassword')->name('changepass');

Route::post('excutechangepass/{id}','ExcuteAccount@excuteChangePass')->name('excutechangepass')->middleware('checkchangepass');

Route::get('notice','NoticeController@loadNotices')->name('loadnotices');

Route::get('notice/{id_notice}','NoticeController@displayData')->name('displaynotice');

Route::get('checkproject/{id}','ProjectController@checkproject')->name('checkproject');

Route::get('advance/{id}','ProjectController@showProjectAdvance')->name('advanceview');

Route::post('excuteadvance/{id}/{id_project}','ProjectController@excuteAdvance')->name('excuteadvance')->middleware('checkadvance');

Route::get('history/{id}','ProjectController@loadAdvance')->name('history');

Route::get('findadvance/{id}','ProjectController@findAdvance')->name('findadvance');

Route::get('searchadvance/{id}','SearchController@quickSearchAdvance');

Route::get('payment/{id}','ProjectController@loadPayment')->name('payment');

Route::get('findpayment/{id}','ProjectController@findPayment')->name('findpayment');

Route::get('searchpayment/{id}','SearchController@quickSearchResult');

// Admin Route
Route::get('admin','LoginController@redirectAdminPage')->name('admin')->middleware('checklogin');

Route::get('addproject/{id}','AdminController@addProject')->name('addproject')->middleware('checkaddproject');

Route::get('adminprofile/{id}','AdminController@getDataAdmin')->name('adminprofile');

Route::get('updateadmin/{id}','AdminController@getDataAdmin2Update')->name('updateadmin');

Route::post('excuteupdateadmin/{id}','AdminController@excuteUpdateFile')->name('excuteupdateadmin')->middleware('checkbeforeupdateadmin');

Route::get('updateadmin/{id}/{error}','AdminController@showError')->name('back2updateadmin');

Route::get('changepassadmin/{id}','AdminController@changePasswordAdmin')->name('changepassadmin');

Route::post('excutechangepassadmin/{id}','AdminController@excuteChangePassAdmin')->name('excutechangepassadmin')->middleware('checkchangepassadmin');

Route::get('changepassfailadmin/{id}/{email}/{alert}',function($id,$email,$alert){
	return view('changepassadmin')->with(['id'=>$id,'email'=>$email,'alert'=>$alert]);
})->name('changepassfailadmin');

Route::get('plan/{id}/{id_project}','AdminController@redirectPlan')->name('plan');

Route::get('updateplan/{id}/{id_project}','AdminController@updatePlan')->name('updateplan');

Route::post('excuteaddplan/{id}/{id_project}','AdminController@excutePlan')->name('excuteaddplan')->middleware('checkplanadd');

Route::post('excuteupdateplan/{id}/{id_project}','AdminController@excutePlan')->name('excuteupdateplan')->middleware('checkplanupdate');


