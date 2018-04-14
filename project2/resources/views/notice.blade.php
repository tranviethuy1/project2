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
		font-style: italic;
	}
	.center{
		margin: auto;
	}
	</style>
	<div class="row"><h4 class ="text-info" style = "margin: auto;font-family:Antiqua;font-style: italic;">Notices</h4></div>
	@foreach($notices as $notice)
		<div class="row" style="margin-top:12px; "><h4 class ="text-info" style ="font-family:Antiqua ;font-size: 18px;font-style: italic; margin-left:20px;"><a href="{{Route('displaynotice',array('id_notice'=>$notice->id_notice))}}">{{$notice->title}}</a></h4></div>
		<div class ="time"><h5 class="timeupdate">{{$notice->create_at}}</h5></div>
	@endforeach
	<div class= "row">
		<ul class="pagination center">
			@if($notices->currentPage() != 1)
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$notices->url($notices->currentPage()-1) )!!}">Previous</a></li>
		    @endif

			@for($i = 1; $i <= $notices->lastPage(); $i++)
		    <li class="{!! ($notices->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$notices->url($i) )!!}">{!! $i !!}</a></li>
			@endfor
			@if($notices->currentPage() != $notices->lastPage())
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$notices->url($notices->currentPage()+1) )!!}">Next</a></li>
		    @endif
 		 </ul>
	</div>

@endsection