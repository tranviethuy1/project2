<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Page</title>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/admin.css')}}">
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	<!-- js -->
	<script src="{!! asset('js/status_information.js')!!}"></script>

</head>
<body>
	<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>
	<!-- header -->
	<header >
		<div class = "row">
			<div class="col-md-4"></div>
			<div class="col-md-4"><p class="text-info title_header">Admin Page</p></div>
			<div class="col-md-4">
				<div class="btn-group btn_group">
					  <button type="button" class="btn btn-light "><i class="fas fa-comment-alt"></i> Messenger</button>
					  <button type="button" class="btn btn-light "><i class="fas fa-location-arrow"></i> Reply</button>
					  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user-circle"></i> My Profile</button>
					    <div class="dropdown-menu">
							<form action="{{Route('adminprofile',array($id))}}" method="get" accept-charset="utf-8">
								<button type="submit" class="btn btn-light dropdown-item">
									<i class="fas fa-user-circle"></i><a>Profile</a>
								</button>
							</form>
							<form action="{{Route('updateadmin',array($id))}}" method="get" accept-charset="utf-8">
								<button type="submit" class="btn btn-light dropdown-item">
									<i class="fas fa-edit"></i><a>Update</a>
								</button>
							</form>
							<form action="{{Route('changepassadmin',array($id))}}" method="get" accept-charset="utf-8">
								<button type="submit" class="btn btn-light dropdown-item">
									<i class="fas fa-key"></i><a>Change Pass</a>
								</button>
							</form>		  							
							<form action="{{route('logout')}}" method="get" accept-charset="utf-8">	
							<button type="submit" class="btn btn-light dropdown-item">
							<i class="fas fa-sign-out-alt"></i><a href="{{Route('logout')}}">Logout</a>
						</button>
						</form>
					    </div>
				</div> 
			</div>
		</div>
	</header>
	<!-- content -->

	<div class="row" style="margin:10px 0px 0px 10px;">
		<!-- sidebar -->
		<div class="col-md-3 panel">
			<div class="panel panel-default sidebar">
			    <div class="panel-heading"><i class="fas fa-home"></i><a class="title" href="{{Route('admin')}}">Home</a></div>
			    <div class="panel-body"><li><i class="fas fa-envelope-open"></i><a href="" class="title">Add Notice</a></li></div>
			    <div class="panel-body"><li><i class="fas fa-user-secret"></i><a href="" class="title">User </a></li></div>
			    <div class="panel-body"><li><i class="fas fa-book"></i><a href="" class="title">Project </a></li></div>
			    <div class="panel-body"><li><i class="fas fa-calculator"></i><a href="" class="title">Payment</a></li></div>
		    </div>
		</div>
		 <!-- extends -->
		 <div class="col-md-9">
		 	<div class="status">
				@if(session('alert'))
				<span class="alert alert-success form-control" style="margin: auto;">{!! session('alert') !!}</span>
			    @endif
			    @if(isset($alert))
			    <span class="alert alert-success form-control" style="margin: auto;">{!! $alert !!}</span>
			    @endif
			</div>
		 	@yield('rightcontent')
		 </div>
	</div>

</body>
</html>