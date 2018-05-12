<?php

namespace App\Http\Middleware;

use Closure;

class Checkupdatetemplates
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
        $id_template = $request->id_template;
        $title = $request->title;
        if(empty($title)){
            return redirect()->Route('updatetemplate',array($id_template))->with('title','Title is empty');
        }
        elseif(!$request->hasFile('file_template')){
            return redirect()->Route('updatetemplate',array($id_template))->with('file','File is empty');
        }elseif($request->hasFile('file_template')){
            $file = $request->file('file_template');
            if(!in_array($file->getClientOriginalExtension(),['docx','pdf','ppt','doc','docx','ppt','pptx','xls','xlsx'])){
                return redirect()->Route('updatetemplate',array($id_template))->with('file','File is unvalid format');
            }
        }
        return $next($request);
    }
}
