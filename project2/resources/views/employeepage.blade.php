<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Employeepage</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/employee.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:100" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
</head>
<body>
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
							<button type="button" class="btn btn-light"><i class="fas fa-graduation-cap"></i>Introduce</button>
	  						<button type="button" class="btn btn-light"><i class="fas fa-location-arrow"></i>Question</button>
	  						
	  						<div class="btn-group">
	  							<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i class="fas fa-home"></i>  My Profile</button>
	  							<div class="dropdown-menu">
	  								<button type="button" class="btn btn-light dropdown-item"><i class="fas fa-user-circle"></i>Profile</button>
	  								<button type="button" class="btn btn-light dropdown-item">
	  									<i class="fab fa-themeisle"></i>  Update</button>
	  								<button type="button" class="btn btn-light dropdown-item">
									<i class="fas fa-sign-out-alt"></i>  Logout</button>
	  							</div>
	  						</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div class="header--inner header--pc">
			<div class="container">
				<div class="row">
					<div class="col-md-3 header--logo">
						<a href="{{route('employeepage')}}">
							<img src="{{URL::asset('images/House-icon.png')}}" alt="" class="img-fluid">
						</a>
						<div class="btn--navbar float-right">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    							<span class="fa fa-bars"></span>
  							</button>
						</div>
						
  					</div>
					<div class="col-md-9 form-search-md">
						<div class="row">
							<div class="col-10">
								<div class="header__search">
									
									<form action="#" method="get" accept-charset="utf-8">
										<div class="input-group">
		  								<input type="text" class="form-control" placeholder="Search something" aria-label="Recipient's username" aria-describedby="basic-addon2">
										  <div class="input-group-append">
										    <!-- <button class="btn btn-outline-secondary" type="button">Button</button> -->
										    <button class="btn 
										    fa fa-search btn--search" type="submit" value ></button>
										</div>
									</div>
									</form>
								</div>

							</div>

							<div class="col-2 header--cart">
								<button type="button" class="btn btn--cart">
									Search
								</button>
							</div>
						</div>

						<div class = "row username">
							<?php
							if(session()->has('name')){
							?>	
								<p class ="text-secondary"><?php echo "Hello ".session('name')." ";}?><i class ="fas fa-heart"></i><i class ="fas fa-heart"></i><i class ="fas fa-heart"></i></p>;
						</div>
					</div>
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
				    <div class="panel panel-default" style ="background: #f5f5f5; height: 900px;">
					    <div class="panel-heading title_home"><i class="fas fa-home"></i><a href="#">Home</a></div>
					    <div class="panel-body"><li><i class="fas fa-check-square"></i><a href="#" class="title">Check project</a></li></div>
					    <div class="panel-body"><li><i class="fas fa-clipboard"></i><a href="#" class="title">Advance</a></li></div>
					    <div class="panel-body"><li><i class="fas fa-history"></i><a href="#" class="title">Histoty</a></li></div>
					    <div class="panel-body"><li><i class="fas fa-envelope-open"></i><a href="#" class="title">Notice</a></li></div>
					    <div class="panel-body"><li><i class="fa fa-heart"></i><a href="#" class="title">Check project</a></li></div>
				    </div>
				</div>

				<div class="col-md-9" style="">
					<div class ="row"><h4 class ="text-danger regulation">Regulations</h4> </div>
					<div class ="row"><h4 class ="text-dark">User object</h4></div>
					<div class ="row"><p class ="text-secondary regulation">Cán bộ, công chức, viên chức, lao động hợp đồng theo quy định của pháp luật làm việc tại các cơ quan nhà nước, đơn vị sự nghiệp công lập, tổ chức chính trị, tổ chức chính trị - xã hội, các tổ chức hội sử dụng kinh phí do ngân sách nhà nước hỗ trợ.</p></div>
					<div class ="row"><h4 class ="text-dark">Rules</h4></div>
					<div class ="row">
						<ol class ="rules">
							<li><p class ="text-secondary regulation"> Công tác phí là khoản chi phí để trả cho người đi công tác trong nước, bao gồm: Chi phí đi lại, phụ cấp lưu trú, tiền thuê phòng nghỉ nơi đến công tác, cước hành lý và tài liệu mang theo để làm việc (nếu có).</p></li>
							<li><p class ="text-secondary regulation"> Thời gian được hưởng công tác phí là thời gian công tác thực tế theo văn bản phê duyệt của người có thẩm quyền cử đi công tác hoặc giấy mời tham gia đoàn công tác (bao gồm cả ngày nghỉ, lễ, tết theo lịch trình công tác, thời gian đi đường).</p></li>	
							<li><p class="text-secondary regulation"> Điều kiện để được thanh toán công tác phí bao gồm:</p>
								<ul style="list-style-type: none">
									<li><p class="text-secondary regulation">Thực hiện đúng nhiệm vụ được giao.</p></li>
									<li><p class="text-secondary regulation"> Được thủ trưởng cơ quan, đơn vị cử đi công tác hoặc được mời tham gia đoàn công tác.</p></li>
									<li><p class="text-secondary regulation">Có đủ các chứng từ để thanh toán theo quy định tại Thông tư này.</p></li>
								</ul>		
							</li>
							<li><p class="text-secondary regulation"> Những trường hợp sau đây không được thanh toán công tác phí:</p>
								<ul style="list-style-type: none">
									<li><p class="text-secondary regulation">Thời gian điều trị, điều dưỡng tại cơ sở y tế, nhà điều dưỡng, dưỡng sức.</p></li>
									<li><p class="text-secondary regulation">  Những ngày học ở trường, lớp đào tạo tập trung dài hạn, ngắn hạn đã được hưởng chế độ đối với người đi học.</p></li>
									<li><p class="text-secondary regulation">Những ngày làm việc riêng trong thời gian đi công tác.</p></li>
									<li><p class="text-secondary regulation">Những ngày được giao nhiệm vụ thường trú hoặc biệt phái tại một địa phương hoặc cơ quan khác theo quyết định của cấp có thẩm quyền.</p></li>
								</ul>		
							</li>
							<li><p class ="text-secondary regulation">Thủ trưởng cơ quan, đơn vị phải xem xét, cân nhắc khi cử người đi công tác (về số lượng người và thời gian đi công tác) bảo đảm hiệu quả công tác, sử dụng kinh phí tiết kiệm.</p></li>
							<li><p class ="text-secondary regulation">Cơ quan, đơn vị cử người đi công tác có trách nhiệm thanh toán các khoản công tác phí cho người đi công tác, trừ trường hợp được quy định cụ thể tại khoản 4 Điều này.</p></li>	
							<li><p class ="text-secondary regulation">Trong những ngày được cử đi công tác nếu do yêu cầu công việc phải làm thêm giờ thì ngoài chế độ phụ cấp lưu trú còn được thanh toán tiền lương làm đêm, làm thêm giờ đối với cán bộ, công chức, viên chức theo quy định hiện hành. Thủ trưởng cơ quan, đơn vị chịu trách nhiệm quy định cụ thể trong quy chế chi tiêu nội bộ: Thủ tục xác nhận làm thêm giờ làm căn cứ thanh toán; quy định các trường hợp đi công tác được thanh toán tiền lương làm thêm giờ, đảm bảo nguyên tắc chỉ được thanh toán trong trường hợp được người có thẩm quyền cử đi công tác phê duyệt làm thêm giờ, không thanh toán cho các trường hợp đi công tác kết hợp giải quyết việc riêng trong những ngày nghỉ và không thanh toán tiền lương làm đêm, làm thêm giờ trong thời gian đi trên các phương tiện như tàu, thuyền, máy bay, xe ô tô và các phương tiện khác.</p></li>																				
						</ol>
					</div>
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

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>