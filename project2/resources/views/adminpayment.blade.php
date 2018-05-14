@extends('layout.adminlayout')
@section('rightcontent')	
	<?php
	$id = session('data')['id'];
	$name = session('data')['name'];
	?>
	<style >
		.radio{
			margin-left: 10px;
			margin-top:5px; 
			padding: 0px;
		}
	</style>
	<div class ="row">
		<div class ="col-md-5"><legend class ="text-info"> Imformation and plan of project</legend></div>	
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

   		</form> 		 
	</div>

	<div class ="row">
		<div class ="col-md-8"><legend class ="text-info">All Employee of project and advances of employee</legend></div>	
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
			      	@if(isset($employees))
						@foreach($employees as $value)
						<input type="text" class="form-control" id="employee" value="{{$value}}" name="employee" disabled>
						<br>
						@endforeach
			      	@endif          
			      	</div>
			      	<div class="col-md-4"><span class="text-info"></span></div>
			    </div>  	
		    </div>
		</form>
		</div>
	</div>	

	<div class ="row">	
		<table class="table table-bordered table-striped">
		    <thead>
		      <tr>
		        <th>Name</th>
		        <th>Date advance</th>
		        <th>Cost travel</th>
		        <th>Rent house</th>
				<th>Postage</th>
				<th>Document</th>
				<th>Others</th>	
				<th>Total</th>
				<th></th>	
		      </tr>
		    </thead>
		    <tbody>
		    @if(isset($advances))	
			    @foreach($advances as $advance )
			    <?php $all = 0 ;?>
			      <tr>
			      	<?php $all+=$advance->travel_cost+$advance->rent_house+$advance->postage+$advance->postage_document+$advance->others; ?>
			        <td><?php $employee = \App\User::where('id',$advance->id_employee)->first(); echo $employee->name; ?></td>
			        <td>{{$advance->advance_date}}</td>
			        <td>{{number_format($advance->travel_cost)}}</td>
			        <td>{{number_format($advance->rent_house)}}</td>
			        <td>{{number_format($advance->postage)}}</td>
			        <td>{{number_format($advance->postage_document)}}</td>
			        <td>{{number_format($advance->others)}}</td>
			        <td>{{number_format($all).'VNĐ'}}</td>
			        <td><a href="{{Route('printadvance',array($advance->id))}}" onclick="return Mesenger('Do you want to print advance ?')" id="print" class="btn btn-info">Print <i class="fas fa-print"></i></a></td>
			      </tr>
			    @endforeach
			@endif      
		    </tbody>
  		</table>
	</div>	


	<div class ="row">
		<div class ="col-md-8"><legend class ="text-info">Forms of payment</legend></div>	
	</div>

	<div class="row" style="margin-top: 20px;">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('excutepayment',array($project->id))}}" method="post">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				     	<label class="control-label col-md-1" for="pn">Employee* </label>
				      	<div class="col-md-4">
				        	<select name="name_employee" class="form-control" id="name_employee" value="1">
				        		@foreach($employees as $employee)
				        		<option>{{$employee}}</option>
				        		@endforeach
				        	</select>
				     	</div>
				     	<label class="control-label col-md-1" for="pn">Days* </label>
						<div class="col-md-4">
							<input name="days" id="days" class="form-control" type="number" value="0" min="0" max="30">
							@if(session()->has('days'))
							<span class="text-danger">{!! session('days')!!}</span>
							@endif	
						</div>
				    </div>	
			    </div>

			    <div class="form-group">
			    	<div class="row">
				     	<label class="control-label col-md-1" for="travel_cost">Travel cost </label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="travel_cost" placeholder="Money for travelling" name="travel_cost">
				        	@if(session()->has('travel'))
							<span class="text-danger">{!! session('travel')!!}</span>
							@endif	
				     	</div>
				     	<label class="control-label col-md-1" for="postage">Postage </label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="postage" placeholder="Money for postage" name="postage">
				        	@if(session()->has('postage'))
							<span class="text-danger">{!! session('postage')!!}</span>
							@endif	
				     	</div>
				    </div>
			    </div>

			    <div class="form-group">
			    	<div class="row">
				     	<label class="control-label col-md-1" for="postage_document">Postage document </label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="postage_document" placeholder="Money for postage document" name="postage_document">
				        	@if(session()->has('postage_document'))
							<span class="text-danger">{!! session('postage_document')!!}</span>
							@endif	
				     	</div>
				     	<label class="control-label col-md-1" for="other">Others </label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="other" placeholder="Money for others" name="others">
				        	@if(session()->has('others'))
							<span class="text-danger">{!! session('others')!!}</span>
							@endif	
				     	</div>
				    </div>
			    </div>

				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-1" for="rh">Rent House*</label>	
						<div class="col-md-3">				
							<div class="form-check">
	     						<label class="form-check-label"> Bộ trưởng </label>
	     						<input type="radio" class="form-check-input radio" name="posision" value="1">
	   						</div>

	    					<div class="form-check">
								<label class="form-check-label">Thứ trưởng</label>
	     						<input type="radio" class="form-check-input radio" name="posision" value="2">
	   						</div>

	    					<div class="form-check ">
								<label class="form-check-label">Đối tượng còn lại</label>
	     						<input type="radio" class="form-check-input radio" name="posision" value="3" checked>
	    					</div>
						</div>

						<div class="col-md-3">
							<div class="form-check">
	     						<label class="form-check-label"> Vùng I</label>
	     						<input type="radio" class="form-check-input radio" name="area" value="1">
	   						</div>
	    					<div class="form-check">
								<label class="form-check-label">Vùng còn lại</label>
	     						<input type="radio" class="form-check-input radio" name="area" value="2" checked>
	   						</div>
						</div>

						<div class="col-md-3">
							@if(session()->has('renthouse'))
							<span class="text-danger">{!! session('renthouse')!!}</span>
							@endif	
						</div>	

					</div>	
				</div>

				<div class="form-group">
			    	<div class="row">
				     	<label class="control-label col-md-1" for="overtime">Over time </label>
				      	<div class="col-md-4">
				        	<input type="number" class="form-control" value="0" min="0" max="8" id="overtime" name="day_overtime">
				     	</div>
				     	<label class="control-label col-md-1" for="other">Benifit* </label>
						<div class="col-md-3">
							<div class="form-check">
	     						<label class="form-check-label"> Đất liền </label>
	     						<input type="radio" class="form-check-input radio" name="place" value="1" checked>
	   						</div>
	    					<div class="form-check">
								<label class="form-check-label">Biển đảo</label>
	     						<input type="radio" class="form-check-input radio" name="place" value="2" >
	   						</div>
						</div>
							
						<div class="col-md-3">
							@if(session()->has('benifit'))
							<span class="text-danger">{!! session('benifit')!!}</span>
							@endif	
						</div>	
				    </div>
			    </div>
				
				<div class="form-group">
					<div class="row">
				    	<div class="col-md-2"></div>
				    	<div class="col-md-2">
				    		<button type="submit" class="btn btn-success" style="width: 150px;"> Payment <i class="fas fa-plus-circle"></i></button>
				    	</div>
				    	<div class="col-md-4"><span class="text-danger" style="height: 38px;line-height: 38px;">Lưu ý :(section(*) cant be empty )</span></div>
				    </div>								
				</div>

				<div class="form-group">
					<legend class="text-danger">Chú ý khi thanh toán:</legend>
					<ul class="list-group">
						<p>Bộ trưởng</p>
					  	<li class="list-group-item"> <p class="text-info">Mức giá thuê phòng ngủ: 2.500.000 đồng/ngày/phòng theo tiêu chuẩn một người/1 phòng, không phân biệt nơi đến công tác.</p></li>
					  	<p>Thứ trưởng</p>
					  	<li class="list-group-item"><p class="text-info">Vùng I:Mức giá thuê phòng ngủ:1.200.000 đồng/ngày/phòng theo tiêu chuẩn một người/1 phòng.</p></li>
					  	<li class="list-group-item"><p class="text-info">Vùng còn lại:Mức giá thuê phòng ngủ:1.100.000 đồng/ngày/phòng theo tiêu chuẩn một người/1 phòng.</p></li>
					  	<p>Đối tượng còn lại</p>
					  	<li class="list-group-item"><p class="text-info">Vùng I: Các đối tượng còn lại: Được thanh toán mức giá thuê phòng ngủ là 1.000.000 đồng/ngày/phòng.</p></li>
					  	<li class="list-group-item"><p class="text-info">Vùng còn lại: Các đối tượng còn lại: Được thanh toán mức giá thuê phòng ngủ là 700.000 đồng/ngày/phòng.</p></li>
					  	<p>Tiền thêm giờ </p>
					  	<li class="list-group-item"><p class="text-info">Overtime (Tiền thêm giờ): là tiền thêm giờ, tức là chuyến công tác vào những ngày thứ bảy và chủ nhật.</p></li>
					  	<li class="list-group-item"><p class="text-info">Công thức tính Over time = 200.000 * số ngày thứ bày và chủ nhật (VNĐ).</p></li>
					  	<p>Tiền phụ cấp lưu trú  </p>
					  	<li class="list-group-item"><p class="text-info">Benifit (Phụ cấp lưu trú): là khoản tiền hỗ trợ thêm cho người đi công tác ngoài tiền lương do cơ quan, đơn vị cử người đi công tác chi trả, được tính từ ngày bắt đầu đi công tác đến khi kết thúc đợt công tác trở về cơ quan, đơn vị.</p></li>
					  	<li class="list-group-item"><p class="text-info">Công thức tính Benifit = 200.000(VNĐ)/người/ngày khi công tác trên đất liền hoặc 250.000 người/ngày khi công tác trên đất biển đảo .</p></li>
					</ul> 
				</div>
		    </form>
		</div> 
	</div>

	<div class ="row">
		<div class ="col-md-8"><legend class ="text-info">History of payment</legend></div>	
	</div>

	<div class ="row">	
		<table class="table table-bordered table-striped">
		    <thead>
		      <tr>
		        <th>Name</th>
		        <th>Date</th>
		        <th>Traveling</th>
		        <th>Rent house</th>
				<th>Postage</th>
				<th>Document</th>
				<th>Others</th>	
				<th>Overtime</th>	
				<th>Benifit</th>
				<th></th>
		      </tr>
		    </thead>
		    <tbody>
		    @if(isset($results))	
			    @foreach($results as $result )
			      <tr>
			        <td><?php $employee = \App\User::where('id',$result->id_employee_r)->first(); echo $employee->name; ?></td>
			        <td>{{$result->date_finish}}</td>
			        <td>{{number_format($result->travel_cost_r)}}</td>
			        <td>{{number_format($result->rent_house_r)}}</td>
			        <td>{{number_format($result->postage_r)}}</td>
			        <td>{{number_format($result->postage_document_r)}}</td>
			        <td>{{number_format($result->others_r)}}</td>
			        <td>{{number_format($result->overtime)}}</td>
			        <td>{{number_format($result->benifit)}}</td>
			        <td>
			        	<a href="{{Route('deletepayment',array($project->id,$result->id))}}" onclick="return Mesenger('Do you want to delete this payment?')" class="btn btn-info" style="width:100px;">Delete <i class="fas fa-trash-alt"></i></a>
				        <a href="{{Route('printresult',array($result->id))}}" onclick="return Mesenger('Do you want to print result ?')" id="print" class="btn btn-secondary" style="width:100px; margin-top: 10px;">Print <i class="fas fa-print"></i></a>
			        </td>
			      </tr>
			    @endforeach
			@endif      
		    </tbody>
  		</table>
	</div>	

	<div class="row">
		<div class ="col-md-7"></div>
		<div class ="col-md-5">
			<a href="{{Route('finishproject',array($project->id))}}" onclick="return Mesenger('Do you want to finish project?')" class="btn btn-success" style="width: 150px;">Finish Project <i class="fas fa-thumbs-up"></i></a>
            <a href="{{Route('admin')}}" class="btn btn-danger" ><span class="glyphicon glyphicon-remove-sign"></span>Back to Home <i class="fas fa-arrow-alt-circle-left"></i></a>
		</div>
	</div>

	<script type="text/javascript">
		function Mesenger(msg){
			if(window.confirm(msg)){
				return true;
			}
			return false;
		};
	</script>
@endsection