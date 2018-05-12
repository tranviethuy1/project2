@extends('layout.adminlayout')
@section('rightcontent')
	<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>
	<div class="row">
		<div class ="col-md-3"><legend class ="text-info">Update Notice</legend></div>
	</div>
	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('excuteupdatenotice',array($notice->id))}}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-1" for="t">Title:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="title" value="{{$notice->title}}" name="title">
				        	@if(session()->has('title'))
							<span class="text-danger">{!! session('title')!!}</span>
							@endif	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Title Of Notice **)</span></div>
				    </div>	
			    </div>

			    <div class="form-group">
				    <div class="row">
				    	<div class="col-md-1"></div>
				      	<label class="control-label col-md-1" for="f">Content:</label>
				      	<div class="col-md-6">          
				        	<textarea rows="4" cols="50" id="content" class="ckeditor" name="content">{{$notice->content}}</textarea>
				        	@if(session()->has('content'))
							<span class="text-danger">{!! session('content')!!}</span>
							@endif	
				      	</div>
				      	<div class="col-md-3"><span class="text-info">(** The Content Of Notice **)</span></div>
				    </div>  
			    </div>
				
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-1" for="t">File:</label>
				      	<div class="col-md-4">
				        	<input type="file" class="form-control" id="file" name="file_notice">
				        	@if(session()->has('file'))
							<span class="text-danger">{!! session('file')!!}</span>
							@endif	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** File of Notice (can NULL) **)</span></div>
				    </div>	
			    </div>

				<div class="form-group">
					<div class="row">
				    	<div class="col-md-2"></div>
				    	<div class="col-md-4">
				    		<button type="submit" onclick="return sendAlert('Make sure you enter enough information!!')" class="btn btn-success"> Update Notice <i class="fas fa-edit"></i></button>
				    		<a href="{{Route('adminnotice')}}" class="btn btn-danger">Cancel <i class="fas fa-times-circle"></i></a>
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>

@endsection	