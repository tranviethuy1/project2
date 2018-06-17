@extends('layout.master')
@section('rightcontent')

<div class="row"><legend class ="text-info" style = "margin-left:20px;"><?php echo $title; ?></legend></div>
	<div class="row" style="margin-left:10px;">
		<?php echo $content; ?>	
	</div>
	
	<div class ="row">
		@if(isset($linkdownload))
		<span class="text-info" style="margin-left: 20px;font-size: 18px;">Chi tiết: </span><a href="{{asset($linkdownload)}}" class ="text-info" style = "margin-left:20px;font-size: 18px;">Downloads <i class="fas fa-download"></i></a> 
		@endif
	</div>
@endsection