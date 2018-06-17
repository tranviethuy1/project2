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
                $error = "Email đã được sử dụng!! ";
                return redirect('createaccount')->with('email',$error);
            }
            if($name == $user->name){
              $error = "Tên này đã tồn tại!! ";
              return redirect('createaccount')->with('name',$error);  
            }
        }

        if(empty($name)){
            $error = "Tên không được để trống!! ";
            return redirect('createaccount')->with('name',$error);
        }elseif(empty($email)){
            $error = "Email không được để trống!! ";
            return redirect('createaccount')->with('email',$error);
        }elseif(empty($password)){
            $error = "Password không được để trống !!";
            return redirect('createaccount')->with('pass',$error);
        }elseif(empty($confirm)){
            $error = "Confirm Password không được để trống!! ";
            return redirect('createaccount')->with('confirm',$error);
        }elseif(empty($male)){
            $error = "Giới tính không được để trống!! ";
            return redirect('createaccount')->with('male',$error);
        }elseif(empty($address)){
            $error = "Địa chỉ không được để trống!! ";
            return redirect('createaccount')->with('address',$error);
        }elseif(empty($birth)){
            $error = "Ngày sinh không được để trống!! ";
            return redirect('createaccount')->with('birth',$error);
        }
        elseif(empty($phone)){
            $error = "Số điện thoại không được để trống!!";
            return redirect('createaccount')->with('phone',$error);
        }elseif($password != $confirm){
            $error = "Mật khẩu và xác nhận mật khẩu khác nhau!! ";
            return redirect('createaccount')->with('error',$error);
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Không đúng định dạng mail xyz@gmail.com";
            return redirect('createaccount')->with('email',$error);
        }elseif(!preg_match("/^[0-9]{10}$/", $phone) && !preg_match("/^[0-9]{11}$/", $phone)){
            $error = "Không đúng định dạng số điện thoại 10-11 số!! ";
            return redirect('createaccount')->with('phone',$error);
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$birth)){
            $error = "Không đúng định dạng ngày yyyy-mm-dd !! ";
            return redirect('createaccount')->with('birth',$error);
        }
        return $next($request);
    }
}
