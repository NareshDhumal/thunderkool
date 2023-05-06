<?php
use App\Models\backend\Customers;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use App\Models\backend\Company;
use App\Models\backend\ProductInvoice;
use App\Models\backend\Product;

?>
@extends('backend.layouts.app')
@section('title', 'Invoice Report')
@section('title', 'Invoice')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <!--begin::Container-->
        {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
        {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Customer Wise Product Report</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            {{-- <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary my-2 me-4" id="" data-bs-toggle="tooltip"
                title="Back"><i class="fa fa-arrow-left"></i></a> --}}
            <span class='btn btn-success' id='export_excel'>Export To Excel</span>

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
                        <div class="card p-5">
                            {{-- @endcan --}}
                            {{-- new code --}}
                            {{ Form::open(['url' => 'admin/invoice/customer/productreport', 'method' => 'get']) }}
                            <div class="row align-items-end mb-4">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="Select Start Date">Select Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control"
                                                value="{{ Request::get('start_date') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Select End Date">Select End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control"
                                                value="{{ Request::get('end_date') }}">
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-label-group">
                                                {{ Form::label('customer_id', 'Select Customers *') }}
                                                {{ Form::select('customer_id', $customers, Request::get('customer_id'), ['class' => 'form-select', 'placeholder' => 'Select Customer', 'id' => 'customer_id']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary mb-1" name="submit" value="Search">
                                    <a class="btn btn-primary mb-1"
                                        href="{{ url('admin/invoice/customer/productreport') }}">Reset</a>

                                </div>
                                {{ Form::close() }}



                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="tbl-datatable">
                                        <thead>
                                            <tr>
                                                <th>Sr no.</th>
                                                <th>Product Description</th>
                                                <th>Hsn</th>
                                                <th>Rate</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                {{-- <th class="noexcel">Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (isset($invoice) && count($invoice) > 0)
                                                {{-- {{dd($invoice->toArray())}} --}}
                                                @php $srno = 1; @endphp
                                                @foreach ($invoice as $data)
                                                    @if (isset($data->productsInvoice) && count($data->productsInvoice) > 0)
                                                        @foreach ($data->productsInvoice as $product_invoice)
                                                            @php
                                                                $product = Product::where('product_id', $product_invoice->product_id)->first();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $srno }}</td>
                                                                <td>{{ $product->product_name ?? '-' }}</td>
                                                                <td>{{ $product_invoice->hsn_code ?? '-' }}</td>
                                                                <td>{{ $product_invoice->rate ?? '-' }}</td>
                                                                <td>{{ $product_invoice->created_at ?? '-' }}</td>
                                                                <td>{{ $product_invoice->product_total_amount ?? '-' }}
                                                                </td>
                                                                {{-- <td style="vertical-align: middle;">
                                                            <a style="color:rgba(255, 255, 255, 0.87);"
                                                                href="{{ url('admin/invoice/view/' . $data->invoice_id) }}"
                                                                class="btn btn-secondary btn-sm" data-bs-toggle="tooltip"
                                                                title="View"><i class="fa fa-eye"></i></a>
                                                        </td> --}}
                                                            </tr>
                                                            @php $srno++; @endphp
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tbody>


                                        {{-- <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td></td>
                                            <td>Total</td>
                                            <td>{{ $baseamount }}</td>
                                            <td>{{ $finaldiscount }}</td>
                                            <td></td>
                                            <td>{{ $finalamount }}</td>
                                            <td></td>
                                        </tr> --}}

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        </div>
    </section>
    </div>
    </section>

@endsection
@section('scripts')
    {{-- <script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script> --}}


    <script>
        $(document).ready(function() {
            $('#customer_id').select2();




            $('#tbl-datatable').DataTable();


            $('#export_excel').click(function() {
                exportexcel();

            });
        });



        function exportexcel() {
            $("#tbl-datatable").remove(".noexcel").table2excel({
                name: "Table2Excel",
                filename: "Customer Wise Report",
                fileext: ".xls",
                exclude_links: true,
                exclude_inputs: false,
                exclude: '.noexcel'
            });
        }
    </script>
@endsection
