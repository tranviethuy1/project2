<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update profile </title>
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">
  <script src="{!! asset('js/status_information.js')!!}"></script>

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }

    .othertop{margin-top:10px;}

    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <?php 
      $id = $values['user']['id'];
      $name = $values['user']['name'];
    ?>
  <div class="container">
    <div class="row">
      <div class="col-md-10 ">
        <form class="form-horizontal" action="{{URL::Route('excuteupdate',array($id))}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <fieldset>
        <!-- Form Name -->
          <div class="status">
            @if(isset($error))
            <span class="alert alert-danger form-control" style="margin: auto;">{!! $error !!}</span>
              @endif
          </div>
        <legend style ="text-align: center;">Update profile</legend>

        <!-- Text input-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="Name (Full name)">Name</label>  
            <div class="col-md-4">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input id="Name" name="name" type="text" value="<?php echo $values['user']['name'] ;?>" class="form-control input-md">
              </div>
            </div>
          </div>

        <!-- File Button --> 
          <div class="form-group">
            <label class="col-md-4 control-label" for="Upload photo">Upload photo</label>
            <div class="col-md-4"><input id="photo" name="avatar" class="input-file" type="file"></div>
          </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Date Of Birth">Date Of Birth</label>  
          <div class="col-md-4">
            <div class="input-group">
               <div class="input-group-addon"><i class="fa fa-birthday-cake"></i></div>
               <input id="Date Of Birth" name="birth" type="text" value ="<?php echo $values['imformation']['birth'] ;?>" class="form-control input-md">
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="email">Email</label>  
          <div class="col-md-4">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-envelope fa" style="font-size: 20px;"></i></div>
                <input id="email" name="email" type="text" value="<?php echo $values['user']['email'] ;?>" class="form-control input-md" >
            </div>
          </div>
        </div>


        <!-- Multiple Radios (inline) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Gender">Gender</label>
          <div class="col-md-4"> 
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-male" style="font-size: 20px;"></i></div>
              <input id="gender" name="gender" type="text" value="<?php if($values['imformation']['male'] == 1){echo "Male";}else{echo "FeMale";} ;?>" class="form-control input-md" >
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Phone number ">Phone number </label>  
          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-phone"></i></div>
              <input id="Phone " name="phone" type="text" value="<?php echo $values['imformation']['phone'] ;?>" class="form-control input-md" >
            </div>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="Address"> Address</label>  
          <div class="col-md-4">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-address-book"></i></div>
              <input id="Email Address" name="address" type="text" value="<?php echo $values['imformation']['address'] ;?>" class="form-control input-md" >
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" ></label>  
          <div class="col-md-4">
            <?php 
            $id = $values['user']['id'];
            $name = $values['user']['name'];
            ?>
          <button type="submit" class="btn btn-success">Upload Profile<i class="fas fa-file"></i></button>  
          <a href="{{URL::Route('employeeback',array('id'=>$id,'name'=>$name))}}" class="btn btn-danger" value="">Back to home<i class="fas fa-arrow-circle-right"></i></a> 
          </div>
        </div>

      </fieldset>
    </form>
      </div>

      <div class="col-md-2 hidden-xs">
        @if(isset($values['imformation']['avatar']))
          <img style ="width: 160px;height: 160px;"  src = "{!! asset($values['imformation']['avatar']) !!}" class="avatar">
        @else
          <img src='http://websamplenow.com/30/userprofile/images/avatar.jpg' class='img-responsive img-thumbnail'>
        @endif
      </div>
    </div>
  </div>

</body>

</html>