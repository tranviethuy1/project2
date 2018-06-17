<?php

namespace App\Http\Middleware;
use Closure;
use DB;
class Checkchangepass
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
        $pass = $request->pass;
        $newpass = $request->newpass;
        $confirmpass = $request->confirmpass;
        $user = DB::table('users')->select('password','email')->where('id',$id)->first();
        $email = $user->email;
        
        if(empty($pass)){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'Password không được trống !!'))->with('pass','Password không được trống !!');
        }
        elseif(empty($newpass)){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'New Password không được trống !!'))->with('new','New Password không được trống !!');
        }elseif(empty($confirmpass)){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'Corfirm Password không được trống !!'))->with('confirm','Corfirm Password không được trống !!');
        }elseif(!password_verify($pass,$user->password)){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'Password này không đúng !!'))->with('pass','Password này không đúng !!');
        }elseif($newpass != $confirmpass){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'New password and Confirm Password khác nhau !!'));
        }
        return $next($request);   
    }
}
