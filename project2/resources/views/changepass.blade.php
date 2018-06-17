<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change pass</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="{!! asset('js/status_information.js')!!}"></script>
  <style>
  .span{
    height: 40px;
    line-height: 40px;
    text-align: center;
  }
  input{
    text-align: center;
  }
  </style>
</head>
<body>
	<!-- <?php var_dump($email)?> -->
	
	<div class ="container">
		<div class = "row" style ="margin-top:100px;">
			<div class = "col-md-12">
				<form class="form-horizontal" action="{{URL::Route('excutechangepass',array($id))}}" method="post" accept-charset="utf8">
					{!! csrf_field() !!}
          <div class="status">
            @if(isset($alert))
            <span class="alert alert-danger form-control span" style="padding: 0px;">{!! $alert !!}</span>
              @endif
          </div>
					<fieldset><legend style ="text-align: center ; font-family:Poppins-Regular;">ĐỔI MẬT KHẨU </legend><hr></fieldset>
					 <!-- input -->
					 <div class="form-group">
            <div class="row">
              <div class="col-md-3"></div>
              <label class="col-md-1 control-label" for="Email">Email</label>  
       				<div class="col-md-4">
            		<!-- <i class="fa fa-user icon"></i> -->
                <input id="Email" name="email" type="text" class="form-control" value ="<?php echo $email?>" disabled>
        			</div>
            </div>
          </div>
    			<!-- password -->
    			<div class="form-group">
            <div class="row">
            <div class="col-md-3"></div>
            <label class="col-md-1 control-label" for="password">Password</label>  
     				<div class="col-md-4">
          	     <!-- <i class="fa fa-lock fa-lg icon"></i> -->
                <input id="password" name="pass" type="password" class="form-control" >
                @if(session()->has('pass'))
                <span class="text-danger">{!! session('pass')!!}</span>
                @endif
      			</div>
            </div>
    			</div>
    			<!-- new password -->
    			<div class="form-group">
            <div class="row">
              <div class="col-md-3"></div>
              <label class="col-md-1 control-label" for="new password">New </label>  
     				     <div class="col-md-4">
<!--           			<i class="fa fa-lock fa-lg icon"></i> -->
          			 <input id="newpass" name="newpass" type="password" class="form-control" >
                  @if(session()->has('new'))
                 <span class="text-danger">{!! session('new')!!}</span>
                 @endif                 
      			   </div>
            </div>
    			</div>
    			<!-- confirm password -->
    			<div class="form-group">
            <div class="row">
              <div class="col-md-3"></div>
              <label class="col-md-1 control-label" for="confirm password">Confirm</label>  
     				 <div class="col-md-4">
          			<!-- <i class="fa fa-lock fa-lg icon"></i> -->
          			<input id="confirm" name="confirmpass" type="password" class="form-control" >
                 @if(session()->has('confirm'))
                <span class="text-danger">{!! session('confirm')!!}</span>
                @endif
      			 </div>
            </div>
    			</div>
    			<!-- button -->
    			<div class="form-group">
            <div class="row">
    				  <label class="col-md-4 control-label" ></label>  
   				   <div class="col-md-4">
          	 <button type ="submit" class="btn btn-success"><span class="glyphicon glyphicon-thumbs-up"></span> Submit <i class="fas fa-arrow-alt-circle-up"></i></button>  
          	 <a href="{{Route('employeepage')}}" class="btn btn-danger" ><span class="glyphicon glyphicon-remove-sign"></span>Back to Home <i class="fas fa-arrow-alt-circle-left"></i></a>
    			   </div>
            </div> 
 				 </div>
				</form>			
			</div>
		</div>
	</div>
</body>
</html>