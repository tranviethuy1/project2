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
    					'<td>'.number_format($advance->travel_cost).'</td>'.
    					'<td>'.number_format($advance->rent_house).'</td>'.
    					'<td>'.number_format($advance->postage).'</td>'.
    					'<td>'.number_format($advance->postage_document).'</td>'.
    					'<td>'.number_format($advance->others).'</td>'.
                        '<td>'.number_format($advance->travel_cost+$advance->rent_house+$advance->postage+$advance->postage_document+$advance->others).'VNĐ'.'</td>'.
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
                        '<td>'.number_format($result->travel_cost_r).'</td>'.
                        '<td>'.number_format($result->rent_house_r).'</td>'.
                        '<td>'.number_format($result->postage_r).'</td>'.
                        '<td>'.number_format($result->postage_document_r).'</td>'.
                        '<td>'.number_format($result->others_r).'</td>'.
                        '<td>'.number_format($result->overtime).'</td>'.
                        '<td>'.number_format($result->benifit).'</td>'.
                        '<td>'.$result->date_finish.'</td>'.
                        '<td>'.number_format($result->travel_cost_r+$result->rent_house_r+$result->postage_r+$result->postage_document_r+$result->others_r+$result->overtime+$result->benifit).' VNĐ'.'</td>'.
                        '</tr>';
                }
                return Response($output);
            }
        }
    }

    public function setNumberEmployee(Request $request){
        if($request->ajax()){
            $number = $request->number_employee;
            $date_start = $request->date_start;
            $users = \App\User::all();
            $employee_nottrue = array();
            $employee_true = array();
            $a1 = \App\User::find(2)->link_user2project->toArray();
            //get busy employee in list of employee $employee_nottrue
            foreach ($users as $user) {
                if($user->posision == 1){
                    $id = $user->id;
                    $projects = \App\User::find($id)->link_user2project->toArray();
                    foreach($projects as $project){
                        $date_end = 0;
                        if($project['status'] != 3){
                            $plan = \App\Plans::where('id_project',$project['id'])->first();
                            $number_date_plan = $plan->days;
                            $date_start_plan = $project['date_start'];
                            $date_end = strtotime($date_start_plan)+$number_date_plan*86400;
                            if(strtotime($date_start) < $date_end){
                                $employee_nottrue[] = $user->name;
                            }
                        }
                    }
                }
            }
            //get employee
            foreach ($users as $user) {
                if($user->posision == 1){
                    if(!in_array($user->name, $employee_nottrue)){
                        $employee_true[] = $user->name; 
                    }
                }
            }
            //response data
            $output = "";
            $option = "";
            foreach($employee_true as $value){
                $option.="<option>".$value."</option>";
            }

            for($i=0;$i<$number;$i++){
                $name = "employee_name".($i+1);
                $output.="<select name='$name' size=1>".$option."
                </select><br><br>";
            }
            return Response($output);
        }
    }


    public function searchEmployee(Request $request){
        if($request->ajax()){
            $name_employee = $request->name_employee;
            $users = DB::table('users')->where('name','LIKE','%'.$name_employee.'%')->get();
            $output = "";

            if($users != null){
                foreach($users as $user){
                    $id_employee = $user->id;
                    $imformation = \App\Imformations::where('id_employee',$id_employee)->first();
                    $url = "resetpassword/".$user->id;
                    $male = null;
                    $posision = null;
                    $avatar = null;

                    if($imformation->male ==1){
                        $male = "Male";
                    }else{
                        $male = "Female"; 
                    }  

                    if($user->posision == 1){
                        $posision = "Employee";
                    }else{
                        $posision = "Admin";
                    }

                    if(isset($imformation->avatar)){
                        $avatar = asset($imformation->avatar);
                    }else{
                        $avatar = asset("http://websamplenow.com/30/userprofile/images/avatar.jpg");
                    }

                    $output.='<tr>'.
                        '<td>'.$user->id.'</td>'.
                        '<td>'."<img src = '$avatar' class='avatar'>".'</td>'.
                        '<td>'.$user->name.'</td>'.
                        '<td>'.$user->email.'</td>'.
                        '<td>'.$posision.'</td>'.
                        '<td>'.$male.'</td>'.
                        '<td>'.$imformation->birth.'</td>'.
                        '<td>'.$imformation->address.'</td>'.
                        '<td>'.$imformation->phone.'</td>'.
                        '<td>'."<a href='$url' class='btn btn-success'>Reset</a>".'</td>'.
                        '</tr>';
                }
                return Response($output);
            }

        }
    } 

    public function chooseNumberEmployee(Request $request){
        if($request->ajax()){
            $number_employee = $request->number_employee;
            $id_project = $request->id_project;
            $output = "";
            $option = "";
            $links = DB::table('links')->where('id_project',$id_project)->get();

            $employees = array();
            foreach ($links as $key => $link) {
                $id_employee = $link->id_employee;
                $user = DB::table('users')->where('id',$id_employee)->first();
                $employees[] = $user->name;
             } 

            if($employees != null){
                foreach($employees as $employee){
                    $option.="<option>".$employee."</option>";
                }

            for($i=0;$i<$number_employee;$i++){
                $name = "employee_name".($i+1);
                $output.="<select name='$name' size=1>".$option."
                </select><br><br>";
            }
            return Response($output);  
            }else{
                $output="<input name='output' type='text' value='This project isnt assignment' class='form-control' disabled>";
                return Response($output);
            }    
        }        
    }

    public function setIdRefuse(Request $request){
        if($request->ajax()){
            $id_refuse = $request->id_refuse;
            $output = "";

            $output.= $id_refuse;

            return Response($output);
        }
    }

    public function searchProject(Request $request){
        if($request->ajax()){
            $search = $request->search;
            $output = "";

            $projects = DB::table('projects')->where('name_project','LIKE','%'.$search.'%')->get();
            // $projects = DB::table('projects')->where('name_project','LIKE','%'.$search.'%')->orWhere('project_manager','LIKE','%'.$search.'%')->orWhere('date_start','LIKE','%'.$search.'%')->get();

            if($projects != null){
               foreach($projects as $project){
                    $plans = DB::table('plans')->where('id_project',$project->id)->first();
                    $links = DB::table('links')->where('id_project',$project->id)->get();
                    $advances = DB::table('advances')->where('id_project',$project->id)->get();
                    $results = DB::table('results')->where('id_project',$project->id)->get();
                    $text_plans = "";
                    $text_links  = "";
                    $text_results = "";
                    $all = 0;

                    $text_plans.="<ul class='project'>
                            <li>Days: ".$plans->days."</li>
                            <li>Travel: ".number_format($plans->travel_cost)." VNĐ"."</li>
                            <li>Rent house: ".number_format($plans->rent_house)." VNĐ"."</li>
                            <li>Postage: ".number_format($plans->postage)." VNĐ"."</li>
                            <li>Document: ".number_format($plans->postage_document)." VNĐ"."</li>
                            <li>Others: ".number_format($plans->others)." VNĐ"."</li>
                            <li>Overtime: ".number_format($plans->overtime)." VNĐ"."</li>
                            <li>Benifit: ".number_format($plans->benifit)." VNĐ"."</li>
                            <hr>
                            <li class='text-info'>Total: ".number_format($plans->travel_cost+$plans->rent_house+$plans->postage+$plans->postage_document+$plans->others+$plans->overtime+$plans->benifit)." VNĐ"."</li>
                        </ul>";

                    foreach($links as $link){
                        $name = \App\User::where('id',$link->id_employee)->value('name');
                        $text_links.=$name."<br>"; 
                    } 

                    foreach ($results as  $result) {
                        $name = \App\User::where('id',$result->id_employee_r)->value('name');
                        $total = $result->travel_cost_r+$result->rent_house_r+$result->postage_r+$result->postage_document_r+$result->others_r+$result->overtime+$result->benifit; 
                        $all+= $total;

                        $text_results.="<ul class='project'> 
                            <li style='color:#007fff;'>Name: ".$name."</li>
                            <li>Date finish: ".$result->date_finish."</li>
                            <li>Travel : ".number_format($result->travel_cost_r)." VNĐ"."</li>
                            <li>Rent house: ".number_format($result->rent_house_r)." VNĐ"."</li>
                            <li>Postage: ".number_format($result->postage_r)." VNĐ"."</li>
                            <li>Document: ".number_format($result->postage_document_r)." VNĐ"."</li>
                            <li>Others: ".number_format($result->others_r)." VNĐ"."</li>
                            <li>Overtime: ".number_format($result->overtime)." VNĐ"."</li>
                            <li>Benifit: ".number_format($result->benifit)." VNĐ"."</li>
                            <hr>
                            <li style='color:#007fff;'>
                                Total: ".$total."
                            </li>
                            <li class='text-info'>Tổng số tiền: ".$all."</li>
                        </ul>";
                    }

                    $output.="<tr>
                        <td>".$project->id."</td>".
                        "<td>
                            <ul class='project'>
                                <li>Name: ".$project->name_project."</li>
                                <li>Manager: ".$project->project_manager."</li>
                                <li>Date start: ".$project->date_start."</li>
                            </ul>
                        </td>".
                        "<td>". $text_plans."</td>".
                        "<td>
                            <ul class='project'>".$text_links."</ul>
                        </td>".
                        "<td>".$text_results."</td>".
                        "<td>
                            <a href='' onclick='return ResetMesenger('Do you want to print ?')' class='btn btn-info'>Print <i class='fas fa-print'></i></a>
                        </td>
                     </tr>";
               } 
               return response($output);
            }    
            
        }
    }

}
