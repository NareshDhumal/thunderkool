
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FEEDBACK PORTAL</title>
    <link rel="icon" href="{{ asset('public/assets/images/jmbaxi_logo.png')}}" type="image/icon type">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->

    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico')}}" />

    <style>
      .content-wrapper {
    background: #cccc !important;
   
      }

      .auth .auth-form-light {
    background: #ffffff;
    box-shadow: rgb(99 99 99 / 20%) 0px 2px 8px 0px;
}
    </style>
  </head>

  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
                @yield('content')
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
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