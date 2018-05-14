@extends('layout.master')
@section('rightcontent')

<div class="row"><legend class ="text-info" style = "margin-left:20px;"><?php echo $title; ?></legend></div>
	<div class="row">
		<?php echo $content; ?>	
	</div>
	
	<div class ="row">
		@if(isset($linkdownload))
		<a href="{{asset($linkdownload)}}" class ="text-info" style = "margin-left:20px; font-style: italic; font-size: 18px;">Downloads <i class="fas fa-download"></i></a> 
		@endif
	</div>
@endsection