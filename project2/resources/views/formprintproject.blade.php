<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>printpdf</title>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/pdf.css')}}">
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	<style>
	  	body { font-family: DejaVu Sans, sans-serif; }
	</style>
</head>
<body>
	<div class="row">
		<table class="table table-bordered table-hover">
			<thead>
		    </thead>
			<tbody>
				<tr>
					<td>
						<ul class="project">
							<li class="bold"><p>Đơn vị:........................</p></li>
							<li class="bold"><p>Bộ phận:........................</p></li>
							<li class="bold"><p>Mã ĐV:........................</p></li>
						</ul>	
					</td>
					<td></td>
					<td>
						<ul class="project">
							<li class="bold" style="text-align: center;"><p>Mẫu số C12 – HD</p></li>
							<li>(Ban hành theo QĐ số: 19/2017/QĐ-BTCngày 30/03/2017  của Bộ trưởng BTC và sửa đổi, bổ sung theo Thông tư số 40/2017/TT-BTC ngày 16/12/2017 của Bộ Tài chính)</li>
						</ul>
					</td>
				</tr>
			</tbody>	
		</table>
	</div>

	<div clas="row">
		<p class ="text-info" style="text-align: center;">BẢNG KÊ THANH TOÁN CÔNG TÁC PHÍ</p>
		<p class ="text-info" style="text-align: center;">{{$project->name_project}}</p>
	</div>

	<div class="row" style="margin-top: 20px;">
		<table class="table table-bordered table-hover">
		    <thead>
		      <tr>
		        <th class="text-info">Project Information</th>
		        <th class="text-info">Plans</th>
		        <th class="text-info">Advances</th>
		        <th class="text-info">Payments</th>
		      </tr>
		    </thead>
	 		<tbody>	
		      	<tr>
			        <td>
			        	<ul class="project">
			        		<li>Name: {{$project->name_project}}</li>
			        		<li>Manager: {{$project->project_manager}}</li>
			        		<li>Date start: {{$project->date_start}}</li>
			        	</ul>
			        </td>
			       	<td>
			        	<ul class="project">
			        		<li>Days: {{$plan->days}}</li>
			        		<li>Travel: {{number_format($plan->travel_cost)}}</li>
			        		<li>Rent: {{number_format($plan->rent_house)}}</li>
			        		<li>Postage: {{number_format($plan->postage)}}</li>
			        		<li>Document: {{number_format($plan->postage_document)}}</li>
			        		<li>Others: {{number_format($plan->others)}}</li>
			        		<li>Overtime: {{number_format($plan->overtime)}}</li>
			        		<li>Benifit: {{number_format($plan->benifit)}}</li>
			        		<hr>
			        		<li class="text-info">Total: {{number_format($plan->benifit+$plan->overtime+$plan->others+$plan->postage_document+$plan->postage+$plan->rent_house+$plan->travel_cost)}}</li>
			        	</ul>
			        </td>
			        <td>
			        	<ul class="project">
						@foreach($data as $value)
			        		<?php $all = 0; ?>
			        		<li style="color:#007fff;">Name: {{$value['name']}}
			        		</li>
			        		<li>Date: {{$value['advance']->advance_date}}</li>
			        		<li>Travel : {{number_format($value['advance']->travel_cost)}}</li>
			        		<li>Rent: {{number_format($value['advance']->rent_house)}}</li>
			        		<li>Postage: {{number_format($value['advance']->postage)}}</li>
			        		<li>Document: {{number_format($value['advance']->postage_document)}}</li>
			        		<li>Others: {{number_format($value['advance']->others)}}</li>
			        		<hr>
			        		<li style="color:#007fff;">
			        			<?php 
			        				$total = $value['advance']->travel_cost+$value['advance']->rent_house+$value['advance']->postage+$value['advance']->postage_document+$value['advance']->others; 
			        				$all+= $total;
			        			?>
			        			Total: {{number_format($total)}}
			        		</li>
			        	@endforeach	
			        	</ul>
			        </td>			        
			        <td>
			        	<ul class="project">
			        	@foreach($data as $value)
			        		<?php $all = 0; ?>
			        		<li style="color:#007fff;">Name: {{$value['name']}}
			        		</li>
			        		<li>Finish: {{$value['result']->date_finish}}</li>
			        		<li>Travel : {{number_format($value['result']->travel_cost_r)}}</li>
			        		<li>Rent: {{number_format($value['result']->rent_house_r)}}</li>
			        		<li>Postage: {{number_format($value['result']->postage_r)}}</li>
			        		<li>Document: {{number_format($value['result']->postage_document_r)}}</li>
			        		<li>Others: {{number_format($value['result']->others_r)}}</li>
			        		<li>Overtime: {{number_format($value['result']->overtime)}}</li>
			        		<li>Benifit: {{number_format($value['result']->benifit)}}</li>
			        		<hr>
			        		<li style="color:#007fff;">
			        			<?php 
			        				$total = $value['result']->travel_cost_r+$value['result']->rent_house_r+$value['result']->postage_r+$value['result']->postage_document_r+$value['result']->others_r+$value['result']->overtime+$value['result']->benifit; 
			        				$all+= $total;
			        			?>
			        			Total: {{number_format($total)}}
			        		</li>
			        	@endforeach	
			        	</ul>
			        </td>
		      	</tr>
			</tbody> 
		</table>
	</div>

	<div class="row">
		<p class ="text-dark" style="text-align: left;">Tổng số tiền (Viết chữ):......................................................</p>		
	</div>
	<div class="row">
		<p class ="text-dark" style="text-align: left;">(Kèm theo.... chứng từ gốc: Vé, Giấy đi đường, Hoá đơn,...)</p> 		
	</div>
	<div clas="row">
			<p class ="text-dark" style="text-align: right;">ngày ...... tháng ...... năm.......</p>
			<p class ="text-dark" style="margin-left:600px;">Ký tên</p>
		</div>
	</div>
</body>
</html>