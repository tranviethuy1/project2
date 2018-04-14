@extends('layout.master')
@section('rightcontent')
	<style>
		.center{
			margin: auto;
		}	
	</style>
	<form action="{{Route('findpayment',array($id))}}" method="get" accept-charset="utf-8">
		<div class="row">
			<div class="col-md-8 payment_search" >
				{!! csrf_field() !!}
				<input type="text" id="payment_search" class="inputfind" placeholder="Name Project" name="payment_search"><i class ="fas fa-search"></i>
				<button type="submit" class="btn btn-success buttonfind" name="submit">Find</button>
			</div>
		</div>
		<!-- search live -->
		<script type="text/javascript">
		$(document).ready(function(){	
			$('.payment_search #payment_search').on('keyup',function(){
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

		<div class="row" style="margin-top: 20px;margin-left: 20px; ">
			<table class="table table-bordered table-hover">
			    <thead>
			      <tr>
			        <th>Project</th>
			        <th>Travel Cost</th>
			        <th>Rent House</th>
			        <th>Postage</th>
			        <th>Postage Document</th>
			        <th>Others</th>
			        <th>Over Time</th>
			        <th>Benifit</th>
			        <th>Date PayMent</th>
			      </tr>
			    </thead>
			    <tbody>
		@if(isset($payments_find))	    
			    @foreach($payments_find as $payment_find)
			    <tr>
			        <td><?php $id_project = $payment_find['id_project']; $project = \App\Projects::where('id',$id_project)->first()->toArray(); echo $project['name_project']; ?></td>
			        <td> <?php if(isset($payment_find['travel_cost_r'])){ echo number_format($payment_find['travel_cost_r']).'VNĐ';} ?></td>
			        <td> <?php if(isset($payment_find['rent_house_r'])){ echo number_format($payment_find['rent_house_r']).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($payment_find['postage_r'])){ echo number_format($payment_find['postage_r']).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($payment_find['postage_document_r'])){ echo number_format($payment_find['postage_document_r']).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($payment_find['others_r'])){ echo number_format($payment_find['others_r']).'VNĐ';} ?></td>
			        <td> <?php if(isset($payment_find['overtime'])){ echo number_format($payment_find['overtime']).'VNĐ';} ?></td>
			        <td> <?php if(isset($payment_find['benifit'])){ echo number_format($payment_find['benifit']).'VNĐ';} ?></td>
			        <td> <?php if(isset($payment_find['date_finish'])){ echo $payment_find['date_finish'];} ?></td>
			    </tr>
			    @endforeach
			    </tbody>
				</table>
		</div>
		@endif

		@if(isset($payments))
			   	@foreach($payments as $payment)
			      <tr>
			        <td><?php $project = \App\Projects::where('id',$payment->id_project)->first()->toArray(); echo $project['name_project']; ?></td>
			        <td> <?php if(isset($payment->travel_cost_r)){ echo number_format($payment->travel_cost_r).'VNĐ';} ?></td>
			        <td> <?php if(isset($payment->rent_house_r)){ echo number_format($payment->rent_house_r).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($payment->postage_r)){ echo number_format($payment->postage_r).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($payment->postage_document_r)){ echo number_format($payment->postage_document_r).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($payment->others_r)){ echo number_format($payment->others_r).'VNĐ';} ?></td>
			        <td> <?php if(isset($payment->overtime)){ echo number_format($payment->overtime).'VNĐ';} ?></td>
			        <td> <?php if(isset($payment->benifit)){ echo number_format($payment->benifit).'VNĐ';} ?></td>
			        <td> <?php if(isset($payment->date_finish)){ echo $payment->date_finish;} ?></td>			        		 
			      </tr>
			    @endforeach
			    </tbody>
				</table>	
		</div>	

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
	</form>
@endsection