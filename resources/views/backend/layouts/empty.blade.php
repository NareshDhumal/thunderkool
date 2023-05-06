
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>THUNDERKOOL</title>
    <!-- plugins:css -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/assets/favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('public/assets/favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/assets/favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/assets/favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/assets/favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/assets/favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/assets/favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/assets/favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/assets/favicon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('public/assets/favicon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/assets/favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/favicon/favicon-16x16.png')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('public/assets/favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/simplebar/css/simplebar.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/vendors/simplebar.css')}}">
    <!-- Main styles for this application-->
    <link href="{{ asset('public/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/style1.css')}}" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
    <link href="{{ asset('public/assets/css/examples.css')}}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
    <link href="{{ asset('public/assets/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet')}}">
  </head>
  <body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
          
                @yield('content')
          
         
        </div>
        <!-- content-wrapper ends -->
      
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>

    <!-- inject:js -->
    <script src="{{ asset('public/assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('public/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('public/assets/js/misc.js')}}"></script>
    <!-- endinject -->
  </body>
</html>