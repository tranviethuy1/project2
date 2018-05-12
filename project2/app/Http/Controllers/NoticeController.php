<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notices;
use DB;
class NoticeController extends Controller
{
    public function loadNotices(Request $request){
    	$notices = \App\Notices::orderBy('id','desc')->paginate(10);
    	return view('notice',['notices'=>$notices]);
    }

    public function displayData(Request $request){
    	$id = $request->id_notice;
    	$notice = DB::table('notices')->where('id',$id)->first();
        if($notice->linkdownload != null){
            return view('displaynotice',['content'=>$notice->content,'title'=>$notice->title,'linkdownload'=>$notice->linkdownload]);
        }else{
            return view('displaynotice',['content'=>$notice->content,'title'=>$notice->title]);
        }
    }

    public function displayIntroduce(Request $request){
    	return view('introduce');
    }
}
