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
            return redirect('adminnotice')->with('title','Title is empty');
        }
        if(empty($content)){
            return redirect('adminnotice')->with('content','Content is empty');
        }
        if($request->hasFile('file_notice')){
            $file = $request->file('file_notice');
            if(!in_array($file->getClientOriginalExtension(),['png','jpg','jpeg','doc','docx','ppt','pptx','odt','ods','pdf'])){
                return redirect('adminnotice')->with('file','File is unvalid format');
            }
        }

        return $next($request);
    }
}
