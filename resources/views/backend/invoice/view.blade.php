<?php
use App\Models\backend\Customers;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use App\Models\backend\Vehicle;
use App\Models\backend\Company;
use App\Models\backend\Product;
use App\Models\backend\Unit;
use App\Models\backend\State;
?>
@extends('backend.layouts.app')
@section('title', 'View Invoice')
@section('styles')
@endsection
@section('content')
    <div class=" col-lg-12 col-md-12 col-sm-12 text-end">
        {{-- <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title= "Back" ><i class="fa fa-arrow-left"></i></a> --}}
        <a href="{{ url()->previous() }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title="Back"><i
                class="fa fa-arrow-left"></i></a>
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


    <div class="container-fluid my-md-4 flex-grow-1">
        <div class="card shadow border-0">
            <div class="card-body">
                <main class="docs-main order-1">


                    <div id="table-wraper">
                        <table class="table-bordered" width="100%" style="width:100%">

                            @php
                                if ($invoice->gst_flag == 1) {
                                    $invoice_title = 'TAX-INVOICE';
                                } else {
                                    $invoice_title = 'INVOICE';
                                }
                                // Fetching Company
                                $company = Company::where('company_id', $invoice->company_id)->first();
                                // if($company) {
                                $company_name = $company->company_name ?? '';
                                $company_address = $company->company_address ?? '';
                                $cm_mobile = $company->cm_mobile ?? '';
                                $gst_no = $company->gst_no ?? '';
                                
                                $cm_bank_name = $company->cm_bank_name ?? '';
                                $cm_branch_name = $company->cm_branch_name ?? '';
                                $cm_bank_ifsc = $company->cm_bank_ifsc ?? '';
                                $cm_account_no = $company->cm_account_no ?? '';
                                
                                $cm_gst_no = $company->cm_gst_no ?? '';
                                $cm_pan_no = $company->cm_pan_no ?? '';
                                // }
                                // Fetching Customer
                                $customer = Customers::where('customer_id', $invoice->customer_id)->first();
                                // if($company) {
                                $customer_name = $customer->customer_name ?? '';
                                $address = $customer->address ?? '';
                                $c_gst_no = $customer->c_gst_no ?? '';
                                $pin_code = $customer->pin_code ?? '';
                                $mobile_no = $customer->mobile_no ?? '';
                                
                                $customer_state = State::where('state_id', $customer->state)->first();
                                $state = $customer_state->state_name ?? '-';
                                
                                // }
                                // Assigning the invoice title
                                // if ($invoice->invoice_cum_challan == '1') {
                                //     $invoice_title = 'INVOICE CUM CHALLAN';
                                // }
                                // Fetching Vehicle make
                                $vehicle_make = VehicleMake::where('vehicle_make_id', $invoice->vehicle_make_id)->first();
                                // if($vehicle_make) {
                                $vehicle_make_name = $vehicle_make->vehicle_make_name ?? '';
                                // }
                                // Fetching Vehicle Model
                                $vehicle_model = VehicleModel::where('vehicle_model_id', $invoice->vehicle_model_id)->first();
                                // if($vehicle_model) {
                                $vehicle_model_name = $vehicle_model->vehicle_model_name ?? '';
                                // }
                                // Fetching Vehicle
                                $vehicle = Vehicle::where('customer_id', $invoice->customer_id)
                                    ->where('vehicle_make_id', $invoice->vehicle_make_id)
                                    ->where('vehicle_model_id', $invoice->vehicle_model_id)
                                    ->first();
                                // if($vehicle) {
                                $chassis_no = $vehicle->chassis_no ?? '';
                                $serial_no = $vehicle->serial_no ?? '';
                                $cab_no = $vehicle->cab_no ?? '';
                                $loco_no = $vehicle->loco_no ?? '';
                                // }
                            @endphp



                            <tr style="border: 0;">


                                <th colspan="16"
                                    style="font-size:15px; border: 0; margin-left:200px; text-align: center;">
                                    <h3>{{ $invoice_title }}</h3>
                                </th>
                            </tr>
                            <tr>
                                <td colspan="8" rowspan="3" style="width: 50%; ">
                                    <img src="{{ asset('/storage/app') . $company->company_logo }}" width="200">


                                    <h5><b> {{ $company_name }}</b></h5>
                                    {{ $company_address }}<br>
                                    Phone No : {{ $cm_mobile }}<br>
                                    GSTIN :{{ $gst_no }} <br>
                                    State : Maharashtra, State Code : 27<br>

                                </td>
                                <td colspan="4">
                                    Invoice No:<br>
                                    <b>{{ $company_short_name->company_short_name }}{{ $invoice->financial_year . '' . $invoice->invoice_no }}</b>
                                </td>
                                <td colspan="4">
                                    Date:<br>
                                    <b>{{ date('d-m-Y', strtotime($invoice->date_of_issue)) }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    Place Of Supply:<br>
                                    <b>{{ $state }}</b>
                                </td>
                                <td colspan="4">

                                </td>
                            </tr>
                            <tr style="border-bottom: 0; ">
                                <td colspan="8" style="vertical-align: text-top; width: 50%; border-bottom: 0; ">
                                    Ship To<br>
                                    Self pick up
                                </td>
                            </tr>

                            <tr style="border-top: 0;">
                                <td colspan="8" style="width: 50%; border-top:1px solid #6c757d; ">
                                    Bill To
                                    <h5>{{ $customer_name }}</h5>
                                    {{ $address }}<br>
                                    Phone No: {{ $mobile_no }} <br>
                                    GSTIN: {{ $c_gst_no }}<br>
                                    State: 27-Maharashtra
                                </td>
                                <td colspan="8" style="width: 50%; border-top: 0;"></td>
                            </tr>


                            @if ($invoice->gst_flag == 1)
                                <tr>

                                <tr style="text-align: left;">
                                    <td style="font-weight: bold;" colspan="1">#</td>
                                    <td style="font-weight: bold;" colspan="3">Item Name</td>
                                    <td style="font-weight: bold;" colspan="2">HSN/ SAC</td>
                                    <td style="font-weight: bold;" colspan="1">Quantity</td>
                                    <td style="font-weight: bold;" colspan="1">Unit</td>
                                    <td style="font-weight: bold;" colspan="2">Price/ Unit</td>
                                    <td style="font-weight: bold;" colspan="2">Discount</td>
                                    <td style="font-weight: bold;" colspan="2">GST</td>
                                    <td style="font-weight: bold;" colspan="2">Amount</td>
                                </tr>


                                @php
                                    $cgst_amount_total = 0;
                                    $sgst_amount_total = 0;
                                    $igst_amount_total = 0;
                                    $product_total_amt = 0;
                                    $orignal_amt_total = 0;
                                    $gst_total_amt_of_row = 0;
                                @endphp
                                @forelse($invoice->productsInvoice as $key => $data)
                                    @php
                                        $cgst_amount_total += $data->cgst_amount;
                                        $sgst_amount_total += $data->sgst_amount;
                                        $igst_amount_total += $data->igst_amount;
                                        // Fetching products
                                        $product = Product::where('product_id', $data->product_id)->first();
                                        // if($product) {
                                        $product_name = $product->product_name ?? '';
                                        $gst_total_amt_of_row += $data->cgst_amount + $data->sgst_amount + $data->igst_amount ?? '-';
                                        
                                        // }
                                        // Fetching unit
                                        $unit = Unit::where('P_unit_id', $data->p_unit)->first();
                                        if ($unit) {
                                            $unit_name = $unit->unit ?? '';
                                        }
                                        
                                        $product_total_amt += $data->product_total_amount;
                                        $orignal_amt_total += $data->orignal_amt;
                                        // print_r($product_total_amt);
                                        
                                        $round_off = explode('.', (string) $product_total_amt);
                                        
                                    @endphp


                                    <tr>
                                        <td colspan="1"> {{ $key + 1 }}</td>
                                        <td colspan="3"> {{ $product_name ?? '-' }}</td>
                                        <td colspan="2">{{ $data->hsn_code ?? '-' }}</td>
                                        <td colspan="1">{{ $data->quantity ?? '-' }}</td>
                                        <td colspan="1">{{ $unit_name ?? '-'}}</td>
                                        <td colspan="2">{{ $data->orignal_amt ?? '-' }}</td>
                                        <td colspan="2"> {{ $data->discount ?? '-' }}</td>
                                        <td colspan="2">
                                            {{ $data->cgst_percent + $data->sgst_percent + $data->igst_percent . '%' }}
                                        </td>

                                        <td colspan="2"> {{ $data->product_total_amount ?? '-' }}</td>
                                    </tr>
                                @empty
                                    no Products Available
                                @endforelse


                                <tr>
                                    <td style="font-weight: bold;" colspan="1"></td>
                                    <td style="font-weight: bold;" colspan="3">Total</td>
                                    <td style="font-weight: bold;" colspan="2"></td>
                                    <td style="font-weight: bold;" colspan="2"></td>
                                    <td style="font-weight: bold;" colspan="2"></td>
                                    <td style="font-weight: bold;" colspan="2"></td>
                                    <td style="font-weight: bold;" colspan="2">
                                        {{ $gst_total_amt_of_row }}</td>
                                    <td style="font-weight: bold;" colspan="2">{{ $product_total_amt ?? '-' }}</td>
                                </tr>

                                </tr>
                            @else
                                <tr>

                                <tr style="text-align: left;">
                                    <td style="font-weight: bold;" colspan="1">#</td>
                                    <td style="font-weight: bold;" colspan="3">Item Name</td>
                                    <td style="font-weight: bold;" colspan="2">HSN/ SAC</td>
                                    <td style="font-weight: bold;" colspan="2">Quantity</td>
                                    <td style="font-weight: bold;" colspan="2">Unit</td>
                                    <td style="font-weight: bold;" colspan="2">Price/ Unit</td>
                                    <td style="font-weight: bold;" colspan="2">Discount</td>
                                    <td style="font-weight: bold;" colspan="2">Amount</td>
                                </tr>


                                @php
                                    $cgst_amount_total = 0;
                                    $sgst_amount_total = 0;
                                    $igst_amount_total = 0;
                                    $product_total_amt = 0;
                                    $orignal_amt_total = 0;
                                @endphp
                                @forelse($invoice->productsInvoice as $key => $data)
                                    @php
                                        $cgst_amount_total += $data->cgst_amount;
                                        $sgst_amount_total += $data->sgst_amount;
                                        $igst_amount_total += $data->igst_amount;
                                        // Fetching products
                                        $product = Product::where('product_id', $data->product_id)->first();
                                        // if($product) {
                                        $product_name = $product->product_name ?? '';
                                        
                                        // }
                                        // Fetching unit
                                        $unit = Unit::where('P_unit_id', $data->p_unit)->first();
                                        if ($unit) {
                                            $unit_name = $unit->unit ?? '';
                                        }
                                        
                                        $product_total_amt += $data->product_total_amount;
                                        $orignal_amt_total += $data->orignal_amt;
                                        // print_r($product_total_amt);
                                        
                                        $round_off = explode('.', (string) $product_total_amt);
                                        
                                    @endphp


                                    <tr>
                                        <td colspan="1"> {{ $key + 1 }}</td>
                                        <td colspan="3"> {{ $product_name ?? '-' }}</td>
                                        <td colspan="2">{{ $data->hsn_code ?? '-' }}</td>
                                        <td colspan="2">{{ $data->quantity ?? '-' }}</td>
                                        <td colspan="2">{{ $unit_name ?? '-' }}</td>
                                        <td colspan="2">{{ $data->orignal_amt ?? '-' }}</td>
                                        <td colspan="2">{{ $data->discount ?? '-' }}</td>

                                        <td colspan="2"> {{ $data->product_total_amount ?? '-' }}</td>
                                    </tr>
                                @empty
                                    no Products Available
                                @endforelse


                                <tr>
                                    <td style="font-weight: bold;" colspan="1"></td>
                                    <td style="font-weight: bold;" colspan="5">Total</td>
                                    <td style="font-weight: bold;" colspan="2"></td>
                                    <td style="font-weight: bold;" colspan="2"></td>
                                    <td style="font-weight: bold;" colspan="2"></td>
                                    <td style="font-weight: bold;" colspan="2"></td>

                                    <td style="font-weight: bold;" colspan="2">{{ $product_total_amt ?? '-' }}</td>
                                </tr>

                                </tr>

                            @endif





                            <tr>
                                <td colspan="8" style="width: 50%;">
                                    Invoice Amount In Words<br>
                                    <strong>{{ $invoice->amt_in_words }}</strong>
                                </td>
                                <td colspan="8" style="width: 50%; border-bottom: 0; ">
                                    <!-- display: table-cell; vertical-align: middle; -->
                                    <!-- <b>Amounts:</b><br>
                                                                                                      Sub Total <br>
                                                                                                      Round off <br> -->
                                    <b>Amounts:</b><br>
                                    <ul style="display: flex; justify-content: space-between; list-style-type: none; ">
                                        <li>Sub Total</li>
                                        <li>{{ $invoice->total_amount ?? '' }}</li>
                                    </ul>
                                    <ul style="display: flex; justify-content: space-between; list-style-type: none; ">
                                        <li>Round off</li>
                                        <li>{{ isset($round_off[1]) ? '0.' . $round_off[1] : '0' }}</li>
                                        {{-- <li></li> --}}
                                    </ul>
                                </td>
                            </tr>

                            @php
                                $payment_method = '';
                                if ($invoice->payment_method == 'Pending') {
                                    $payment_method = 'Pending';
                                } elseif ($invoice->payment_method == 'Cheque') {
                                    $payment_method = 'Cheque, Bank Name :' . $invoice->bank_name . ', Cheque No :' . $invoice->cheque_no;
                                } elseif ($invoice->payment_method == 'Electronic Transaction') {
                                    $payment_method = 'Electronic Transaction, Electronic Payment Ref :' . $invoice->e_transaction_ref;
                                } elseif ($invoice->payment_method == 'Cash') {
                                    $payment_method = 'Cash';
                                }
                            @endphp


                            <tr style="border-top: 0; border-right: 1px solid #6c757d;">
                                <td colspan="8" rowspan=""
                                    style="width: 50%; vertical-align: text-top; border-top: 1px solid #6c757d; ">
                                    Payment mode<br>
                                    <b> {{ $payment_method ?? '-' }}</b>

                                </td>

                                <td colspan="8" style="width: 50%; ">
                                    <!-- <b>Total:</b><br>
                                                                                                      Received <br> -->
                                    <ul style="display: flex; justify-content: space-between; list-style-type: none;;">
                                        <li>Total</li>
                                        <li>{{ $invoice->total_amount ?? '' }}</li>
                                    </ul>
                                    <ul style="display: none; justify-content: space-between; list-style-type: none;">
                                        <li>Received</li>
                                        <li>₹10.00</li>
                                    </ul>
                                </td>
                            </tr>

                            <tr style=" display: none;">
                                <td colspan="8" style="width: 50%;  display: none;">
                                    <ul style="display: none; justify-content: space-between; list-style-type: none;">
                                        <li>Balance</li>
                                        <li>₹5,500.00</li>
                                    </ul>
                                </td>
                            </tr>

                            <tr style=" display: none;">
                                <td colspan="8" style="width: 50%; display: none; ">
                                    <ul style="display: none; justify-content: space-between; list-style-type: none;;">
                                        <li>Previous Balance</li>
                                        <li>₹12.00</li>
                                    </ul>
                                    <ul style="display: none; justify-content: space-between; list-style-type: none;">
                                        <li>Current Balance</li>
                                        <li>₹5,500.00</li>
                                    </ul>
                                </td>
                            </tr>

                            @if ($invoice->gst_flag == 1)

                                @if ($customer->state == '21')
                                    <tr>

                                    <tr>
                                        <td style="font-weight: bold;" colspan="3" rowspan="2">HSN/ SAC</td>
                                        <td style="font-weight: bold;" colspan="2" rowspan="2">Taxable Amount</td>
                                        <td style="font-weight: bold;" colspan="4">CGST</td>
                                        <td style="font-weight: bold;" colspan="4">SGST</td>
                                        <td style="font-weight: bold;" colspan="3" rowspan="2">Total Tax Amount
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Rate</td>
                                        <td colspan="2">Amount</td>
                                        <td colspan="2">Rate</td>
                                        <td colspan="2">Amount</td>
                                    </tr>

                                    @foreach ($invoice->productsInvoice as $key => $data)
                                        <tr>
                                            <td colspan="3">{{ $data->hsn_code ?? '-' }}</td>
                                            <td colspan="2">{{ $data->orignal_amt ?? '-' }}</td>
                                            <td colspan="2">{{ $data->cgst_percent ?? '-' }}</td>
                                            <td colspan="2">{{ $data->cgst_amount ?? '-' }}</td>
                                            <td colspan="2">{{ $data->sgst_percent ?? '-' }}</td>
                                            <td colspan="2">{{ $data->sgst_amount ?? '-' }}</td>
                                            <td colspan="3"> {{ $data->product_total_amount ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td style="font-weight: bold;" colspan="3">Total</td>
                                        <td style="font-weight: bold;" colspan="2">{{ $orignal_amt_total ?? '-' }}
                                        </td>
                                        <td style="font-weight: bold;" colspan="2"></td>
                                        <td style="font-weight: bold;" colspan="2">{{ $cgst_amount_total ?? '' }}</td>
                                        <td style="font-weight: bold;" colspan="2"></td>
                                        <td style="font-weight: bold;" colspan="2">{{ $sgst_amount_total ?? '' }}</td>
                                        <td style="font-weight: bold;" colspan="3">{{ $invoice->total_amount ?? '' }}
                                        </td>
                                    </tr>

                                    </tr>
                                @else
                                    <tr>

                                    <tr>
                                        <td style="font-weight: bold;" colspan="4" rowspan="2">HSN/ SAC</td>
                                        <td style="font-weight: bold;" colspan="4" rowspan="2">Taxable Amount</td>
                                        <td style="font-weight: bold;" colspan="4">IGST</td>
                                        <td style="font-weight: bold;" colspan="4" rowspan="2">Total Tax Amount
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Rate</td>
                                        <td colspan="2">Amount</td>
                                    </tr>

                                    @foreach ($invoice->productsInvoice as $key => $data)
                                        <tr>
                                            <td colspan="4">{{ $data->hsn_code ?? '-' }}</td>
                                            <td colspan="4">{{ $data->orignal_amt ?? '-' }}</td>
                                            <td colspan="2">{{ $data->igst_percent ?? '-' }}</td>
                                            <td colspan="2">{{ $data->igst_amount ?? '-' }}</td>
                                            <td colspan="4"> {{ $data->product_total_amount ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td style="font-weight: bold;" colspan="4">Total</td>
                                        <td style="font-weight: bold;" colspan="4">{{ $orignal_amt_total ?? '-' }}
                                        </td>
                                        <td style="font-weight: bold;" colspan="2"></td>
                                        <td style="font-weight: bold;" colspan="2">{{ $igst_amount_total ?? '' }}</td>
                                        <td style="font-weight: bold;" colspan="4">{{ $invoice->total_amount ?? '' }}
                                        </td>
                                    </tr>

                                    </tr>

                                @endif
                            @else
                                <tr>
                                <tr>
                                    <td style="font-weight: bold;" colspan="8">HSN/ SAC</td>
                                    <td style="font-weight: bold;" colspan="8">Total Amount</td>
                                </tr>
                                @foreach ($invoice->productsInvoice as $key => $data)
                                    <tr>
                                        <td colspan="8">{{ $data->hsn_code ?? '-' }}</td>
                                        <td colspan="8">{{ $data->product_total_amount ?? '-' }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td style="font-weight: bold;" colspan="8">Total</td>
                                    <td style="font-weight: bold;" colspan="8">{{ $invoice->total_amount ?? '' }}</td>
                                </tr>
                                </tr>

                            @endif


                            <tr style="border-bottom: 0; border-right: 1px solid #6c757d;">
                                <td colspan="8" rowspan="4"
                                    style="width: 50%; vertical-align: text-top; border-right: 0; ">
                                    <b>Terms and conditions :</b><br>
                                    <p style="margin-bottom:3px;">1. Subject to Kalyan Jurisdiction</p>
                                    <p style="margin-bottom:3px;">2. Vehicle Parked, Driven & Worked under
                                        owners
                                        risk.
                                    </p>
                                    <p style="margin-bottom:3px;">3. Goods once sold will not be taken
                                        back.</p>
                                    <p style="margin-bottom:3px;">4. No Guarantee on Gas & Electronic
                                        Items.</p>
                                    <p style="margin-bottom:3px;">5. KM is just mentioned for reference
                                        purpose.
                                    </p>
                                </td>
                                {{-- </tr>
                            <tr style="border-left: 0; border-top: 0;vertical-align: text-top;"> --}}
                                <td colspan="8" style="width: 50%; border-left: 0; border-top: 0; ">
                                    <b>Company's Bank details :</b><br>
                                    Bank Name:{{ $cm_bank_name }}
                                    <br>
                                    Branch Name : {{ $cm_branch_name }}
                                    <br>
                                    Bank Account No. :{{ $cm_account_no }}
                                    <br>
                                    Bank IFSC Code :{{ $cm_bank_ifsc }}
                                    <br>
                                    Account Number : {{ $cm_account_no }}
                                    <br>
                                    Account holder's Name : {{ $company_name }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="8" style="width: 50%; text-align: center;">
                                    For : {{ $company_name }}
                                    <br><br><br>
                                    Authorised Signatory
                                </td>
                            </tr>

                        </table>
                    </div>


                    <div class="text-center">
                        <span class="btn btn-danger print_btn text-center mt-2">Print</span>
                    </div>
                </main>

            </div>

        </div>

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
                printData('#table-wraper');
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
                '<style>@page{margin: 1mm 1mm 0.5mm 5mm;}h3,h4,h5,p{margin:5px 0;} table tr td{border:1px solid black; border-collapse: collapse!important;} table{border-collapse: collapse!important; width:90% } table th{color:white; background-color:gray; border:1px solid black; .sr_no{ text-align:center!important }</style>'
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
