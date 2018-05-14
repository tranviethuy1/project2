<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
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
        $id = null;
        
    	$users = DB::table('users')->where('email',$email)->get();
    	
        foreach ($users as $value) {
            $posision = $value->posision;
            $name = $value->name;
            $id = $value->id;
    	}

    	if(Auth::attempt(array('email'=>$email,'password'=>$password))){
    		session()->put('data',['id' => $id,'name' => $name]);
    		if($posision == 1){
    			return redirect()->Route('loadnotices')->with('values', ['id'=>$id,'name'=>$name]);
    		}else{
    			return redirect('admin')->with('values', ['id'=>$id,'name'=>$name]);		
            }

    	}else{
    		return redirect('/')->with('error','User is not exist');
    	}
    }

    public function logout(){
        Auth::logout();
        session()->forget('data');
        return view('login');
    }

    public function redirectAdminPage(){
        if(!session()->has('links')){
            $projects = \App\Projects::where('status',1)->orWhere('status',2)->paginate(5);
            return view('admin')->with('projects',$projects);
        }else{
            $links = session('links');
            foreach ($links as $key => $link) {
                $value =  new \App\Links();
                $value->id_employee = $link['id_employee'];
                $value->id_project = $link['id_project'];
                $value->save();
            }
            session()->forget('links');
            $projects = \App\Projects::where('status',1)->orWhere('status',2)->paginate(5);
            return view('admin')->with(['projects'=>$projects,'alert'=>'Data is restored']);
        }
    }
}
