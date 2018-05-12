@extends('layout.adminlayout')
@section('rightcontent')
		<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>
	<div class="row">
		<div class ="col-md-3"><legend class ="text-info" style="font-family: Anquila;font-style:italic;">Update Project</legend></div>
	</div>
	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('excuteupdateproject',array($id,$project->id))}}" method="post">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-2" for="pn">Project Name:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="projectname" name="project_name" value="{{$project->name_project}}">
							@if(session()->has('name'))
							<span class="text-danger">{!! session('name')!!}</span>
							@endif  												      	         
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Nhập tên của dự án **)</span></div>
				    </div>	
			    </div>

			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-2" for="ds">Date start:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="date_start" name="date_start" value="{{$project->date_start}}">
							@if(session()->has('date'))
							<span class="text-danger">{!! session('date')!!}</span>
							@endif  												      	         
				     	</div>
				     	<div class="col-md-4"><span class="text-info">(** yyyy-mm-dd **)</span></div>
				    </div>
			    </div>

			    <div class="form-group">
				    <div class="row">
				    	<div class="col-md-1"></div>
				      	<label class="control-label col-md-2" for="de">Describe:</label>
				      	<div class="col-md-6">          
				        	<textarea rows="4" id = "describe" class="ckeditor" cols="50" name="describe">{{$project->describe}}</textarea>
							@if(session()->has('describe'))
							<span class="text-danger">{!! session('describe')!!}</span>
							@endif  												      	         
				      	</div>
				      	<div class="col-md-3"><span class="text-info">(** Describe about project **)</span></div>
				    </div>  
			    </div>
				
				<div class="form-group">
					<div class="row">
				    	<div class="col-md-3"></div>
				    	<div class="col-md-4">
				    		<button type="submit" class="btn btn-success"> Update Project</button>
				    		<a href="{{Route('admin')}}" class="btn btn-primary"> Back To Home</a>
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>
@endsection