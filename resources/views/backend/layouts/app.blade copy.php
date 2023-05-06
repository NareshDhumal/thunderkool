
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Dashboard 2 by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!--     Fonts and icons     -->
  @include('backend.includes.head')
</head>

<body class="">
  <div class="wrapper ">
    @include('backend.includes.slidebar')
    <div class="main-panel">
      <!-- Navbar -->
      @include('backend.includes.header')
      <!-- End Navbar -->
      @yield('content')
      @include('backend.includes.footer')
    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="{{ asset('public/assets/js/core/jquery.min.js')}}"></script>
  <script src="{{ asset('public/assets/js/core/popper.min.js')}}"></script>
  <script src="{{ asset('public/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('public/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{ asset('public/assets/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('public/assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('public/assets/js/paper-dashboard.min.js')}}?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{ asset('public/assets/demo/demo.js')}}"></script>


  
</body>

</html>