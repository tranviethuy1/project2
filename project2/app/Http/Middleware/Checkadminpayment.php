<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class Checkadminpayment
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
        $id_project = $request->id_project;
        $name_employee =$request->name_employee;
        $days = $request->days;
        $travel_cost = $request->travel_cost;
        $postage = $request->postage;
        $postage_document = $request->postage_document;
        $others = $request->others;
        $posision = $request->posision;
        $area = $request->area;
        $day_overtime = $request->day_overtime;
        $place = $request->place;

        $user = DB::table('users')->where('name',$name_employee)->first();

        $result = DB::table('results')->where('id_project',$id_project)->where('id_employee_r',$user->id)->first();

        if($result != null){
            return redirect()->Route('adminpayment',array($id_project))->with('alert','Cant solved because this employee is solved before');     
        }

        if($days == 0){
            return redirect()->Route('adminpayment',array($id_project))->with('days','Day is more than one days ');
        }elseif(!empty($travel_cost) && !is_numeric($travel_cost)){
            return redirect()->Route('adminpayment',array($id_project))->with('travel','Travel cost is unvalid number format');
        }elseif(!empty($postage) && !is_numeric($postage)){
            return redirect()->Route('adminpayment',array($id_project))->with('postage','Postage is unvalid number format');
        }elseif(!empty($postage_document) && !is_numeric($postage_document)){
            return redirect()->Route('adminpayment',array($id_project))->with('postage_document','Travel cost is unvalid number format');
        }elseif(!empty($others) && !is_numeric($others)){
            return redirect()->Route('adminpayment',array($id_project))->with('others','Others cost is unvalid number format');
        }elseif($posision == null || $area == null){
            return redirect()->Route('adminpayment',array($id_project))->with('renthouse','Check the posision of employee and area of project');
        }elseif($place == null){
            return redirect()->Route('adminpayment',array($id_project))->with('benifit','Check the travel location');
        }


        return $next($request);
    }
}
