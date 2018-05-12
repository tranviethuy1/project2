@extends('layout.master')
@section('rightcontent')

		<div class="row">
			<div class="col-md-12 ">
			<form class="form-horizontal">
				<div class = "row"><legend class ="text-info" style="margin-left:10px;">Project Information</legend></div>
				
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-2"></div>		
				      	<label class="control-label col-md-2" for="pn">Project Name:</label>
				      	<div class="col-md-4">
				        <input type="text" class="form-control" id="projectname" value="<?php if(isset($project)){echo $project['name_project'];} ?>" name="project_name" disabled>
				      	</div>
				    </div>  
			    </div>

			    <div class="form-group">
			    	<div class="row">
			    		<div class="col-md-2"></div>
				      	<label class="control-label col-md-2" for="pm">Project Manager:</label>
				      	<div class="col-md-4">          
				        <input type="text" class="form-control" id="projectmanager" value="<?php if(isset($project)){echo $project['project_manager'];} ?>" name="" disabled>
				      	</div>
				  	</div>
			    </div>

			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-2"></div>
				     	<label class="control-label col-md-2" for="employee">Employee:</label>
				      	<div class="col-md-4">
				      	@if(isset($name_employee))
							@foreach($name_employee as $value)
							<input type="text" class="form-control" id="employee" value="{{$value}}" name="employee" disabled>
							<br>
							@endforeach
							@else
							<input type="text" class="form-control" id="employee" value="" name="employee" disabled>
				      	@endif          
				      	</div>
				    </div>  	
			    </div>

			    <div class="form-group">
			    	<div class="row">
			    		<div class="col-md-2"></div>
				      	<label class="control-label col-md-2" for="pm">Date Start:</label>
				      	<div class="col-md-4">          
				        <input type="text" class="form-control" id="dt" value="<?php if(isset($project)){echo $project['date_start'];} ?>" name="date_start" disabled>
				      	</div>
			      	</div>
			    </div>
		    </form>    				
			</div> 
		</div>	

		<div class = "row">
			<div class="col-md-12 ">
			<legend class ="text-info">Describe</legend>
			@if(isset($project))<p style="margin-left:20px;"><?php echo $project['describe']; ?></p>@endif
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 ">
			<form class="form-horizontal">
				<legend class ="text-info">Plan</legend>
				<p class="text-dark">This is plan of project. Employee sees and make a reasonable loan: </p>
				<div class="form-group">
					<div class="row">	
						<div class="col-md-2"></div>
				      	<label class="control-label col-md-2" for="pn">Travel cost:</label>
				      	<div class="col-md-4">
				        <input type="text" class="form-control" id="travel_cost" value="<?php if(isset($plan)){echo number_format($plan['travel_cost']).' VNĐ';} ?>" name="travel_cost" disabled>
				      	</div>
			  		</div>
			    </div>

				<div class="form-group">
					<div class="row">	
						<div class="col-md-2"></div>
				      	<label class="control-label col-md-2" for="pn">Rent House:</label>
				      	<div class="col-md-4">
				        <input type="text" class="form-control" id="rent_house" value="<?php if(isset($plan)){echo number_format($plan['rent_house']).' VNĐ';} ?>" name="rent_house" disabled>
				      	</div>
				    </div>  
			    </div>

			    <div class="form-group">
			    	<div class="row">	
						<div class="col-md-2"></div>
				      	<label class="control-label col-md-2" for="pn">Postage:</label>
				      	<div class="col-md-4">
				        <input type="text" class="form-control" id="postage" value="<?php if(isset($plan)){echo number_format($plan['postage']).' VNĐ';} ?>" name="postage" disabled>
				      	</div>
				    </div>	
			    </div>

			    <div class="form-group">
			    	<div class="row">	
						<div class="col-md-2"></div>
			      		<label class="control-label col-md-2" for="pn">Postage Document:</label>
			     		<div class="col-md-4">
			        	<input type="text" class="form-control" id="postage_document" value="<?php if(isset($plan)){echo number_format($plan['postage_document']).' VNĐ';} ?>" name="postage_document" disabled>
			      		</div>
			  		</div>
			    </div>

			    <div class="form-group">
			    	<div class="row">	
						<div class="col-md-2"></div>				    	
			     		<label class="control-label col-md-2" for="pn">Others:</label>
			      		<div class="col-md-4">
			        	<input type="text" class="form-control" id="others" value="<?php if(isset($plan)){echo number_format($plan['others']).' VNĐ';} ?>" name="others" disabled>
			      		</div>
			      	</div>	
			    </div>

			    <div class="form-group">
			    	<div class="row">
						<div class="col-md-2"></div>	
			      		<label class="control-label col-md-2" for="pn">Over Time:</label>
			      		<div class="col-md-4">
			       		<input type="text" class="form-control" id="overtime" value="<?php if(isset($plan)){echo number_format($plan['overtime']).' VNĐ';} ?>" name="overtime" disabled>
			      		</div>
			      	</div>	
			    </div>

			    <div class="form-group">
			    	<div class="row">
						<div class="col-md-2"></div>				    	
			      		<label class="control-label col-md-2" for="pn">Benifit:</label>
			      		<div class="col-md-4">
			        	<input type="text" class="form-control" id="benifit" value="<?php if(isset($plan)){echo number_format($plan['benifit']).' VNĐ';} ?>" name="benifit" disabled>
			     		</div>
			     	</div>	
			    </div>

			   	<div class="form-group">
			   		<div class="row">
						<div class="col-md-2"></div>
			      		<label class="control-label col-md-2" for="pn">Day:</label>
			     		<div class="col-md-4">
			        	<input type="text" class="form-control" id="days" value="<?php if(isset($plan)){echo $plan['days'].' days';} ?>" name="days" disabled>
			      		</div>
			      	</div>	
			    </div>

			    <div class="form-group">
			   		<div class="row">
						<div class="col-md-2"></div>
			      		<label class="control-label col-md-2" for="t">Total:</label>
			     		<div class="col-md-4">
			        	<input type="text" class="form-control" id="days" value="<?php if(isset($plan)){echo number_format($plan['travel_cost']+$plan['rent_house']+$plan['postage']+$plan['postage_document']+$plan['others']+$plan['overtime']+$plan['benifit']).' VNĐ';} ?>" name="total" disabled>
			      		</div>
			      	</div>	
			    </div>

			</form>
			</div>
		</div>	
@endsection