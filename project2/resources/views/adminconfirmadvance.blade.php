@extends('layout.adminlayout')
@section('rightcontent')
	<?php
	$id = session('data')['id'];
	$name = session('data')['name'];
	?>
	
	<div class ="row">
		<legend class ="text-info">Danh sách các phiếu tạm ứng đã duyệt </legend>	
	</div>

	<div class ="row">
		<div class="col-md-12">			
			<table class="table table-bordered table-striped">
			    <thead>
			      <tr>
			        <th class="text-info">ID </th>
			        <th class="text-info">Project</th>
			        <th class="text-info">Manager</th>
			        <th class="text-info">Start</th>
			        <th class="text-info">Status</th>
			        <th class="text-info"></th>
			      </tr>
			    </thead>
			    <tbody>
			    @if(isset($projects))
				@foreach($projects as $project)
				    <tr>
				        <td>{{$project->id}}</td>
				        <td>{{$project->name_project}}</td>
				        <td>{{$project->project_manager}}</td>
				        <td>{{$project->date_start}}</td>
				        <td><?php if($project->status == 2){echo "Not finish";}else{echo "Finish";} ?></td>
				        <td>
				        	<a href="{{Route('seedetailadvance',array($project->id))}}" class="btn btn-danger">See detail <i class="fas fa-eye"></i></a>
				        </td>
				    </tr>
				@endforeach    
			    @endif  
			    </tbody>
	  		</table>
		</div>	

		@if(isset($projects))
		<div class= "row">
			<ul class="pagination" style="margin-left:350px;">
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
		</div>

@endsection