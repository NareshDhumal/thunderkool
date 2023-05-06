@extends('backend.layouts.app')
@section('content')
    <div class="content">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> --}}
        <section id="basic-datatable">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-start">
                                <h4 class="card-title page-title">Feedbacks Reports</h4>
                                <a href="{{ route('admin.feedbacks') }}" class="btn btn-inverse-danger btn-fw"
                                    style=""><i class="bx bx-arrow-back"></i><span
                                        class="align-middle ml-25">Back</span></a>
                            </div>
                            {{-- @can('Create Admin Users') --}}
                            {{-- @endcan --}}

                            {{-- <form method="post" action="{{route('admin.test')}}"> --}}
                            {{ Form::open(['route' => 'admin.reports', 'method' => 'get']) }}
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        value="{{ Request::get('start_date') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        value="{{ Request::get('end_date') }}" required>
                                </div>
                                <div class="col-md-3">
                                    {{ Form::select('rating_star', ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], Request::get('rating_star'), ['placeholder' => 'Enter Rating', 'class' => 'form-control']) }}
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" style=""
                                        class="btn btn-block btn-dark btn-sm font-weight-medium auth-form-btn">submit</button>
                                </div>

                            </div>
                            {{ Form::close() }}






                            {{-- <p>Date: <input type="text" id="datepicker"></p> --}}


                            <div class="table table-responsive mt-5">
                                <table class="table zero-configuration mt-2" id="tbl-datatable"
                                    style="white-space: nowrap;">
                                    <thead>
                                        <tr>

                                            <th style="text-align: center">Sr No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Rating</th>
                                            <th>Date</th>
                                            {{-- <th>Action</th> --}}

                                        </tr>
                                        <tr>

                                            <th style="text-align: center">Sr No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Rating</th>
                                            <th>Date</th>
                                            {{-- <th>Action</th> --}}

                                        </tr>

                                    </thead>
                                    <tbody>
                                        @if (isset($all_reports) && count($all_reports) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($all_reports as $last_feedback_recived)
                                                {{-- @if (isset($all_reports->rating) && count($last_feeback->rating) > 0)
                                                    @foreach ($last_feeback->rating as $ratings) --}}
                                                <tr>
                                                    <td class='text-center'>{{ $srno }}</td>
                                                    <td>{{ $last_feedback_recived->feedback_name }}</td>
                                                    <td>{{ $last_feedback_recived->feedback_email }}</td>
                                                    <td>{{ $last_feedback_recived->feedback_phone }}</td>
                                                    <td>{{ $last_feedback_recived->feedback_meta_value }}</td>
                                                    <td>{{ $last_feedback_recived->created_at }}</td>

                                                    {{-- <td>
                                                                @if ($ratings->feedback_meta_key)
                                                                    {{ $ratings->feedback_meta_value }}
                                                                @else
                                                                    --
                                                                @endif

                                                            </td> --}}

                                                    {{-- <td class='p-0'>
                                                                <a href="{{ url('admin/feedbacks/view/' . $last_feedback_recived->feedback_form_id) }}"
                                                                    class="btn btn-primary">View</a>

                                                            </td> --}}
                                                </tr>
                                                @php $srno++; @endphp
                                            @endforeach
                                        @endif
                                        {{-- @endforeach
                                        @endif --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
{{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> --}}
<script>
    $(document).ready(function() {

        // Setup - add a text input to each footer cell
        $('#tbl-datatable thead tr').clone(true).appendTo('#example thead');
        $('#tbl-datatable thead tr:eq(1) th').each(function(i) {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        var table = $('#tbl-datatable').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            dom: 'Bfrtip',
            buttons: [{
                text: '<i class="feather icon-download-cloud"></i> Excel',
                extend: 'excel',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },

                title: function() {
                    var printTitle = "MARKETING SUMMARY SHEET {{ session('year') }}";
                    return printTitle
                },
                className: 'btn btn-success text-white font-weight-bold',
            }, ]
        });




        // $('#tbl-datatable').DataTable({
        //         "bPaginate": false,
        //         dom: 'Bfrtip',
        //         scrollX: true,
        //         fixedHeader: true,
        //         buttons: [


        //         ],



        //     });






        // $(function() {
        //     var table = $("#tbl-datatable").DataTable({
        //         // Date range vars
        //         minDateFilter = "";
        //         maxDateFilter = "";

        //         $("#daterange").daterangepicker();
        //         $("#daterange").on("apply.daterangepicker", function(ev, picker) {
        //             minDateFilter = Date.parse(picker.startDate);
        //             maxDateFilter = Date.parse(picker.endDate);

        //             $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        //                 var date = Date.parse(data[4]);

        //                 if (
        //                     (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
        //                     (isNaN(minDateFilter) && date <= maxDateFilter) ||
        //                     (minDateFilter <= date && isNaN(maxDateFilter)) ||
        //                     (minDateFilter <= date && date <= maxDateFilter)
        //                 ) {
        //                     return true;
        //                 }
        //                 return false;
        //             });
        //             table.draw();
        //         });


        //     });
        // });


        //         $( function() {
        //     $( "#datepicker" ).datepicker();
        //   } );
    });
</script>
