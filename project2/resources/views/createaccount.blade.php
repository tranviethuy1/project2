<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/createaccount.css')}}">

		<!-- Website Font style -->
	    <link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!-- js -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="{!! asset('js/status_information.js')!!}"></script>
		<title>Create account</title>
		<style type="text/css">
			body{
				background-color: #d3d3d3; 
			}
		</style>
	</head>
	<body>

		<div class="container">
			<div class="row main">
				<div class="panel-heading">

					<div class="status">
						@if(session('error'))
						<span class="alert alert-danger form-control" style="text-align:center;line-height: 10px;">{!! session('error') !!}</span>
					    @endif
					    @if(isset($alert))
					    <span class="alert alert-success form-control" style="text-align:center;line-height: 10px;">{!! $alert !!}</span>
					    @endif
					</div>

	               	<div class="panel-title text-center">
	               		<h1 class="title">Tạo tài khoản</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="{{Route('addaccount')}}">
					{{ csrf_field() }}	
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-user"></i></span>
									<input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name"/>
								</div>
								@if(session()->has('name'))
								<span class="text-danger">{!! session('name')!!}</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-envelope"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>								
								</div>
								@if(session()->has('email'))
								<span class="text-danger">{!! session('email')!!}</span>
								@endif	
							</div>
						</div>
						
						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-unlock"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
								@if(session()->has('pass'))
								<span class="text-danger">{!! session('pass')!!}</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-unlock"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
								</div>
								@if(session()->has('confirm'))
								<span class="text-danger">{!! session('confirm')!!}</span>
								@endif								
							</div>
						</div>
						
						<div class="form-group">
							<label for="male" class="cols-sm-2 control-label">Gender</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-transgender"></i></span>
									<label for = "male" class = "space"></label>
									<label for="male" class="cols-sm-2 control-label">Male</label><input type="radio" class="left-male" name="male" id="male1" value="1" style="margin-left:2px; " />
									<label for = "male" class = "space"></label>
									<label for="male" class="cols-sm-2 control-label">Female</label><input type="radio" class="right-male" name="male" id="male2" value="2" style="margin-left:2px; " />
								</div>
								@if(session()->has('male'))
								<span class="text-danger">{!! session('male')!!}</span>
								@endif								
							</div>
						</div>

						<div class="form-group">
							<label for="address" class="cols-sm-2 control-label">Address</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-address-book"></i></span>
									<input type="text" class="form-control" name="address" id="address"  placeholder="Enter your Address"/>
								</div>
								@if(session()->has('address'))
								<span class="text-danger">{!! session('address')!!}</span>
								@endif								
							</div>
						</div>

						<div class="form-group">
							<label for="birth" class="cols-sm-2 control-label">Birth</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-birthday-cake"></i></span>
									<input type="text" class="form-control" name="birth" id="birth"  placeholder="yyyy-mm-dd"/>
								</div>
								@if(session()->has('birth'))
								<span class="text-danger">{!! session('birth')!!}</span>
								@endif								
							</div>
						</div>

						<div class="form-group">
							<label for="phone" class="cols-sm-2 control-label">Phone</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fas fa-phone"></i></span>
									<input type="text" class="form-control" name="phone" id="phone"  placeholder="Phone Number"/>
								</div>
								@if(session()->has('phone'))
								<span class="text-danger">{!! session('phone')!!}</span>
								@endif								
							</div>
						</div>

						<div class="form-group ">
							<input type="submit" class="btn btn-primary btn-lg btn-block login-button" name = "submit" value ="Register">
						</div>
						<div class="login-register">
				            <a href="{{route('/')}}">Login</a>
				        </div>
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
	</body>
</html>