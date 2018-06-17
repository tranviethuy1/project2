<?php

namespace App\Http\Middleware;

use Closure;
use DB;
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

        $users = DB::table('users')->get();
        $oldname = DB::table('users')->where('id',$id)->value('name');
        $oldemail = DB::table('users')->where('id',$id)->value('email');


        foreach($users as $user){
            if($name != $oldname && $name == $user->name){
                $error = "Tên này đã được sử dụng !! ";
                return  redirect()->Route('back2updateadmin',array($id,$error))->with('name','Tên này đã được sử dụng !! ');
            }
            if($email != $oldemail && $email == $user->email){
                $error = "Email này đã được sử dụng !! ";
                return  redirect()->Route('back2updateadmin',array($id,$error))->with('email','Email này đã được sử dụng !! ');
            }
        }
        if(empty($name)){
            $error = "Bạn chưa nhập đầy đủ dữ liệu !!";
            return  redirect()->Route('back2updateadmin',array($id,$error))->with('name','Tên không được để trống !!');
        }elseif(empty($email)){
            $error = "Bạn chưa nhập đầy đủ dữ liệu !!";
            return  redirect()->Route('back2updateadmin',array($id,$error))->with('email','Email không được để trống !!');
        }elseif(empty($gender)){
            $error = "Bạn chưa nhập đầy đủ dữ liệu !!";
            return  redirect()->Route('back2updateadmin',array($id,$error))->with('gender','Giới tính không được để trống !!');
        }elseif(empty($address)){
            $error = "Bạn chưa nhập đầy đủ dữ liệu !!";
            return  redirect()->Route('back2updateadmin',array($id,$error))->with('address','Địa chỉ không được để trống !!');
        }elseif(empty($phone)){
            $error = "Bạn chưa nhập đầy đủ dữ liệu !!";
            return  redirect()->Route('back2updateadmin',array($id,$error))->with('phone','Số điện thoại không được để trống !!');
        }elseif(empty($birth)){
            $error = "Bạn chưa nhập đầy đủ dữ liệu !!";
            return  redirect()->Route('back2updateadmin',array($id,$error))->with('birth','Ngày sinh không được để trống !! ');
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Không đúng định dạng email!!";
            return redirect()->Route('back2updateadmin',array($id,$error))->with('email','Không đúng định dạng email !!');
        }elseif(!preg_match("/^[0-9]{10}$/", $phone) && !preg_match("/^[0-9]{11}$/", $phone)){
            $error = "Không đúng định dạng số điện thoại !!";
            return redirect()->Route('back2updateadmin',array($id,$error))->with('phone','Không đúng định dạng số điện thoại !! 10-11 số');
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$birth)){
            $error = "Không đúng định dạng ngày !!";
            return redirect()->Route('back2updateadmin',array($id,$error))->with('phone','Không đúng định dạng ngày yyyy-mm-dd');
        }elseif($gender != 1 && $gender != 2){
            $error = "Lựa chọn Male hoặc Female !!";
            return redirect()->Route('back2updateadmin',array($id,$error))->with('gender','Lựa chọn Male hoặc Female !!');
        }
        return $next($request); 
    }
}
