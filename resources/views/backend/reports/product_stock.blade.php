@extends('backend.layouts.app')
@section('title', 'Products Stock Report')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<style>
    tfoot {
        display: table-header-group;
    }
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
        <h4 class="text-white fw-bolder fs-2qx me-5">Products Stock Report</h4>
    </div>
    {{-- @can('Create Admin Users') --}}
    <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
        {{-- <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary my-2 me-4" data-bs-toggle="tooltip" title="Back"><i class="fa fa-arrow-left"></i></a> --}}
        {{-- <span class='btn btn-success' id='export_excel'>Export To Excel</span> --}}
        <span class='btn btn-success'onclick="exportexcel()" id='excel'>Export To Excel</span>

    </div>
    {{-- </div> --}}
    {{-- </div> --}}
    <!--end::Container-->
</div>
<!--end::Toolbar-->

<section class="db-section admin-form">
    <div class="content">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div style="width:600px;">
                                    {{-- <h4 class="card-title"></h4> --}}


                                    {{ Form::open(['url' => 'admin/productstock', 'method' => 'get']) }}
                                    <div class="row align-items-end">
                                        <div class="col-md-4">
                                            <div class="form-label-group">
                                                {{ Form::label('group_id', 'Select Group *') }}
                                                {{ Form::select('group_id', $group, Request::get('group_id'), ['class' => 'form-select', 'placeholder' => 'Select Group', 'id' => 'group_id']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-label-group">
                                                {{ Form::label('company_id', 'Select Company *') }}
                                                {{ Form::select('company_id', $companies, Request::get('company_id'), ['class' => 'form-select', 'placeholder' => 'Select Company', 'id' => 'company_id']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" class="btn btn-primary mb-1" name="submit" value="Search">
                                            {{-- <input type="reset" class="btn btn-primary" name="reset" value="Reset" id="reset"> --}}
                                            <a class="btn btn-primary mb-1" href="{{url('admin/productstock')}}">Reset</a>

                                        </div>
                                    </div>

                                   
                                    {{ Form::close() }}


                                </div>

                                {{-- <div class="text-end"
                                    style="position: absolute;
                                right: 50px;">
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-inverse-primary btn-dark float-right">
                                        <span class="align-middle ml-25"><i class="fa fa-arrow-left"></i></span></a>
                                    <span class='btn btn-sm btn-success px-2' id='export_excel'>Export To Excel</span>

                                </div> --}}





                                {{-- @can('Create Admin Users') --}}

                            </div>
                            {{-- @endcan --}}
                            <div class="table-responsive">
                                <table class="table zero-configuration" id="tbl-datatable" style="border-collapse: collapse !important; width:100% !important;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Company Name</th>
                                            <th>Hsn Code</th>
                                            <th>Product Rate</th>
                                            <th>Group</th>
                                            <th>Product Unit</th>
                                            <th>Product Stock</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @php
                                            $total_stock = 0;
                                        @endphp
                                        @if (isset($product_stock) && count($product_stock) > 0)
                                            @php $srno = 1; @endphp
                                            @foreach ($product_stock as $product_data)
                                                @php
                                                    $total_stock += $product_data->product_stock;
                                                @endphp

                                                <tr>
                                                    <td>{{ $srno }}</td>
                                                    <td>{{ $product_data->product_name }}</td>
                                                    <td>{{ $product_data->company->company_name ?? '-' }}</td>
                                                    <td>{{ $product_data->hsn_code }}</td>
                                                    <td>{{ $product_data->product_rate }}</td>
                                                    <td>{{ $product_data->group->group_name ?? '-' }}</td>
                                                    <td>{{ $product_data->product_unit }}</td>
                                                    <td>{{ $product_data->product_stock }}</td>

                                                </tr>
                                                @php $srno++; @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{ $total_stock }}</td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</section>


    {{-- @section('scripts') --}}
    {{-- <script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.min.js"></script> --}}
    {{-- <script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script> --}}
    <script>
        $(document).ready(function() {

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



            $('#export_excel').click(function() {
                exportexcel();

            });

            
           
        });

        // function ExportToExcel(type, fn, dl) {
        //     var elt = document.getElementById('tbl-datataable');
        //     var wb = XLSX.utils.table_to_book(elt, {
        //         sheet: "sheet1"
        //     });
        //     return dl ?
        //         XLSX.write(wb, {
        //             bookType: type,
        //             bookSST: true,
        //             type: 'base64'
        //         }) :
        //         XLSX.writeFile(wb, fn || ('tbl-datatable.' + (type || 'xlsx')));
        // } //end of export function

        function exportexcel() {
            $("#tbl-datatable").table2excel({
                name: "Table2Excel",
                filename: "product stock",
                fileext: ".xls"
            });

          
        }
    </script>
@endsection
