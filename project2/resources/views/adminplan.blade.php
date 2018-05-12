@extends('layout.adminlayout')
@section('rightcontent')
	<div class="row">
		<div class ="col-md-5"><legend class ="text-info" >Add plan for project</legend></div>
	</div>
	
	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('excuteaddplan',array($id,$project->id))}}" method="post">
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
				      		@if(!isset($plan))
				        	<input type="number" class="form-control" id="days" value="1" name="days">
							@else
							<input type="number" class="form-control" id="days" value="<?php echo $plan->days ?>" name="days" disabled>
							@endif

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
				      	<label class="control-label col-md-2" for="tc">Travel Cost:</label>
				      	<div class="col-md-4">
				      		@if(!isset($plan))
				        	<input type="text" class="form-control" id="travel_cost" placeholder=" Enter money for travelling" name="travel_cost">
							@else
							<input type="text" class="form-control" id="travel_cost" value="<?php echo number_format($plan->travel_cost).' VNĐ'; ?>" name="travel_cost" disabled>
							@endif

							@if(session()->has('travel_cost'))
							<span class="text-danger">{!! session('travel_cost')!!}</span>
							@endif          
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Tiền đi lại trong chuyến công tác **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="rh">Rent House:</label>
				      	<div class="col-md-4">
				      		@if(!isset($plan))
				        	<input type="text" class="form-control" id="rent_house" placeholder="Enter money for rent" name="rent_house">
							@else
							<input type="text" class="form-control" id="rent_house" value="<?php echo number_format($plan->rent_house).' VNĐ' ;  ?>" name="rent_house" disabled>
							@endif  
							@if(session()->has('rent_house'))
							<span class="text-danger">{!! session('rent_house')!!}</span>
							@endif  							          
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Tiền thuê nhà khi đi công tác **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="p">Postage:</label>
				      	<div class="col-md-4">
				      		@if(!isset($plan))
				        	<input type="text" class="form-control" id="postage" placeholder="Enter money for postage" name="postage">
							@else
							<input type="text" class="form-control" id="postage" value="<?php echo number_format($plan->postage).' VNĐ'; ?>" name="postage" disabled>
							@endif
							@if(session()->has('postage'))
							<span class="text-danger">{!! session('postage')!!}</span>
							@endif  							            
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Cước phí di chuyển và phương tiện **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="pd">Postage Document:</label>
				      	<div class="col-md-4">          
				      		@if(!isset($plan))
				        	<input type="text" class="form-control" id="postage_document" placeholder="Enter money for postage-document" name="postage_document">
							@else
							<input type="text" class="form-control" id="postage_document" value="<?php echo number_format($plan->postage_document).' VNĐ'; ?>" name="postage_document" disabled>
							@endif 
							@if(session()->has('postage_document'))
							<span class="text-danger">{!! session('postage_document')!!}</span>
							@endif  											        
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Cước tài liệu, thiết bị, dụng cụ, đạo cụ **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="o">Others:</label>
				      	<div class="col-md-4"> 
				      		@if(!isset($plan))
				        	<input type="text" class="form-control" id="others" placeholder="Enter money for others action" name="others">
							@else
							<input type="text" class="form-control" id="others" value="<?php echo number_format($plan->others).' VNĐ'; ?>" name="others" disabled>
							@endif 
							@if(session()->has('others'))
							<span class="text-danger">{!! session('others')!!}</span>
							@endif  												      	         
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Cước hành lý khi đi công tác **)</span></div>
				    </div>  
			    </div>
				
				<div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="ot">Overtime:</label>
				      	<div class="col-md-4"> 
				      		@if(!isset($plan))
				        	<input type="text" class="form-control" id="overtime" placeholder="Enter money for overtime" name="overtime">
							@else
							<input type="text" class="form-control" id="overtime" value="<?php echo number_format($plan->overtime).' VNĐ'; ?>" name="overtime" disabled>
							@endif
							@if(session()->has('overtime'))
							<span class="text-danger">{!! session('overtime')!!}</span>
							@endif  							 				      	         
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Tiền thêm giờ **)</span></div>
				    </div>  
			    </div>

			    <div class="form-group">
				    <div class="row">
				      	<label class="control-label col-md-2" for="b">Benifit:</label>
				      	<div class="col-md-4"> 
				      		@if(!isset($plan))
				        	<input type="text" class="form-control" id="benifit" placeholder="Enter welfare money" name="benifit">
							@else
							<input type="text" class="form-control" id="benifit" value="<?php echo number_format($plan->benifit).' VNĐ'; ?>" name="benifit" disabled>
							@endif 	
							@if(session()->has('benifit'))
							<span class="text-danger">{!! session('benifit')!!}</span>
							@endif  										      	         
				      	</div>
				      	<div class="col-md-5"><span class="text-info">(** Tiền phúc lợi **)</span></div>
				    </div>  
			    </div>
				
				<div class="form-group">
					<div class="row">
				    	<div class="col-md-2"></div>
				    	<div class="col-md-4">
				    		@if(!isset($plan))
				    		<button type="submit" class="btn btn-success"> Add Plan</button>
				    		<a href="{{Route('admin')}}" class="btn btn-primary"> Back to Home</a>
				    		@else
							<a href="{{Route('updateplan',array($id,$project->id))}}" class="btn btn-success"> Fix Plan</a>
							<a href="{{Route('admin')}}" class="btn btn-primary"> Back to Home</a>
				    		@endif
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>

@endsection