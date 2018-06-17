<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\Results;
use App\Charts\MyChart;
use App\Projects;
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

        return redirect('admin')->with('alert','Thêm chuyến công tác thành công !!');
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
            $imformation = \App\Imformations::where('id',$id)->first();
            if($imformation->avatar != null){
                unlink($imformation->avatar);
            }
            
            $file = $request->file('avatar');
            if(in_array($file->getClientOriginalExtension(),['png','jpg','jpeg'])){
                $photo_name = mt_rand();
                $type = $file->getClientOriginalExtension();
                $link = "images/avatars/";
                $file->move($link,$photo_name.".".$type);
                $imforUpdate->avatar = $link.$photo_name.".".$type;
                
                $userUpdate->save();
                $imforUpdate->save();
                return Redirect('admin')->with('alert','Cập nhật thông tin thành công !!');
            }else{
                $error = "Không đúng định dạng file hoặc kích cỡ file quá lớn !!";
                return redirect()->Route('back2updateadmin',array($id,$error));
            }
        }else{
            $userUpdate->save();
            $imforUpdate->save();
            return redirect('admin')->with('alert','Cập nhật thông tin thành công !!');
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

        return redirect('admin')->with('alert','Đổi mật khẩu thành công !!');
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

            return redirect('admin')->with('alert','Thêm các khoản ước tính của chuyến công tác thành công !!');
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
            return redirect('admin')->with('alert','Cập nhật các khoản ước tính của chuyến công tác thành công !!');
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
                    return redirect('admin')->with('alert','Cập nhật cán bộ cho chuyến công tác này !!');
                }else{
                    return redirect('admin')->with('alert','Đã phân công cán bộ cho chuyến công tác này !!');
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
                    return redirect('admin')->with('alert','Cập nhật cán bộ cho chuyến công tác này !!');
                }else{
                    return redirect('admin')->with('alert','Đã phân công cán bộ cho chuyến công tác này !!');
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
                    return redirect('admin')->with('alert','Cập nhật cán bộ cho chuyến công tác này !!');
                }else{
                    return redirect('admin')->with('alert','Đã phân công cán bộ cho chuyến công tác này !!');
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
                    return redirect('admin')->with('alert','Cập nhật cán bộ cho chuyến công tác này !!');
                }else{
                    return redirect('admin')->with('alert','Đã phân công cán bộ cho chuyến công tác này !!');
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
                    return redirect('admin')->with('alert','Cập nhật cán bộ cho chuyến công tác này !!');
                }else{
                    return redirect('admin')->with('alert','Đã phân công cán bộ cho chuyến công tác này !!');
                }

            }
        }

    public function updateAssignment(Request $request){
        $id = session('data')['id'];
        $id_project = $request->id_project;
        $links = \App\Projects::find($id_project)->link_project2link->toArray();
        session()->put('links',$links);
        DB::table('links')->where('id_project',$id_project)->delete();
        return redirect()->Route('assignment',array($id,$id_project))->with('alert','Bạn có thể phân công laih cán bộ cho chuyến công tác hoặc hủy thao tác này !!');
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
        return redirect()->Route('admin')->with('alert','Cập nhật chuyến công tác thành công !!');
    }

    public function redirectAdminUnconfirmAdvance(){
        $projects = \App\Projects::where('status',1)->paginate(5);
        return view('adminunconfirmadvance')->with('projects',$projects);
    }

    public function seeAdvance(Request $request){
        $id_project = $request->id_project;
        $project = \App\Projects::where('id',$id_project)->first();
        $plan = \App\Plans::where('id_project',$id_project)->first();

        $name_employee = array();

        $links = \App\Projects::find($id_project)->link_project2link->toArray();
        //get user
        foreach ($links as $key => $link) {
            $id_employee = $link['id_employee'];
            $user = \App\User::where('id',$id_employee)->first();
            $name_employee[] = $user->name;
        }

        $advances = \App\Advances::where('id_project',$id_project)->get();
        if(empty($advances)){
            return view('seeadvanceunconfirm')->with(['plan'=>$plan,'project'=>$project,'name_employee'=>$name_employee]);
        }else{
            $admin = null;
            $data_messages = array();

            //get mesage
            foreach($advances as $advance){
                $message = DB::table('refuses')->where('id_advance',$advance->id)->get();
                if(count($message) != 0){
                    $user_mes = DB::table('users')->where('id',$advance->id_employee)->first();
                    foreach ($message as $value) {
                        $admin = DB::table('users')->where('id',$value->id_admin)->first();
                    }
                    $data_messages[] = ['message'=>$message,'employee'=>$user_mes->name,'admin'=>$admin->name];
                }
            }

            return view('seeadvanceunconfirm')->with(['plan'=>$plan,'project'=>$project,'advances'=>$advances,'name_employee'=>$name_employee, 'data_messages'=>$data_messages]);
        }  
    }

    public function acceptAdvance(Request $request){
        $id_project = $request->id_project;
        $advances = DB::table('advances')->where('id_project',$id_project)->first();

        if(empty($advances)){
            return redirect()->Route('seeadvance',array($id_project))->with('alert','Không thể duyệt phiếu tạm ứng vì không có phiếu vay tạm ứng nào trong chuyến công tác này !!');
        }else{
            $project = \App\Projects::where('id',$id_project)->first();
            $project->status = 2;
            $project->save();

            $projects = \App\Projects::where('status',1)->paginate(5);
            return view('adminunconfirmadvance')->with(['projects'=>$projects,'alert'=>"Đã duyệt phiếu tạm ứng !!"]);            
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
        return redirect()->Route('seeadvance',array($id_project))->with('alert','Thông điệp đã được gửi đến cán bộ !!');

    }

    public function updateRefuse(Request $request){
        $id_project = $request->id_project;
        $id_refuse = $request->id_refuse;
        $content_refuse = $request->content_refuse;
        if($content_refuse == null){
            return redirect()->Route('seeadvance',array($id_project))->with('content_refuse','Nội dung thông điệp trống !!');
        }else{
            
            $id_admin = session('data')['id'];    
            $create_at = date("Y-m-d H:i:s"); 
            $reason = $content_refuse;

            DB::table('refuses')->where('id',$id_refuse)->update(['id_admin'=> $id_admin, 'reason' => $reason, 'create_at' => $create_at]);
            return redirect()->Route('seeadvance',array($id_project))->with('alert','Cập nhật thông điệp thành công !!');
        }
    }

    public function deleteRefuse(Request $request){
        $id_project = $request->id_project;
        $id_refuse = $request->id_refuse;
        DB::table('refuses')->where('id',$id_refuse)->delete();
        return redirect()->Route('seeadvance',array($id_project))->with('alert','Xóa thông điệp thành công !!');
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
        return view('adminuser')->with(['users'=>$users,'alert'=>'Reset mật khẩu thành công. Mật khẩu ngẫu nhiên: 1234  !! ']);
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
            return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Thêm thông báo thành công !! ']);
        }else{
            $notice->save();
            $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
            return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Thêm thông báo thành công !! ']);
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
        return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Xóa thông báo thành công !! ']);
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
        $notice->title = $title;
        $notice->content = $content;
        $notice->create_at = date("Y-m-d");
        $notice->id_employee = session('data')['id'];

        if($request->hasFile('file_notice')){
            if($notice->linkdownload != null){
                unlink($notice->linkdownload);
            }

            $file = $request->file('file_notice');
            $type = $file->getClientOriginalExtension();
            $name = mt_rand();
            $link = "files/";
            $file->move($link,$name.".".$type);
            $notice->linkdownload = $link.$name.".".$type;    

            $notice->save();

            $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
            return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Cập nhật thông báo thành công !! ']);
        }else{
            $notice->save();

            $notices = DB::table('notices')->orderBy('id','desc')->paginate(6);
            return view('adminnotice')->with(['notices'=>$notices,'alert'=>'Cập nhật thông báo thành công !! ']);
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
            return Redirect('admin')->with('alert','Không thể thanh toán vì chuyến công tác này chưa thêm các khoản chi dự tính !!');
        }elseif($links == null){
            return Redirect('admin')->with('alert','Không thể thanh toán vì chuyến công tác này chưa phân công cho cán bộ !!');
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
        return redirect()->Route('adminpayment',array($id_project))->with('alert','Thanh toán cho '.$name_employee);
    }

    public function deletePayment(Request $request){
        $id_project = $request->id_project;
        $id_result = $request->id_result;
        DB::table('results')->where('id',$id_result)->delete();
        return redirect()->Route('adminpayment',array($id_project))->with('alert','Xoá phiếu thanh toán thành công !!');
    }

    public function finishProject(Request $request){
        $id_project = $request->id_project;
        $employees_links = array();
        $employees_results = array();
        $links = DB::table('links')->where('id_project',$id_project)->get();
        $results = DB::table('results')->where('id_project',$id_project)->get();

        // get id_employee in links table
        if($links == null){
            return redirect()->Route('adminpayment',array($id_project))->with('alert','Không thể kết thúc chuyến công tác vì chưa phân công cho cán bộ !!');
        }else{
            foreach ($links as $key => $value) {
                $employees_links[] = $value->id_employee;
            } 
        }
        // get id_employee in results table
        if($results == null){
            return redirect()->Route('adminpayment',array($id_project))->with('alert','Không thể kết thúc chuyến công tác vì chưa thanh toán cho cán bộ được phân công !!');
        }else{
            foreach ($results as $key => $value) {
                $employees_results[] = $value->id_employee_r;
            } 
        }
        //compare 2 array
        if(count($employees_links) != count($employees_results)){
            return redirect()->Route('adminpayment',array($id_project))->with('alert','Không thể kết thúc chuyến công tác vì chưa thanh toán cho tất cả cán bộ được phân công !!');
        }else{
            $project = DB::table('projects')->where('id',$id_project)->update(['status'=>3]);
            return redirect()->Route('admin')->with('alert','Đã kết thúc chuyến công tác !!');
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

        return redirect('admintemplate')->with('alert','Thêm mẫu đơn thành công !!');
    }

    public function deleteTemplate(Request $request){
        $id_template = $request->id_template;
        $file = DB::table('templates')->where('id',$id_template)->value('linkdownload');
        unlink($file);

        DB::table('templates')->where('id',$id_template)->delete();

        return redirect('admintemplate')->with('alert','Xóa mẫu đơn thành công !!');    
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
        return redirect()->Route('admintemplate')->with('alert','Cập nhật mẫu đơn thành công !!');
    }

    public function findStatistic(Request $request){
        $month = $request->month;
        $year = $request->year;
        $results = array();

        if($month == "all"){
            $projects = Results::select('id_project')->whereYear('date_finish',$year)->distinct()->get();
            foreach ($projects as $value){
                $name = DB::table('projects')->where('id',$value->id_project)->value('name_project');
                $travel_cost = DB::table('results')->where('id_project',$value->id_project)->sum('travel_cost_r');
                $rent_house = DB::table('results')->where('id_project',$value->id_project)->sum('rent_house_r');
                $postage = DB::table('results')->where('id_project',$value->id_project)->sum('postage_r');
                $postage_document = DB::table('results')->where('id_project',$value->id_project)->sum('postage_document_r');
                $others = DB::table('results')->where('id_project',$value->id_project)->sum('others_r');
                $overtime = DB::table('results')->where('id_project',$value->id_project)->sum('overtime');
                $benifit = DB::table('results')->where('id_project',$value->id_project)->sum('benifit');
                
                $results[] = ['name'=> $name,'travel_cost_r'=>$travel_cost,'rent_house_r'=>$rent_house,'postage_r'=>$postage,'postage_document_r'=>$postage_document, 'others_r'=>$others, 'overtime'=>$overtime,'benifit'=>$benifit];
            }
        }else{
            $projects = Results::select('id_project')->whereMonth('date_finish',$month)->whereYear('date_finish',$year)->distinct()->get();            
            foreach ($projects as $value){
                $name = DB::table('projects')->where('id',$value->id_project)->value('name_project');
                $travel_cost = DB::table('results')->where('id_project',$value->id_project)->sum('travel_cost_r');
                $rent_house = DB::table('results')->where('id_project',$value->id_project)->sum('rent_house_r');
                $postage = DB::table('results')->where('id_project',$value->id_project)->sum('postage_r');
                $postage_document = DB::table('results')->where('id_project',$value->id_project)->sum('postage_document_r');
                $others = DB::table('results')->where('id_project',$value->id_project)->sum('others_r');
                $overtime = DB::table('results')->where('id_project',$value->id_project)->sum('overtime');
                $benifit = DB::table('results')->where('id_project',$value->id_project)->sum('benifit');
                
                $results[] = ['name'=> $name,'travel_cost_r'=>$travel_cost,'rent_house_r'=>$rent_house,'postage_r'=>$postage,'postage_document_r'=>$postage_document, 'others_r'=>$others, 'overtime'=>$overtime,'benifit'=>$benifit];
            }
        }

        $january = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),1)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $february = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),2)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $march = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),3)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $april = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),4)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $may = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),5)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $june = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),6)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $july = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),7)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $august = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),8)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $september = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),9)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $october = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),10)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $november = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),11)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();
        $december = Results::where(DB::raw("(DATE_FORMAT(date_finish,'%m'))"),12)->where(DB::raw("(DATE_FORMAT(date_finish,'%Y'))"),date('Y'))->get();

        $chart =  new MyChart;
        $chart->dataset('Statistics of completed projects', 'line', [count($january),count($february),count($march),count($april),count($may),count($june),count($july),count($august),count($september),count($october),count($november),count($december)])->color('#56aaff');
        $chart->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December ']);

        $jan = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),1)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $feb = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),2)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $mar = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),3)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $ap = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),4)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $ma = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),5)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $jun = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),6)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $jul = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),7)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $aug = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),8)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $sep = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),9)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $oc= Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),10)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $nov = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),11)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();
        $dec = Projects::where(DB::raw("(DATE_FORMAT(date_start,'%m'))"),12)->where(DB::raw("(DATE_FORMAT(date_start,'%Y'))"),date('Y'))->get();  


        $chart_p =  new MyChart;
        $chart_p->dataset('Statistics project in year', 'line', [count($jan),count($feb),count($mar),count($ap),count($ma),count($jun),count($jul),count($aug),count($sep),count($oc),count($nov),count($dec)])->color('#56aaff');
        $chart_p->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December ']); 

        return view('statistic')->with(['chart'=>$chart,'chart_p'=>$chart_p,'results'=>$results]);
    }
}
