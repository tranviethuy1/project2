@extends('layout.adminlayout')
@section('rightcontent')
	<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>

	<div class="row">
		<legend class ="text-info">Thêm chuyến công tác </legend>
	</div>
	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('addproject',array($id))}}" method="post">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-2" for="pn">Project Name*:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="projectname" name="project_name">
				        	@if(session()->has('name'))
							<span class="text-danger">{!! session('name')!!}</span>
							@endif	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Enter name of project **)</span></div>
				    </div>	
			    </div> 

			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-2" for="ds">Date start*:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="date_start" name="date_start">
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
				      	<label class="control-label col-md-2" for="de">Describe*:</label>
				      	<div class="col-md-6">          
				        	<textarea rows="4" cols="50" id="describe" class="ckeditor" name="describe"></textarea>
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
				    	<div class="col-md-5">
				    		<button type="submit" class="btn btn-success"> Add Project <i class="fas fa-plus-circle"></i></button>
				    		<span class="text-danger"> Chú ý * thông tin bắt buộc </span>
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>
	
	<div class = "row" style="margin-top:50px; ">
		<legend class="text-info">Danh sách chuyến công tác chưa kết thúc  </legend>
		<table class="table table-bordered table-striped">
		    <thead>
		      <tr>
		        <th class="text-info">ID </th>
		        <th class="text-info">Name </th>
		        <th class="text-info">Manager </th>
		        <th class="text-info">Start </th>
		        <th class="text-info">Accept </th>
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
			        	@if($project->status == 1)
							<i class="fas fa-thumbs-down"></i>
			        	@else
							<i class="fas fa-thumbs-up"></i>
			        	@endif
			       	</td>

			        <td>
			        	<a href="{{Route('updateproject',array($project->id))}}" class="btn btn-secondary">Update <i class="fas fa-edit"></i></a>
			        	<a href="{{Route('plan',array($id,$project->id))}}" class="btn btn-warning">Plan <i class="fas fa-align-justify"></i></a>
			        	<a href="{{Route('assignment',array($id,$project->id))}}" class="btn btn-info">Assign <i class="fas fa-bell"></i></a>
						<a href="{{Route('adminpayment',array($project->id))}}" class="btn btn-danger">Payment <i class="fas fa-dollar-sign"></i></a>
			        </td>
			    </tr>
			@endforeach    
		    @endif  
		    </tbody>
  		</table>
	</div>	

	@if(isset($projects))
	<div class= "row">
		<ul class="pagination" style="margin: auto;">
			@if($projects->currentPage() != 1)
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$projects->url($projects->currentPage()-1) )!!}">Previous</a></li>
		    @endif

			@for($i = 1; $i <= $projects->lastPage(); $i++)
		    <li class="{!! ($projects->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$projects->url($i) )!!}">{!! $i !!}</a></li>
			@endfor
			@if($projects->currentPage() != $projects->lastPage())
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$projects->url($projects->currentPage()+1) )!!}">Next</a></li>
		    @endif
 		 </ul>
	</div>
	@endif

@endsection
