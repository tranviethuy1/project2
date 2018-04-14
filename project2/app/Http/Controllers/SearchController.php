<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SearchController extends Controller
{
    public function quickSearchAdvance(Request $request){
    	if($request->ajax()){
            $name_project = $request->name_project;
            $id_employee = $request->id;
    		$projects = DB::table('projects')->where('name_project','LIKE','%'.$name_project.'%')->get();
            $output="";
    		if($projects != null){
    			foreach ($projects as $project) {
    			$id_project = $project->id;
    			$advance = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$id_employee)->first();
    			$output.='<tr>'.
                        '<td>'.$project->name_project.'</td>'.
    					'<td>'.$advance->advance_date.'</td>'.
    					'<td>'.number_format($advance->travel_cost).'VNĐ'.'</td>'.
    					'<td>'.number_format($advance->rent_house).'VNĐ'.'</td>'.
    					'<td>'.number_format($advance->postage).'VNĐ'.'</td>'.
    					'<td>'.number_format($advance->postage_document).'VNĐ'.'</td>'.
    					'<td>'.number_format($advance->others).'VNĐ'.'</td>'.
    					'</tr>';
    			}
    			return Response($output);
    		}
    	}
    }
    
    public function quickSearchResult(Request $request){
        if($request->ajax()){
            $name_project = $request->payment_search;
            $id_employee = $request->id;
            $projects = DB::table('projects')->where('name_project','LIKE','%'.$name_project.'%')->get();
            $output="";
            if($projects != null){
                foreach ($projects as $project) {
                $id_project = $project->id;
                $result = DB::table('results')->where('id_project',$id_project)->where('id_employee_r',$id_employee)->first();
                $output.='<tr>'.
                        '<td>'.$project->name_project.'</td>'.
                        '<td>'.number_format($result->travel_cost_r).'VNĐ'.'</td>'.
                        '<td>'.number_format($result->rent_house_r).'VNĐ'.'</td>'.
                        '<td>'.number_format($result->postage_r).'VNĐ'.'</td>'.
                        '<td>'.number_format($result->postage_document_r).'VNĐ'.'</td>'.
                        '<td>'.number_format($result->others_r).'VNĐ'.'</td>'.
                        '<td>'.number_format($result->overtime).'VNĐ'.'</td>'.
                        '<td>'.number_format($result->benifit).'VNĐ'.'</td>'.
                        '<td>'.$result->date_finish.'</td>'.
                        '</tr>';
                }
                return Response($output);
            }
        }
    }


}
