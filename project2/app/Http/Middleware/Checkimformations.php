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
                return redirect('createaccount')->with('error',$error);
            }
        }

        if(empty($name) || empty($email) || empty($password) || empty($confirm) || empty($male) || empty($address) || empty($birth) || empty($phone)){
            $error = "It is not enough data";
            return redirect('createaccount')->with('error',$error);
        }elseif($password != $confirm){
            $error = "Password and Confirm are different";
            return redirect('createaccount')->with('error',$error);
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format";
            return redirect('createaccount')->with('error',$error);
        }elseif(!preg_match("/^[0-9]{10}$/", $phone) && !preg_match("/^[0-9]{11}$/", $phone)){
            $error = "Invalid phone format";
            return redirect('createaccount')->with('error',$error);
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$birth)){
            $error = "Invalid date format";
            return redirect('createaccount')->with('error',$error);
        }
        return $next($request);
    }
}
