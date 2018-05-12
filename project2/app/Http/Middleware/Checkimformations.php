<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class Checkimformations
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

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm = $request->input('confirm');
        $male = $request->input('male');
        $address = $request->input('address');
        $birth = $request->input('birth');
        $phone = $request->input('phone');

        $users = DB::table('users')->get();
        $error = null;

        foreach ($users as $user) {
            if($email == $user->email){
                $error = "Email is exist";
                return redirect('createaccount')->with('email',$error);
            }
            if($name == $user->name){
              $error = "Name is exist";
              return redirect('createaccount')->with('name',$error);  
            }
        }

        if(empty($name)){
            $error = "Name is empty";
            return redirect('createaccount')->with('name',$error);
        }elseif(empty($email)){
            $error = "Email is empty";
            return redirect('createaccount')->with('email',$error);
        }elseif(empty($password)){
            $error = "Password is empty";
            return redirect('createaccount')->with('pass',$error);
        }elseif(empty($confirm)){
            $error = "Confirm Password is empty";
            return redirect('createaccount')->with('confirm',$error);
        }elseif(empty($male)){
            $error = "Male is empty";
            return redirect('createaccount')->with('male',$error);
        }elseif(empty($address)){
            $error = "Address is empty";
            return redirect('createaccount')->with('address',$error);
        }elseif(empty($birth)){
            $error = "Birth is empty";
            return redirect('createaccount')->with('birth',$error);
        }
        elseif(empty($phone)){
            $error = "Phone is empty";
            return redirect('createaccount')->with('phone',$error);
        }elseif($password != $confirm){
            $error = "Password and Confirm are different";
            return redirect('createaccount')->with('error',$error);
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format xyz@gmail.com";
            return redirect('createaccount')->with('email',$error);
        }elseif(!preg_match("/^[0-9]{10}$/", $phone) && !preg_match("/^[0-9]{11}$/", $phone)){
            $error = "Invalid phone format 10-11 numbers";
            return redirect('createaccount')->with('phone',$error);
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$birth)){
            $error = "Invalid date format yyyy-mm-dd";
            return redirect('createaccount')->with('birth',$error);
        }
        return $next($request);
    }
}
