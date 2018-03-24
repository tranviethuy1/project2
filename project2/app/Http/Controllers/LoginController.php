<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
class LoginController extends Controller
{
    //
    public function login(Request $request){
    	
    	$email = $request->input('email');
    	$password = $request->input('pass');
    	$posision = null;
        $name = null;
        
    	$users = DB::table('users')->where('email',$email)->get();
    	
        foreach ($users as $value) {
            $posision = $value->posision;
            $name = $value->name;
    	}

    	if(Auth::attempt(array('email'=>$email,'password'=>$password))){
    		
    		if($posision == 1){
    			return redirect('employeepage')->with('name', $name);
    		}else{
    			return redirect('admin')->with('name', $name);		
            }

    	}else{
    		return redirect('/')->with('error','User is not exist');
    	}
    }

    public function logout(){
        Auth::logout();
        return view('login');
    }

}
