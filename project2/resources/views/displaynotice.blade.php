@extends('layout.master')
@section('rightcontent')
<!-- <?php var_dump($content);
?> -->
<div class="row"><h4 class ="text-info" style = "margin: auto;font-family:Antiqua;font-style: italic;">{{$title}}</h4></div>
	<div class="row" style="margin-top:12px; ">
		<p style ="font-family:Antiqua ;font-size: 14px;font-style: italic; margin-left:20px;">{{$content}}</p>
	</div>
	
	<div class ="row">
		<a href="" class ="text-info" style = "margin-left:20px; font-style: italic; font-size: 18px;">Downloads</a>
	</div>
@endsection