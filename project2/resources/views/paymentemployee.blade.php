@extends('layout.master')
@section('rightcontent')
	<style>
		.center{
			margin: auto;
		}	
	</style>
	<div class="row">
	<div class="col-md-12">
	<legend class ="text-info" style ="text-align: left;">Lịch sử thanh toán </legend>
	<form action="{{Route('findpayment',array($id))}}" method="get" accept-charset="utf-8">
		<div class="form-group">
			<div class="row">
				<div class="col-md-5" >
					{!! csrf_field() !!}
					<input type="text" id="payment_search" class="form-control inputfind" placeholder="Name Project" name="payment_search">	
				</div>
				<div class="col-md-4">
					<i class ="fas fa-search"></i><button type="submit" class="btn btn-success buttonfind" name="submit">Find</button>		
				</div>
			</div>
		</div>
	</form>	
	</div>
	</div>
		<!-- search live -->
		<script type="text/javascript">
		$(document).ready(function(){	
			$('#payment_search').on('keyup',function(){
			$value = $(this).val();
				$.ajax({
					type: 'get',
					url: "{{url('searchpayment',array($id))}}",
					data: {'payment_search': $value},
					success:function(data){
						$('tbody').html(data);
					}
				});
			});
		});
		</script>

		<div class="row" style="margin-top: 20px;margin-left: 10px; ">
			<table class="table table-bordered table-striped">
			    <thead>
			      <tr>
			        <th class="text-info">Project</th>
			        <th class="text-info">Travel </th>
			        <th class="text-info">Rent </th>
			        <th class="text-info">Postage</th>
			        <th class="text-info">Document</th>
			        <th class="text-info">Others</th>
			        <th class="text-info">Over Time</th>
			        <th class="text-info">Benifit</th>
			        <th class="text-info">Date </th>
			        <th class="text-info">Total</th>
			      </tr>
			    </thead>
			    <tbody>
			@if(isset($payments_find))	    
			    @foreach($payments_find as $payment_find)
			    <tr>
			        <td><?php $id_project = $payment_find['id_project']; $project = \App\Projects::where('id',$id_project)->first()->toArray(); echo $project['name_project']; ?></td>
			        <td> <?php if(isset($payment_find['travel_cost_r'])){ echo number_format($payment_find['travel_cost_r']);} ?></td>
			        <td> <?php if(isset($payment_find['rent_house_r'])){ echo number_format($payment_find['rent_house_r']) ;} ?></td>
			        <td> <?php if(isset($payment_find['postage_r'])){ echo number_format($payment_find['postage_r']) ;} ?></td>
			        <td> <?php if(isset($payment_find['postage_document_r'])){ echo number_format($payment_find['postage_document_r']);} ?></td>
			        <td> <?php if(isset($payment_find['others_r'])){ echo number_format($payment_find['others_r']);} ?></td>
			        <td> <?php if(isset($payment_find['overtime'])){ echo number_format($payment_find['overtime']);} ?></td>
			        <td> <?php if(isset($payment_find['benifit'])){ echo number_format($payment_find['benifit']);} ?></td>
			        <td> <?php if(isset($payment_find['date_finish'])){ echo $payment_find['date_finish'];} ?></td>
			        <td> <?php if(isset($payment_find)){ echo number_format($payment_find['travel_cost_r']+$payment_find['rent_house_r']+$payment_find['postage_r']+$payment_find['postage_document_r']+$payment_find['others_r']+$payment_find['overtime']+$payment_find['benifit']);} ?></td>
			    </tr>
			    @endforeach
			@endif

			@if(isset($payments))
			   	@foreach($payments as $payment)
			      <tr>
			        <td><?php $project = \App\Projects::where('id',$payment->id_project)->first()->toArray(); echo $project['name_project']; ?></td>
			        <td> <?php if(isset($payment->travel_cost_r)){ echo number_format($payment->travel_cost_r);} ?></td>
			        <td> <?php if(isset($payment->rent_house_r)){ echo number_format($payment->rent_house_r) ;} ?></td>
			        <td> <?php if(isset($payment->postage_r)){ echo number_format($payment->postage_r) ;} ?></td>
			        <td> <?php if(isset($payment->postage_document_r)){ echo number_format($payment->postage_document_r) ;} ?></td>
			        <td> <?php if(isset($payment->others_r)){ echo number_format($payment->others_r);} ?></td>
			        <td> <?php if(isset($payment->overtime)){ echo number_format($payment->overtime);} ?></td>
			        <td> <?php if(isset($payment->benifit)){ echo number_format($payment->benifit);} ?></td>
			        <td> <?php if(isset($payment->date_finish)){ echo $payment->date_finish;} ?></td>
			        <td> <?php if(isset($payment)){ echo number_format($payment->travel_cost_r+$payment->rent_house_r+$payment->postage_r+$payment->postage_document_r+$payment->others_r+$payment->overtime+$payment->benifit).' VNĐ' ;} ?></td>			        		 
			      </tr>
			    @endforeach
			@endif    
			    </tbody>
			</table>	
		</div>	

		@if(isset($payments))
		<div class= "row">
			<ul class="pagination center">
				@if($payments->currentPage() != 1)
			    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$payments->url($payments->currentPage()-1) )!!}">Previous</a></li>
			    @endif

				@for($i = 1; $i <= $payments->lastPage(); $i++)
			    <li class="{!! ($payments->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$payments->url($i) )!!}">{!! $i !!}</a></li>
				@endfor
				@if($payments->currentPage() != $payments->lastPage())
			    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$payments->url($payments->currentPage()+1) )!!}">Next</a></li>
			    @endif
	 		 </ul>
		</div>
		@endif
@endsection