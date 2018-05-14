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

Route::get('seemessagerefuse/{id_project}','ProjectController@seeMessageRefuses')->name('seemessagerefuse');

Route::get('payment/{id}','ProjectController@loadPayment')->name('payment');

Route::get('findpayment/{id}','ProjectController@findPayment')->name('findpayment');

Route::get('searchpayment/{id}','SearchController@quickSearchResult');

Route::get('introduce','NoticeController@displayIntroduce')->name('introduce');

// Admin Route
Route::get('admin','LoginController@redirectAdminPage')->name('admin')->middleware('checklogin');

Route::post('addproject/{id}','AdminController@addProject')->name('addproject')->middleware('checkaddproject');

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

Route::get('assignment/{id}/{id_project}','AdminController@redirectAssignment')->name('assignment');

Route::get('setassignment/{date_start}','SearchController@setNumberEmployee')->name('setassignment');

Route::get('excuteassignment/{id}/{id_project}','AdminController@excuteAssignment')->name('excuteassignment')->middleware('checkassignment');

Route::get('updateassignment/{id_project}','AdminController@updateAssignment')->name('updateAssignment');

Route::get('updateproject/{id_project}','AdminController@redirectUpdateProject')->name('updateproject');

Route::post('excuteupdateproject/{id}/{id_project}','AdminController@excuteUpdateProject')->name('excuteupdateproject')->middleware('checkupdateproject');

Route::get('showunconfirmadvance','AdminController@redirectAdminUnconfirmAdvance')->name('showunconfirmadvance');

Route::get('seeadvance/{id_project}','AdminController@seeAdvance')->name('seeadvance');

Route::get('acceptadvance/{id_project}','AdminController@acceptAdvance')->name('acceptadvance');

Route::post('refuseadvance/{id_project}','AdminController@refuseAdvance')->name('refuseadvance')->middleware('checkrefuse');

Route::get('setrefuse/{id_project}','SearchController@chooseNumberEmployee')->name('setrefuse');

Route::get('setidrefuse','SearchController@setIdRefuse')->name('setidrefuse');

Route::post('updatemessagerefuse/{id_project}','AdminController@updateRefuse')->name('updatemessagerefuse');

Route::get('deleterefuse/{id_project}/{id_refuse}','AdminController@deleteRefuse')->name('deleterefuse');

Route::get('showconfirmadvance','AdminController@redirectAdminConfirmAdvance')->name('showconfirmadvance');

Route::get('seedetailadvance/{id_project}','AdminController@seeDetail')->name('seedetailadvance');

Route::get('showuser','AdminController@redirectShowUser')->name('showuser');

Route::post('finduser','AdminController@findUser')->name('finduser');

Route::get('searchemployee','SearchController@searchEmployee')->name('searchemployee');

Route::get('resetpassword/{id_employee}','AdminController@resetPassword')->name('resetpassword');

Route::get('adminnotice','AdminController@redirectNotice')->name('adminnotice');

Route::post('addnotice','AdminController@addNotice')->name('addnotice')->middleware('checkaddnotice');

Route::get('deletenotice/{id_notice}','AdminController@deleteNotice')->name('deletenotice');

Route::get('updatenotice/{id_notice}','AdminController@redirectUpdateNotice')->name('updatenotice');

Route::post('excuteupdatenotice/{id_notice}','AdminController@excuteUpdateNotice')->name('excuteupdatenotice')->middleware('checkupdatenotice');

Route::get('adminpayment/{id_project}','AdminController@redirectPaymentProject')->name('adminpayment');

Route::post('excutepayment/{id_project}','AdminController@excutePayment')->name('excutepayment')->middleware('checkadminpayment');

Route::get('deletepayment/{id_project}/{id_result}','AdminController@deletePayment')->name('deletepayment');

Route::get('finishproject/{id_project}','AdminController@finishProject')->name('finishproject');

Route::get('projectmanager','ProjectController@showListProject')->name('projectmanager');

Route::get('searchproject','SearchController@searchProject')->name('searchproject');

Route::get('admintemplate','AdminController@redirectAdminTemplate')->name('admintemplate');

Route::post('addtemplate','AdminController@addTemplate')->name('addtemplate')->middleware('checkaddtemplate');

Route::get('updatetemplate','AdminController@redirectUpdateTemplate')->name('updatetemplate');

Route::get('deletetemplate/{id_template}','AdminController@deleteTemplate')->name('deletetemplate');

Route::get('updatetemplate/{id_template}','AdminController@redirectUpdateTemplate')->name('updatetemplate');

Route::post('excuteupdatetemplate/{id_template}','AdminController@excuteUpdateTemplate')->name('excuteupdatetemplate')->middleware('checkupdatetemplate');

Route::get('listtemplate','TemplateController@showListTemplate')->name('listtemplate');

Route::get('printpayment/{id_project}','PdfController@downloadpdf')->name('printpayment');

Route::get('printadvance/{id_advance}','PdfController@downloadAdvance')->name('printadvance');

Route::get('printresult/{id_result}','PdfController@downloadResult')->name('printresult');


