<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class Checkrefuse
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
        $reason = $request->reason;
        $number_employee = $request->number_employee;
        $id_project = $request->id_project;
        
        $advances = DB::table('advances')->where('id_project',$id_project)->get();

        if(count($advances) == 0){
            return redirect()->Route('seeadvance',array($id_project))->with('alert','Cant refuse because No advance in this project');
        }   

        if(empty($reason)){
            return redirect()->Route('seeadvance',array($id_project))->with('alert','Cant refuse when reason is empty');
        }

        switch($number_employee) {
            case 0:
                    return redirect()->Route('seeadvance',array($id_project))->with('alert','Choose employee');
                break;
            case 1:
                break;
            case 2:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                if($name1 == $name2){
                    return redirect()->Route('seeadvance',array($id_project))->with('alert','Can not select the same name');
                }
                break;
            case 3:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                if($name1 == $name2 || $name2 = $name3 || $name3 = $name1){
                    return redirect()->Route('seeadvance',array($id_project))->with('alert','Can not select the same name');
                }
                break;

                case 4:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                $name4 = $request->employee_name4;
                if($name1 == $name2 || $name2 = $name3 || $name3 = $name4 || $name4 = $name1 || $name3 = $name1 || $name2 = $name4){
                    return redirect()->Route('seeadvance',array($id_project))->with('alert','Can not select the same name');
                } 
                break;                                                                                               
            case 5:
                $name1 = $request->employee_name1;
                $name2 = $request->employee_name2;
                $name3 = $request->employee_name3;
                $name4 = $request->employee_name4;
                $name5 = $request->employee_name5;
                if($name1 == $name2 || $name2 = $name3 || $name3 = $name4 || $name4 = $name1 || $name3 = $name1 || $name2 = $name4 || $name4 = $name5 || $name1 = $name5 || $name2 = $name5 || $name3 = $name5){
                    return redirect()->Route('seeadvance',array($id_project))->with('alert','Can not select the same name');
                } 
                break;     
        }
        return $next($request);
    }
}
