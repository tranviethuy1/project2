@extends('layout.master')
@section('rightcontent')

<div class="row"><legend class ="text-info" style = "margin-left:20px; font-style: italic;"><?php echo $title; ?></legend></div>
	<div class="row" style="margin-top:12px; ">
		<p style="margin-left:20px;"><?php echo $content; ?></p>
	</div>
	
	<div class ="row">
		@if(isset($linkdownload))
		<a href="{{asset($linkdownload)}}" class ="text-info" style = "margin-left:20px; font-style: italic; font-size: 18px;">Downloads</a> 
		@endif
	</div>
@endsection