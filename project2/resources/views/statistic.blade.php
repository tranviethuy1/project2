@extends('layout.adminlayout')
@section('rightcontent')
        <!-- Main Application (Can be VueJS or other JS framework) -->

		<div class="row">
			<legend class="text-info">Biểu đồ thống kê số dự án khởi tạo theo tháng trong năm  </legend>
		</div>
		
		<div class="row">

            {!! $chart_p->container() !!}

        </div>

		<div class="row">
			<legend class="text-info">Biểu đồ thống kê số  dự án đã thực hiện theo tháng trong năm  </legend>
		</div>
        <div class="row">

            {!! $chart->container() !!}
        </div>

        <!-- End Of Main Application -->

        {!! $chart->script() !!}
        {!! $chart_p->script() !!}

	<div class ="row">
		<legend class ="text-info">Thống kê chi tiết  </legend>	
	</div>

	<form class="form-horizontal" action="{{Route('findstatistic')}}" method="post">
		{!! csrf_field() !!}
		<div class="row" style="margin-top: 20px;">
			<div class="col-md-3">	
				<div class="form-group">
				  <label for="sel1">Select month:</label>
				  <select id="mon" class="form-control" name="month">
				  	<option value="all" selected>All</option>
				    <option value="1">1</option>
				    <option value="2">2</option>
				    <option value="3">3</option>
				    <option value="4">4</option>
				    <option value="5">5</option>
				    <option value="6">6</option>
					<option value="7">7</option>
				    <option value="8">8</option>
				    <option value="9">9</option>
				    <option value="10">10</option>
				    <option value="11">11</option>
				    <option value="12">12</option>
				  </select>
				</div>
			</div>

			<div class="col-md-3">	
				<div class="form-group">
				  <label for="sel2">Select year:</label>
				  <select id="yea" class="form-control" name="year">
				    <option value="2016">2016</option>
				    <option value="2017">2017</option>
				    <option value="2018" selected>2018</option>
				    <option value="2019">2019</option>
				    <option value="2020">2020</option>
				    <option value="2021">2021</option>
					<option value="2022">2022</option>
				    <option value="2023">2023</option>
				    <option value="2024">2024</option>
				    <option value="2025">2025</option>
				    <option value="2026">2026</option>
				    <option value="2027">2027</option>
				  </select>
				</div>
			</div>
		<?php if(isset($projects)){var_dump($projects) ;} ?>
			<div class="col-md-3">	
				<div class="form-group">
					<button type="submit" class="btn btn-danger" style="width: 150px;margin-top: 30px;">Statistic <i class="fas fa-chart-bar"></i></button>
				</div>
			</div>
		</div>
	</form>
		
	<script type="text/javascript">
	$(document).ready(function(){	
		$('#mon').on('change',function(){
		$value1 = $(this).val();
		$value2 = $('#yea').val();
			$.ajax({
				type: 'get',
				url: "{{url('searchstatisticmonth')}}",
				data: {'month': $value1,'year':$value2},
				success:function(data){
					$('tbody').html(data);
				}
			});
		});
	});

	$(document).ready(function(){	
		$('#yea').on('change',function(){
		$value1 = $(this).val();
		$value2 = $('#mon').val();
			$.ajax({
				type: 'get',
				url: "{{url('searchstatisticyear')}}",
				data: {'month': $value2,'year':$value1},
				success:function(data){
					$('tbody').html(data);
				}
			});
		});
	});

	</script>

	<div class="row" style="margin-top: 20px;">
		<table class="table table-bordered table-striped">
		    <thead>
		      <tr>
		        <th class="text-info">Name</th>
		        <th class="text-info">Travel</th>
		        <th class="text-info">Rent </th>
				<th class="text-info">Postage</th>
				<th class="text-info">Document</th>
				<th class="text-info">Others</th>	
				<th class="text-info">Overtime</th>	
				<th class="text-info">Benifit</th>	
				<th class="text-info">Total</th>
		      </tr>
		    </thead>
		    <tbody>
		    @if(isset($results))	
			    @foreach($results as $result )
			    <?php $all = 0 ;?>
			      <tr>
			      	<?php $all+=$result['travel_cost_r']+$result['rent_house_r']+$result['postage_r']+$result['postage_document_r']+$result['others_r']+$result['overtime']+$result['benifit']; ?>
			        <td>{{$result['name']}}</td>
			        <td>{{number_format($result['travel_cost_r'])}}</td>
			        <td>{{number_format($result['rent_house_r'])}}</td>
			        <td>{{number_format($result['postage_r'])}}</td>
			        <td>{{number_format($result['postage_document_r'])}}</td>
			        <td>{{number_format($result['others_r'])}}</td>
			        <td>{{number_format($result['overtime'])}}</td>
			        <td>{{number_format($result['benifit'])}}</td>
			        <td>{{number_format($all).' VNĐ'}}</td>
			      </tr>
			    @endforeach
			@endif      
		    </tbody>
  		</table>
	</div>

	<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
	<script src=//cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js charset=utf-8></script>
	<script src=//cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js charset=utf-8></script>
	<script src=//cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
@endsection
