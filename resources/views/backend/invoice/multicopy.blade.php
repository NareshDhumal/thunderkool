<?php
use App\Models\backend\Customers;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use App\Models\backend\Vehicle;
use App\Models\backend\Company;
use App\Models\backend\Product;
use App\Models\backend\Unit;
use App\Models\backend\Invoice;
use App\Models\backend\State;
?>
@php
    $data = app('request')->input('id');
    $copies = app('request')->input('copies');
    $customer_copies = app('request')->input('costomer_copy');
    
    $myArray = explode(',', $data);
    
    // for ($i = 0; $i < count($myArray); $i++) {
    //     if (!empty($myArray[$i])) {
    //         # code...
    //         dd($myArray[$i]);
    //         // $test = Invoice::where('invoice_no', $myArray[$i])->first();
    //         $row = Invoice::with('productsInvoice')
    //             ->where('invoice_id', $myArray[$i])
    //             ->get();
    //         // $company_short_name = Company::where('company_id', $row->company_id)->first();
    //     }
    // }
    
    // dd($myArray);
    $invoices = Invoice::with('productsInvoice')
        ->whereIn('invoice_no', $myArray)
        ->get();
    
    // dd($invoices);
    foreach ($invoices as $row) {
        //     # code...
        // $company_short_name = Company::where('company_id', $row->company_id)->first();
    }
    
@endphp
@extends('backend.layouts.app')
@section('title', 'View Invoice')
@section('styles')
@endsection
@section('content')
    <div class=" col-lg-12 col-md-12 col-sm-12 text-end">
        {{-- <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title= "Back" ><i class="fa fa-arrow-left"></i></a> --}}
        {{-- <a href="{{ url()->previous() }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title="Back"><i
                class="fa fa-arrow-left"></i></a> --}}
    </div>

    <div class="text-center">
        <span class="btn btn-danger print_btn text-center mt-2">Print</span>
    </div>
    <style>
        ul,
        li,
        tr,
        td,
        h5,
        b {
            margin: 0;
            padding: 0;

        }

        td {
            /* padding: 0 10px 10px 10px; */
            padding-left: 10px;
        }
    </style>


    {{-- {{dd($invoices->toArray())}} --}}
    <div id="full-print">


        @if ($copies == '1')

            @foreach ($invoices as $invoice)
                <div class="{{ $loop->index }}">
                    @php
                        $copy_name = 'orignal copy';
                        
                    @endphp
                    @php
                        $company_short_name = Company::where('company_id', $invoice->company_id)->first();
                    @endphp
                    @include('backend.invoice.twrap')


                    <div class="pagebreak" style="page-break-after: always; margin-bottom: 100px">

                    </div>
                </div>
            @endforeach
        @endif

        {{-- {{dd($customer_copies,$copies )}} --}}
        @if ($customer_copies == '1')
            @foreach ($invoices as $invoice)
                <div class="{{ $loop->index }}">
                    @php
                        $copy_name = 'customer copy';
                        
                    @endphp
                    @php
                        $company_short_name = Company::where('company_id', $invoice->company_id)->first();
                    @endphp
                    @include('backend.invoice.twrap')
                </div>


                <div class="pagebreak" style="page-break-after: always; margin-bottom: 100px">

                </div>
            @endforeach
        @endif


        @if ($copies == '2')

            @foreach ($invoices as $invoice)
                <div class="{{ $loop->index }}">

                    @php
                        $company_short_name = Company::where('company_id', $invoice->company_id)->first();
                    @endphp

                    @php
                        $copy_name = 'customer copy';
                    @endphp
                    @include('backend.invoice.twrap')
                    <div class="pagebreak" style="page-break-after: always; margin-bottom: 100px">

                    </div>
                    @php
                        $copy_name = 'orignal copy';
                        
                    @endphp
                    @include('backend.invoice.twrap')

                    <div class="pagebreak" style="page-break-after: always; margin-bottom: 100px">

                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.js"
        integrity="sha512-/fgTphwXa3lqAhN+I8gG8AvuaTErm1YxpUjbdCvwfTMyv8UZnFyId7ft5736xQ6CyQN4Nzr21lBuWWA9RTCXCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            console.log('ok');

            $('.print_btn').on('click', function() {
                printData('#full-print');
            });



        });

        function printData(elem, inv_no, data_type) {
            Popup(jQuery(elem).html());
        }

        function Popup(data) {
            console.log(data);

            var mywindow = window.open('', 'Print');
            mywindow.document.write('<html><head><title>Dashboard</title>');
            //mywindow.document.write('<style>@page{margin: 1mm 5mm 0.5mm 5mm;}h3,h4,h5,p{margin:5px 0;} .print-wrapper{border:1px solid #000;padding:0px 20px;margin-bottom:30px;font-family: Arial;}table tr td{font-size:14px;}.fee-content{ border-collapse: collapse;}.fee-content tr td{padding:4px;border:1px solid #000;}.fee-content tr th{border:1px solid #000;font-size:14px;}.last-td{padding-bottom:5px;}.hide-on-print{display:none;}</style>');
            // mywindow.document.write(
            //     '<style>@page{margin: 1mm 5mm 0.5mm 5mm;}h3,h4,h5,p{margin:5px 0;} table tr td{font-size:14px; border:1px solid black; border-collapse: collapse!important;} table{border-collapse: collapse!important; width:100% } table th{color:white; background-color:gray; border:1px solid black; .sr_no{ text-align:center!important }</style>'
            // );

            mywindow.document.write(

                '<style>@page{margin: 1mm 1mm 0.5mm 5mm;}h3,h4,h5,p{margin:5px 0;} table tr td{border:1px solid black; border-collapse: collapse!important;} table{border-collapse: collapse!important; width:90% } table th{color:white; background-color:gray; border:1px solid black; .sr_no{ text-align:center!important }.pagebreak</style>'
            );

            mywindow.document.write('</head><body >');
            mywindow.document.write(data);
            //mywindow.document.write(data);
            mywindow.document.write('</body></html>');

            // mywindow.print();
            // mywindow.close();
            setTimeout(function() { // wait until all resources loaded
                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10
                mywindow.print(); // change window to winPrint
                mywindow.close(); // change window to winPrint
            }, 250);

            return true;
        }
    </script>
@endsection
