@extends('backend.layouts.app')
@section('content')
    <div class="content">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-start d-flex align-items-center">
                                <h4 class="card-title page-title" style="margin-top:0px !important;">Feedback Reports</h4>
                                <a href="{{ route('admin.feedbacks') }}" class="btn btn-inverse-danger btn-fw " style="float:right;position: absolute;
                                right: 50px;"><i
                                    class="bx bx-arrow-back"></i><span class="align-middle ml-25 mb-5">Back</span></a>
                            </div>
                          
                            {{-- @can('Create Admin Users') --}}
                            {{-- @endcan --}}
                            
                                <div class="table table-responsive mt-5">
                                <table class="table zero-configuration mt-2" id="tbl-datatable" style="white-space: nowrap;">
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
                                        @if (isset($last_feeback) && count($last_feeback) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($last_feeback as $last_feedback_recived)
                                                {{-- @if (isset($last_feeback->rating) && count($last_feeback->rating) > 0)
                                                    @foreach ($last_feeback->rating as $ratings) --}}
                                                <tr>
                                                    <td class='text-center'>{{ $srno }}</td>
                                                    <td>{{ $last_feedback_recived->feedback_name }}</td>
                                                    <td>{{ $last_feedback_recived->feedback_email }}</td>
                                                    <td>{{ $last_feedback_recived->feedback_phone }}</td>
                                                    <td>{{ $last_feedback_recived->rating->feedback_meta_value }}</td>
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
            buttons: [
                {
                        text: '<i class="feather icon-download-cloud"></i> Excel',
                        extend: 'excel',footer: true ,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        },

                        title: function() {
                            var printTitle = "MARKETING SUMMARY SHEET {{ session('year') }}";
                            return printTitle
                        },
                        className: 'btn btn-success text-white font-weight-bold',
                    },
            ]
        });




        // $('#tbl-datatable').DataTable({
        //         "bPaginate": false,
        //         dom: 'Bfrtip',
        //         scrollX: true,
        //         fixedHeader: true,
        //         buttons: [

                    
        //         ],



        //     });
    });
</script>
