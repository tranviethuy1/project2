<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- font family-->
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<!-- font awesome -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">

	<!-- bootstrap -->
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

	 <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="{!! asset('js/status_information.js')!!}"></script>
	<!-- my css and js -->
	  <link rel="stylesheet" type="text/css" href="{!! asset('css/updateprofile.css')!!}">
</head>
<body>
	  <?php 
	    $id = session('data')['id']; 
	    $name = session('data')['name'];
	  ?>
    <div class="container">
    	<div class="row add_product_title">
    		<div class="col-3">
	    		<div class="title_home">
					<a href="{{Route('loadnotices')}}" >Trở về trang chủ
						<i class="fas fa-backward"></i>
					</a>
				</div>
    		</div>
    		<div class="col-7">
    			<div class="text-info title_add_product">Cập nhật thông tin cá nhân</div>
    		</div>
    		<div class="col-4"></div>
    	</div>
		<div class="row add_product_menu">
			<div class="col-lg-6">
			@if(isset($values['imformation']['avatar']))
	          <img src = "{!! asset($values['imformation']['avatar']) !!}" class="image_add_product">
	        @else
	          <img src='http://websamplenow.com/30/userprofile/images/avatar.jpg' class='image_add_product img-thumbnail'>
	        @endif
		    </div>
		  
			<div class="col-lg-6">

				<div class="status" style="margin-top: 15px;">
			    	@if(isset($error))
					<span class="alert alert-success form-control">
						{!! $error !!}
					</span>
				    @endif
			    </div>

				<form  action="{{URL::Route('excuteupdate',array($id))}}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group" >
				    <label for="exampleInputEmail1" >Email</label>
				    <input type="text" class=" form-control input--text" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $values['user']['email'];?>" name="email">
				    @if(session()->has('email'))
					<span class="text-danger">{!! session('email')!!}</span>
					@endif
				</div>
				<div class="form-group" >
				    <label for="1" >Name</label>
				    <input type="text" class=" form-control input--text" id="name" aria-describedby="emailHelp" placeholder="Your Name" value="<?php if(isset($values['user']['name'])){echo $values['user']['name'];} ?>" name="name">
				    @if(session()->has('name'))
					<span class="text-danger">{!! session('name')!!}</span>
					@endif
				</div>

				<div class="form-group">
				    <label for="2">Avatar</label>
				    <input type="file" class="input--file" id="photo"  name="avatar" >
				</div>

				<div class="form-group">
				    <label for="3">Date Of Birth</label>
				    <input type="text" class="form-control input--text" id="dateofbirth" value="<?php if(isset($values['imformation']['birth'])){echo $values['imformation']['birth'];}?>" name="birth">
				    @if(session()->has('birth'))
					<span class="text-danger">{!! session('birth')!!}</span>
					@endif
				</div>

		        <div class="form-group">
				    <label for="4">Gender</label>
				    <div class="malecheck">
					    Male<input id="gender1" name="gender" type="radio" class="form-check" value="1" <?php if(isset($values['imformation']['male'])){if($values['imformation']['male']==1){echo "checked";}} ?> >
					    Female<input id="gender2" name="gender" type="radio" class="form-check" value= "2" <?php if(isset($values['imformation']['male'])){if($values['imformation']['male']==2){echo "checked";}} ?>>				    
			               	@if(session()->has('gender'))
							<span class="text-danger">{!! session('gender')!!}</span>
							@endif
					</div>		
				</div>

				<div class="form-group">
				    <label for="5">Phone Number</label>
				    <input type="text" class="form-control input--text" id="phone" value="<?php echo $values['imformation']['phone'] ;?>" name="phone">
				    @if(session()->has('phone'))
					<span class="text-danger">{!! session('phone')!!}</span>
					@endif
				</div>

				<div class="form-group">
				    <label for="6">Address</label>
				    <input type="text" class="form-control input--text" id="Address" value="<?php echo $values['imformation']['address'] ;?>" name="address">
				    @if(session()->has('address'))
					<span class="text-danger">{!! session('address')!!}</span>
					@endif
				</div>

				  <button type="submit" class="btn btn-primary ">Update Profile <i class="fas fa-edit"></i></button>
			    </form>
		    </div>
		</div>
	</div>
</body>
</html>