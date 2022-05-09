<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Organic Shop</title>
    
    <!-- Font awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="/frontend/css/font-awesome.css" rel="stylesheet">
    <link href="/frontend/css/bootstrap.css" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="/frontend/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/jquery.simpleLens.css">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="/frontend/css/theme-color/green-theme.css" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="/frontend/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="/frontend/css/style.css" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="/frontend/magiczoomplus/magiczoomplus.css" rel="stylesheet">
    <script src="/frontend/magiczoomplus/magiczoomplus.js"></script>

    <style>
      .top-bn {
  		  background: url("//bizweb.dktcdn.net/100/091/032/themes/113811/assets/shutterstock-bg.jpg?1645171932909") no-repeat;
			  background-size: cover;
        height: 300px;
      }
      .overlay {
        background-color: rgba(0, 0, 0, 0.49);
        width: 100%;
        height: 300px;
        z-index: 10;
      }
    </style>

    
  </head>
  <body> 
     <!-- wpf loader Two -->
    <!-- <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Đang tải</span>
      </div>
    </div>  -->
    <!-- / wpf loader Two -->       
 <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->
  
    <!-- Start header section -->
	<header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
            <!-- start header top left -->
              <div class="aa-header-top-left">
                <!-- start language -->
                
                <div class="cellphone hidden-xs">
                  <p>Organic Shop</p>
                </div>
                <!-- / language -->

                <!-- start cellphone -->
                <div class="cellphone hidden-xs">
                  <p><span class="fa fa-phone"></span>0123.456.888</p>
                </div>
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  @if (Auth::check())
                    <li class="hidden-xs">{{ Auth::user()->name }}</li>
                    <li class="hidden-xs"><a href="{{ url('/logout') }}">Thoát</a></li>
                  @else
                    <li class="hidden-xs"><a href="{{ url('/register') }}">Đăng ký</a></li>
                    <li class="hidden-xs"><a href="{{ url('/login') }}">Đăng nhập</a></li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="{!! URL('/') !!}">
                  <p> <strong>Organic</strong>Shop <span>Thực phẩm lành - Sống khỏe mạnh</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->
              <div class="aa-cartbox">
                <a class="aa-cart-link" href="{!! url('gio-hang') !!}">
                  <span class="fa fa-shopping-cart"></span>
                  <span class="aa-cart-title">GIỎ HÀNG</span>
                  <span class="aa-cart-notify">
                    <?php 
                      $count = Cart::count(); 
                      print_r($count);
                    ?>
                  </span>
                </a>
              </div>
              <!-- / cart box -->
              <!-- search box -->
              @include('frontend.blocks.search')
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
    <!-- menu -->
  <section id="menu">
    <div class="container " style="height: 60px;">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <!-- Start menu -->
          @include('frontend.blocks.menu')
          <!-- End menu -->
        </div>
      </div>       
    </div>
  </section>
  <!-- / menu -->
  <!-- Content pages -->
  
    @yield('content')

  <!-- / Content pages -->

  <!-- / product category -->
    <!-- jQuery library -->
    @yield('my_javascript')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="/frontend/js/bootstrap.js"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="/frontend/js/jquery.smartmenus.js"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="/frontend/js/jquery.smartmenus.bootstrap.js"></script>  
  <!-- To Slider JS -->
  <script src="/frontend/js/sequence.js"></script>
  <script src="/frontend/js/sequence-theme.modern-slide-in.js"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="/frontend/js/jquery.simpleGallery.js"></script>
  <script type="text/javascript" src="/frontend/js/jquery.simpleLens.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="/frontend/js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="/frontend/js/nouislider.js"></script>
  <!-- Custom js -->
  <script src="/frontend/js/custom.js"></script> 

  <!-- My scripts -->
  <script src="/frontend/js/myscript.js"></script> 
  </body>
</html>