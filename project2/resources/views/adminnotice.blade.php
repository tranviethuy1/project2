@extends('layout.adminlayout')
@section('rightcontent')
	<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>
	<div class="row">
		<div class ="col-md-3"><legend class ="text-info">Add Notice</legend></div>
	</div>
	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('addnotice')}}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-1" for="t">Title:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="title" name="title">
				        	@if(session()->has('title'))
							<span class="text-danger">{!! session('title')!!}</span>
							@endif				        	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Title Of Notice **)</span></div>
				    </div>	
			    </div>

			    <div class="form-group">
				    <div class="row">
				    	<div class="col-md-1"></div>
				      	<label class="control-label col-md-1" for="f">Content:</label>
				      	<div class="col-md-6">          
				        	<textarea rows="4" cols="50" id="content" class="ckeditor" name="content"></textarea>
				        	@if(session()->has('content'))
							<span class="text-danger">{!! session('content')!!}</span>
							@endif
				      	</div>
				      	<div class="col-md-3"><span class="text-info">(** The Content Of Notice **)</span></div>
				    </div>  
			    </div>
				
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-1" for="t">File:</label>
				      	<div class="col-md-4">
				        	<input type="file" class="form-control" id="file" name="file_notice">
				        	@if(session()->has('file'))
							<span class="text-danger">{!! session('file')!!}</span>
							@endif				        	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** File of Notice (can NULL) **)</span></div>
				    </div>	
			    </div>

				<div class="form-group">
					<div class="row">
				    	<div class="col-md-2"></div>
				    	<div class="col-md-4">
				    		<button type="submit" class="btn btn-success" onclick="return sendAlert('Make sure you enter enough information!!')"> Add Notice <i class="fas fa-newspaper"></i></button>
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>

	<div class = "row" style="margin-top:50px; padding: 0px;">
		<legend class="text-info">All Notices</legend>
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		      <tr>
		        <th>ID </th>
		        <th>Title</th>
		        <th>Date Start</th>
		        <th>Admin</th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>
		    @if(isset($notices))
			@foreach($notices as $notice)
			    <tr>
			        <td>{{$notice->id}}</td>
			        <td>{{$notice->title}}</td>
			        <td>{{$notice->create_at}}</td>
			        <td><?php $admin = \App\User::where('id',$notice->id_employee)->first(); echo $admin->name;?> </td>
			        <td>
			        	<a href="{{Route('updatenotice',array($notice->id))}}" class="btn btn-secondary">Update <i class="fas fa-edit"></i></a>
			        	<a href="{{Route('deletenotice',array($notice->id))}}" onclick="return sendAlert('Do you want to delete this notice?')" class="btn btn-info">Delete <i class="fas fa-trash-alt"></i></a>
			        </td>
			    </tr>
			@endforeach    
		    @endif  
		    </tbody>
  		</table>
	</div>	
	
	<script type="text/javascript">
		function sendAlert(msg){
			if(window.confirm(msg)){
				return true;
			}
			return false;
		};
	</script>
	@if(isset($notices))
	<div class= "row">
		<ul class="pagination" style="margin: auto;">
			@if($notices->currentPage() != 1)
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$notices->url($notices->currentPage()-1) )!!}">Previous</a></li>
		    @endif

			@for($i = 1; $i <= $notices->lastPage(); $i++)
		    <li class="{!! ($notices->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$notices->url($i) )!!}">{!! $i !!}</a></li>
			@endfor
			@if($notices->currentPage() != $notices->lastPage())
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$notices->url($notices->currentPage()+1) )!!}">Next</a></li>
		    @endif
 		 </ul>
	</div>
	@endif

@endsection	