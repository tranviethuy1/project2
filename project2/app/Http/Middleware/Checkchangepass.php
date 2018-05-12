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
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'Password is empty'))->with('pass','Password is empty');
        }
        elseif(empty($newpass)){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'New Password is empty'))->with('new','New Password is empty');
        }elseif(empty($confirmpass)){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'Corfirm Password is empty'))->with('confirm','Corfirm Password is empty');
        }elseif(!password_verify($pass,$user->password)){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'Your password is incorrect'))->with('pass','Your password is incorrect');
        }elseif($newpass != $confirmpass){
            return redirect()->Route('changepassfail',array('id'=>$id ,'email'=>$email ,'alert'=>'New password and confirmpass are diffirent!'));
        }
        return $next($request);   
    }
}
