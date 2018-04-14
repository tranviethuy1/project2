@extends('layout.master')
@section('rightcontent')
<style>
	.inputstyle{
		width: 150px;
	}
</style>
	<div class = "row">
		<div class="col-md-12 ">
			@if(isset($project))
			<form class="form-horizontal" action="{{URL::route('excuteadvance',array($id,$project['id']))}}" method="post" accept-charset="utf-8">
			@else
			<form class="form-horizontal" action="" method="post" accept-charset="utf-8">
			@endif	
				{{ csrf_field() }}
				<div class="status">
		            @if(isset($alert_advance))
		            <span class="alert alert-success form-control" style="margin: auto;">{!! $alert_advance !!}</span>
		             @endif
		        </div>
				<legend class ="text-info" style ="text-align: left;">Advance</legend>

				<div class ="form-group">
					<label class="control-label col-md-2" for="Project_name">Project Name:</label>
					@if(isset($project))
					<div class="col-md-4" ><p style="font-family:Antiqua;font-style: italic;line-height: 30px;text-align: left;">{{$project['name_project']}}</p></div>
					@endif
				</div>

				<div class="form-group">
					<label class="control-label col-md-2" for="Project_name">Rent House:</label>	
					<div class="col-md-3">				
						<div class="form-check">
     						<label class="form-check-label"> Bộ trưởng</label>
     						<input type="radio" class="form-check-input" name="posision" value="1">
   						</div>
    					<div class="form-check">
							<label class="form-check-label">Thứ trưởng</label>
     						<input type="radio" class="form-check-input" name="posision" value="2">
   						</div>
    					<div class="form-check ">
							<label class="form-check-label">Đối tượng còn lại</label>
     						<input type="radio" class="form-check-input" name="posision" value="3" checked>
    					</div>
					</div>
					<div class="col-md-3">
						<div class="form-check">
     						<label class="form-check-label"> Vùng I</label>
     						<input type="radio" class="form-check-input" name="area" value="1">
   						</div>
    					<div class="form-check">
							<label class="form-check-label">Vùng còn lại</label>
     						<input type="radio" class="form-check-input" name="area" value="2" checked>
   						</div>
					</div>	
					<div class="col-md-4">
						<label class="form-check-label" for="pn">Số ngày công tác dự kiến:</label>
						<input style="text-align: center;" type="text" value="<?php if(isset($plan)){ echo number_format($plan->days);}?>" name="day" disabled>
						<span class="text-info">days</span>
					</div>	
				</div>

				<div class="form-group">
					<ul class="list-group">
						<p>Bộ trưởng</p>
					  	<li class="list-group-item"> <p class="text-info">Mức giá thuê phòng ngủ: 2.500.000 đồng/ngày/phòng theo tiêu chuẩn một người/1 phòng, không phân biệt nơi đến công tác.</p></li>
					  	<p>Thứ trưởng</p>
					  	<li class="list-group-item"><p class="text-info">Vùng I:Mức giá thuê phòng ngủ:1.200.000 đồng/ngày/phòng theo tiêu chuẩn một người/1 phòng.</p></li>
					  	<li class="list-group-item"><p class="text-info">Vùng còn lại:Mức giá thuê phòng ngủ:1.100.000 đồng/ngày/phòng theo tiêu chuẩn một người/1 phòng.</p></li>
					  	<p>Đối tượng còn lại</p>
					  	<li class="list-group-item"><p class="text-info">Vùng I: Các đối tượng còn lại: Được thanh toán mức giá thuê phòng ngủ là 1.000.000 đồng/ngày/phòng.</p></li>
					  	<li class="list-group-item"><p class="text-info">Vùng còn lại: Các đối tượng còn lại: Được thanh toán mức giá thuê phòng ngủ là 700.000 đồng/ngày/phòng.</p></li>
					</ul> 
				</div>


				<div class ="form-group">
					<label class="control-label col-md-3" for="Travel-cost">Travel-cost</label>
					<div class="col-md-9" >
						<input type="text" class="inputstyle" placeholder="Enter a number" name="travel_cost"><span>VNĐ</span>
						<span class="text-info">(**Bao gồm tiền đi trong toàn bộ chuyến công tác**) </span>
					</div>
				</div>

				<div class ="form-group">
					<label class="control-label col-md-3" for="Project_name">Postage</label>
					<div class="col-md-9" >
						<input type="text" class="inputstyle" placeholder="Enter a number" name="postage"><span>VNĐ</span>
						<span class="text-info">(**Cước, phí di chuyển cho bản thân và phương tiện**) </span>
					</div>
				</div>

				<div class ="form-group">
					<label class="control-label col-md-3" for="Project_name">Postage-documment</label>
					<div class="col-md-9" >
						<input type="text" class="inputstyle" placeholder="Enter a number" name="postage_document"><span>VNĐ</span>
						<span class="text-info">(**Cước tài liệu, thiết bị, dụng cụ, đạo cụ của chuyến công tác **) </span>
					</div>
				</div>
				
				<div class ="form-group">
					<label class="control-label col-md-3" for="Project_name">Other</label>
					<div class="col-md-9" >
						<input type="text" class="inputstyle" placeholder="Enter a number" name="others"><span>VNĐ</span>
						<span class="text-info">(**Cước hành lý của người đi công tác **) </span>
					</div>
				</div>
				
				<div class="form-group">
          		<label class="col-md-3 control-label" ></label>  
          			<div class="col-md-4">
          				<div class="btn-group-btn-group-lg">
		         		<button type="submit" class="btn btn-success"  <?php if(!isset($project)|| (isset($project) && $project['status'] == 2)){echo"disabled";}?> >Advance or Update<i class="fas fa-arrow-circle-right" ></i></button>
		         		</div>  
		         	</div>
        		</div>

			</form>
		</div>
	</div>

	<div class="row">
		<p>Information on the last loan, you can update to fix before Admin accept:</p>
		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Project_name</th>
		        <th>Date_advance</th>
		        <th>Cost_travel</th>
		        <th>Rent_house</th>
				<th>Postage</th>
				<th>Postage_document</th>
				<th>Other</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td><?php if(isset($project)){echo $project['name_project'];} ?></td>
		        <td><?php if(isset($advance)){echo $advance->advance_date;} ?></td>
		        <td><?php if(isset($advance)){echo $advance->travel_cost;} ?></td>
		        <td><?php if(isset($advance)){echo $advance->rent_house;} ?></td>
		        <td><?php if(isset($advance)){echo $advance->postage;} ?></td>
		        <td><?php if(isset($advance)){echo $advance->postage_document;} ?></td>
		        <td><?php if(isset($advance)){echo $advance->others;} ?></td>
		      </tr>
		    </tbody>
  		</table>
	</div>			

@endsection