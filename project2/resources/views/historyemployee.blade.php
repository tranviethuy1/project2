@extends('layout.master')
@section('rightcontent')
	<style>
		.center{
			margin: auto;
		}	
	</style>

	<legend class ="text-info" style ="text-align: left;">Show all your advance</legend>
	<form action="{{Route('findadvance',array($id))}}" method="get" accept-charset="utf-8">
		<div class="form-group">
			<div class="row">
				<div class="col-md-5" >
					{!! csrf_field() !!}
					<input type="text" id="search" class="form-control inputfind" placeholder="Name Project" name="name_project">
				</div>
				<div class="col-md-4">
					<i class ="fas fa-search"></i><button type="submit" class="btn btn-success buttonfind" name="submit">Find</button>
				</div>
			</div>
		</div>
		<!-- search live -->
		<script type="text/javascript">
		$(document).ready(function(){	
			$('#search').on('keyup',function(){
				$value = $(this).val();
				$.ajax({
					type: 'get',
					url: "{!! url('searchadvance',array($id)) !!}",
					data: {'name_project': $value},
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
			        <th>Project</th>
			        <th>Advance_Date</th>
			        <th>Travel_Cost</th>
			        <th>Rent_House</th>
			        <th>Postage</th>
			        <th>Postage_Document</th>
			        <th>Others</th>
			        <th>Total</th>
			      </tr>
			    </thead>
			    <tbody>
		 	@if(isset($advances_find))	
			    @foreach($advances_find as $advance_find)
			      	<tr>
				        <td><?php $id_project = $advance_find['id_project']; $project = \App\Projects::where('id',$id_project)->first()->toArray(); echo $project['name_project']; ?></td>
				        <td> <?php if(isset($advance_find['advance_date'])){ echo $advance_find['advance_date'];} ?></td>
				        <td> <?php if(isset($advance_find['travel_cost'])){ echo number_format($advance_find['travel_cost']);} ?></td>
				        <td> <?php if(isset($advance_find['rent_house'])){ echo number_format($advance_find['rent_house']) ;} ?></td>
				        <td> <?php if(isset($advance_find['postage'])){ echo number_format($advance_find['postage']) ;} ?></td>
				        <td> <?php if(isset($advance_find['postage_document'])){ echo number_format($advance_find['postage_document']);} ?></td>
				        <td> <?php if(isset($advance_find['others'])){ echo number_format($advance_find['others']);} ?></td>
				        <td> <?php if(isset($advance_find)){ echo number_format($advance_find['travel_cost']+$advance_find['rent_house']+$advance_find['postage']+$advance_find['postage_document']+$advance_find['others']+$advance_find['others']).'VNĐ';} ?></td>
			      	</tr>
			   	@endforeach
			@endif

			@if(isset($advances))	
				@foreach($advances as $advance)
			    <tr>
			        <td><?php $project = \App\Projects::where('id',$advance->id_project)->first()->toArray(); echo $project['name_project']; ?></td>
			        <td> <?php if(isset($advance->advance_date)){ echo $advance->advance_date;} ?></td>
			        <td> <?php if(isset($advance->travel_cost)){ echo number_format($advance->travel_cost);} ?></td>
			        <td> <?php if(isset($advance->rent_house)){ echo number_format($advance->rent_house);} ?></td>
			        <td> <?php if(isset($advance->postage)){ echo number_format($advance->postage) ;} ?></td>
			        <td> <?php if(isset($advance->postage_document)){ echo number_format($advance->postage_document) ;} ?></td>
			        <td> <?php if(isset($advance->others)){ echo number_format($advance->others);} ?></td>
			        <td> <?php if(isset($advance)){ echo number_format($advance->travel_cost+$advance->rent_house+$advance->postage+$advance->postage_document+$advance->others).'VNĐ';} ?></td>
			    </tr>
			    @endforeach
			@endif
			</tbody>
		</table>
		</div>

		@if(isset($advances))	
		<div class= "row">
			<ul class="pagination center">
				@if($advances->currentPage() != 1)
			    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$advances->url($advances->currentPage()-1) )!!}">Previous</a></li>
			    @endif

				@for($i = 1; $i <= $advances->lastPage(); $i++)
			    <li class="{!! ($advances->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$advances->url($i) )!!}">{!! $i !!}</a></li>
				@endfor
				@if($advances->currentPage() != $advances->lastPage())
			    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$advances->url($advances->currentPage()+1) )!!}">Next</a></li>
			    @endif
	 		 </ul>
		</div>
		@endif
	</form>
@endsection