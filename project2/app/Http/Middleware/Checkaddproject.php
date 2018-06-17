<?php

namespace App\Http\Middleware;

use Closure;

class Checkaddproject
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

        if(empty($project_name)){
            return redirect('admin')->with('name','Tên chuyến công tác không được trống !!');
        }elseif(empty($date_start)){
            return redirect('admin')->with('date','Ngày thêm chuyến công tác không được  trống !! ');
        }elseif(empty($describe)){
            return redirect('admin')->with('describe','Mô tả chuyến công tác không được trống !!');
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$date_start)){
            return redirect('admin')->with('date','Không đúng định dạng ngày yyyy-mm-dd');
        }
        return $next($request);
    }
}
