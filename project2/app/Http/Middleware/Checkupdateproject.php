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
            return redirect()->Route('updateproject',array($id_project))->with('name','Name project is empty');
        }elseif(empty($date_start)){
            return redirect()->Route('updateproject',array($id_project))->with('date','Date start is empty');
        }elseif(empty($describe)){
            return redirect()->Route('updateproject',array($id_project))->with('describe','Describe start is empty');
        }elseif(!preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",$date_start)){
            return redirect()->Route('updateproject',array($id_project))->with('date','Unvalid Date format yyyy-mm-dd');
        }        

        return $next($request);
    }
}
