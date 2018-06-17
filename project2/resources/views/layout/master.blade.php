<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Page</title>
	<!-- bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/employee.css')}}">
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

	<header>
		<div class="header--toolbar">
			<div class="container">
				<div class="row">
					<div class="header--social col-md-6">
						<ul>
							<li class="header--social__item">
								<a href="https://www.facebook.com/"><img src="{{URL::asset('images/icons/icons8-facebook.png')}}" alt="fb" class="img-fluid" />
								</a>
							</li>
							<li class="header--social__item">
								<a href="https://www.facebook.com/"><img src="{{URL::asset('images/icons/message-group-filled.png')}}" alt="tw" class="img-fluid"/>
								</a>
							</li>
							<li class="header--social__item">
								<a href="https://www.facebook.com/"><img src="{{URL::asset('images/icons/icons8-instagram.png')}}" alt="g+" class="img-fluid"/>
								</a>
							</li>
							<li class="header--social__item">
								<a href="https://www.facebook.com/"><img src="{{URL::asset('images/icons/icons8-youtube-50.png')}}" alt="IG" class="img-fluid"/>
								</a>
							</li>
						</ul>
					</div>

					<div class="header--button col-md-6">
						<div class="btn-group">
							<button type="button" class="btn btn-light"><i class="fas fa-external-link-alt"></i><a class="text-dark" href="{{Route('introduce')}}"> Introduce</a></button>
	  						<button type="button" class="btn btn-light"><i class="fas fa-location-arrow"></i> Question</button>
	  						
	  						<div class="btn-group">
	  							<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user-circle"></i> My Profile</button>
	  							<div class="dropdown-menu">
	  								<form action="{{URL::Route('profile',array($id))}}" method="get" accept-charset="utf-8">
		  								<button type="submit" class="btn btn-light dropdown-item">
		  									<i class="fas fa-user-circle"></i><a> Profile</a>
		  								</button>
		  							</form>
		  							<form action="{{URL::Route('updateprofile',array($id))}}" method="get" accept-charset="utf-8">
		  								<button type="submit" class="btn btn-light dropdown-item">
		  									<i class="fas fa-edit"></i><a> Update</a>
		  								</button>
		  							</form>
		  							<form action="{{URL::Route('changepass',array($id))}}" method="get" accept-charset="utf-8">
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

						<div class="row" style="margin-left: 350px;">
  							<span class="text-danger" style="font-weight: 700;">
								 Xin chào : 
							</span>
							<span class="text-info" style="font-weight: 700; font-family: Tahoma;">
							{{session('data')['name']}}
							</span>								
  						</div>	
					</div>
				</div>
			</div>
			
		</div>
<!-- 	<script type="text/javascript">
		$(document).ready(function(){
			$("#slideshow > div:gt(0)").hide();
			setInterval(function() { 
			  $('#slideshow > div:first')
			    .fadeOut(1000)
			    .next()
			    .fadeIn(1000)
			    .end()
			    .appendTo('#slideshow');
			},  3000);
		});
	</script>
 -->
		<div class="header--inner header--pc">
				<div class ="row">
					<div class="col-md-3">
						<img src="{{asset('images/law.png')}}" alt="congtac" style="margin-left:50px; height: 260px;width: 280px;">	
					</div>
					<div class="col-md-6">
						<div id="slideshow">
							<div><img src="{{asset('images/congtac.jpg')}}" style="height: 260px;width: 630px;margin-left:30px; "></div>
							<!-- <div><img src="{{asset('images/congtac2.jpg')}}" style="height: 260px;width: 630px;"></div> -->
						</div>
					</div>
					<div class="col-md-3">
						<img src="{{asset('images/bachkhoa.png')}}" alt="congtac" style="height: 260px;width: auto;margin-left:20px; ">	
					</div>
				</div>
		</div>

	</header>
	<body>
	<!-- /content -->
	<div class="content">
		<div class="container">
			<!-- Sidebar -->
			<div class="row">
				<div class="col-md-3 panel">
				    <div class="panel panel-default sidebar">
					    <div class="panel-heading title_home"><i class="fas fa-home"></i><a href="{{Route('loadnotices')}}" class="title">Home</a></div>
					    <div class="panel-body"><li><i class="fas fa-check-square"></i><a href="{{URL::Route('checkproject',array($id))}}" class="title">Check project</a></li></div>
					    <div class="panel-body"><li><i class="fas fa-clipboard"></i><a href="{{Route('advanceview',array($id))}}" class="title">Advance</a></li></div>
					    <div class="panel-body"><li><i class="fas fa-history"></i><a href="{{Route('history',array($id))}}" class="title">History</a></li></div>
					    <div class="panel-body"><li><i class="fas fa-book"></i><a href="{{Route('payment',array($id))}}" class="title">Payment</a></li></div>
					    <!-- <div class="panel-body"><li><i class="fas fa-envelope-open"></i><a href="{{Route('loadnotices')}}" class="title">Notice</a></li></div> -->
					    <div class="panel-body"><li><i class="fas fa-file"></i><a href="{{Route('listtemplate')}}" class="title">Template</a></li></div>
						<div class="panel-body"><video src="http://www.w3schools.com/html/mov_bbb.mp4" width="285" height="285" controls loop>Your browser does not support.</video></div>
						<div class="panel-body"><iframe src="https://player.vimeo.com/video/11774747" width="285" height="285" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
				    </div>
				</div>

				<div class="col-md-9">
					<div class="status">
						@if(session('alert'))
						<span class="alert alert-success form-control">{!! session('alert') !!}</span>
					    @endif
					    @if(isset($alert))
					    <span class="alert alert-success form-control">{!! $alert !!}</span>
					    @endif
					</div>
					@yield('rightcontent')
				</div>
			</div>
		</div>
	</div>	
	<body>
	<footer>
		<div class="container">
			<div class="footer-menu">
			 	<ul class="menu">
			 		<li class="footer-menu-item menu-home">
			 			<a href="#">Share</a>
			 		</li>	
			 		<li class="footer-menu-item">
			 			<a href="#">Blog</a>
			 		</li>
			 		<li class="footer-menu-item">
			 			<a href="#">Help</a>
			 		</li>
			 		<li class="footer-menu-item">
			 			<a href="#">About us</a>
			 		</li>
			 		<li class="footer-menu-item">
			 			<a href="#">Contact us</a>
			 		</li>
			 	</ul>
			 	<div class="payment">
			 		<div class="row">
			 			<div class="col-3">
			 				<a href="#">
			 					<img src="https://www.agrifj.co.uk/images/icons/visa.png" alt="visa" class="img-fluid" />
			 				</a>
			 			</div>
			 			<div class="col-3">
				 			<a href="#">
				 				<img src="https://www.mur-tackle-shop.de/mediafiles/tpl/zahlung-paypal.png" alt="paypal" class="img-fluid" />
				 			</a>
			 			</div>
			 			<div class="col-3">
				 			<a href="#">
				 				<img src="https://www.agrifj.co.uk/images/icons/master-card.png" alt="master card" class="img-fluid"/>
				 			</a>
			 			</div>
			 			<div class="col-3">
				 			<a href="#">
				 				<img src="https://uswitch-cms.imgix.net/uswitch-mobiles/mobiles-original-images/retailers/mobiles-co-uk.png?w=100&h=50" alt="mobile banking" class="img-fluid"/>
				 			</a>
			 			</div>
			 		</div>		
			 	</div>
			 </div>
			<div class ="fs-ftbott">
				<p style ="text-align: center;">Bản quyền thuộc về Trường Đại học Bách khoa Hà Nội.</p>
				<p style ="text-align: center;">Địa chỉ: Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội.</p>
				<p style ="text-align: center;">Điện thoại: 0243 623 1732 - 0243 868 0898.</p>
			</div>

		</div>
		

	</footer>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>