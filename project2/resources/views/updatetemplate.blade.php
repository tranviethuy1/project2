@extends('layout.adminlayout')
@section('rightcontent')
	<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>
	<script type="text/javascript">
		function sendAlert(msg){
			if(window.confirm(msg)){
				return true;
			}
			return false;
		};
	</script>
	<div class="row">
		<div class ="col-md-3"><legend class ="text-info">Update Template</legend></div>
	</div>

	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('excuteupdatetemplate',array($template->id))}}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-1" for="t">Title:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="title" value = "{{$template->title}}" name="title">
				        	@if(session()->has('title'))
							<span class="text-danger">{!! session('title')!!}</span>
							@endif				        	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Title Of template **)</span></div>
				    </div>	
			    </div>
				
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-1" for="t">File:</label>
				      	<div class="col-md-4">
				        	<input type="file" class="form-control" id="file" name="file_template">
				        	@if(session()->has('file'))
							<span class="text-danger">{!! session('file')!!}</span>
							@endif				        	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** File of template **)</span></div>
				    </div>	
			    </div>

				<div class="form-group">
					<div class="row">
				    	<div class="col-md-2"></div>
				    	<div class="col-md-4">
				    		<button type="submit" class="btn btn-success" onclick="return sendAlert('Make sure Your file is .doc .docx .pdf .ppt .pptx .xls or .xlsx!!')"> Update template <i class="fas fa-download"></i></i></button>
				    		<a href="{{Route('admintemplate')}}" class="btn btn-danger" > Cancel<i class="fas fa-times-circle"></i></a>
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>

@endsection	