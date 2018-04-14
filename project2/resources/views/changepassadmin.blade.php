<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change pass</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="{!! asset('js/status_information.js')!!}"></script>
  <style>
    .form-control{
        line-height: 15px;
        text-align: center;
    }
  </style>
</head>
<body>
	
	<div class ="container">
		<div class = "row" style ="margin-top:100px;">
			<div class = "col-sm-11">
				<form class="form-horizontal" action="{{URL::Route('excutechangepassadmin',array($id))}}" method="post" accept-charset="utf8">
					{!! csrf_field() !!}
          <div class="status">
            @if(isset($alert))
            <span class="alert alert-success form-control" style="margin: auto;">{!! $alert !!}</span>
              @endif
          </div>
					<fieldset><legend style ="text-align: center ; font-family:Poppins-Regular;">Change Pasword</legend></fieldset>
					<!-- input -->
					<div class="form-group"><label class="col-md-4 control-label" for="Email">Email</label>  
           				<div class="col-md-4">
              				<div class="input-group">
                			<div class="input-group-addon"><i class="fa fa-user"></i></div>
                			<input id="Email" name="email" type="text" class="form-control input-md" value ="<?php echo $email?>" disabled>
              				</div>
            			</div>
          			</div>
          			<!-- password -->
          			<div class="form-group"><label class="col-md-4 control-label" for="password">Password</label>  
           				<div class="col-md-4">
              				<div class="input-group">
                			<div class="input-group-addon"><i class="fa fa-lock fa-lg"></i></div>
                			<input id="password" name="pass" type="password" class="form-control input-md" >
              				</div>
            			</div>
          			</div>
          			<!-- new password -->
          			<div class="form-group"><label class="col-md-4 control-label" for="new password">New </label>  
           				<div class="col-md-4">
              				<div class="input-group">
                			<div class="input-group-addon"><i class="fa fa-lock fa-lg"></i></div>
                			<input id="newpass" name="newpass" type="password" class="form-control input-md" >
              				</div>
            			</div>
          			</div>
          			<!-- confirm password -->
          			<div class="form-group"><label class="col-md-4 control-label" for="confirm password">Confirm</label>  
           				<div class="col-md-4">
              				<div class="input-group">
                			<div class="input-group-addon"><i class="fa fa-lock fa-lg"></i></div>
                			<input id="confirm" name="confirmpass" type="password" class="form-control input-md" >
              				</div>
            			</div>
          			</div>
          			<!-- button -->
          			<div class="form-group">
          				<label class="col-md-4 control-label" ></label>  
         				<div class="col-md-4">
			        	<button type ="submit" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Submit</button>  
			        	<a href="{{URl::Route('admin')}}" class="btn btn-danger" ><span class="glyphicon glyphicon-remove-sign"></span>Back to Home</a>
          				</div>
       				 </div>
				</form>			
			</div>
		</div>
	</div>
</body>
</html>