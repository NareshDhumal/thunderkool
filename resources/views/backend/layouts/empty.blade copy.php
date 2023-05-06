
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>THUNDERKOOL</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->

    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico')}}" />
  </head>
  <body>
    <div class="container-scroller text-center">
      <div class="container-fluid page-body-wrapper full-page-wrapper text-center">
        <div class="content-wrapper d-flex align-items-center auth">
        
          
                @yield('content')
          
         
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
 -->
    <!-- inject:js -->
    <script src="{{ asset('public/assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('public/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('public/assets/js/misc.js')}}"></script>
    <!-- endinject -->
  </body>
</html>