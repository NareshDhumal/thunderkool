<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<!-- Breadcrumb-->
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

    <title>@yield('title')</title>
    @include('backend.includes.head')
</head>

<body id="kt_body" style="background-image: url({{ asset('public/assets/media/patterns/header-bg.png') }})"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-column flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                @include('backend.includes.slidebar')
                {{-- <div class="wrapper d-flex flex-column min-vh-100 bg-light"> --}}
                {{-- @include('backend.includes.header') --}}
                <div class="container-fluid db-body">
                    @yield('content')

                </div>
                @include('backend.includes.footer')
                @include('backend.includes.alerts')

            </div>

            {{-- </div> --}}
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}


    <script src="{{ asset('public/assets/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/simplebar/js/simplebar.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('public/assets/vendors/chart.js/js/chart.min.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/@coreui/chartjs/js/coreui-chartjs.js') }}"></script>
    <script src="{{ asset('public/assets/vendors/@coreui/utils/js/coreui-utils.js') }}"></script>
    <script src="{{ asset('public/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/js/numberToWords.js') }}"></script>
    <script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/jQuery.print.js') }}"></script>
    <script src="{{ asset('public/assets/js/dataTables.select.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/jquery.table2excel.min.js') }}"></script>





    {{-- <script src="{{ asset('public/assets/js/toastr.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/assets/js/buttons.html5.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/js/buttons.print.min.js') }}"></script> --}}











    @yield('scripts')
</body>

</html>
