<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MEBNI</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/img/logo/logo_mebni.png') }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animated-headline.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">

    <script src="{{ asset('assets/frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('assets/frontend/img/logo/logo_mebni.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <main>
        <!-- header -->
        @include('layouts.frontend.header')
        <!-- end header -->

        @yield('content')

        <!--  footer -->
        @include('layouts.frontend.footer')
        <!-- end footer -->
    </main>

    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->
    <script src="{{ asset('assets/frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('assets/frontend/js/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/animated.headline.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.magnific-popup.js') }}"></script>

    <!-- Date Picker -->
    <script src="{{ asset('assets/frontend/js/gijgo.min.js') }}"></script>
    <!-- Nice-select, sticky -->
    <script src="{{ asset('assets/frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.sticky.js') }}"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/hover-direction-snake.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('assets/frontend/js/contact.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.form.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/mail-script.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
</body>

</html>
