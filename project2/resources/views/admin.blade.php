@extends('layout.adminlayout')
@section('rightcontent')

	<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>
	<div class="row">
		<div class ="col-md-3"><legend class ="text-info" style="font-family: Anquila;font-style:italic;">Add Project</legend></div>
	</div>
	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('addproject',array($id))}}" method="get">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-2" for="pn">Project Name:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="projectname" name="project_name">
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Nhập tên của dự án **)</span></div>
				    </div>	
			    </div>

			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-2" for="ds">Date start:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="date_start" name="date_start">
				     	</div>
				     	<div class="col-md-4"><span class="text-info">(** yyyy-mm-dd **)</span></div>
				    </div>
			    </div>

			    <div class="form-group">
				    <div class="row">
				    	<div class="col-md-1"></div>
				      	<label class="control-label col-md-2" for="de">Describe:</label>
				      	<div class="col-md-6">          
				        	<textarea rows="4" cols="50" name="describe"></textarea>
				      	</div>
				      	<div class="col-md-3"><span class="text-info">(** Describe about project **)</span></div>
				    </div>  
			    </div>
				
				<div class="form-group">
					<div class="row">
				    	<div class="col-md-3"></div>
				    	<div class="col-md-4">
				    		<button type="submit" class="btn btn-success"> Add Project</button>
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>
	<div class = "row" style="margin-top:50px; ">
		<legend class="text-info" style="font-family: Anquila;font-style:italic;" >All projects are not finished</legend>
		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>ID </th>
		        <th>Name Project</th>
		        <th>Project Manager</th>
		        <th>Date Start</th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>
		    @if(isset($projects))
			@foreach($projects as $project)
			    <tr>
			        <td>{{$project->id}}</td>
			        <td>{{$project->name_project}}</td>
			        <td>{{$project->project_manager}}</td>
			        <td>{{$project->date_start}}</td>
			        <td>
			        	<a href="{{Route('plan',array($id,$project->id))}}" class="btn btn-success">Plan</a>
			        	<a href="" class="btn btn-info">Assignment</a>
						<a href="" class="btn btn-warning">Advance</a>
						<a href="" class="btn btn-danger">Payment</a>
			        </td>
			    </tr>
			@endforeach    
		    @endif  
		    </tbody>
  		</table>
	</div>	

@endsection
