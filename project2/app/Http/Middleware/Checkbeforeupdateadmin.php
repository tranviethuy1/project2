<?php

namespace App\Http\Middleware;

use Closure;

class Checkbeforeupdateadmin
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

        if(empty($name) || empty($email) || empty($gender) || empty($address) || empty($birth) || empty($phone)){
            $error = "It is not enough data";
            return  redirect()->Route('back2updateadmin',array($id,$error));
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
            return redirect()->Route('back2updateadmin',array($id,$error));
        }elseif(!preg_match("/^[0-9]{10}$/", $phone) && !preg_match("/^[0-9]{11}$/", $phone)){
            $error = "Invalid phone format";
            return redirect()->Route('back2updateadmin',array($id,$error));
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$birth)){
            $error = "Invalid date format";
            return redirect()->Route('back2updateadmin',array($id,$error));
        }elseif($gender != "Male" && $gender != "FeMale"){
            $error = "Gener is Male or FeMale";
            return redirect()->Route('back2updateadmin',array($id,$error));
        }
        return $next($request); 
    }
}
