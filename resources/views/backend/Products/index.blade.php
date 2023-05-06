@extends('backend.layouts.app')
@section('title', 'Product Details')

@section('content')

<style>
    body{
        overflow-x: hidden !important;
    }
    .daterangepicker td, .daterangepicker th{
        padding: 0 !important;
    }
    #tbl-datatable_wrapper{position:static !important;}
    #basic-datatable #tbl-datatable_filter{
        position:absolute;
        right:30px;
    }
</style>

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <!--begin::Container-->
        {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
        {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Products Details</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-success my-2" data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
        </div>
        {{-- </div> --}}
        {{-- </div> --}}
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <div class="content">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card  p-5">
                        <div class="card-body">
                            {{-- <div class="d-flex align-items-center"> --}}
                            {{-- <h4 class="card-title">Products Details</h4>

                                @can('Create Admin Users')
                                <div class="text-end" style="position: absolute;
                        right: 50px;">
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-inverse-primary btn-fw"><i
                                            class="bx bx-plus"></i> Add </a>
                                </div> --}}
                            {{-- </div> --}}
                            {{-- @endcan --}}
                            <div class="table-responsive">
                                <table class="table zero-configuration" id="tbl-datatable" style="border-collapse: collapse !important; width:100% !important;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Company Name</th>
                                            {{-- <th>Product Code</th> --}}
                                            <th>Product Rate</th>
                                            <th>Product Stock</th>
                                            <th>Hsn Code</th>
                                            {{-- <th>Sac Code</th> --}}
                                            {{-- <th>Tax %</th> --}}
                                            <th>Product Unit</th>
                                            <th>Gst %</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @if (isset($products) && count($products) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($products as $product_data)
                                                <tr>
                                                    <td>{{ $srno }}</td>
                                                    <td>{{ $product_data->product_name }}</td>
                                                    <td>{{ $product_data->company->company_name ?? '-'}}</td>

                                                    {{-- <td>{{ $product_data->product_code }}</td> --}}
                                                    <td>{{ $product_data->product_rate ?? '-'}}</td>
                                                    <td>{{ $product_data->product_stock  }}</td>
                                                    <td>{{ $product_data->hsn_code }}</td>
                                                    {{-- <td>{{ $product_data->sac_code }}</td> --}}
                                                    {{-- <td>{{ $product_data->tax_percent }}</td> --}}
                                                    <td>{{ $product_data->product_unit }}</td>
                                                    <td>{{ $product_data->gst_percent }}</td>
                                                    <td >
                                                        {{-- @can('Update Admin Users') --}}
                                                        <a href="{{ url('admin/products/edit/' . $product_data->product_id) }}"
                                                            class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit"><i class="fa fa-pen"></i></a>
                                                        {{-- @endcan --}}
                                                        {!! Form::open([
                                                            'method' => 'GET',
                                                            'url' => ['admin/products/delete', $product_data->product_id],
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        {{-- @can('Delete Admin Users') --}}
                                                        {!! Form::button('<i class="fa fa-trash"></i>', [
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-sm btn-danger','data-bs-toggle'=>'tooltip','title'=> 'Delete',
                                                            'onclick' => "return confirm('Are you sure you want to Delete this Entry ?')",
                                                        ]) !!}
                                                        {{-- @endcan --}}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                                @php $srno++; @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    {{-- @section('scripts') --}}
    {{-- <script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
   

            // Setup - add a text input to each footer cell
            // $('#tbl-datatable tfoot th').each(function() {
            //     var title = $('#tbl-datatable tfoot th').eq($(this).index()).text();
            //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            // });

            // // DataTable
            // var table = $('#tbl-datatable').DataTable();

            // // Apply the search
            // table.columns().every(function() {
            //     var that = this;

            //     $('input', this.footer()).on('keyup change', function() {
            //         that
            //             .search(this.value)
            //             .draw();
            //     });
            // });

            $('#tbl-datatable thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#tbl-datatable thead');

            var table = $('#tbl-datatable').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();

                            $(cell).html(
                                '<input type="text" style="width:150px;" placeholder="' +
                                title + '" />');

                            $(
                                    'input', $('.filters th').eq($(api.column(colIdx).header())
                                        .index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr =
                                        '({search})'; //$(this).parents('th').find('select').val();
                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '', this.value != '', this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();
                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
            });

            table.draw();
        });
    </script>
@endsection
