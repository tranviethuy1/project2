<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

		<!-- Website CSS style -->
		<link rel="stylesheet" type="text/css" href="{{URL::asset('css/createaccount.css')}}">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
		
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<title>Create account</title>
		<style type="text/css" media="screen">
			body{
				background-color: #d3d3d3; 
			}
		</style>
		<script type="text/javascript">
			function alertError(value){
				if(value.length != 0){
					alert(value);
				}
			}

			function alertInserted(value){
				alert(value);
			}
		</script>
	</head>
	<body>
		<script type="text/javascript">
			<?php if(session()->has('error')){ ?>
			var value = '<?php echo session('error'); ?>';
			alertError(value);
			<?php session()->forget('error');} ?>
		</script>	
		
		<script type="text/javascript">
			<?php if(isset($alert)){ ?>
			var value = '<?php echo $alert; ?>';
			alertInserted(value);
			<?php } ?>
		</script>

		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Create Account</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="POST" action="{{route('addaccount')}}">
					{{ csrf_field() }}	
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Your Name</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="male" class="cols-sm-2 control-label">Gender</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<label for = "male" class = "space"></label>
									<label for="male" class="cols-sm-2 control-label">Male</label><input type="radio" class="left-male" name="male" id="male1" value="1" />
									<label for = "male" class = "space"></label>
									<label for="male" class="cols-sm-2 control-label">Female</label><input type="radio" class="right-male" name="male" id="male2" value="2" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="address" class="cols-sm-2 control-label">Address</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="address" id="address"  placeholder="Enter your Address"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="birth" class="cols-sm-2 control-label">Birth</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="birth" id="birth"  placeholder="yyyy-mm-dd"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="phone" class="cols-sm-2 control-label">Phone</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="phone" id="phone"  placeholder="Phone Number"/>
								</div>
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

<!-- 		<script type="text/javascript" src="assets/js/bootstrap.js"></script> -->
		<script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
	</body>
</html>