<?php
use App\Models\backend\Customers;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use App\Models\backend\Company;
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
            <h4 class="text-white fw-bolder fs-2qx me-5">Invoice Details</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary my-2 me-4" id="" data-bs-toggle="tooltip" title="Back"><i class="fa fa-arrow-left"></i></a>
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
                            {{ Form::open(['url' => 'admin/invoicereport', 'method' => 'get']) }}
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
                                                {{ Form::label('company_id', 'Select Company *') }}
                                                {{ Form::select('company_id', $companies, Request::get('company_id'), ['class' => 'form-select', 'placeholder' => 'Select Company', 'id' => 'company_id']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" class="btn btn-primary mb-1" name="submit" value="Search">
                                    <a class="btn btn-primary mb-1" href="{{ url('admin/invoicereport') }}">Reset</a>

                                </div>
                            </div>
                            {{ Form::close() }}



                            <div class="table-responsive">                                
                                <table class="table zero-configuration" id="tbl-datatable">
                                    <thead>
                                        <tr>
                                            <th>Sr no.</th>
                                            <th>Invoice Number</th>
                                            <th>Company Name</th>
                                            <th>Customer Name</th>
                                            <th>Vehicle Make</th>
                                            <th>Vehicle Model</th>
                                            <th>Vehicle Number</th>
                                            <th>KM</th>
                                            <th>FOC</th>
                                            <th>Dated</th>
                                            <th>Bas. Amt</th>
                                            <th>Disc</th>
                                            <th>Gst%</th>
                                            <th>Total</th>
                                            <th class="noexcel">Actions</th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @php
                                            $baseamount = 0;
                                            $finaldiscount = 0;
                                            $finalamount = 0;
                                        @endphp
                                        @if (isset($invoice) && count($invoice) > 0)
                                            {{-- {{dd($invoice->toArray())}} --}}
                                            @php $srno = 1; @endphp
                                            @foreach ($invoice as $data)
                                                @php
                                                    $baseamount += (float)$data->base_amount;
                                                    $finaldiscount += (float)$data->discount;
                                                    $finalamount += (float)$data->total_amount;
                                                    
                                                @endphp
    
                                                @php
                                                    $customer_name = '';
                                                    $vehicle_make = '';
                                                    $vehicle_model = '';
                                                    $company_name = '';
                                                    $customer_name = Customers::where('customer_id', $data->customer_id)->first();
                                                    if ($customer_name) {
                                                        $customer_name = $customer_name->customer_name;
                                                    }
                                                    $vehicle_make = VehicleMake::where('vehicle_make_id', $data->vehicle_make_id)->first();
                                                    if ($vehicle_make) {
                                                        $vehicle_make = $vehicle_make->vehicle_make_name;
                                                    }
                                                    $vehicle_model = Vehiclemodel::where('vehicle_model_id', $data->vehicle_model_id)->first();
                                                    if ($vehicle_model) {
                                                        $vehicle_model = $vehicle_model->vehicle_model_name;
                                                    }
                                                    $company_name = Company::where('company_id', $data->company_id)->first();
                                                    if ($company_name) {
                                                        $company_name = $company_name->company_name;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $srno }}</td>
                                                    <td>{{ $data->invoice_no }}</td>
                                                    <td>{{ $company_name }}</td>
                                                    <td>{{ $customer_name ? $customer_name : 'N/A' }}</td>
                                                    <td>{{ $vehicle_make ? $vehicle_make : 'N/A' }}</td>
                                                    <td>{{ $vehicle_model ? $vehicle_model : 'N/A' }}</td>
                                                    <td>{{ $data->vehicle_number ? $data->vehicle_number : 'N/A' }}</td>
                                                    <td>{{ $data->km ? $data->km : 'N/A' }}</td>
                                                    <td>{{ $data->free_of_charge == '1' ? 'Yes' : 'No' }}</td>
                                                    <td>{{ $data->date_of_issue ? $data->date_of_issue : 'N/A' }}</td>
                                                    <td>{{ $data->base_amount ? $data->base_amount : 'N/A' }}</td>
                                                    <td>{{ $data->discount ? $data->discount : 'N/A' }}</td>
                                                    @if (isset($data->total_cgst_percent) && $data->total_cgst_percent != '')
                                                        <td>{{ $data->total_cgst_percent ? $data->total_cgst_percent : 'N/A' }}
                                                        </td>
                                                    @else
                                                        <td>{{ $data->total_igst_percent ? $data->total_igst_percent : 'N/A' }}
                                                        </td>
                                                    @endif
                                                    <td>{{ $data->total_amount ? $data->total_amount : 'N/A' }}</td>
    
                                                    <td style="vertical-align: middle;">
                                                        {{-- @can('Update Admin Users') --}}
                                                        <a style="color:rgba(255, 255, 255, 0.87);"
                                                            href="{{ url('admin/invoice/view/' . $data->invoice_id) }}"
                                                            class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                                    </td>
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
                                        <td></td>
                                        <td></td>
    
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{ $baseamount }}</td>
                                        <td>{{ $finaldiscount }}</td>
                                        <td></td>
                                        <td>{{ $finalamount }}</td>
                                        <td></td>
                                    </tr>
    
                                </table>
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

            $('#tbl-datatable').DataTable();


            $('#export_excel').click(function() {
                exportexcel();

            });
        });



        function exportexcel() {
            $("#tbl-datatable").remove(".noexcel").table2excel({
                name: "Table2Excel",
                filename: "invoice report",
                fileext: ".xls",
                exclude_links: true,
                exclude_inputs: false,
                exclude: '.noexcel'
            });
        }
    </script>
@endsection
