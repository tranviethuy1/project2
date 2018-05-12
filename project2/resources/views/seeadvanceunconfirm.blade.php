@extends('layout.adminlayout')
@section('rightcontent')
	<?php
	$id = session('data')['id'];
	$name = session('data')['name'];
	?>
	<div class ="row">
		<div class ="col-md-5"><legend class ="text-info">Plan Of Project</legend></div>	
	</div>
	
	<div class="row">
		<form class="form-horizontal">
			{!! csrf_field() !!}
			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-2"></div>
			     	<label class="control-label col-md-2" for="pn">Project Name:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="projectname" value="<?php echo $project->name_project; ?>" name="project_name" disabled>
			     	</div>
			     	<div class="col-md-4"><span class="text-info">(** Tên của dự án **)</span></div>
			    </div>	
		    </div>
			
			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-2"></div>
			     	<label class="control-label col-md-2" for="ds">Date start:</label>
			      	<div class="col-md-4">
			        	<input type="text" class="form-control" id="date_start" value="<?php echo $project->date_start; ?>" name="date_start" disabled>
			     	</div>
			     	<div class="col-md-4"><span class="text-info">(** Ngày bắt đầu **)</span></div>
			    </div>
		    </div>

			<div class="form-group">
		    	<div class="row">
		    		<div class="col-md-2"></div>
			     	<label class="control-label col-md-2" for="ds">Days:</label>
			      	<div class="col-md-2">
			      		@if(!isset($plan))
			        	<input type="number" class="form-control" id="days" name="days" disabled>
						@else
						<input type="number" class="form-control" id="days" value="<?php echo $plan->days ?>" name="days" disabled>
						@endif
			     	</div>
			     	<div class="col-md-2"></div>
			     	<div class="col-md-4"><span class="text-info">(** Số ngày công tác **)</span></div>
			    </div>
		    </div>

		    <div class="form-group">
			    <div class="row">
			    	<div class="col-md-2"></div>
			      	<label class="control-label col-md-2" for="tc">Travel Cost:</label>
			      	<div class="col-md-4">
			      		@if(!isset($plan))
			        	<input type="text" class="form-control" id="travel_cost" name="travel_cost" disabled>
						@else
						<input type="text" class="form-control" id="travel_cost" value="<?php echo number_format($plan->travel_cost).' VNĐ'; ?>" name="travel_cost" disabled>
						@endif          
			      	</div>
			      	<div class="col-md-4"><span class="text-info">(** Tiền đi lại trong chuyến công tác **)</span></div>
			    </div>  
		    </div>

		    <div class="form-group">
			    <div class="row">
			    	<div class="col-md-2"></div>
			      	<label class="control-label col-md-2" for="rh">Rent House:</label>
			      	<div class="col-md-4">
			      		@if(!isset($plan))
			        	<input type="text" class="form-control" id="rent_house" name="rent_house" disabled>
						@else
						<input type="text" class="form-control" id="rent_house" value="<?php echo number_format($plan->rent_house).' VNĐ' ;  ?>" name="rent_house" disabled>
						@endif            
			      	</div>
			      	<div class="col-md-4"><span class="text-info">(** Tiền thuê nhà khi đi công tác **)</span></div>
			    </div>  
		    </div>

		    <div class="form-group">
			    <div class="row">
			    	<div class="col-md-2"></div>
			      	<label class="control-label col-md-2" for="p">Postage:</label>
			      	<div class="col-md-4">
			      		@if(!isset($plan))
			        	<input type="text" class="form-control" id="postage"  name="postage" disabled>
						@else
						<input type="text" class="form-control" id="postage" value="<?php echo number_format($plan->postage).' VNĐ'; ?>" name="postage" disabled>
						@endif            
			      	</div>
			      	<div class="col-md-4"><span class="text-info">(** Cước phí di chuyển và phương tiện **)</span></div>
			    </div>  
		    </div>

		    <div class="form-group">
			    <div class="row">
			    	<div class="col-md-2"></div>
			      	<label class="control-label col-md-2" for="pd">Postage Document:</label>
			      	<div class="col-md-4">          
			      		@if(!isset($plan))
			        	<input type="text" class="form-control" id="postage_document"  name="postage_document" disabled>
						@else
						<input type="text" class="form-control" id="postage_document" value="<?php echo number_format($plan->postage_document).' VNĐ'; ?>" name="postage_document" disabled>
						@endif 				        
			      	</div>
			      	<div class="col-md-4"><span class="text-info">(** Cước tài liệu, thiết bị, dụng cụ, đạo cụ **)</span></div>
			    </div>  
		    </div>

		    <div class="form-group">
			    <div class="row">
			    	<div class="col-md-2"></div>
			      	<label class="control-label col-md-2" for="o">Others:</label>
			      	<div class="col-md-4"> 
			      		@if(!isset($plan))
			        	<input type="text" class="form-control" id="others"  name="others" disabled>
						@else
						<input type="text" class="form-control" id="others" value="<?php echo number_format($plan->others).' VNĐ'; ?>" name="others" disabled>
						@endif 					      	         
			      	</div>
			      	<div class="col-md-4"><span class="text-info">(** Cước hành lý khi đi công tác **)</span></div>
			    </div>  
		    </div>
			
			<div class="form-group">
			    <div class="row">
			    	<div class="col-md-2"></div>
			      	<label class="control-label col-md-2" for="ot">Overtime:</label>
			      	<div class="col-md-4"> 
			      		@if(!isset($plan))
			        	<input type="text" class="form-control" id="overtime" name="overtime" disabled>
						@else
						<input type="text" class="form-control" id="overtime" value="<?php echo number_format($plan->overtime).' VNĐ'; ?>" name="overtime" disabled>
						@endif 				      	         
			      	</div>
			      	<div class="col-md-4"><span class="text-info">(** Tiền thêm giờ **)</span></div>
			    </div>  
		    </div>

		    <div class="form-group">
			    <div class="row">
			    	<div class="col-md-2"></div>
			      	<label class="control-label col-md-2" for="b">Benifit:</label>
			      	<div class="col-md-4"> 
			      		@if(!isset($plan))
			        	<input type="text" class="form-control" id="benifit"  name="benifit" disabled>
						@else
						<input type="text" class="form-control" id="benifit" value="<?php echo number_format($plan->benifit).' VNĐ'; ?>" name="benifit" disabled>
						@endif 				      	         
			      	</div>
			      	<div class="col-md-4"><span class="text-info">(** Tiền phúc lợi **)</span></div>
		   		 </div>  
	   		 </div>
			
			<hr>

			<div class="form-group">
			    <div class="row">
			    	<div class="col-md-2"></div>
			      	<label class="control-label col-md-2" for="t">Total:</label>
			      	<div class="col-md-4"> 
			      		@if(!isset($plan))
			        	<input type="text" class="form-control" id="benifit"  name="total" disabled>
						@else
						<input type="text" class="form-control" id="benifit" value="<?php echo number_format($plan->travel_cost+$plan->rent_house+$plan->postage+$plan->postage_document+$plan->others+$plan->overtime+$plan->benifit).' VNĐ'; ?>" name="benifit" disabled>
						@endif 				      	         
			      	</div>
			      	<div class="col-md-4"><span class="text-info">(** Tổng số tiền  **)</span></div>
		   		 </div>  
	   		 </div>

   		</form> 		 
	</div>

	<div class ="row">
		<div class ="col-md-5"><legend class ="text-info">All Employee of project</legend></div>	
	</div>

	<div class="row" style="margin-left: 0px;">
		<div class="col-md-12">
		<form class="form-horizontal">
			{!! csrf_field() !!}
			<div class="form-group">
		    	<div class="row">
			    	<div class="col-md-1"></div>
			     	<label class="control-label col-md-2" for="employee">Employee:</label>
			      	<div class="col-md-3">
			      	@if(isset($name_employee))
						@foreach($name_employee as $value)
						<input type="text" class="form-control" id="employee" value="{{$value}}" name="employee" disabled>
						<br>
						@endforeach
					@else
						<input type="text" class="form-control" id="employee" value="" name="employee" disabled>
			      	@endif          
			      	</div>
			      	<div class="col-md-4"><span class="text-info"></span></div>
			    </div>  	
		    </div>
		</form>
		</div>
	</div>	

	<div class ="row">
		<div class ="col-md-5"><legend class ="text-info">All loan of project</legend></div>	
	</div>

	<div class ="row">	
		<table class="table table-bordered table-striped">
		    <thead>
		      <tr>
		        <th>Name</th>
		        <th>Date advance</th>
		        <th>Traveling</th>
		        <th>Rent house</th>
				<th>Postage</th>
				<th>Document</th>
				<th>Others</th>	
		      </tr>
		    </thead>
		    <tbody>
		    <?php $all = 0 ;?>
		    @if(isset($advances))	
			    @foreach($advances as $advance )
			      <tr>
			      	<?php $all+=$advance->travel_cost+$advance->rent_house+$advance->postage+$advance->postage_document+$advance->others; ?>
			        <td><?php $employee = \App\User::where('id',$advance->id_employee)->first(); echo $employee->name; ?></td>
			        <td>{{$advance->advance_date}}</td>
			        <td>{{number_format($advance->travel_cost)}}</td>
			        <td>{{number_format($advance->rent_house)}}</td>
			        <td>{{number_format($advance->postage)}}</td>
			        <td>{{number_format($advance->postage_document)}}</td>
			        <td>{{number_format($advance->others)}}</td>
			      </tr>
			    @endforeach
			@endif      
		    </tbody>
  		</table>
	</div>	

	<div class ="row">
		<div class ="col-md-6"></div>
		<div class ="col-md-3"><p class ="text-info" style="font-size: 20px;text-align: right;">All of Advances:</p></div>	
		<div class ="col-md-3"><p class ="text-info" style="font-size: 20px;">{{number_format($all)." VNĐ "}}</p></div>
	</div>

	<div class="row">
		<div class ="col-md-7"></div>
		<div class ="col-md-5">
			<a href="{{Route('acceptadvance',array($project->id))}}" onclick="return AcceptMesenger('Do you want to accept advances?')" class="btn btn-danger" style="width: 150px;">Accept <i class="fas fa-thumbs-up"></i></a>
			<button type="button" class="btn btn-warning" style="width: 150px;" data-toggle="modal" data-target="#myModal" >Send message <i class="fas fa-comments"></i></button>	
		</div>
	</div>

	<hr>

	<div class="container">	
		<div class ="row">
			<div class="col-md-6">
				<div class="card text-center">
					  <div class="card-header">
					      <span style="font-family: 'Gamja Flower', cursive;font-size: 25px;font-weight: 500">Messages</span>
					  </div>
					  <div class="card-body">
					  	@if($data_messages!=null)
	                        @foreach($data_messages as $data_message)
							    <div class="response-customer" style="border-bottom: 1px solid #dcc0c0;text-align: left!important;">
										<?php $admin = $data_message['admin']; $employee = $data_message['employee']; ?>
										@foreach($data_message['message'] as $message)
										 <div>
											<span style="background-color: #3275ca;color: #ffffff">Admin:</span>
										    <span class="name_comment" style="font-weight: 700">
										     	{!! $admin !!}
										    </span>
										 </div>

										 <div>
											<span style="background-color: #3275ca;color: #ffffff">Employee:</span>
										    <span class="name_comment" style="font-weight: 700">
										     	{!! $employee !!}
										    </span>
										 </div>

										 <div class="content_commnet" style="margin-left: 24px;">
									        {!! $message->reason !!}
									     </div>
									     <div class="time_comment" style="font-style: italic;font-size: 12px;float: right;">
									     	{!!  $message->create_at !!}
									     </div>
									     <div class="button_refuses">
									     	<button class="btn btn-info fix_mes" value="{{$message->id}}">Fix message</button>
									     	<a class="btn btn-danger" href="{{Route('deleterefuse',array($project->id,$message->id))}}">Delete</a>
									     </div>
									     <hr>
									     <br>
									     @endforeach
								    </div>
								    <br>
							@endforeach
					    @endif
					   </div>
					    <div class="card-footer text-muted" style="font-family: 'Gamja Flower', cursive;font-size: 25px;font-weight: 500">
					     All must be the most accurate.
					    </div>
				</div>	
			</div>
			<div class="col-md-6" id="fix_comment" >
				<form method="post" action="{{Route('updatemessagerefuse',array($project->id))}}" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form--response" style="font-size: 30px;">
						Fix message
					</div>
		  				
	  				<div class="form-group">
	    				<label for="exampleFormControlTextarea1" class="contact--us__title">
						<i class="fas fa-hand-pointer"></i> 
	    				 Select message</label>
	    				<select class="form-control" id="id_refuse" value="1" name="id_refuse"><option id="selectmessage"></option>}
	    				option</select>
	  				</div>	
		  				
	  				<div class="form-group">
	    				<label for="exampleFormControlTextarea1" class="contact--us__title">
						<i class="fas fa-terminal"></i>
	    				Content of your response</label>
	    				<textarea class="ckeditor" id="exampleFormControlTextarea1" rows="3" name="content_refuse"></textarea>
	  				</div>
					<div class="btn--submit">
						<input type="submit" name="Send" value="Send response"  class="btn btn-primary" />
					</div>
				</form>
			</div>	
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$("#fix_comment").hide();

		    $(".fix_mes").click(function(){
			    $value = $(this).val();
			    $.ajax({
					type: 'get',
					url: "{{url('setidrefuse')}}",
					data: {'id_refuse': $value}, 
					success:function(data){
						$('#selectmessage').html(data);
					}
				});

		        $("#fix_comment").show();
		    });
		});
	</script>


	<script> 
		function AcceptMesenger(msg){
			if(window.confirm(msg)){
				return true;
			}
			return false;
		};

		$(document).ready(function(){	
			$('#number').on('change',function(){
			$value = $(this).val();
				$.ajax({
					type: 'get',
					url: "{{url('setrefuse',array($project->id))}}",
					data: {'number_employee': $value}, 
					success:function(data){
						$('#show').html(data);
					}
				});
			});
		});
	</script>

	  <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog modal-lg">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	        	<form class="form-horizontal" action="{{route('refuseadvance',array($project->id))}}" method="post" accept-charset="utf-8">
	        		{{ csrf_field() }}
	        		<div class="form-group">
				    	<div class="row">
					     	<label class="control-label col-md-4" for="ds">Select the number of employee:</label>
					      	<div class="col-md-2">
					        	<input type="number" class="form-control" value="0" min="0" max="5" name="number_employee" id="number" >
					        	<br>
					     	</div>
					    </div>
				    </div>

					<div class="form-group">
				    	<div class="row">
					    	<div class="control-labe col-md-2">Employees:</div>
					      	<div class="col-md-4" id="show">

					     	</div>
					    </div>
				    </div>

		        	<div>
				        <p>Comment the reason why refuse</p>
				        <textarea name="reason" class="ckeditor" id="reason" rows="4" cols="50"></textarea>
				    </div>
				    <div style="margin-top: 20px;">
		         		 <button type="submit" class="btn btn-success" style="margin-left: 670px; ">Comment</button>
		         	</div>	
	         	</form> 
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	      
	    </div>
	  </div>		

@endsection