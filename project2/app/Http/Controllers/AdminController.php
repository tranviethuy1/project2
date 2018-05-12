<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\Results;
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

    public function redirectAssignment(Request $request){
        $id_employee = $request->id;
        $id_project =$request->id_project;
        $project = \App\Projects::where('id',$id_project)->first();
        $links = \App\Projects::find($id_project)->link_project2link->toArray();
        if(empty($links)){
            return view('assignment')->with(['id'=>$id_employee,'project'=>$project]);    
        }else{
            $listemployee = array();
            foreach ($links as $link) {
                $user = \App\User::where('id',$link['id_employee'])->first();
                $listemployee[] = $user->name;
            }
            return view('assignment')->with(['id'=>$id_employee,'project'=>$project,'employees'=>$listemployee]);
        }
    } 

    public function excuteAssignment(Request $request){
        $id = $request->id;
        $id_project = $request->id_project;
        $number_employee = $request->number_employee;
        switch($number_employee) {
            case 1:
                $name1 = $request->employee_name1;
                $user1 = \App\User::where('name',$name1)->first();
                DB::table('links')->insert([
                    ['id_employee' => $user1->id, 'id_project' => $id_project],
                ]);
                if(session()->has('links')){
                    session()->forget('links');
                    return redirect('admin')->with('alert','Updated assignment for the project');
                }else{
                    return redirect('admin')->with('alert','Added assignment for the project');
                }

            case 2:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $user1 = \App\User::where('name',$name1)->first();
                $user2 = \App\User::where('name',$name2)->first();
                DB::table('links')->insert([
                    ['id_employee' => $user1->id, 'id_project' => $id_project],
                    ['id_employee' => $user2->id, 'id_project' => $id_project],
                ]);

                if(session()->has('links')){
                    session()->forget('links');
                    return redirect('admin')->with('alert','Updated assignment for the project');
                }else{
                    return redirect('admin')->with('alert','Added assignment for the project');
                }

            case 3:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                $user1 = \App\User::where('name',$name1)->first();
                $user2 = \App\User::where('name',$name2)->first();
                $user3 = \App\User::where('name',$name3)->first();
                DB::table('links')->insert([
                    ['id_employee' => $user1->id, 'id_project' => $id_project],
                    ['id_employee' => $user2->id, 'id_project' => $id_project],
                    ['id_employee' => $user3->id, 'id_project' => $id_project],
                ]); 

                if(session()->has('links')){
                    session()->forget('links');
                    return redirect('admin')->with('alert','Updated assignment for the project');
                }else{
                    return redirect('admin')->with('alert','Added assignment for the project');
                }  

            case 4:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                $name4 = $request->employee_name4;
                $user1 = \App\User::where('name',$name1)->first();
                $user2 = \App\User::where('name',$name2)->first();
                $user3 = \App\User::where('name',$name3)->first();
                $user4 = \App\User::where('name',$name4)->first();
                DB::table('links')->insert([
                    ['id_employee' => $user1->id, 'id_project' => $id_project],
                    ['id_employee' => $user2->id, 'id_project' => $id_project],
                    ['id_employee' => $user3->id, 'id_project' => $id_project],
                    ['id_employee' => $user4->id, 'id_project' => $id_project],
                ]); 

                if(session()->has('links')){
                    session()->forget('links');
                    return redirect('admin')->with('alert','Updated assignment for the project');
                }else{
                    return redirect('admin')->with('alert','Added assignment for the project');
                }

            default:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                $name4 = $request->employee_name4;
                $name5 = $request->employee_name5;
                $user1 = \App\User::where('name',$name1)->first();
                $user2 = \App\User::where('name',$name2)->first();
                $user3 = \App\User::where('name',$name3)->first();
                $user4 = \App\User::where('name',$name4)->first();
                $user5 = \App\User::where('name',$name5)->first();
                DB::table('links')->insert([
                    ['id_employee' => $user1->id, 'id_project' => $id_project],
                    ['id_employee' => $user2->id, 'id_project' => $id_project],
                    ['id_employee' => $user3->id, 'id_project' => $id_project],
                    ['id_employee' => $user4->id, 'id_project' => $id_project],  
                    ['id_employee' => $user5->id, 'id_project' => $id_project], 
                ]);                                 

                if(session()->has('links')){
                    session()->forget('links');
                    return redirect('admin')->with('alert','Updated assignment for the project');
                }else{
                    return redirect('admin')->with('alert','Added assignment for the project');
                }

            }
        }

    public function updateAssignment(Request $request){
        $id = session('data')['id'];
        $id_project = $request->id_project;
        $links = \App\Projects::find($id_project)->link_project2link->toArray();
        session()->put('links',$links);
        DB::table('links')->where('id_project',$id_project)->delete();
        return redirect()->Route('assignment',array($id,$id_project))->with('alert','You can update assignment or cancel assignment');
    }    

    public function redirectUpdateProject(Request $request){
        $id_project = $request->id_project;
        $project = \App\Projects::where('id',$id_project)->first();
        return view('updateproject')->with('project',$project);
    }

    public function excuteUpdateProject(Request $request){
        $id_employee = $request->id;
        $id_project = $request->id_project;
        $project_name = $request->project_name;
        $date_start = $request->date_start;
        $describe = $request->describe;

        $name = \App\User::find($id_employee)->name;

        $project = \App\Projects::where('id',$id_project)->first();

        $project->name_project = $project_name;
        $project->date_start = $date_start;
        $project->describe = $describe;

        $project->save();
        return redirect()->Route('admin')->with('alert','Update Project Succesful');
    }

    public function redirectAdminUnconfirmAdvance(){
        $projects = \App\Projects::where('status',1)->paginate(5);
        return view('adminunconfirmadvance')->with('projects',$projects);
    }

    public function seeAdvance(Request $request){
        $id_project = $request->id_project;
        $project = \App\Projects::where('id',$id_project)->first();
        $plan = \App\Plans::where('id_project',$id_project)->first();
        $advances = \App\Advances::where('id_project',$id_project)->get();
        $admin = null;
        $data_messages = array();

        $name_employee = array();

        $links = \App\Projects::find($id_project)->link_project2link->toArray();
        //get user
        foreach ($links as $key => $link) {
            $id_employee = $link['id_employee'];
            $user = \App\User::where('id',$id_employee)->first();
            $name_employee[] = $user->name;
        }
        //get mesage
        foreach($advances as $advance){
            $user = DB::table('users')->where('id',$advance->id_employee)->first();
            $message = DB::table('refuses')->where('id_advance',$advance->id)->get();
            if($message != null){
                foreach ($message as $key => $value) {
                    $admin = DB::table('users')->where('id',$value->id_admin)->first();
                }
                $data_messages[] = ['message'=>$message,'employee'=>$user->name,'admin'=>$admin->name];
            }
        }

        if(empty($advances)){
            return view('seeadvanceunconfirm')->with(['plan'=>$plan,'project'=>$project,'name_employee'=>$name_employee]);
        }else{
            return view('seeadvanceunconfirm')->with(['plan'=>$plan,'project'=>$project,'advances'=>$advances,'name_employee'=>$name_employee, 'data_messages'=>$data_messages]);
        }  
    }

    public function acceptAdvance(Request $request){
        $id_project = $request->id_project;
        $advances = DB::table('advances')->where('id_project',$id_project)->first();

        if(empty($advances)){
            return redirect()->Route('seeadvance',array($id_project))->with('alert','Cant accept because No advance in this project');
        }else{
            $project = \App\Projects::where('id',$id_project)->first();
            $project->status = 2;
            $project->save();

            $projects = \App\Projects::where('status',1)->paginate(5);
            return view('adminunconfirmadvance')->with(['projects'=>$projects,'alert'=>"Accepted Advances"]);            
        } 
    }

    public function refuseAdvance(Request $request){
        $id_project = $request->id_project;
        $reason = $request->reason;
        $number_employee = $request->number_employee;
        $date = date("Y-m-d H:i:s"); 
        $admin = session('data')['id'];
        switch($number_employee) {
            case 1:
                $name1 = $request->employee_name1;
                $user1 = DB::table('users')->where('name',$name1)->first();
                $advance1 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user1->id)->first();
                DB::table('refuses')->insert([
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance1->id],
                ]);
                break;

            case 2:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $user1 = DB::table('users')->where('name',$name1)->first();
                $advance1 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user1->id)->first();
                $user2 = DB::table('users')->where('name',$name2)->first();
                $advance2 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user2->id)->first();
                DB::table('refuses')->insert([
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance1->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance2->id],
                ]);
                break;

            case 3:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                $user1 = DB::table('users')->where('name',$name1)->first();
                $advance1 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user1->id)->first();
                $user2 = DB::table('users')->where('name',$name2)->first();
                $advance2 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user2->id)->first();
                $user3 = DB::table('users')->where('name',$name3)->first();
                $advance3 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user3->id)->first();
                DB::table('refuses')->insert([
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance1->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance2->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance3->id],
                ]);
                break;

            case 4:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                $name4 = $request->employee_name4;
                $user1 = DB::table('users')->where('name',$name1)->first();
                $advance1 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user1->id)->first();
                $user2 = DB::table('users')->where('name',$name2)->first();
                $advance2 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user2->id)->first();
                $user3 = DB::table('users')->where('name',$name3)->first();
                $advance3 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user3->id)->first();
                $user4 = DB::table('users')->where('name',$name4)->first();
                $advance4 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user4->id)->first();
                DB::table('refuses')->insert([
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance1->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance2->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance3->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance4->id],
                ]);
                break;       

            default:         
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                $name4 = $request->employee_name4;
                $name5 = $request->employee_name5;
                $user1 = DB::table('users')->where('name',$name1)->first();
                $advance1 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user1->id)->first();
                $user2 = DB::table('users')->where('name',$name2)->first();
                $advance2 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user2->id)->first();
                $user3 = DB::table('users')->where('name',$name3)->first();
                $advance3 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user3->id)->first();
                $user4 = DB::table('users')->where('name',$name4)->first();
                $advance4 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user4->id)->first();
                $user5 = DB::table('users')->where('name',$name5)->first();
                $advance5 = DB::table('advances')->where('id_project',$id_project)->where('id_employee',$user5->id)->first();
                DB::table('refuses')->insert([
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance1->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance2->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance3->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance4->id],
                    ['id_admin' => $admin, 'reason' => $reason, 'create_at' => $date, 'id_advance' => $advance5->id],
                ]);
                break;  

            }  
        return redirect()->Route('seeadvance',array($id_project))->with('alert','Message is sent to employee');

    }

    public function updateRefuse(Request $request){
        $id_project = $request->id_project;
        $id_refuse = $request->id_refuse;
        $content_refuse = $request->content_refuse;
        if($content_refuse == null){
            return redirect()->Route('seeadvance',array($id_project))->with('content_refuse','Content is empty');
        }else{
            
            $id_admin = session('data')['id'];    
            $create_at = date("Y-m-d H:i:s"); 
            $reason = $content_refuse;

            DB::table('refuses')->where('id',$id_refuse)->update(['id_admin'=> $id_admin, 'reason' => $reason, 'create_at' => $create_at]);
            return redirect()->Route('seeadvance',array($id_project))->with('alert','Update message succesful');
        }
    }

    public function deleteRefuse(Request $request){
        $id_project = $request->id_project;
        $id_refuse = $request->id_refuse;
        DB::table('refuses')->where('id',$id_refuse)->delete();
        return redirect()->Route('seeadvance',array($id_project))->with('alert','Delete mesage succesful');
    }

    public function redirectAdminConfirmAdvance(){
        $projects = \App\Projects::where('status',2)->orwhere('status',3)->paginate(5);
        return view('adminconfirmadvance')->with('projects',$projects);
    }

    public function seeDetail(Request $request){
        $id_project = $request->id_project;
        $project = \App\Projects::where('id',$id_project)->first();
        $advances = \App\Advances::where('id_project',$id_project)->paginate(2);

        return view('seeadvanceconfirm')->with(['advances'=>$advances,'project'=>$project]);
    }
    
    public function redirectShowUser(){
        $users = DB::table('users')->paginate(6);
        return view('adminuser')->with('users',$users);
    }

    public function findUser(Request $request){
        $name = $request->employee;
        $users = DB::table('users')->where('name','LIKE','%'.$name.'%')->paginate(6);
        return view('adminuser')->with('users',$users);
    }

    public function resetPassword(Request $request){
        $id_employee = $request->id_employee;
        $user = \App\User::where('id',$id_employee)->first();
        $password = "1234";
        $user->password = bcrypt($password);
        $user->save();

        $users = DB::table('users')->paginate(6);
        return view('adminuser')->with(['users'=>$users,'alert'=>'Reset Password Succesful']);
    }

    public function redirectNotice(){
        $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
        return view('adminnotice')->with('notices',$notices);
    }

    public function addNotice(Request $request){
        $title = $request->title;
        $content = $request->content;
        $notice = new \App\Notices();

        $notice->title = $title;
        $notice->content = $content;
        $notice->create_at = date("Y-m-d");
        $notice->id_employee = session('data')['id'];

        if($request->hasFile('file_notice')){
            $file = $request->file('file_notice');
            $type = $file->getClientOriginalExtension();
            $name = mt_rand();
            $link = "files/";
            $file->move($link,$name.".".$type);
            $notice->linkdownload = $link.$name.".".$type;    

            $notice->save();

            $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
            return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Add Notice Succesful']);
        }else{
            $notice->save();
            $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
            return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Add Notice Succesful']);
        }    
    }

    public function deleteNotice(Request $request){
        $id_notice = $request->id_notice;
        $file = DB::table('notices')->where('id',$id_notice)->value('linkdownload');
        if($file !=null){
            unlink($file);
        }

        DB::table('notices')->where('id',$id_notice)->delete();

        $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
        return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Delete Notice Succesful']);
    }

    public function redirectUpdateNotice(Request $request){
        $id_notice = $request->id_notice;
        $notice = DB::table('notices')->where('id',$id_notice)->first();
        return view('updatenotice')->with('notice',$notice);
    }

    public function excuteUpdateNotice(Request $request){
        $id_notice = $request->id_notice;
        $title = $request->title;
        $content = $request->content;

        $notice = \App\Notices::where('id',$id_notice)->first();
        if($notice->linkdownload != null){
            unlink($notice->linkdownload);
        }

        $notice->title = $title;
        $notice->content = $content;
        $notice->create_at = date("Y-m-d");
        $notice->id_employee = session('data')['id'];

        if($request->hasFile('file_notice')){
            $file = $request->file('file_notice');
            $type = $file->getClientOriginalExtension();
            $name = mt_rand();
            $link = "files/";
            $file->move($link,$name.".".$type);
            $notice->linkdownload = $link.$name.".".$type;    

            $notice->save();

            $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
            return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Update Notice Succesful']);
        }else{
            $notice->linkdownload = null;
            $notice->save();

            $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
            return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Update Notice Succesful']);
        }    
    }

    public function redirectPaymentProject(Request $request){
        $id_project = $request->id_project;
        $employees = array();
        $project = DB::table('projects')->where('id',$id_project)->first();
        $plan = DB::table('plans')->where('id_project',$id_project)->first();
        $links = DB::table('links')->where('id_project',$id_project)->get();
        $advances = DB::table('advances')->where('id_project',$id_project)->get();
        $results = DB::table('results')->where('id_project',$id_project)->get();

        if($plan == null){
            return Redirect('admin')->with('alert','Cant solve because this project isnt assigned to employee');
        }elseif($links == null){
            return Redirect('admin')->with('alert','Cant solve because this project isnt added plan');
        }else{
            foreach ($links as $key => $value) {
                $id_employee = $value->id_employee;
                $user = DB::table('users')->where('id',$id_employee)->first();
                $employees[] = $user->name;
            }

            return view('adminpayment')->with(['project' => $project , 'plan' => $plan , 'employees' => $employees , 'advances' => $advances, 'results' => $results]);
        }
    }

    public function excutePayment(Request $request){
        $id_project = $request->id_project;
        $name_employee =$request->name_employee;
        $days = $request->days;
        $travel_cost = $request->travel_cost;
        $postage = $request->postage;
        $postage_document = $request->postage_document;
        $others = $request->others;
        $posision = $request->posision;
        $area = $request->area;
        $day_overtime = $request->day_overtime;
        $place = $request->place;

        $user = DB::table('users')->where('name',$name_employee)->first();

        $rent_house = null;
        if($posision == 1){
            $rent_house = 2500000*$days;
        }elseif($posision == 2 && $area == 1 ){
            $rent_house = 1200000*$days;
        }elseif($posision == 2 && $area == 2){
            $rent_house = 1100000*$days;
        }elseif($posision == 3 && $area == 1){
            $rent_house = 1000000*$days;
        }else{
            $rent_house = 700000*$days;
        }

        $overtime = $day_overtime*200000;

        $benifit = null;

        if($place == 1){
            $benifit = 200000*$days;
        }else{
             $benifit = 250000*$days;
        }

        $date_finsish = date("Y-m-d");

        $result =  new Results;

        $result->id_employee_r = $user->id;
        $result->travel_cost_r = $travel_cost;
        $result->rent_house_r = $rent_house;
        $result->postage_r = $postage;
        $result->postage_document_r = $postage_document;
        $result->others_r = $others;
        $result->overtime = $overtime;
        $result->benifit = $benifit;
        $result->date_finish = $date_finsish;
        $result->id_project = $id_project;

        $result->save();
        return redirect()->Route('adminpayment',array($id_project))->with('alert','Solved for '.$name_employee);
    }

    public function deletePayment(Request $request){
        $id_project = $request->id_project;
        $id_result = $request->id_result;
        DB::table('results')->where('id',$id_result)->delete();
        return redirect()->Route('adminpayment',array($id_project))->with('alert','Delete succesful');
    }

    public function finishProject(Request $request){
        $id_project = $request->id_project;
        $employees_links = array();
        $employees_results = array();
        $links = DB::table('links')->where('id_project',$id_project)->get();
        $results = DB::table('results')->where('id_project',$id_project)->get();

        // get id_employee in links table
        if($links == null){
            return redirect()->Route('adminpayment',array($id_project))->with('alert','Cant finish project because this project isnt assigned to employee');
        }else{
            foreach ($links as $key => $value) {
                $employees_links[] = $value->id_employee;
            } 
        }
        // get id_employee in results table
        if($results == null){
            return redirect()->Route('adminpayment',array($id_project))->with('alert','Cant finish project because this project isnt solved for anyone');
        }else{
            foreach ($results as $key => $value) {
                $employees_results[] = $value->id_employee_r;
            } 
        }
        //compare 2 array
        if(count($employees_links) != count($employees_results)){
            return redirect()->Route('adminpayment',array($id_project))->with('alert','Cant finish project because this project isnt solved for all employee');
        }else{
            $project = DB::table('projects')->where('id',$id_project)->update(['status'=>3]);
            return redirect()->Route('admin')->with('alert','Finished this project');
        }
    }

    public function redirectAdminTemplate(){
        $templates = DB::table('templates')->paginate(6);
        return view('admintemplate')->with('templates',$templates);
    }

    public function addTemplate(Request $request){
        $title = $request->title;
        $file = $request->file('file_template');

        $template = new \App\Templates();
        
        $type = $file->getClientOriginalExtension();
        $photo_name = mt_rand();

        $link = "templates/";
        $file->move($link,$photo_name.".".$type);

        $template->title = $title;
        $template->linkdownload= $link.$photo_name.".".$type;
        $template->create_at = date("Y-m-d");

        $template->save();

        return redirect('admintemplate')->with('alert','Add template succesful');
    }

    public function deleteTemplate(Request $request){
        $id_template = $request->id_template;
        $file = DB::table('templates')->where('id',$id_template)->value('linkdownload');
        unlink($file);

        DB::table('templates')->where('id',$id_template)->delete();

        return redirect('admintemplate')->with('alert','Delete template succesful');    
    }

    public function redirectUpdateTemplate(Request $request){
        $id_template = $request->id_template;
        $template = DB::table('templates')->where('id',$id_template)->first();

        return view('updatetemplate')->with('template',$template);
    }

    public function excuteUpdateTemplate(Request $request){
        $id_template = $request->id_template;
        $title = $request->title;
        $file = $request->file('file_template');

        $template = \App\Templates::where('id',$id_template)->first();
        if($template->linkdownload != null){
            unlink($template->linkdownload);
        }

        $type = $file->getClientOriginalExtension();
        $file_name = mt_rand();
        $link = "templates/";
        $file->move($link,$file_name.".".$type);

        $template->title = $title;
        $template->create_at = date("Y-m-d");
        $template->linkdownload = $link.$file_name.".".$type;

        $template->save();
        return redirect()->Route('admintemplate')->with('alert','Update template succesful');
    }
}
