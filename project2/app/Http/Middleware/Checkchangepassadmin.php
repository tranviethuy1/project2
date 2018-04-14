<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class Checkchangepassadmin
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
        
        if(empty($pass)||empty($newpass)||empty($confirmpass)){
            return redirect()->Route('changepassfailadmin',array('id'=>$id ,'email'=>$email ,'alert'=>'It is not enough data'));
        }elseif(!password_verify($pass,$user->password)){
            return redirect()->Route('changepassfailadmin',array('id'=>$id ,'email'=>$email ,'alert'=>'Your password incorrect'));
        }elseif($newpass != $confirmpass){
            return redirect()->Route('changepassfailadmin',array('id'=>$id ,'email'=>$email ,'alert'=>'New password and confirmpass are diffirent!'));
        }
        return $next($request); 
    }
}
