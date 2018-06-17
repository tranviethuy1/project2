@extends('layout.master')
@section('rightcontent')

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
				<legend class ="text-info" style ="text-align: center;">Phiếu tạm ứng </legend>

				@if(isset($project))					
					@if($project['status'] == 1)
					<legend class ="text-warning" style ="text-align: center;font-family: Tahoma; font-weight:700; font-size: 20px;">
						Advance is warning
					</legend>	
						@if(isset($refuses))
							<div style="text-align: center; height: 50px;"><span class="fas fa-envelope-square"><a href="{{Route('seemessagerefuse',array($project['id']))}}"> Click here to see message</a></span></div>
						@endif
					@endif	
					@if($project['status'] == 2)
					<legend class ="text-success" style ="text-align: center;font-family: Tahoma; font-weight:700; font-size: 20px;">
						Advance is accepted
					</legend>
					@endif
				@endif
					
				<hr>
					
				<div class ="form-group">
					<div class="row">
						<label class="control-label col-md-2" for="Project_name">Project Name:</label>
						@if(isset($project))
						<div class="col-md-4"><input class="form-control" type="text" name="pn" id="pn" value="{{$project['name_project']}}" disabled></div>
						@endif
					</div>	
				</div>

				<div class="form-group">
					<div class="row">
						<label class="control-label col-md-2" for="rh">Rent House:</label>	
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
						
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="d">Số ngày công tác dự kiến:</label>
								@if(!isset($day))
								<input type="number" class="form-control" name="day" value="<?php if(isset($plan)){ echo $plan->days;}?>">
								@else
								<input type="number" class="form-control" name="day" value="<?php echo $day; ?>">
								@endif

								@if(session()->has('days'))
									<span class="text-danger">{!! session('days')!!}</span>
								@endif
							</div>
						</div>
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
					<div class="row">
						<label class="control-label col-md-2" for="Travel-cost">Travel-cost</label>
						<div class="col-md-3" >
							<input type="text" class="form-control" placeholder="Money for travelling" name="travel_cost" >
						</div>
						<div class="col-md-7">
							<span class="text-info">(**Bao gồm tiền đi lại trong toàn bộ chuyến công tác**) </span>
						</div>
					</div>	
				</div>

				<div class ="form-group">
					<div class="row">
						<label class="control-label col-md-2" for="pt">Postage</label>
						<div class="col-md-3" >
							<input type="text" class="form-control" placeholder="Money for postage" name="postage">
						</div>
						<div class="col-md-7">	
							<span class="text-info">(**Cước, phí di chuyển cho bản thân và phương tiện**) </span>
						</div>
					</div>	
				</div>

				<div class ="form-group">
					<div class="row">
						<label class="control-label col-md-2" for="pd">Postage-documment</label>
						<div class="col-md-3" >
							<input type="text" class="form-control" placeholder="Postage_document" name="postage_document">
						</div>
						<div class="col-md-7">	
							<span class="text-info">(**Cước tài liệu, thiết bị, dụng cụ, đạo cụ của chuyến công tác**) </span>
						</div>
					</div>
				</div>
				
				<div class ="form-group">
					<div class="row">
						<label class="control-label col-md-2" for="o">Other</label>
						<div class="col-md-3" >
							<input type="text" class="form-control" placeholder="Money for others" name="others">
						</div>
						<div class="col-md-7">	
							<span class="text-info">(**Cước hành lý của người đi công tác **) </span>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
	          			<label class="col-md-2 control-label" ></label>  
	          			<div class="col-md-4">
	          				<div class="btn-group-btn-group-lg">
			         		<button type="submit" class="btn btn-success"  <?php if(!isset($project)|| (isset($project) && $project['status'] == 2)){echo"disabled";}?> >Tạm ứng hoặc cập nhật  <i class="fas fa-arrow-circle-right" ></i></button>
			         		</div>  
			         	</div>
			         </div>
        		</div>

				<div class="form-group">
					<ul class="list-group">
						<p>Rent house(Tiền thuê nhà của chuyến công tác)</p>
						<li class="list-group-item"><p class="text-info"> Hóa đơn, chứng từ thuê phòng nghỉ hợp pháp theo quy định của pháp luật (áp dụng khi thanh toán tiền thuê phòng nghỉ theo hóa đơn thực tế).</p></li>
						<p>Travel-cost(Tiền đi lại trong toàn bộ chuyến công tác)</p>
					  	<li class="list-group-item"> <p class="text-info">Hóa đơn, chứng từ mua vé hợp pháp theo quy định của pháp luật khi đi công tác bằng các phương tiện giao thông hoặc giấy biên nhận của chủ phương tiện.</p></li>
					  	<li class="list-group-item"> <p class="text-info">Riêng chứng từ thanh toán vé máy bay ngoài cuống vé (hoặc vé điện tử) phải kèm theo thẻ lên máy bay theo quy định của pháp luật. Trường hợp mất thẻ lên máy bay thì phải có xác nhận của cơ quan, đơn vị cử đi công tác (áp dụng khi thanh toán chi phí đi lại theo thực tế)</p></li>
					  	<li class="list-group-item"><p class="text-info">Giấy đi đường của người đi công tác có đóng dấu xác nhận của cơ quan, đơn vị nơi đến công tác (hoặc của khách sạn, nhà khách nơi lưu trú).</p></li>
					  	<p>Postage(Cước, phí di chuyển cho bản thân và phương tiện)</p>
					  	<li class="list-group-item"><p class="text-info">Hóa đơn thanh toán cước, phí di chuyển cho bản thân và phương tiện.</p></li>
					  	<p>Documment(Cước tài liệu, thiết bị, dụng cụ, đạo cụ của chuyến công tác)</p>
					  	<li class="list-group-item"><p class="text-info">Hóa đơn mua các tài liệu trong chuyến công tác có chữ ký của cơ sở bán hoặc đơn vị bán trong trường hợp cơ sở không viết hóa đơn đề nghị cán bộ có giấy xác thực của cơ sở bán kèm chữ ký.</p></li>
					  	<p>Others(Cước hành lý của người đi công tác)</p>
					  	<li class="list-group-item"><p class="text-info">Hóa đơn thanh toán cước phí hành lý kèm chữ ký của nơi vận chuyển.</p></li>
					</ul> 
				</div>

			</form>
		</div>
	</div>

	<div class="row">
		<p style="margin-left: 10px;">Information on the last loan, you can update to fix before Admin accept:</p>
		<table class="table table-bordered table-hover" style="margin-left:10px; ">
		    <thead>
		      <tr>
		        <th class="text-info"> Name </th>
		        <th class="text-info"> Date </th>
		        <th class="text-info"> Travel</th>
		        <th class="text-info"> Rent</th>
				<th class="text-info"> Postage</th>
				<th class="text-info"> Document</th>
				<th class="text-info"> Others</th>
				<th class="text-info"> Total</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td><?php if(isset($project)){echo $project['name_project'];} ?></td>
		        <td><?php if(isset($advance)){echo $advance->advance_date;} ?></td>
		        <td><?php if(isset($advance)){echo number_format($advance->travel_cost);} ?></td>
		        <td><?php if(isset($advance)){echo number_format($advance->rent_house);} ?></td>
		        <td><?php if(isset($advance)){echo number_format($advance->postage);} ?></td>
		        <td><?php if(isset($advance)){echo number_format($advance->postage_document);} ?></td>
		        <td><?php if(isset($advance)){echo number_format($advance->others);} ?></td>
		        <td><?php if(isset($advance)){echo number_format($advance->travel_cost+$advance->rent_house+$advance->others+$advance->postage+$advance->postage_document).' VNĐ';} ?></td>
		      </tr>
		    </tbody>
  		</table>
	</div>			

@endsection