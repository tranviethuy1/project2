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

        return view('createaccount')->with('alert','Create Account successfull');
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
                return view('employeepage')->with('alert','Update succesful');
            }else{
                $error = "Invalid format file or Size of file is too big";
                return redirect()->Route('updateprofile',array($id,$error));
            }
        }else{
            $userUpdate->save();
            $imforUpdate->save();
            return view('employeepage')->with('alert','Update succesful');
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

        return view('employeepage')->with('alert','Change password succesful');
    }
}
