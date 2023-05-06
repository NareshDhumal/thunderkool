{{-- <footer class="footer">
    <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2022 creativeLabs.</div>
    <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
</footer> --}}

<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-xxl d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2023©</span>
            <a href="http://www.parasightsolutions.com/" target="_blank"
                class="text-gray-800 text-hover-primary">ParasightSolutions</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
            <li class="menu-item">
                <a href="http://parasightsolutions.com/about.html" target="_blank" class="menu-link px-2">About</a>
            </li>
            <li class="menu-item">
                <a href="http://parasightsolutions.com/services.html" target="_blank"
                    class="menu-link px-2">Services</a>
            </li>
            {{-- <li class="menu-item">
                <a href="https://keenthemes.com/products/ceres-html-pro" target="_blank"
                    class="menu-link px-2">Purchase</a>
            </li> --}}
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->



{{-- For Numbers to words --}}
<script src="{{ asset('public/assets/js/numberToWords.js') }}" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
{{-- Select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- DataTable --}}

<script src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>

{{-- <script src="{{ asset('public/assets/js/jquery.table2excel.min.js') }}"></script> --}}

{{-- Scripts added by Manisha 01 March 2023 --}}

<script>
    var hostUrl = "assets/";
</script>
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('public/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('public/assets/js/scripts.bundle.js') }}"></script>
<script src=""></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('public/assets/js/custom/widgets.js') }}"></script>
{{-- <script src="{{ asset('public/assets/js/bootstrap-datepicker.min.js') }}"></script> --}}

<!--end::Page Custom Javascript-->
<!--end::Javascript-->

{{-- Scripts added by Manisha 01 March 2023 --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('public/assets/js/toastr.min.js') }}"></script>


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> --}}




{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
