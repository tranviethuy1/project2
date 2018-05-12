@extends('layout.adminlayout')
@section('rightcontent')

	<div class="row">
		<div class ="col-md-5"><legend class ="text-info" >Add plan for project</legend></div>
	</div>
	
	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('excuteupdateplan',array($id,$project->id))}}" method="post">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				     	<label class="control-label col-md-2" for="pn">Project Name:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="projectname" value="<?php echo $project->name_project; ?>" name="project_name" disabled>
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Tên của dự án **)</span></div>
				    </div>	
			    </div>
				
				<div class="form-group">
			    	<div class="row">
				     	<label class="control-label col-md-2" for="ds">Date start:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="date_start" value="<?php echo $project->date_start; ?>" name="date_start" disabled>
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Ngày bắt đầu **)</span></div>
				    </div>
			    </div>

				<div class="form-group">
			    	<div class="row">
				     	<label class="control-label col-md-2" for="ds">Days:</label>
				      	<div class="col-md-2">
							<input type="number" class="form-control" id="days" value="<?php echo $updateplan->days ?>" name="days" >
							@if(session()->has('day'))
							<span class="text-danger">{!! session('day')!!}</span>
							@endif							
				     	</div>
				     	<div class="col-md-2"></div>
				     	<div class="col-md-5"><span class="text-info">(** Số ngày công tác **)</span></div>
				    </div>
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="ts">Travel Cost:</label>
				      	<div class="col-md-4">
							<input type="text" class="form-control" id="travel_cost" value="<?php echo $updateplan->travel_cost; ?>" name="travel_cost">        
							@if(session()->has('travel_cost'))
							<span class="text-danger">{!! session('travel_cost')!!}</span>
							@endif  
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Tiền đi lại trong chuyến công tác **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="ts">Rent House:</label>
				      	<div class="col-md-4">
							<input type="text" class="form-control" id="rent_house" value="<?php echo $updateplan->rent_house ;  ?>" name="rent_house" >    
							@if(session()->has('rent_house'))
							<span class="text-danger">{!! session('rent_house')!!}</span>
							@endif 
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Tiền thuê nhà khi đi công tác **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="ts">Postage:</label>
				      	<div class="col-md-4">
							<input type="text" class="form-control" id="postage" value="<?php echo $updateplan->postage; ?>" name="postage" >     
							@if(session()->has('postage'))
							<span class="text-danger">{!! session('postage')!!}</span>
							@endif  
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Cước phí di chuyển và phương tiện **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="ts">Postage Document:</label>
				      	<div class="col-md-4">          
							<input type="text" class="form-control" id="postage_document" value="<?php echo $updateplan->postage_document; ?>" name="postage_document" >		        
							@if(session()->has('postage_document'))
							<span class="text-danger">{!! session('postage_document')!!}</span>
							@endif				      	
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Cước tài liệu, thiết bị, dụng cụ, đạo cụ **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="ts">Others:</label>
				      	<div class="col-md-4"> 
							<input type="text" class="form-control" id="others" value="<?php echo $updateplan->others; ?>" name="others">				      	         
							@if(session()->has('others'))
							<span class="text-danger">{!! session('others')!!}</span>
							@endif 
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Cước hành lý khi đi công tác **)</span></div>
				    </div>  
			    </div>
				
				<div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="ts">Overtime:</label>
				      	<div class="col-md-4"> 
							<input type="text" class="form-control" id="overtime" value="<?php echo $updateplan->overtime; ?>" name="overtime" >		      	         
							@if(session()->has('overtime'))
							<span class="text-danger">{!! session('overtime')!!}</span>
							@endif 
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Tiền thêm giờ **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="ts">Benifit:</label>
				      	<div class="col-md-4"> 
							<input type="text" class="form-control" id="benifit" value="<?php echo $updateplan->benifit; ?>" name="benifit" >			      	         
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Tiền phúc lợi **)</span></div>
				    </div>  
			    </div>
				
				<div class="form-group">
					<div class="row">
				    	<div class="col-md-2"></div>
				    	<div class="col-md-4">
				    		<button type="submit" class="btn btn-success"> Update Plan</button>
				    		<a href="{{Route('admin')}}" class="btn btn-primary"> Back to Home</a>
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>

@endsection