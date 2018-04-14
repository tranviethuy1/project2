<?php

namespace App\Http\Middleware;

use Closure;

class Checkadvance
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
        $id_project = $request->id_project;
        $posision = $request->posision;
        $area = $request->area;
        $day = $request->day;
        $travel_cost = $request->travel_cost;
        $postage = $request->postage;
        $postage_document = $request->postage_document;
        $others = $request->others;
        $day = $request->day;
        
        if($day == null){
            return redirect()->Route('advanceview',array($id))->with('alert','Day is emty');
        }elseif( (isset($travel_cost) && !is_numeric($travel_cost)) || (isset($day) && !is_numeric($day))|| (isset($postage) && !is_numeric($postage)) || (isset($postage_document) && !is_numeric($postage_document))|| (isset($others) && !is_numeric($others))){
            return redirect()->Route('advanceview',array($id))->with('alert','Unvalid number format');;
        }elseif ($day<0 || $day >30) {
            return redirect()->Route('advanceview',array($id))->with('alert','Day is more than 30 days');;           
        }    
        return $next($request);
    }
}
