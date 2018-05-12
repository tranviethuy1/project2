<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
class PdfController extends Controller
{
    public function downloadpdf(Request $request){
	    $id_project = $request->id_project;
	    $project = DB::table('projects')->where('id',$id_project)->first();
	    $plan = DB::table('plans')->where('id_project',$id_project)->first();
		$data = array();
	    $links = DB::table('links')->where('id_project',$id_project)->get();
	    foreach ($links as $key => $link) {
	    	$user = DB::table('users')->where('id',$link->id_employee)->first();
	    	$advance = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user->id)->first();
	    	$result = DB::table('results')->where('id_project',$id_project)->where('id_employee_r',$user->id)->first();

	    	$data[] = ['name'=>$user->name,'advance'=>$advance,'result'=>$result];
	    }

	    $pdf = PDF::loadView('formprintproject',['project'=>$project,'plan'=>$plan,'data'=>$data]);
		
		$name_download = $project->name_project.$project->date_start."."."pdf";

	    return $pdf->stream();
	}

}
