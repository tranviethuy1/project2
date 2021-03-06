<?php

namespace App\Http\Middleware;

use Closure;

class Checkupdatenotice
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
        $id_notice = $request->id_notice;
        $title = $request->title;
        $content = $request->content;
        if(empty($title)){
            return redirect()->Route('updatenotice',array($id_notice))->with('title','Tiêu đề không được trống !!');
        }
        if(empty($content)){
             return redirect()->Route('updatenotice',array($id_notice))->with('title','Nội dụng không được trống !!');
        }
        if($request->hasFile('file_notice')){
            $file = $request->file('file_notice');
            if(!in_array($file->getClientOriginalExtension(),['png','jpg','jpeg','doc','docx','ppt','pptx','odt','ods','pdf'])){
                 return redirect()->Route('updatenotice',array($id_notice))->with('file','File không đúng định dạng !!');
            }
        }

        return $next($request);
    }
}
