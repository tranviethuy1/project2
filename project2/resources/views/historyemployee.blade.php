@extends('layout.master')
@section('rightcontent')
	<style>
		.center{
			margin: auto;
		}	
	</style>
	<form action="{{Route('findadvance',array($id))}}" method="get" accept-charset="utf-8">
		<div class="row">
			<div class="col-md-8 text_search" >
				{!! csrf_field() !!}
				<input type="text" id="search" class="inputfind" placeholder="Name Project" name="name_project"><i class ="fas fa-search"></i>
				<button type="submit" class="btn btn-success buttonfind" name="submit">Find</button>
			</div>
		</div>
		<!-- search live -->
		<script type="text/javascript">
		$(document).ready(function(){	
			$('.text_search #search').on('keyup',function(){
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

		<div class="row" style="margin-top: 20px;margin-left: 20px; ">
			<table class="table table-bordered table-hover">
			    <thead>
			      <tr>
			        <th>Project</th>
			        <th>Advance_Date</th>
			        <th>Travel_Cost</th>
			        <th>Rent_House</th>
			        <th>Postage</th>
			        <th>Postage_Document</th>
			        <th>Others</th>
			      </tr>
			    </thead>
			    <tbody>
		 @if(isset($advances_find))	
			    @foreach($advances_find as $advance_find)
			      	<tr>
			        <td><?php $id_project = $advance_find['id_project']; $project = \App\Projects::where('id',$id_project)->first()->toArray(); echo $project['name_project']; ?></td>
			        <td> <?php if(isset($advance_find['advance_date'])){ echo $advance_find['advance_date'];} ?></td>
			        <td> <?php if(isset($advance_find['travel_cost'])){ echo number_format($advance_find['travel_cost']).'VNĐ';} ?></td>
			        <td> <?php if(isset($advance_find['rent_house'])){ echo number_format($advance_find['rent_house']).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($advance_find['postage'])){ echo number_format($advance_find['postage']).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($advance_find['postage_document'])){ echo number_format($advance_find['postage_document']).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($advance_find['others'])){ echo number_format($advance_find['others']).'VNĐ';} ?></td>
			      	</tr>
			    @endforeach
			    </tbody>
				</table>
		</div>
		@endif

		@if(isset($advances))	
			@foreach($advances as $advance)
			    <tr>
			        <td><?php $project = \App\Projects::where('id',$advance->id_project)->first()->toArray(); echo $project['name_project']; ?></td>
			        <td> <?php if(isset($advance->advance_date)){ echo $advance->advance_date;} ?></td>
			        <td> <?php if(isset($advance->travel_cost)){ echo number_format($advance->travel_cost).'VNĐ';} ?></td>
			        <td> <?php if(isset($advance->rent_house)){ echo number_format($advance->rent_house).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($advance->postage)){ echo number_format($advance->postage).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($advance->postage_document)){ echo number_format($advance->postage_document).'VNĐ' ;} ?></td>
			        <td> <?php if(isset($advance->others)){ echo number_format($advance->others).'VNĐ';} ?></td>
			    </tr>
			    @endforeach
			    </tbody>
				</table>
		</div>

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