<?php

namespace App\Http\Middleware;

use Closure;

class Checkaddtemplates
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
       $title = $request->title; 
        if(empty($title)){
            return redirect('admintemplate')->with('title','Tiêu đề không được trống !!');
        }
        elseif(!$request->hasFile('file_template')){
            return redirect('admintemplate')->with('file','File không được trống !!');
        }elseif($request->hasFile('file_template')){
            $file = $request->file('file_template');
            if(!in_array($file->getClientOriginalExtension(),['docx','pdf','ppt','doc','docx','ppt','pptx','xls','xlsx'])){
                return redirect('admintemplate')->with('file','Không đúng định dạng file !!');
            }
        }
        return $next($request);
    }
}
