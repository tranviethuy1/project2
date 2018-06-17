@extends('layout.adminlayout')
@section('rightcontent')

<style >	
	.center{
		margin: auto;
	}
</style>
	
	<div class="row"><legend class ="text-info" style ="text-align: left;">Danh sách các chuyến công tác kết thúc </legend></div>
	<form action="{{Route('findproject')}}" method="post" accept-charset="utf-8">
		<div class="form-group">
			<div class="row">
				<div class="col-md-5" >
					{!! csrf_field() !!}
					<input type="text" id="search" class="form-control" placeholder="Project information" name="search">
				</div>
				<div class="col-md-4">
					<button type="submit" class="btn btn-success" style="width: 130px;" onclick="return sendMessage('Make sure! You enter one project!!')" name="submit">Find project <i class="fas fa-arrow-alt-circle-right"></i></button>
				</div>
			</div>
		</div>
	</form>	

	<script type="text/javascript">

		$(document).ready(function(){	
			$('#search').on('keyup',function(){
				$value = $(this).val();
				$.ajax({
					type: 'get',
					url: "{!! url('searchproject') !!}",
					data: {'search': $value},
					success:function(data){
						$('tbody').html(data);
					}
				});
			});
		});

		function sendMessage(msg){
			if(window.confirm(msg)){
				return true;
			}
			return false;
		};
	</script>
	<div class="row" style="margin-top: 20px;margin-left: 0px;">
		<table class="table table-bordered table-hover">
		    <thead>
		      <tr>
		        <th class="text-info">ID</th>
		        <th class="text-info">Informations</th>
		        <th class="text-info">Plans</th>
		        <th class="text-info">Employees</th>
		        <th class="text-info">Payments</th>
		        <th></th>
		      </tr>
		    </thead>
	 		<tbody>	
	 		@if(isset($projects))	
	 		<?php $i = 0; ?>
	 			@foreach($projects as $project)	    
		      	<tr>
			        <td>{{$project->id}}</td>
			        <td>
			        	<ul class="project">
			        		<li>Name: {{$project->name_project}}</li>
			        		<li>Manager: {{$project->project_manager}}</li>
			        		<li>Date start: {{$project->date_start}}</li>
			        	</ul>
			        </td>
			        <td>
			        	<ul class="project">
			        		<li>Days: {{$data_project[$i][$project->id]['plans']->days}}</li>
			        		<li>Travel: {{number_format($data_project[$i][$project->id]['plans']->travel_cost)." VNĐ"}}</li>
			        		<li>Rent house: {{number_format($data_project[$i][$project->id]['plans']->rent_house)." VNĐ"}}</li>
			        		<li>Postage: {{number_format($data_project[$i][$project->id]['plans']->postage)." VNĐ"}}</li>
			        		<li>Document: {{number_format($data_project[$i][$project->id]['plans']->postage_document)." VNĐ"}}</li>
			        		<li>Others: {{number_format($data_project[$i][$project->id]['plans']->others)." VNĐ"}}</li>
			        		<li>Overtime: {{number_format($data_project[$i][$project->id]['plans']->overtime)." VNĐ"}}</li>
			        		<li>Benifit: {{number_format($data_project[$i][$project->id]['plans']->benifit)." VNĐ"}}</li>
			        		<hr>
			        		<li style="color:#007fff;">Total: {{number_format($data_project[$i][$project->id]['plans']->benifit+$data_project[$i][$project->id]['plans']->overtime+$data_project[$i][$project->id]['plans']->others+$data_project[$i][$project->id]['plans']->postage_document+$data_project[$i][$project->id]['plans']->postage+$data_project[$i][$project->id]['plans']->rent_house+$data_project[$i][$project->id]['plans']->travel_cost)." VNĐ"}}</li>
			        	</ul>
			        </td>
			        <td>
			        	<ul class="project">
			        		<?php $links = $data_project[$i][$project->id]['links']; ?>
			        		@foreach($links as $link)
			        		<li><?php $name = \App\User::where('id',$link->id_employee)->value('name'); echo $name; ?></li>
			        		@endforeach
			        	</ul>
			        </td>
			        <td>
			        	<ul class="project">
			        		<?php $results = $data_project[$i][$project->id]['results']; $all = 0; ?>
			        		@foreach($results as $result)
			        		<li style="color:#007fff;">Name: 
								<?php $name = \App\User::where('id',$result->id_employee_r)->value('name'); echo $name;?>
			        		</li>
			        		<li>Date finish: {{$result->date_finish}}</li>
			        		<li>Travel : {{number_format($result->travel_cost_r)." VNĐ"}}</li>
			        		<li>Rent house: {{number_format($result->rent_house_r)." VNĐ"}}</li>
			        		<li>Postage: {{number_format($result->postage_r)." VNĐ"}}</li>
			        		<li>Document: {{number_format($result->postage_document_r)." VNĐ"}}</li>
			        		<li>Others: {{number_format($result->others_r)." VNĐ"}}</li>
			        		<li>Overtime: {{number_format($result->overtime)." VNĐ"}}</li>
			        		<li>Benifit: {{number_format($result->benifit)." VNĐ"}}</li>
			        		<hr>
			        		<li style="color:#007fff;">
			        			<?php 
			        				$total = $result->travel_cost_r+$result->rent_house_r+$result->postage_r+$result->postage_document_r+$result->others_r+$result->overtime+$result->benifit; 
			        				$all+= $total;
			        			?>
			        			Total: {{number_format($total)." VNĐ"}}
			        		</li>
			        		@endforeach

			        		<li class="text-info">Tổng số tiền: {{number_format($all)." VNĐ"}}</li>
			        	</ul>
			        </td>
			        <td>
			        	<a href="{{Route('printpayment',array($project->id))}}" onclick="return sendMessage('Bạn có muốn in phiếu thanh toán này không?')" id="print" class="btn btn-info">Print <i class="fas fa-print"></i></a>
			        </td>
		      	</tr>
				<?php $i =$i+1; ?>
		      	@endforeach
			@endif
			</tbody> 
		</table>
	</div>

		@if(isset($projects))
		<div class= "row">
			<ul class="pagination center">
				@if($projects->currentPage() != 1)
			    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$projects->url($projects->currentPage()-1) )!!}">Previous</a></li>
			    @endif

				@for($i = 1; $i <= $projects->lastPage(); $i++)
			    <li class="{!! ($projects->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$projects->url($i) )!!}">{!! $i !!}</a></li>
				@endfor
				@if($projects->currentPage() != $projects->lastPage())
			    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$projects->url($projects->currentPage()+1) )!!}">Next</a></li>
			    @endif
	 		 </ul>
		</div>
		@endif	
@endsection