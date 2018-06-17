<?php

namespace App\Http\Middleware;

use Closure;

class Checkplanupdate
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
        $id_employee = $request->id;
        $id_project =$request->id_project;
        $days = $request->days;
        $travel_cost = $request->travel_cost;
        $rent_house = $request->rent_house;
        $postage = $request->postage;
        $postage_document = $request->postage_document;
        $others = $request->others; 
        $overtime = $request->overtime;
        $benifit = $request->benifit;

        if($days <= 0 ){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('day','Số ngày công tác không được nhỏ hơn 0 !!');
        }elseif( isset($travel_cost) && !is_numeric($travel_cost)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('travel_cost','Travel cost  không đúng định dạng số !!');
        }elseif( isset($rent_house) && !is_numeric($rent_house)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('rent_house','Rent house  không đúng định dạng số !!');
        }elseif( isset($postage) && !is_numeric($postage)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('postage','Postage  không đúng định dạng số !!');
        }elseif( isset($postage_document) && !is_numeric($postage_document)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('postage_document','Postage document  không đúng định dạng số !!');
        }elseif( isset($others) && !is_numeric($others)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('others','Others  không đúng định dạng số !!');
        }elseif( isset($overtime) && !is_numeric($overtime)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('overtime','Overtime  không đúng định dạng số !!');
        }elseif( isset($benifit) && !is_numeric($benifit)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('benifit','Benifit  không đúng định dạng số !!');
        }
        return $next($request);
    }
}
