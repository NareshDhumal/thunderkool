@extends('backend.layouts.app')
@section('title', 'Purchase Bill Details')
@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <style>
        tfoot {
            display: table-header-group;
        }

        .daterangepicker td,
        .daterangepicker th {
            padding: 0 !important;
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
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Purchase Bill Details</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.purchasebill.create') }}" class="btn btn-success my-2"  data-bs-toggle="tooltip" title="Add"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->

    <section class="db-section ">
        <div class="content">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card  p-5">
                            {{-- <div class="card-body"> --}}
                                {{-- <div class="text-start">
                                <h4 class="card-title page-title">Purchase Bill Reports</h4>
                            </div> --}}


                                {{-- <div style="text-align: right">
                                <a href="{{ route('admin.purchasebill.create') }}" class="btn btn-inverse-primary btn-fw"><i
                                        class="bx bx-plus"></i> Add </a>
                            </div> --}}


                                <div style="padding:8px !important;">

                                    {{-- date range  input --}}
                                    
                                <div class="input-group my-2 daterange-inn" style="display:flex;justify-content:flex-end;">
                                    <div style="display:flex;justify-content:center;align-items:center;" class=" mx-2">
                                        <i class="fa fa-calendar" style="margin-right:8px;" aria-hidden="true"></i>
                                        <input class="form-control form-control-sm" id="daterange"
                                            placeholder="Search by date range..">
                                    </div>
                                </div>


                                    <div class="table-responsive">
                                    <table id="tbl-datatable" cclass="table zero-configuration" style="border-collapse: collapse !important; width:100% !important;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Sr No</th>
                                                <th>Purchase Number</th>
                                                <th>Company Name</th>
                                                <th>Supplier Name</th>
                                                <th>Date</th>
                                                <th>Base Amt</th>
                                                <th>Total</th>
                                                <th>Action</th>

                                            </tr>

                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th style="text-align: center">Sr No</th>
                                                <th>Purchase Number</th>
                                                <th>Company Name</th>
                                                <th>Supplier Name</th>
                                                <th>Base Amt</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Action</th>


                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            @if (isset($purchase_bill_details) && count($purchase_bill_details) > 0)
                                                @php $srno = 1; @endphp
                                                @foreach ($purchase_bill_details as $purchase_bill)
                                                    {{-- {{ dd($purchase_bill->toArray()) }} --}}
                                                    {{-- @if (isset($purchase_bill->company) && count($purchase_bill->company) > 0)
                                                    @foreach ($purchase_bill->company as $company_details) --}}
                                                    {{-- {{ dd($purchase_bill->company[$loop->index]->company_name) }} --}}
                                                    {{-- @foreach ($purchase_bill->supplier as $suplier_details) --}}
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


                                                        @php
                                                            $arr = 0;
                                                        @endphp

                                                        @foreach ($purchase_bill->Product_details as $product_data)
                                                            @php
                                                                $arr = $arr + $product_data->row_total_gst;
                                                            @endphp
                                                        @endforeach

                                                        <td>{{ $arr }}</td>


                                                        <td>{{ round($arr) }}</td>


                                                        <td>
                                                            <a href="{{ url('admin/purchase/bill/view/' . $purchase_bill->invoice_no) }}"
                                                                class="btn btn-secondary" title="View" data-bs-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                                            <a href="{{ url('admin/purchase/bill/edit/' . $purchase_bill->invoice_no) }}"
                                                                class="btn btn-primary" title="Edit" data-bs-toggle="tooltip"><i class="fa fa-pen"></i></a>
                                                            <a href="{{ url('admin/purchase/bill/delete/' . $purchase_bill->invoice_no) }}"
                                                                class="btn btn-danger" title="Delete" data-bs-toggle="tooltip"
                                                                onclick="return confirm('Are you sure? You want to delete the entry!');"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @php $srno++; @endphp
                                                    {{-- @endforeach --}}
                                                    {{-- @endforeach
                                                @endif --}}
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

    </section>



    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(document).ready(function() {
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


            // minDateFilter = "";
            // maxDateFilter = "";
            // $("#daterange").daterangepicker();
            // $("#daterange").on("apply.daterangepicker", function(ev, picker) {
            //     minDateFilter = Date.parse(picker.startDate);
            //     maxDateFilter = Date.parse(picker.endDate);
            //     $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            //         var date = Date.parse(data[4]);
            //         if (
            //             (isNaN(minDateFilter) && isNaN(maxDateFilter)) ||
            //             (isNaN(minDateFilter) && date <= maxDateFilter) ||
            //             (minDateFilter <= date && isNaN(maxDateFilter)) ||
            //             (minDateFilter <= date && date <= maxDateFilter)
            //         ) {
            //             return true;
            //         }
            //         return false;
            //     });
            //     table.draw();
            // });

            // Daterange code
            minDateFilter = "";
            maxDateFilter = "";
            $("#daterange").daterangepicker();
            $("#daterange").on("apply.daterangepicker", function(ev, picker) {
                minDateFilter = Date.parse(picker.startDate);
                maxDateFilter = Date.parse(picker.endDate);
                $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                    var date = Date.parse(data[8]);
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
