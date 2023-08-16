<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<!-- Meta -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

      @include('partials.seo')

    <title>{{ $general->sitename(__($pageTitle)) }}</title>
	<!-- Google Fonts css-->
	<link href="//fonts.googleapis.com/css?family=Playfair+Display:400,700,700i,900%7CPoppins:300,400,500,600,700,800,900" rel="stylesheet">
	<!-- Bootstrap css -->
	<link href="{{ asset($activeTemplateTrue. 'front/layout2/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
	<!-- Font Awesome icon css-->
	<link href="{{ asset($activeTemplateTrue. 'front/layout2/css/font-awesome.min.css')}}" rel="stylesheet" media="screen">
	<link href="{{ asset($activeTemplateTrue. 'front/layout2/css/flaticon.css')}}" rel="stylesheet" media="screen">
	<!-- Swiper's CSS -->
	<link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'front/layout2/css/swiper.min.css')}}">
	<!-- Animated css -->
	<link href="{{ asset($activeTemplateTrue. 'front/layout2/css/animate.css')}}" rel="stylesheet">
	<!-- Magnific Popup CSS -->
	<link href="{{ asset($activeTemplateTrue. 'front/layout2/css/magnific-popup.css')}}" rel="stylesheet">
	<!-- Slick nav css -->
	<link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'front/layout2/css/slicknav.css')}}">
	<!-- Main custom css -->
	<link href="{{ asset($activeTemplateTrue. 'front/layout2/css/custom.css')}}" rel="stylesheet" media="screen">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      @stack('style-lib')

     @stack('style')
</head>
<body data-spy="scroll" data-target="#navigation" data-offset="71">
	<!-- Preloader starts -->
	<div class="preloader">
		<div class="loader"></div>
	</div>
	<!-- Preloader Ends -->


   @include($activeTemplate. 'partials.header')
    @yield('content')


    @include($activeTemplate. 'partials.footer')

   	<!-- Footer Section ends -->
	<!-- Jquery Library File -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/jquery-1.12.4.min.js')}}"></script>
	<!-- Bootstrap js file -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/tether.min.js')}}"></script>
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/bootstrap.min.js')}}"></script>
	<!-- Bootstrap form validator -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/validator.min.js')}}"></script>
	<!-- Wow js file -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/wow.js')}}"></script>
	<!-- Swiper Carousel js file -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/swiper.min.js')}}"></script>
	<!-- Counterup js file -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/waypoints.min.js')}}"></script>
    <script src="{{ asset($activeTemplateTrue. 'front/layout2/js/jquery.counterup.min.js')}}"></script>
	<!-- Magnific Popup core JS file -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/jquery.magnific-popup.min.js')}}"></script>
	<!-- Slick Nav js file -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/jquery.slicknav.js')}}"></script>
	<!-- SmoothScroll -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/smoothscroll.js')}}"></script>
    <!-- Main Custom js file -->
	<script src="{{ asset($activeTemplateTrue. 'front/layout2/js/function.js')}}"></script>
	<link rel="stylesheet" href="{{ asset($activeTemplateTrue. 'css/color.php?color='.$general->base_color.'&secondColor='.$general->secondary_color) }}">


  @stack('script-lib')

  @stack('script')

  @include('partials.plugins')

  @include('partials.notify')

  </body>
</html>
