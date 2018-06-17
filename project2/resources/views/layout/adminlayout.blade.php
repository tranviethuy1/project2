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
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
	<!-- font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	<!-- js -->
	<script src="{!! asset('js/status_information.js')!!}"></script>
	<script src="{!! asset('ckeditor/ckeditor.js')!!}"" type="text/javascript" language="javascript"></script>
	
</head>
<body>
	<?php 
		$id = session('data')['id'];
		$name = session('data')['name'];
	?>
	<!-- header -->
	<header >
		<div class = "row">
			<div class="col-md-4">
				<span class="text-danger" style="font-weight: 700;">
					 Xin chào : 
				</span>
				<span class="text-info" style="font-weight: 700; font-family: Tahoma;">
				{{session('data')['name']}}
				</span>								
			</div>
			<div class="col-md-4"><p class="text-info title_header">Admin Page</p></div>
			<div class="col-md-4">
				<div class="btn-group btn_group">
					  <button type="button" class="btn btn-light "><i class="fas fa-comment-alt"></i> Messenger</button>
					  <button type="button" class="btn btn-light "><i class="fas fa-location-arrow"></i> Reply</button>
					  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user-circle"></i> My Profile</button>
					    <div class="dropdown-menu">
							<form action="{{Route('adminprofile',array($id))}}" method="get" accept-charset="utf-8">
								<button type="submit" class="btn btn-light dropdown-item">
									<i class="fas fa-user-circle"></i><a> Profile</a>
								</button>
							</form>
							<form action="{{Route('updateadmin',array($id))}}" method="get" accept-charset="utf-8">
								<button type="submit" class="btn btn-light dropdown-item">
									<i class="fas fa-edit"></i><a> Update</a>
								</button>
							</form>
							<form action="{{Route('changepassadmin',array($id))}}" method="get" accept-charset="utf-8">
								<button type="submit" class="btn btn-light dropdown-item">
									<i class="fas fa-key"></i><a> Change Pass</a>
								</button>
							</form>		  							
							<form action="{{route('logout')}}" method="get" accept-charset="utf-8">	
							<button type="submit" class="btn btn-light dropdown-item">
							<i class="fas fa-sign-out-alt"></i><a class="text-dark" href="{{Route('logout')}}"> Logout</a>
							</button>
						</form>
					    </div>
				</div> 
			</div>
		</div>
	</header>
	<!-- content -->
	
	<div class="row">
		<img src="{{asset('images/adminheader1.png')}}" alt="header1" class="headerimg">
	</div>

	<div class="row" >
		<!-- sidebar -->
		<div class="col-md-3 panel">
			<div class="panel panel-default sidebar">
			    <div class="panel-heading"><i class="fas fa-home"></i><a class="title" href="{{Route('admin')}}">Home</a></div>
			    <div class="panel-body"><li><i class="fas fa-envelope-open"></i><a href="{{Route('adminnotice')}}" class="title">Add Notice</a></li></div>
			    <div class="panel-body"><li><i class="fas fa-user-secret"></i><a href="{{Route('showuser')}}" class="title">User </a></li></div>
			    <div class="panel-body"><li><i class="fas fa-book"></i><a href="{{Route('projectmanager')}}" class="title">Project </a></li></div>
			    <div class="panel-body"><li><i class="fas fa-chart-bar"></i><a href="{{Route('statistic')}}" class="title">Statistic </a></li></div>
			    <div class="panel-body"><li><i class="fas fa-file"></i><a href="{{Route('admintemplate')}}" class="title">Add Template</a></li></div>
			    <div class="panel-body">
				    <ul class="navbar-nav advance">	
				    	<li class="nav-item dropdown">
				    		<a href="" class="nav-link dropdown-toggle a" data-toggle="dropdown"><i class="fas fa-calculator"></i> <span class="para">Advance</span></a>
				    	    <div class="dropdown-menu menu">  
						        <a class="dropdown-item item" href="{{Route('showunconfirmadvance')}}"><i class="far fa-calendar-times"></i><span class="para">Unconfirmed</span></a>
						        <a class="dropdown-item item" href="{{Route('showconfirmadvance')}}"><i class="far fa-calendar-check"></i><span class="para">Confimred</span></a>
						    </div>
				    	</li>
				    </ul>	
			    </div>
		    </div>
		</div>
		 <!-- extends -->
		 <div class="col-md-9">
		 	<div class="status">
				@if(session('alert'))
				<span class="alert alert-success form-control" style="text-align:center;">{!! session('alert') !!}</span>
			    @endif
			    @if(isset($alert))
			    <span class="alert alert-success form-control" style="text-align:center;">{!! $alert !!}</span>
			    @endif
			</div>
		 	@yield('rightcontent')
		 </div>
	</div>

</body>
</html>