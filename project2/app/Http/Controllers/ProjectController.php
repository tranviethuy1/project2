<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Advances;
use App\User;
class ProjectController extends Controller
{
    public function checkproject(Request $request){
    	$id = $request->id;
    	$projects= \App\User::find($id)->link_user2project->toArray();
        if(count($projects) != 0){
            $project = array();
            $name = array();
            $plan = array();
        	foreach ($projects as $value) {
        		if($value['status'] == 1 || $value['status'] == 2){
        			$project = $value;
        		}
        	}
            if(count($project) != 0){
            $id_project = $project['id'];
            $plan = \App\Plans::where('id_project',$id_project)->first()->toArray();
            $links = \App\Projects::find($id_project)->link_project2link->toArray();
                foreach ($links as $value) {
                    $id_employee = $value['id_employee']; 
                    $arr = \App\User::select('name')->where('id',$id_employee)->first();
                    $name[]=$arr->name; 
                }
                return view('checkproject')->with(['project'=>$project,'name_employee'=>$name,'plan'=>$plan]);                
            }else{
                return view('checkproject');
            }
    	}else{
    		return view('checkproject');
    	}
    }

    public function showProjectAdvance(Request $request){
        $id = $request->id;
        $projects= \App\User::find($id)->link_user2project->toArray(); 

        if(count($projects) != 0){
            $project = array();
            foreach ($projects as $value) {
                if($value['status'] == 1 || $value['status'] == 2){
                    $project = $value;
                }
            }

            if(count($project) != 0 ){
                $id_project = $project['id'];
                $advance = \App\Advances::where('id_project',$id_project)->where('id_employee',$id)->first();
                $plan = \App\Plans::where('id_project',$id_project)->first();
                return view('advance')->with(['id'=>$id,'project'=>$project,'advance'=>$advance,'plan'=>$plan]);
            }else{
                 return view('advance')->with('id',$id);
            }
        }else{
            return view('advance')->with('id',$id);
        }
    }

    public function excuteAdvance(Request $request){
        $id = $request->id;
        $id_project = $request->id_project;
        $posision = $request->posision;
        $area = $request->area;
        $day = $request->day;
        $travel_cost = $request->travel_cost;
        $postage = $request->postage;
        $postage_document = $request->postage_document;
        $others = $request->others;
        $day = $request->day;
        $rent_house = null;
        if($posision == 1){
            $rent_house = 2500000*$day;
        }elseif($posision == 2 && $area == 1 ){
            $rent_house = 1200000*$day;
        }elseif($posision == 2 && $area == 2){
            $rent_house = 1100000*$day;
        }elseif($posision == 3 && $area == 1){
            $rent_house = 1000000*$day;
        }else{
            $rent_house = 700000*$day;
        }

        $advance = \App\Advances::where('id_project',$id_project)->where('id_employee',$id)->first();
        if(empty($advance)){
            $adv = new \App\Advances;
            $adv->id_employee = $id;
            $adv->advance_date = date("Y-m-d");
            $adv->travel_cost =  $travel_cost;
            $adv->rent_house = $rent_house;
            $adv->postage = $postage;
            $adv->postage_document = $postage_document;
            $adv->others = $others; 
            $adv->id_project = $id_project; 
            $adv->save();
            $project = \App\Projects::find($id_project)->first()->toArray();
            return view('advance')->with(['id'=>$id,'project'=>$project,'advance'=>$adv,'alert_advance'=>'Advance successful']);
        }else{
            $advance->id_employee = $id;
            $advance->advance_date = date("Y-m-d");
            $advance->travel_cost =  $travel_cost;
            $advance->rent_house = $rent_house;
            $advance->postage = $postage;
            $advance->postage_document = $postage_document;
            $advance->others = $others; 
            $advance->id_project = $id_project; 
            $advance->save();
            $project = \App\Projects::select('name_project')->find($id_project)->first()->toArray();
            return view('advance')->with(['id'=>$id,'project'=>$project,'advance'=>$advance,'alert_advance'=>'Update successful']);
        }
    }

    public function loadAdvance(Request $request){
        $id = $request->id;
        $advance = \App\Advances::where('id_employee',$id)->orderBy('id','desc')->paginate(20);
        return view('historyemployee')->with(['id'=>$id,'advances'=>$advance]);
    }

    public function findAdvance(Request $request){
        $name_project = $request->name_project;
        $id_employee =$request->id;
        $name_project = strtolower($name_project);
        $projects = \App\Projects::all();
        $advance_find = array();
        foreach ($projects as $project) {
            $id_project = $project->id;
            $value = strtolower($project->name_project);
            if($name_project == $value){
                $advance = \App\Advances::where('id_project',$id_project)->where('id_employee',$id_employee)->first()->toArray();
                $advance_find[] = $advance;
            }
        }
        return view('historyemployee')->with(['id'=>$id_employee,'advances_find'=>$advance_find]);
    }

        public function loadPayment(Request $request){
        $id = $request->id;
        $results = \App\Results::where('id_employee_r',$id)->orderBy('id','desc')->paginate(8);
        return view('paymentemployee')->with(['id'=>$id,'payments'=>$results]);
    }

        public function findPayment(Request $request){
        $name_project = $request->name_project;
        $id_employee =$request->id;
        $name_project = strtolower($name_project);
        $projects = \App\Projects::all();
        $payment_find = array();
        foreach ($projects as $project) {
            $id_project = $project->id;
            $value = strtolower($project->name_project);
            if($name_project == $value){
                $result = \App\Results::where('id_project',$id_project)->where('id_employee_r',$id_employee)->first()->toArray();
                $payment_find[] = $result;
            }
        }
        return view('paymentemployee')->with(['id'=>$id_employee,'payments_find'=>$payment_find]);
    }

}
