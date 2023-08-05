<!DOCTYPE html>
<!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'TesLaravel') }} | {{ $title }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/style-gue.css') }}">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->

    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/font-awesome.min.css') }}">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/owl.transitions.css') }}">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/animate.css') }}">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/normalize.css') }}">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/meanmenu.min.css') }}">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/main.css') }}">
   
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/metisMenu/metisMenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/metisMenu/metisMenu-vertical.css') }}">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/calendar/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/calendar/fullcalendar.print.min.css') }}">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="{{ asset('theme/css/responsive.css') }}">
  

    @notify_css

    @yield('style')
</head>
<body>
    <!--**********************************
        Sidebar start
    ***********************************-->
    @include('layouts.components.sidebar')
    <!--**********************************
        Sidebar end
    ***********************************-->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="{{ asset('theme/img/logo/logo.png') }}" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        
        <!--**********************************
            Header start
        ***********************************-->
        @include('layouts.components.navbar')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
           
            
        @yield('content')
        
        
        <!--**********************************
            footer
        ***********************************-->
        @include('layouts.footer')
        <!--**********************************
            footer
        ***********************************-->
        @include('partials.modal')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('theme/') }}"></script>

    <!-- jquery
        ============================================ -->
    <script src="{{ asset('theme/js/vendor/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <!-- wow JS
        ============================================ -->
    <script src="{{ asset('theme/js/wow.min.js') }}"></script>
    <!-- price-slider JS
        ============================================ -->
    <script src="{{ asset('theme/js/jquery-price-slider.js') }}"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="{{ asset('theme/js/jquery.meanmenu.js') }}"></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src="{{ asset('theme/js/owl.carousel.min.js') }}"></script>
    <!-- sticky JS
        ============================================ -->
    <script src="{{ asset('theme/js/jquery.sticky.js') }}"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="{{ asset('theme/js/jquery.scrollUp.min.js') }}"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="{{ asset('theme/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('theme/js/scrollbar/mCustomScrollbar-active.js') }}"></script>
    <!-- metisMenu JS
        ============================================ -->
    <script src="{{ asset('theme/js/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('theme/js/metisMenu/metisMenu-active.js') }}"></script>
   
    <script src="{{ asset('theme/js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('theme/js/sparkline/jquery.charts-sparkline.js') }}"></script>
    <!-- calendar JS
        ============================================ -->
    <script src="{{ asset('theme/js/calendar/moment.min.js') }}"></script>
    <script src="{{ asset('theme/js/calendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('theme/js/calendar/fullcalendar-active.js') }}"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="{{ asset('theme/js/plugins.js') }}"></script>
    <!-- main JS
        ============================================ -->
    <script src="{{ asset('theme/js/main.js') }}"></script>

    @notify_js
    @notify_render

    @yield('script')

</body>

</html>
