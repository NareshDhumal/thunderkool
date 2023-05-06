<?php
use App\Models\backend\Customers;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use App\Models\backend\Company;
?>
@extends('backend.layouts.app')
@section('title', 'Invoice Details')

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
            <h4 class="text-white fw-bolder fs-2qx me-5">Invoice Details</h4>
        </div>       
                {{-- @can('Create Admin Users') --}}
            <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.invoice.create') }}" class="btn btn-success my-2"><i class="fa fa-plus"></i></a>
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
                        {{-- <div class="card-body">
                            <div class="text-start">
                                <h4 class="card-title">Invoice Details</h4>
                            </div>
                            @can('Create Admin Users') --}}
                            {{-- <div class="text-end"> --}}
                                {{-- <a href="{{ route('admin.invoice.create') }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a> --}}
                                {{-- <a href="{{ route('admin.state') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a> --}}
                            {{-- </div> --}}
                            {{-- <div class="row">
                                <div class="col-md-4"> --}}
                            {{-- {{dd($companies)}} --}}
                            {{-- <select class="form-select" id="company_select">
                                    <option>Select a Company</option>
                                    @foreach ($companies as $key => $company)
                                        <option value="{{$key}}">{{$company}}</option>
                            @endforeach
                            </select>
                        </div> --}}
                    {{-- </div> --}}
                    {{-- @endcan --}}
                    <div style="padding:8px !important;">
                        <div class="input-group my-2 daterange-inn" style="display:flex;justify-content:flex-end;">
                            <div style="display:flex;justify-content:center;align-items:center;" class=" mx-2">
                                <i class="fa fa-calendar" style="margin-right:8px;" aria-hidden="true"></i>
                                <input class="form-control form-control-sm" id="daterange" placeholder="Search by date range..">
                            </div>
                        </div>
                        <div class="table-responsive">
                        <table class="table zero-configuration table-sm" id="tbl-datatable" style="border-collapse: collapse !important; width:100% !important;">
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
                                    <th>Total</th>
                                    <th style="min-width: 160px">Actions</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                @if(isset($invoice) && count($invoice)>0)
                                @php $srno = 1; @endphp
                                @foreach($invoice as $data)
                                @php
                                $customer_name = '';
                                $vehicle_make = '';
                                $vehicle_model = '';
                                $company_name = '';
                                $customer_name = Customers::where('customer_id',$data->customer_id)->first();
                                if($customer_name) {
                                $customer_name = $customer_name->customer_name;
                                }
                                $vehicle_make = VehicleMake::where('vehicle_make_id',$data->vehicle_make_id)->first();
                                if($vehicle_make) {
                                $vehicle_make = $vehicle_make->vehicle_make_name;
                                }
                                $vehicle_model = Vehiclemodel::where('vehicle_model_id',$data->vehicle_model_id)->first();
                                if($vehicle_model) {
                                $vehicle_model = $vehicle_model->vehicle_model_name;
                                }
                                $company_name = Company::where('company_id',$data->company_id)->first();
                                if($company_name) {
                                $company_name = $company_name->company_name;
                                }
                                @endphp
                                <tr>
                                    <td>{{ $srno }}</td>
                                    <td>{{ $data->invoice_no }}</td>
                                    <td>{{ $company_name }}</td>
                                    <td>{{ $customer_name ? $customer_name : 'N/A' }}</td>
                                    <td>{{ $vehicle_make ? $vehicle_make : 'N/A' }}</td>
                                    <td>{{ $vehicle_model ? $vehicle_model : 'N/A'  }}</td>
                                    <td>{{ $data->vehicle_number ? $data->vehicle_number : 'N/A' }}</td>
                                    <td>{{ $data->km ? $data->km : 'N/A' }}</td>
                                    <td>{{ $data->free_of_charge == '1' ? 'Yes' : 'No' }}</td>
                                    <td>{{ $data->date_of_issue ? $data->date_of_issue : 'N/A' }}</td>
                                    <td>{{ $data->base_amount ? $data->base_amount : 'N/A' }}</td>
                                    <td>{{ $data->discount ? $data->discount : 'N/A' }}</td>
                                    <td>{{ $data->total_amount ? $data->total_amount : 'N/A' }}</td>
                                    <td style="min-width: 160px">
                                        {{-- @can('Update Admin Users') --}}
                                        {{-- <div class="d-inline"> --}}
                                            <a style="color:rgba(255, 255, 255, 0.87);" href="{{ url('admin/invoice/view/'.$data->invoice_id) }}" class="btn btn-secondary btn-sm"><i class="fa fa-eye"></i></a>
                                        {{-- </div> --}}
                                    {{-- <div class="d-inline"> --}}
                                            <a href="{{ url('admin/invoice/edit/'.$data->invoice_id) }}" class="btn btn-primary"><i class="fa fa-pen"></i></a>
                                        {{-- </div> --}}
                                        {!! Form::open([
                                        'method'=>'GET',
                                        'url' => ['admin/invoice/delete', $data->invoice_id ],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {{-- @endcan --}}
                                        {{-- @can('Delete Admin Users') --}}
                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                        {{-- @endcan --}}
                                        {!! Form::close() !!}
                                        <a href=""></a>
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
        // Setup - add a text input to each footer cell
        $('#tbl-datatable thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#tbl-datatable thead');

        var table = $('#tbl-datatable').DataTable({
            orderCellsTop: true
            , fixedHeader: true
            , initComplete: function() {
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
                        if (title == 'Vehicle Number' || title == 'Customer Name' || title == 'Company Name') {
                            $(cell).html('<input type="text" style="width:150px;" placeholder="' + title + '" />');
                        } else {
                            $(cell).html('<input type="text" style="display:none" placeholder="' + title + '" />');
                        }
                        // On every keypress in this input
                        $(
                                'input'
                                , $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('change', function(e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();
                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value + ')))') :
                                        ''
                                        , this.value != ''
                                        , this.value == ''
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
            }
        , });
        //console.log(role);
        // Daterange code
        minDateFilter = "";
        maxDateFilter = "";
        $("#daterange").daterangepicker();
        $("#daterange").on("apply.daterangepicker", function(ev, picker) {
            minDateFilter = Date.parse(picker.startDate);
            maxDateFilter = Date.parse(picker.endDate);
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var date = Date.parse(data[9]);
                if (
                    (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
                    (isNaN(minDateFilter) && date <= maxDateFilter) ||
                    (minDateFilter <= date && isNaN(maxDateFilter)) ||
                    (minDateFilter <= date && date <= maxDateFilter)
                ) {
                    return true;
                }
                return false;
            });
            table.draw();
        });
    });

</script>
@endsection
