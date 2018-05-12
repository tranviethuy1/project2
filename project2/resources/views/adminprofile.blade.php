<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- font family-->
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300&amp;subset=vietnamese" rel="stylesheet">  
  
  <!-- font awesome -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('fonts/font-awesome-4.7.0/css/fontawesome-all.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:600" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:300" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- jquery -->
  <!-- my css and js -->
  <link rel="stylesheet" type="text/css" href="{!! asset('css/profile.css')!!}">
  <script src="{!! asset('js/owl.carousel.min.js')!!}"></script>   
</head>
<body>
  <?php 
    $id = session('data')['id']; 
    $name = session('data')['name'];
  ?>
  <div class="profile">
    <div class="container">
      <div class="row">
        <div class="col-1"></div>
        <div class="col-5 col--5--left">
          <div class="big--avatar">
            <div class=" thoi thoi1">
              <div class=" thoi thoi2">
                <div class=" thoi thoi3">
                  <div class=" thoi thoi4">
                    @if(isset($values['imformation']['avatar']))
                    <img src="{!! asset($values['imformation']['avatar']) !!}" alt="" class="img-fluid"/>
                    @else
                    <img src="{!! asset('http://websamplenow.com/30/userprofile/images/avatar.jpg') !!}" alt="" class="img-fluid"/>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="big--name">
            <h3>
              @if(isset($values['user']['name']))
                {{$values['user']['name']}}
              @endif
            </h3>
          </div>
          <div class="big-back-to-home">
            <a href="{{Route('admin')}}" class="btn btn-primary"> 
              <i class="fas fa-home"></i>
            </a>

            <a href="{{Route('updateadmin',array($id))}}" class="btn btn-primary update"> 
              <i class="fas fa-pen-square"></i>
            </a>
          </div>
        </div>
        <div class="col-5 col--5-right">
          <div class="profile--content">
            <div class="profile--avatar">
              @if(isset($values['imformation']['avatar']))
                <img src="{!! asset($values['imformation']['avatar']) !!}" alt="" class="img-fluid"/>
              @else
                <img src="{!! asset('http://websamplenow.com/30/userprofile/images/avatar.jpg') !!}" alt="" class="img-fluid"/>
              @endif
            </div>
            <div class="profile--name">
              @if(isset($values['user']['name']))
                {{$values['user']['name']}}
              @endif
            </div>

            <div class="profile--contact">
              <div class="profile--phone">
                <p class="profile--title">
                  <i class="fas fa-phone"></i> Mobile
                </p>
                <p class="profile--data">
                  {{$values['imformation']['phone']}}
                </p>
              </div>
              <div class="profile--mail">
                <p class="profile--title">
                  <i class="fas fa-envelope"></i> Email
                </p>
                <p class="profile--data">
                  {{$values['user']['email']}}
                </p>
                
              </div>
            </div>

            <div class="profile--infor">
              <div class="profile--address">
                <p class="profile--title">
                  <i class="fas fa-address-card"></i> Address
                </p>
                <p class="profile--data">
                  {{$values['imformation']['address']}}
                </p>
              </div>
              <div class="profile--gender">
                <p class="profile--title">
                  <i class="fas fa-transgender"></i> Gender
                </p>
                <p class="profile--data">
                  @if(isset($values['imformation']['male']))
                    @if($values['imformation']['male'] == 1)
                      Male
                    @else
                      Female
                    @endif
                  @endif
                </p>
              </div>
              <div class="birthday">
                <p class="profile--title">
                  <i class="fas fa-birthday-cake"></i> Birthday
                </p>
                <p class="profile--data">
                  @if(isset($values['imformation']['birth']))
                    {{$values['imformation']['birth']}}
                  @endif
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-1"></div>
      </div>
    </div>
  </div>
    
<!-- script carousel -->
    <script>
            $(document).ready(function() {
              $('.list').owlCarousel({
                loop: true,
                responsiveClass: true,
                responsive: {
                  0: {
                    items: 1,
                    
                  },
                  600: {
                    items: 2,
                    margin: 60,
                    
                  },
                  960:{
                  items:3
              },
                  1000: {
                    items: 5,
                    loop: true,
                  }
                }
              })
            })
        </script>

        <script>
            var owl = $('.gallery--list');
      owl.owlCarousel({
          loop:true,
          nav:false,
          margin:5,
          autoplay:true,
          autoplayTimeout:3000,
          autoplayHoverPause:true,
          responsive:{
              0:{
                  items:1
              },
              600:{
                  items:2
              },            
              960:{
                  items:3
              },
              1200:{
                  items:4
              }
          }
      });
      owl.on('mousewheel', '.owl-stage', function (e) {
          if (e.deltaY>0) {
              owl.trigger('next.owl');
          } else {
              owl.trigger('prev.owl');
          }
          e.preventDefault();
      });
        </script>

</body>
</html>