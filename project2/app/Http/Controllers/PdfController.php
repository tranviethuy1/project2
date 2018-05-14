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

	public function downloadAdvance(Request $request){
		$id_advance = $request->id_advance;
		$advance = DB::table('advances')->where('id',$id_advance)->first();
		$project = DB::table('projects')->where('id',$advance->id_project)->first();
		$name = DB::table('users')->where('id',$advance->id_employee)->value('name');

		$pdf = PDF::loadView('formprintadvance',['project'=>$project,'advance'=>$advance,'name'=>$name]);

		$name_download = $project->name_project.$advance->advance_date."."."pdf";

		return $pdf->stream();
	}

	public function downloadResult(Request $request){
		$id_result = $request->id_result;
		$result = DB::table('results')->where('id',$id_result)->first();
		$project = DB::table('projects')->where('id',$result->id_project)->first();
		$name = DB::table('users')->where('id',$result->id_employee_r)->value('name');

		$pdf = PDF::loadView('formprintresult',['project'=>$project,'result'=>$result,'name'=>$name]);

		$name_download = $project->name_project.$result->date_finish."."."pdf";

		return $pdf->stream();
	}

}
