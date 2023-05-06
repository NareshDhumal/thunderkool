@extends('backend.layouts.app')
@section('title', 'Purchase Report')
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
            <h4 class="text-white fw-bolder fs-2qx me-5">Purchase Bill Report</h4>
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
                                {{-- <div class="text-start">
                                  <h4 class="card-title page-title">Purchase Bill Reports</h4>
                              </div>
    
    
                              <div class="text-end" style="position: absolute;
                                  right: 50px;">
                                  <a href="{{ route('admin.dashboard') }}" class="btn btn-inverse-primary float-right">
                                      <span class="align-middle ml-25">Back</span></a>
                                      <span class='btn btn-success' id='export_excel'>Export To Excel</span>
                              </div> --}}

                                <div class="">

                                    {{-- date range  input --}}
                                    {{-- <div class="input-group my-2 daterange-inn"
                                        style="display:flex;justify-content:flex-end;">
                                        <div style="display:flex;justify-content:center;align-items:center;" class=" mx-2">
                                            <i class="fa fa-calendar" style="margin-right:8px;" aria-hidden="true"></i>
                                            <input class="form-control form-control-sm" id="daterange"
                                                placeholder="Search by date range..">
                                        </div>
                                    </div> --}}

                                    {{ Form::open(['url' => 'admin/Purchasereport', 'method' => 'get']) }}
                                    <div class="row align-items-end">

                                        <div class="col-md-10">
                                            <div class="row">
                                                
                                        <div class="col-lg-3 col-md-6">
                                            <label for="Select Start Date">Select Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control"
                                                value="{{ Request::get('start_date') }}">
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <label for="Select End Date">Select End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control"
                                                value="{{ Request::get('end_date') }}">
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-label-group">
                                                {{ Form::label('company_id', 'Select Company *') }}
                                                {{ Form::select('company_id', $company, Request::get('company_id'), ['class' => 'form-select', 'placeholder' => 'Select Company', 'id' => 'company_id']) }}
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6">
                                            <div class="form-label-group">
                                                {{ Form::label('supplier_id', 'Select Supplier *') }}
                                                {{ Form::select('supplier_id', $supplier, Request::get('supplier_id'), ['class' => 'form-select', 'placeholder' => 'Select Supplier', 'id' => 'supplier_id']) }}
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-primary mb-1" name="submit" value="Search">
                                            <a class="btn btn-primary mb-1" href="{{url('admin/Purchasereport')}}">Reset</a>

                                        </div>
                                    </div>

                                    {{ Form::close() }}

                                </div>


                                <div class="table-responsive ">

                                    <table id="tbl-datatable" class="table zero-configuration" style="border-collapse: collapse !important; width:100% !important;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Sr No</th>
                                                <th>Purchase Number</th>
                                                <th>Company Name</th>
                                                <th>Supplier Name</th>
                                                <th>Date</th>
                                                <th>Basic Amt</th>
                                                <th>Total Gst Amt</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align: center">Sr No</th>
                                                <th>Purchase Number</th>
                                                <th>Company Name</th>
                                                <th>Supplier Name</th>
                                                <th>Date</th>
                                                <th>Base Amt</th>
                                                <th>Total Gst Amt</th>
                                                <th>Total</th>
                                            </tr>
                                        </tfoot>
    
                                        <tbody>
                                            @php
                                                $basicAmount = 0;
                                                $basicAmountTotal = 0;
                                                $totalGstAmountTotal = 0;
                                                $totalAmountTotal = 0;
                                            @endphp
                                            @if (isset($purcase_reports) && count($purcase_reports) > 0)
                                                @php $srno = 1; @endphp
                                                @foreach ($purcase_reports as $purchase_bill)
                                                    <tr>
                                                        <td class='text-center'>{{ $srno }}</td>
                                                        <td>{{ $purchase_bill->company->company_short_name . '00' . $purchase_bill->invoice_no . $purchase_bill->financial_year }}
                                                        </td>
                                                        <td>
                                                            @if (isset($purchase_bill->company->company_name))
                                                                {{ $purchase_bill->company->company_name }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $purchase_bill->supplier->s_name }}
                                                        </td>
                                                        <td>{{ $purchase_bill->created_at }}</td>
    
    
    
    
                                                        @foreach ($purchase_bill->Product_details as $product_data)
                                                            @php
                                                                
                                                                $arr = $product_data->total_init_amount;
                                                                $basicAmountTotal += $arr;
                                                                
                                                            @endphp
                                                        @endforeach
    
                                                        {{-- {{dd($basicAmountTotal)}} --}}
    
                                                        <td>{{ $arr }}</td>
    
    
                                                        @php
                                                            $gst = $product_data->cgst_total + $product_data->sgst_total + $product_data->igst_total;
                                                            
                                                            $totalGstAmountTotal += $gst;
                                                            
                                                        @endphp
                                                        <td>{{ round($gst) }}</td>
    
    
                                                        @php
                                                            $total = $arr + $gst;
                                                            $totalAmountTotal += $total;
                                                        @endphp
    
                                                        <td>{{ round($total) }}</td>
                                                    </tr>
                                                    @php $srno++; @endphp
                                                @endforeach
                                            @endif
    
    
    
                                        </tbody>
                                        <tr>
                                            <td>Final Amount</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{ $basicAmountTotal }}</td>
                                            <td>{{ round($totalGstAmountTotal) }}</td>
                                            <td>{{ round($totalAmountTotal) }}</td>
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




    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>






    <script>
        $(document).ready(function() {
            // console.log('test');
            // Setup - add a text input to each footer cell
            $('#tbl-datatable tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable
            var table = $('#tbl-datatable').DataTable({
                initComplete: function() {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },

            });


            minDateFilter = "";
            maxDateFilter = "";
            $("#daterange").daterangepicker();
            $("#daterange").on("apply.daterangepicker", function(ev, picker) {
                minDateFilter = Date.parse(picker.startDate);
                maxDateFilter = Date.parse(picker.endDate);
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    var date = Date.parse(data[4]);
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



        function exportexcel() {
            $("#tbl-datatable").table2excel({
                name: "Table2Excel",
                filename: "purchase report",
                fileext: ".xls"
            });
        }
    </script>
@endsection
