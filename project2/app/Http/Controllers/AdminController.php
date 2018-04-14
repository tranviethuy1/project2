<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
  	public function addProject( Request $request){
  		$id_employee = $request->id;
  		$project_name = $request->input('project_name');
  		$date_start = $request->input('date_start');
        $describe = $request->describe;

        $user = \App\User::find($id_employee)->first();

        $project = new \App\Projects();
        $project->name_project = $project_name;
        $project->project_manager = $user->name;
        $project->date_start = $date_start;
        $project->describe = $describe;

        $project->save();

        return redirect('admin')->with('alert','Add Project Successful');
  	}

  	public function getDataAdmin(Request $request){
        $id = $request->id;
        $users = \App\Imformations::find($id)->link_imfor2user->toArray();
        $imformations = \App\Imformations::find($id)->toArray();
        $values = ['user' => $users,'imformation' => $imformations];
        return view('adminprofile')->with('values',$values);
    }

        public function getDataAdmin2Update(Request $request){
        $id = $request->id;
        $users = \App\Imformations::find($id)->link_imfor2user->toArray();
        $imformations = \App\Imformations::find($id)->toArray();
        $values = ['user' => $users,'imformation' => $imformations];
        return view('updateprofileadmin')->with(['values'=>$values]);
    }

        public function excuteUpdateFile(Request $request){
        $id = $request->id;
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $gender = $request->input('gender');
        $address = $request->input('address');
        $birth = $request->input('birth');
        $phone = $request->input('phone');
        $integerMale = null;
        if($gender = "Male"){
            $integerMale = 1;
        }else{
            $integerMale = 2;
        } 

        $imforUpdate = \App\Imformations::find($id);
        $userUpdate = \App\User::find($id);
        
        $userUpdate->name = $name;

        $imforUpdate->male = $integerMale;
        $imforUpdate->birth = $birth;
        $imforUpdate->address = $address;
        $imforUpdate->phone = $phone;

        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            if(in_array($file->getClientOriginalExtension(),['png','jpg','jpeg'])){
                $photo_name = $file->getClientOriginalName();
                $link = "images/avatars/";
                $file->move($link,$photo_name);
                $imforUpdate->avatar = $link.$photo_name;
                
                $userUpdate->save();
                $imforUpdate->save();
                return Redirect('admin')->with('alert','Update succesful');
            }else{
                $error = "Invalid format file or Size of file is too big";
                return redirect()->Route('back2updateadmin',array($id,$error));
            }
        }else{
            $userUpdate->save();
            $imforUpdate->save();
            return redirect('admin')->with('alert','Update succesful');
        }
    }

    public function showError(Request $request){
        $id = $request->id;
        $error = $request->error;
        $users = \App\Imformations::find($id)->link_imfor2user->toArray();
        $imformations = \App\Imformations::find($id)->toArray();
        $values = ['user' => $users,'imformation' => $imformations];
        return view('updateprofileadmin')->with(['values'=>$values,'error'=>$error]);
    }

    public function changePasswordAdmin(Request $request){
        $id = $request->id;
        $user = DB::table('users')->select('email')->where('id',$id)->first();
        return view('changepassadmin')->with(['id'=>$id,'email'=>$user->email]);
    }

    public function excuteChangePassAdmin(Request $request){
        $id = $request->id;
        $newpass = $request->newpass;

        $userUpdate = \App\User::find($id);
        $userUpdate->password = bcrypt($newpass);
        $userUpdate->save();

        return redirect('admin')->with('alert','Change password succesful');
    }

    public function redirectPlan(Request $request){
        $id_employee = $request->id;
        $id_project =$request->id_project;
        $project = \App\Projects::where('id',$id_project)->first();
        $plan = \App\Plans::where('id_project',$id_project)->first();
        if(empty($plan)){
            return view('adminplan')->with(['id'=>$id_employee,'project'=>$project]);    
        }else{
            return view('adminplan')->with(['id'=>$id_employee,'project'=>$project,'plan'=>$plan]);
        }
    }

    public function updatePlan(Request $request){
        $id_employee = $request->id;
        $id_project =$request->id_project;
        $project = \App\Projects::where('id',$id_project)->first();
        $updateplan = \App\Plans::where('id_project',$id_project)->first(); 
        return view('updateplan')->with(['id'=>$id_employee,'project'=>$project,'updateplan'=>$updateplan]);  
    }

    public function excutePlan(Request $request){
        $id_employee = $request->id;
        $id_project =$request->id_project;
        $days = $request->days;
        $travel_cost = $request->travel_cost;
        $rent_house = $request->rent_house;
        $postage = $request->postage;
        $postage_document = $request->postage_document;
        $others = $request->others; 
        $overtime = $request->overtime;
        $benifit = $request->benifit;

        $plan = \App\Plans::where('id_project',$id_project)->first();

        if(empty($plan)){
            
            $value = new \App\Plans();
            $value->travel_cost = $travel_cost;
            $value->rent_house = $rent_house;
            $value->postage = $postage;
            $value->postage_document = $postage_document;
            $value->others = $others;
            $value->overtime = $overtime;
            $value->benifit = $benifit;
            $value->days = $days;
            $value->id_project = $id_project;
            $value->save();

            return redirect('admin')->with('alert','Added plan for the project');
        }else{

            $plan->travel_cost = $travel_cost;
            $plan->rent_house = $rent_house;
            $plan->postage = $postage;
            $plan->postage_document = $postage_document;
            $plan->others = $others;
            $plan->overtime = $overtime;
            $plan->benifit = $benifit;
            $plan->days = $days;
            $plan->save();
            return redirect('admin')->with('alert','Updated plan for the project');
        }
    }


}
