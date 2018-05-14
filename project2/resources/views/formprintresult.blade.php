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
		<p class ="text-info" style="text-align: center;">PHIẾU THANH TOÁN  </p>
	</div>

	<div class="row" style="margin-top: 20px;">
		<table class="table table-bordered table-hover">
		    <thead>
		      <tr>
		        <th class="text-info">Project Information</th>
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
			        		<?php $all = 0; ?>
			        		<li style="color:#007fff;">Name: {{$name}}
			        		</li>
			        		<li>Date: {{$result->date_finish}}</li>
			        		<li>Travel : {{number_format($result->travel_cost_r)}}</li>
			        		<li>Rent: {{number_format($result->rent_house_r)}}</li>
			        		<li>Postage: {{number_format($result->postage_r)}}</li>
			        		<li>Document: {{number_format($result->postage_document_r)}}</li>
			        		<li>Others: {{number_format($result->others_r)}}</li>
			        		<li>Overtime: {{number_format($result->overtime)}}</li>
			        		<li>Benifit: {{number_format($result->benifit)}}</li>
			        		<hr>
			        		<li style="color:#007fff;">
			        			<?php 
			        				$total = $result->travel_cost_r+$result->rent_house_r+$result->postage_r+$result->postage_document_r+$result->others_r+$result->overtime+$result->benifit; 
			        				$all+= $total;
			        			?>
			        			Total: {{number_format($total)." VNĐ "}}
			        		</li>
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