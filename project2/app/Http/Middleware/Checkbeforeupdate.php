<?php

namespace App\Http\Middleware;

use Closure;

class Checkbeforeupdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $id = $request->id;
        $name = $request->input('name');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $address = $request->input('address');
        $birth = $request->input('birth');
        $phone = $request->input('phone');

        if(empty($name)){
            $error = "It is not enough data";
            return  redirect()->Route('back2updateprofile',array($id,$error))->with('name','Name is empty');
        }elseif(empty($email)){
            $error = "It is not enough data";
            return  redirect()->Route('back2updateprofile',array($id,$error))->with('email','Email is empty');
        }elseif(empty($gender)){
            $error = "It is not enough data";
            return  redirect()->Route('back2updateprofile',array($id,$error))->with('gender','Gender is empty');
        }elseif(empty($address)){
            $error = "It is not enough data";
            return  redirect()->Route('back2updateprofile',array($id,$error))->with('address','Address is empty');
        }elseif(empty($phone)){
            $error = "It is not enough data";
            return  redirect()->Route('back2updateprofile',array($id,$error))->with('phone','Phone is empty');
        }elseif(empty($birth)){
            $error = "It is not enough data";
            return  redirect()->Route('back2updateprofile',array($id,$error))->with('birth','Birth is empty');
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
            return redirect()->Route('back2updateprofile',array($id,$error))->with('email','Invalid email format');
        }elseif(!preg_match("/^[0-9]{10}$/", $phone) && !preg_match("/^[0-9]{11}$/", $phone)){
            $error = "Invalid phone format";
            return redirect()->Route('back2updateprofile',array($id,$error))->with('phone','Invalid phone format 10-11 number');
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$birth)){
            $error = "Invalid date format";
            return redirect()->Route('back2updateprofile',array($id,$error))->with('phone','Invalid birth format yyyy-mm-dd');
        }elseif($gender != 1 && $gender != 2){
            $error = "Gener is Male or FeMale";
            return redirect()->Route('back2updateprofile',array($id,$error))->with('gender','Gener is Male or FeMale');
        }
        return $next($request); 
    }
}
