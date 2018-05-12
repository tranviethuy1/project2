@extends('layout.adminlayout')
@section('rightcontent')
		
	<?php
	$id = session('data')['id'];
	$name = session('data')['name'];
	?>
	<div class ="row">
		<div class ="col-md-3"><legend class ="text-info" >Add Assignment</legend></div>	
	</div>

	<div class ="row">
		<div class="col-md-12">
			<form class="form-horizontal" action="" method="">
			{!! csrf_field() !!}
			 <div class="form-group">
		    	<div class="row">
			    	<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="pn">Project Name:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" value="{{$project->name_project}}" id="projectname" disabled>
			        	<br>
			     	</div>
			    </div>	
		    </div>

		    <div class="form-group">
		    	<div class="row">
			    	<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="ds">Date start:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" value="{{$project->date_start}}" id="date_start" disabled>
			        	<br>
			     	</div>
			    </div>
		    </div>
			</form>	
		</div>	
	</div>

@if(isset($employees))
	<div class="form-group">
    	<div class="row">
	    	<div class="col-md-1"></div>
	     	<label class="control-label col-md-2" for="e">Employee:</label>
	      	<div class="col-md-4">
	      		@foreach($employees as $employee)
	        	<input type="text" class="form-control" value="{{$employee}}" disabled>
	        	<br>
	        	@endforeach
	     	</div>
	    </div>
    </div>

	<div class="row">
    	<div class="col-md-3"></div>
    	<div class="col-md-9">
    		<a href="{{Route('updateAssignment',array($project->id))}}" class="btn btn-success"> Fix Assignment</a>
    		<a href="{{Route('admin')}}" class="btn btn-primary"> Back to Home</a>
    	</div>
    </div>
@else
	
	<!-- search live -->
	<script type="text/javascript">
	$(document).ready(function(){	
		$('#number').on('change',function(){
		$value = $(this).val();
			$.ajax({
				type: 'get',
				url: "{{url('setassignment',array($project->date_start))}}",
				data: {'number_employee': $value},
				success:function(data){
					$('#show').html(data);
				}
			});
		});
	});
	</script>
	
		<form class="form-horizontal" action="{{Route('excuteassignment',array($id,$project->id))}}" method="get">
			<div class="form-group">
		    	<div class="row">
			    	<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="ds">Select the number of employee:</label>
			      	<div class="col-md-2">
			        	<input type="number" class="form-control" value="0" min="0" max="5" name="number_employee" id="number" >
			        	<br>
			     	</div>
			    </div>
		    </div>

			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			    	<div class="control-labe col-md-2">Name of employees</div>
			      	<div class="col-md-4" id="show">

			     	</div>
			    </div>
		    </div>

		    <div class="row">
		    	<div class="col-md-3"></div>
		    	<div class="col-md-9">
		    		<button type ="submit" class="btn btn-success"> Assignment</button>
		    		<a href="{{Route('admin')}}" class="btn btn-primary"> Cancel</a>
		    	</div>
		    </div>

		</form>

@endif
@endsection

