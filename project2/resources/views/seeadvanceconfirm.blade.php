@extends('layout.adminlayout')
@section('rightcontent')
	<?php
	$id = session('data')['id'];
	$name = session('data')['name'];
	?>

	<div class ="row">
		<div class ="col-md-5"><legend class ="text-info">Project Imformation</legend></div>	
	</div>
	
	<div class="col-md-12">
		<form class="form-horizontal">
			{!! csrf_field() !!}
			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="pn">Project Name:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="projectname" value="<?php echo $project->name_project; ?>" name="project_name" disabled>
			     	</div>
			     	<div class="col-md-4"><span class="text-info">(** Tên của dự án **)</span></div>
			    </div>	
		    </div>
			
			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="ds">Date start:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="date_start" value="<?php echo $project->date_start; ?>" name="date_start" disabled>
			     	</div>
			     	<div class="col-md-4"><span class="text-info">(** Ngày bắt đầu **)</span></div>
			    </div>
		    </div>
		</form> 
	</div>	   

	<div class ="row">
		<div class ="col-md-5"><legend class ="text-info">Advances Imformation</legend></div>	
	</div>

	<div class="col-md-12">
		<form class="form-horizontal">
			{!! csrf_field() !!}
		@foreach($advances as $advance)
			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="e">Employee:</label>
			      	<div class="col-md-4">
			      		<?php $employee = \App\User::where('id',$advance->id_employee)->first(); ?>
			        	<input type="text" class="form-control" id="employee" value="<?php echo $employee->name; ?>" name="employee" disabled>
			     	</div>
			     	<div class="col-md-4"></div>
			    </div>	
		    </div>

		    <div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="date">Date Advance:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="advance_date" value="<?php echo $advance->advance_date; ?>" name="advance_date" disabled>
			     	</div>
			     	<div class="col-md-4"></div>
			    </div>	
		    </div>

		    <div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="tc">Travel Cost:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="travel_cost" value="<?php echo number_format($advance->travel_cost)." VNĐ "; ?>" name="travel_cost" disabled>
			     	</div>
			     	<div class="col-md-4"></div>
			    </div>	
		    </div>
			
			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="rh">Rent House:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="rent_house" value="<?php echo number_format($advance->rent_house)." VNĐ "; ?>" name="rent_house" disabled>
			     	</div>
			     	<div class="col-md-4"></div>
			    </div>	
		    </div>

		    <div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="p">Postage:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="postage" value="<?php echo number_format($advance->postage)." VNĐ "; ?>" name="postage" disabled>
			     	</div>
			     	<div class="col-md-4"></div>
			    </div>	
		    </div>
			
			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="pd">Postage Documnent:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="postage_document" value="<?php echo number_format($advance->postage_document)." VNĐ "; ?>" name="postage_document" disabled>
			     	</div>
			     	<div class="col-md-4"></div>
			    </div>	
		    </div>

		    <div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="date">Others:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="others" value="<?php echo number_format($advance->others)." VNĐ "; ?>" name="others" disabled>
			     	</div>
			     	<div class="col-md-4"></div>
			    </div>	
		    </div>
			
			<hr style="width:700px;margin-left: 0px;">

		    <div class="form-group">
		    	<div class="row">
		    		<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="date">Total:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="total" value="<?php echo number_format($advance->travel_cost+$advance->rent_house+$advance->postage+$advance->postage_document+$advance->others)." VNĐ "; ?>" name="total" disabled>
			     	</div>
			     	<div class="col-md-4"></div>
			    </div>	
		    </div>
			
		@endforeach    
		</form> 

		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-3"><a href="{{Route('showconfirmadvance')}}" class="btn btn-info" style="width: 150px;">Back <i class="fas fa-arrow-circle-left"></i></a></div>
		</div>

	</div>	 
@endsection
