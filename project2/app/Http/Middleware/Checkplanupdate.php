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
            return redirect()->Route('plan',array($id_employee,$id_project))->with('alert','Days can not be unsigned');
        }elseif( isset($travel_cost) && !is_numeric($travel_cost)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('alert','Travel cost unvalid format');
        }elseif( isset($rent_house) && !is_numeric($rent_house)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('alert','Rent house unvalid format');
        }elseif( isset($postage) && !is_numeric($postage)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('alert','Postage unvalid format');
        }elseif( isset($postage_document) && !is_numeric($postage_document)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('alert','Postage document unvalid format');
        }elseif( isset($others) && !is_numeric($others)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('alert','Others unvalid format');
        }elseif( isset($overtime) && !is_numeric($overtime)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('alert','Overtime unvalid format');
        }elseif( isset($benifit) && !is_numeric($benifit)){
            return redirect()->Route('plan',array($id_employee,$id_project))->with('alert','Benifit unvalid format');
        }
        return $next($request);
    }
}
