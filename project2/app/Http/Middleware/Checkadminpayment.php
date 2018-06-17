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
            return redirect()->Route('adminpayment',array($id_project))->with('alert','Cán bộ này đã được thanh toán trước đó rồi !!');     
        }
 
        if($days == 0){
            return redirect()->Route('adminpayment',array($id_project))->with('days','Số ngày công tác tối thiểu là 1 !! ');
        }elseif(!empty($travel_cost) && !is_numeric($travel_cost)){
            return redirect()->Route('adminpayment',array($id_project))->with('travel','Travel cost không đúng định dạng số!!');
        }elseif(!empty($postage) && !is_numeric($postage)){
            return redirect()->Route('adminpayment',array($id_project))->with('postage','Postage không đúng định dạng số!!');
        }elseif(!empty($postage_document) && !is_numeric($postage_document)){
            return redirect()->Route('adminpayment',array($id_project))->with('postage_document','Postage document không đúng định dạng số !!');
        }elseif(!empty($others) && !is_numeric($others)){
            return redirect()->Route('adminpayment',array($id_project))->with('others','Others cost không đúng định dạng số !!');
        }elseif($posision == null || $area == null){
            return redirect()->Route('adminpayment',array($id_project))->with('renthouse','Chọn vùng công tác và chức vụ của cán bộ !!');
        }elseif($place == null){
            return redirect()->Route('adminpayment',array($id_project))->with('benifit','Chọn loại địa điểm công tác !!');
        }


        return $next($request);
    }
}
