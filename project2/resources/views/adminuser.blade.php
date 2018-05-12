@extends('layout.adminlayout')
@section('rightcontent')

<style >
	.avatar{
		width: 50px;
		height: 50px;
	}	

	.center{
		margin: auto;
	}
</style>
	
	<div class="row"><legend class ="text-info" style ="text-align: left;">Show all Employee</legend></div>
	<form action="{{Route('finduser')}}" method="post" accept-charset="utf-8">
		<div class="form-group">
			<div class="row">
				<div class="col-md-5" >
					{!! csrf_field() !!}
					<input type="text" id="search_employee" class="form-control" placeholder="Name Employee" name="employee">
				</div>
				<div class="col-md-4">
					<button type="submit" class="btn btn-success" style="width: 130px;" onclick="return findMessage('Make sure! You enter one name!!')" name="submit">Find user <i class="fas fa-arrow-alt-circle-right"></i></button>
				</div>
			</div>
		</div>
	</form>		

		<!-- search live -->
		<script type="text/javascript">
		$(document).ready(function(){	
			$('#search_employee').on('keyup',function(){
				$value = $(this).val();
				$.ajax({
					type: 'get',
					url: "{!! url('searchemployee') !!}",
					data: {'name_employee': $value},
					success:function(data){
						$('tbody').html(data);
					}
				});
			});
		});

		function findMessage(msg){
			if(window.confirm(msg)){
				return true;
			}
			return false;
		};
		</script>

		<div class="row" style="margin-top: 20px;margin-left: 0px;">
			<table class="table table-bordered table-striped">
			    <thead>
			      <tr>
			        <th>ID</th>
			        <th>Avatar</th>
			        <th>Name</th>
			        <th>Email</th>
			        <th>Posision</th>
			        <th>Male</th>
			        <th>Birth</th>
			        <th>Address</th>
			        <th>Phone</th>
			        <th></th>
			      </tr>
			    </thead>
		 		<tbody>				    
		 	@if(isset($users))	
			    @foreach($users as $user)
			    	<?php $imformation = \App\Imformations::where('id_employee',$user->id)->first(); ?>
			      	<tr>
				        <td>{{$user->id}}</td>
				        <td>
				        	@if(isset($imformation->avatar))
				        		<img src = "{!! asset($imformation->avatar) !!}" class="avatar">
				        	@else
				        		<img src='http://websamplenow.com/30/userprofile/images/avatar.jpg' class='avatar'>
				        	@endif
				        </td>
				        <td>{{$user->name}}</td>
				        <td>{{$user->email}}</td>
				        <td><?php if($user->posision == 1){echo "Employee";}else{echo "Admin";} ?></td>
				        <td><?php if($imformation->male == 1){echo "Male";}else{echo "Female";} ?></td>
				        <td>{{$imformation->birth}}</td>
				        <td>{{$imformation->address}}</td>
				        <td>{{$imformation->phone}}</td>
				        <td>
				        	<a href="{{Route('resetpassword',array($user->id))}}" onclick="return ResetMesenger('Do you want to reset password?')" class="btn btn-info">Reset <i class="fas fa-database"></i></a>
				        </td>
			      	</tr>
			    @endforeach
			@endif
			</tbody> 
			</table>
		</div>
		
		<script type="text/javascript">
			function ResetMesenger(msg){
				if(window.confirm(msg)){
					return true;
				}
				return false;
			};
		</script>
		@if(isset($users))
		<div class= "row">
			<ul class="pagination center">
				@if($users->currentPage() != 1)
			    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$users->url($users->currentPage()-1) )!!}">Previous</a></li>
			    @endif

				@for($i = 1; $i <= $users->lastPage(); $i++)
			    <li class="{!! ($users->currentPage() == $i) ? 'active' : 'page-item' !!}"><a class="page-link" href="{!! str_replace('/?','?',$users->url($i) )!!}">{!! $i !!}</a></li>
				@endfor
				@if($users->currentPage() != $users->lastPage())
			    	<li class="page-item"><a class="page-link" href="{!! str_replace('/?','?',$users->url($users->currentPage()+1) )!!}">Next</a></li>
			    @endif
	 		 </ul>
		</div>
		@endif

@endsection