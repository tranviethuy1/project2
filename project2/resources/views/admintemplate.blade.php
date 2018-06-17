@extends('layout.adminlayout')
@section('rightcontent')
	<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>
	<script type="text/javascript">
		function sendAlert(msg){
			if(window.confirm(msg)){
				return true;
			}
			return false;
		};
	</script>
	<div class="row">
		<legend class ="text-info">Thêm mẫu đơn </legend>
	</div>

	<div class="row">
		<div class="col-md-12">	
			<form class="form-horizontal" action="{{Route('addtemplate')}}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-1" for="t">Title*:</label>
				      	<div class="col-md-4">
				        	<input type="text" class="form-control" id="title" name="title">
				        	@if(session()->has('title'))
							<span class="text-danger">{!! session('title')!!}</span>
							@endif				        	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** Title Of template **)</span></div>
				    </div>	
			    </div>
				
			    <div class="form-group">
			    	<div class="row">
				    	<div class="col-md-1"></div>
				     	<label class="control-label col-md-1" for="t">File*:</label>
				      	<div class="col-md-4">
				        	<input type="file" class="form-control" id="file" name="file_template">
				        	@if(session()->has('file'))
							<span class="text-danger">{!! session('file')!!}</span>
							@endif				        	
				     	</div>
				     	<div class="col-md-5"><span class="text-info">(** File of template **)</span></div>
				    </div>	
			    </div>

				<div class="form-group">
					<div class="row">
				    	<div class="col-md-2"></div>
				    	<div class="col-md-5">
				    		<button type="submit" class="btn btn-success" onclick="return sendAlert('Chắc chắn rằng file có định dạng : .doc .docx .pdf .ppt .pptx .xls or .xlsx!!')"> Add template <i class="fas fa-download"></i></i></button>
				    		<span class="text-danger"> Chú ý * thông tin bắt buộc</span>
				    	</div>
				    </div>								
				</div>
		    </form>
		</div> 
	</div>

	<div class = "row" style="margin-top:50px; padding: 0px;">
		<legend class="text-info">Danh sách mẫu đơn </legend>
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		      <tr>
		        <th class="text-info">ID </th>
		        <th class="text-info">Title</th>
		        <th class="text-info">Last update</th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>
	    	@if(isset($templates))
		    	@foreach($templates as $template)
			    <tr>
			        <td>{{$template->id}}</td>
			        <td>{{$template->title}}</td>
			        <td>{{$template->create_at}}</td>
			        <td>
			        	<a href="{{Route('updatetemplate',array($template->id))}}" class="btn btn-secondary">Update <i class="fas fa-edit"></i></a>
			        	<a href="{{Route('deletetemplate',array($template->id))}}" onclick="return sendAlert('Bạn có muốn xóa mẫu đơn này không ?')" class="btn btn-info">Delete <i class="fas fa-trash-alt"></i></a>
			        </td>
			    </tr>
			    @endforeach
		    @endif
		    </tbody>
  		</table>
	</div>

	@if(isset($templates))
	<div class= "row">
		<ul class="pagination" style="margin: auto;">
			@if($templates->currentPage() != 1)
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$templates->url($templates->currentPage()-1) )!!}">Previous</a></li>
		    @endif

			@for($i = 1; $i <= $templates->lastPage(); $i++)
		    <li class="{!! ($templates->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$templates->url($i) )!!}">{!! $i !!}</a></li>
			@endfor
			@if($templates->currentPage() != $templates->lastPage())
		    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$templates->url($templates->currentPage()+1) )!!}">Next</a></li>
		    @endif
 		 </ul>
	</div>
	@endif

@endsection	
