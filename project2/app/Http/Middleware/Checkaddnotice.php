<?php

namespace App\Http\Middleware;

use Closure;

class Checkaddnotice
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
        $content = $request->content;
        if(empty($title)){
            return redirect('adminnotice')->with('title','Tiêu đề không được trống !!');
        }
        if(empty($content)){
            return redirect('adminnotice')->with('content','Nội dung không được trống !!');
        }
        if($request->hasFile('file_notice')){
            $file = $request->file('file_notice');
            if(!in_array($file->getClientOriginalExtension(),['png','jpg','jpeg','doc','docx','ppt','pptx','odt','ods','pdf'])){
                return redirect('adminnotice')->with('file','Không đúng định dạng file !!');
            }
        }

        return $next($request);
    }
}
