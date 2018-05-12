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
            return redirect('admin')->with('name','Name project is empty');
        }elseif(empty($date_start)){
            return redirect('admin')->with('date','Date start is empty');
        }elseif(empty($describe)){
            return redirect('admin')->with('describe','Describe start is empty');
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$date_start)){
            return redirect('admin')->with('date','Unvalid Date format yyyy-mm-dd');
        }
        return $next($request);
    }
}
