<?php

namespace App\Http\Middleware;

use Closure;

class Checkupdateproject
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
        $project_name = $request->project_name;
        $date_start = $request->date_start;
        $describe = $request->describe;
        $id_project = $request->id_project;

        if(empty($project_name)){
            return redirect()->Route('updateproject',array($id_project))->with('name','Tên chuyến công tác không được trống !!');
        }elseif(empty($date_start)){
            return redirect()->Route('updateproject',array($id_project))->with('date','Ngày thêm chuyến công tác không được  trống !!');
        }elseif(empty($describe)){
            return redirect()->Route('updateproject',array($id_project))->with('describe','Mô tả chuyến công tác không được trống !!');
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$date_start)){
            return redirect()->Route('updateproject',array($id_project))->with('date','Không đúng định dạng ngày yyyy-mm-dd');
        }         

        return $next($request);
    }
}
