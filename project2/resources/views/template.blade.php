@extends('layout.master')
@section('rightcontent')

<style>
	div h4 a:hover{
		color: #7f7f7f;
	}
	.time{
		margin-left: 600px;
		margin-top:0px; 
	}
	.updatetime{
		font-family:Antiqua;
	}
	.center{
		margin: auto;
	}
	</style>
	<div class="row"><legend class ="text-info" style = "font-family:Antiqua; margin-left: 10px;">Mẫu đơn </legend></div>
	@foreach($lists as $list)
		<div class="row" style="margin-top:12px; "><h4 class ="text-info" style ="font-family:Antiqua ;font-size: 18px; margin-left:20px;"><a href="{{asset($list->linkdownload)}}">{{$list->title}} <i class="fas fa-download"></i></a></h4></div>
		<div class ="time"><h6 class="timeupdate">{{$list->create_at}}</h6></div>
	@endforeach
	<div class= "row">
		<ul class="pagination center">
			@if($lists->currentPage() != 1)
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$lists->url($lists->currentPage()-1) )!!}">Previous</a></li>
		    @endif

			@for($i = 1; $i <= $lists->lastPage(); $i++)
		    <li class="{!! ($lists->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$lists->url($i) )!!}">{!! $i !!}</a></li>
			@endfor
			@if($lists->currentPage() != $lists->lastPage())
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$lists->url($lists->currentPage()+1) )!!}">Next</a></li>
		    @endif
 		 </ul>
	</div>

@endsection