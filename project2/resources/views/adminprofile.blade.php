<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User profile </title>
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">
      <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">


    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }

    .othertop{margin-top:10px;}

    .avatar{
      width: 160px;
      height: 160px;
    }

    </style>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-10 ">
        <form class="form-horizontal">
        <fieldset>

        <!-- Form Name -->
        <legend style ="text-align: center;">User profile</legend>

        <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="Name (Full name)">Name</label>  
            <div class="col-md-4">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input id="Name" name="name" type="text" value="<?php echo $values['user']['name'] ;?>" class="form-control input-md" disabled>
              </div>
            </div>
          </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Date Of Birth">Date Of Birth</label>  
          <div class="col-md-4">
            <div class="input-group">
               <div class="input-group-addon"><i class="fa fa-birthday-cake"></i></div>
               <input id="Date Of Birth" name="Date Of Birth" type="text" value ="<?php echo $values['imformation']['birth'] ;?>" class="form-control input-md" disabled>
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="email">Email</label>  
          <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-envelope fa" style="font-size: 20px;"></i></div>
                <input id="email" name="email" type="text" value="<?php echo $values['user']['email'] ;?>" class="form-control input-md" disabled>
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="password">Password</label>  
          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-lock fa-lg" style="font-size: 20px;"></i></div>
              <input id="password" name="password" type="text" value ="<?php echo $values['user']['password'] ;?>" class="form-control input-md" disabled>
            </div>
          </div>
        </div>

        <!-- Multiple Radios (inline) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Gender">Gender</label>
          <div class="col-md-4"> 
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-male" style="font-size: 20px;"></i></div>
              <input id="password" name="gender" type="text" value="<?php if($values['imformation']['male'] == 1){echo "Male";}else{echo "FeMale";} ;?>" class="form-control input-md" disabled>
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Phone number ">Phone number </label>  
          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-phone"></i></div>
              <input id="Phone number " name="phone" type="text" value="<?php echo $values['imformation']['phone'] ;?>" class="form-control input-md" disabled>
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Address"> Address</label>  
          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-address-book"></i></div>
              <input id="Email Address" name="Email Address" type="text" value="<?php echo $values['imformation']['address'] ;?>" class="form-control input-md" disabled>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" ></label>  
          <div class="col-md-4">
            <a href="{{Route('admin')}}" class="btn btn-success">Back to Home <i class="fas fa-chevron-right"></i></a>
          </div>
        </div>

      </fieldset>
    </form>
      </div>

      <div class="col-md-2 hidden-xs">
        @if(isset($values['imformation']['avatar']))
          <img src = "{!! asset($values['imformation']['avatar']) !!}" class="avatar">
        @else
          <img src='http://websamplenow.com/30/userprofile/images/avatar.jpg' class='img-responsive img-thumbnail'>
        @endif
      </div>
    </div>
  </div>

</body>

</html>