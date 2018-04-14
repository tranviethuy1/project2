<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notices;
use DB;
class NoticeController extends Controller
{
    public function loadNotices(Request $request){
    	$notices = \App\Notices::orderBy('id_notice','desc')->paginate(10);
    	return view('notice',['notices'=>$notices]);
    }

    public function displayData(Request $request){
    	$id = $request->id_notice;
    	$notice = DB::table('notices')->select('title','content')->where('id_notice',$id)->first();
    	return view('displaynotice',['content'=>$notice->content,'title'=>$notice->title]);
    }
}
