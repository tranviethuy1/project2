<?php

namespace App\Http\Controllers;
use App\User;
use App\Imformations;
use Illuminate\Http\Request;
use DB;
class ExcuteAccount extends Controller
{
    public function insertData(Request $request){
    	$name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $male = $request->input('male');
        $address = $request->input('address');
        $birth = $request->input('birth');
        $phone = $request->input('phone');
        $id = null;
        // DB::table('users')->insert(['name'=>$name,'email'=>$email,'password'=>bcrypt('$password'),'remember_token'=>str_random(100)]);
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->remember_token = str_random(70);
        $user->save();

        $values = DB::table('users')->where('email',$email)->get();
        foreach ($values as $value) {
            $id = $value->id;
        }
        // DB::table('imformations')->insert(['id_employee'=>$id,'male'=>$male,'birth'=>$birth,'address'=>$address,'phone'=>$phone]);

        $imformations = new Imformations;
        $imformations->id_employee = $id;
        $imformations->male = $male;
        $imformations->birth = $birth;
        $imformations->address = $address;
        $imformations->phone = $phone;
        $imformations->save();

        return view('createaccount')->with('alert','Tạo tài khoản thành công !! ');
    }

    public function getDataUser(Request $request){
        $id = $request->id;
        $users = \App\Imformations::find($id)->link_imfor2user->toArray();
        $imformations = \App\Imformations::find($id)->toArray();
        $values = ['user' => $users,'imformation' => $imformations];
        return view('profile')->with('values',$values);
    }

    public function getDataUser2Update(Request $request){
        $id = $request->id;
        $error = $request->error;
        $users = \App\Imformations::find($id)->link_imfor2user->toArray();
        $imformations = \App\Imformations::find($id)->toArray();
        $values = ['user' => $users,'imformation' => $imformations];
        return view('updateprofile')->with(['values'=>$values,'error'=>$error]);
    }

    public function showError(Request $request){
        $id = $request->id;
        $error = $request->error;
        $users = \App\Imformations::find($id)->link_imfor2user->toArray();
        $imformations = \App\Imformations::find($id)->toArray();
        $values = ['user' => $users,'imformation' => $imformations];
        return view('updateprofile')->with(['values'=>$values,'error'=>$error]);
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

        $imforUpdate = \App\Imformations::find($id);
        $userUpdate = \App\User::find($id);
        
        $userUpdate->name = $name;

        $imforUpdate->male = $gender;
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
                return redirect()->Route('loadnotices')->with('alert','Cập nhật thành công !!');
            }else{
                $error = "Không đúng định dạng file hoặc kích cỡ file quá lớn !!";
                return redirect()->Route('updateprofile',array($id,$error));
            }
        }else{
            $userUpdate->save();
            $imforUpdate->save();
            return redirect()->Route('loadnotices')->with('alert','Cập nhật thành công !!');
        }
    }

    public function changePassword(Request $request){
        $id = $request->id;
        $user = DB::table('users')->select('email')->where('id',$id)->first();
        return view('changepass')->with(['id'=>$id,'email'=>$user->email]);
    }

    public function excuteChangePass(Request $request){

        $id = $request->id;
        $newpass = $request->newpass;

        $userUpdate = \App\User::find($id);
        $userUpdate->password = bcrypt($newpass);
        $userUpdate->save();

        return view('employeepage')->with('alert','Đổi mật khẩu thành công !!');
    }
}
