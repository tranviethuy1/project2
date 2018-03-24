<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Imformations;
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
        $user->password =bcrypt($password);
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
}
