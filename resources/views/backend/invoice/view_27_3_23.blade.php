<?php
use App\Models\backend\Customers;
use App\Models\backend\VehicleMake;
use App\Models\backend\Vehiclemodel;
use App\Models\backend\Vehicle;
use App\Models\backend\Company;
use App\Models\backend\Product;
use App\Models\backend\Unit;
?>
@extends('backend.layouts.app')
@section('title', 'View Invoice')
@section('styles')
@endsection
@section('content')
    <div class="container-lg my-md-4 flex-grow-1">
        <div class="card shadow border-0">
            <div class="card-body">
                <main class="docs-main order-1">
                    {{-- <form method="post"> --}}
                    <div id="table-wraper">
                        <table class="table-bordered tbl-datatable" cellpadding="5" width="100%" style="width:100%">
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

                            <tr>
                                <td colspan="6" align="center"><img
                                        src="{{ asset('/storage/app') . $company->company_logo }}" width="200"></td>
                                <td colspan="6" class="company_nm" align="center">
                                    <h4 style="margin-bottom:10px;font-size:17px;"> {{ $company_name }}</h4>
                                    <h5 style="font-size:14px;">{{ $company_address }}<br>
                                        {{-- @if ($invoice->gst_flag == 1) --}}
                                        Mobile : {{ $cm_mobile }}<br>
                                        GSTIN :{{ $gst_no }} <br>
                                        State : Maharashtra, State Code : 27<br>
                                        Bank Name : {{ $cm_bank_name }} ,&nbsp;
                                        Branch Name : {{ $cm_branch_name }} ,
                                        Ifsc Code : {{ $cm_bank_ifsc }} ,&nbsp;
                                        Account Number : {{ $cm_account_no }}

                                    </h5>
                                    {{-- @endif --}}
                                </td>
                                <td colspan="6" align="center">
                                    <div class="hide_print">
                                        <input class="invoice_checkbox" id="checkbox1" type="checkbox" value="0" checked>Original
                                        Copy<br />
                                        <input class="invoice_checkbox" id="checkbox2" type="checkbox" value="1">Customer Copy
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th colspan="18" align="center" class="bold" style="font-size:15px;text-align: center;">
                                    {{ $invoice_title }}</th>
                            </tr>

                            <tr>
                                <td colspan="18" class="bold">Invoice No. {{ $company_short_name->company_short_name }}
                                    GST 00
                                    {{ $invoice->invoice_no .
                                        '
                                                                                                                                                                                                                                                                                                                                                ' .
                                        $invoice->financial_year }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="18" class="bold">Dated:
                                    {{ date('d-m-Y', strtotime($invoice->date_of_issue)) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9" valign="top" align="center" style="text-transform:uppercase;">
                                    <strong>Customer
                                        Details</strong>
                                </td>
                                <td colspan="9" valign="top" align="center" style="text-transform:uppercase;">
                                    <strong>Vehicle
                                        Details</strong>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td colspan="9" style="text-transform:uppercase;">Name : {{ $customer_name }}</td>
                                <td colspan="5" style="text-transform:uppercase;">Make : {{ $vehicle_make_name }}</td>
                                <td colspan="4" style="text-transform:uppercase;">Chassis No : {{ $chassis_no }}</td>
                            </tr>
                            <tr>
                                <td colspan="9" rowspan="2" style="text-transform:uppercase;">
                                    Address : {{ $address }}<br>
                                    Pin Code : {{ $pin_code }}<br>
                                    GST NO : {{ $c_gst_no }}</td>
                                <td colspan="5" style="text-transform:uppercase;">Vehicle No :
                                    {{ $invoice->vehicle_number }}</span></td>
                                <td colspan="4" style="text-transform:uppercase;">Serial No : {{ $serial_no }}</td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-transform:uppercase;">Model :
                                    {{ $vehicle_model_name }}</span>
                                </td>
                                <td colspan="4" style="text-transform:uppercase;">Cab No : {{ $cab_no }} </td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-transform:uppercase;">Mobile : {{ $mobile_no }} </td>
                                <td colspan="5" style="text-transform:uppercase;">KM : {{ $invoice->km }}</td>
                                <td colspan="4" style="text-transform:uppercase;">Loco No : {{ $loco_no }}</td>
                            </tr>


                            <tr>
                                @if ($invoice->gst_flag == 1)
                            <tr class="">
                                <td class="bold" rowspan="2" colspan="1">Sr NO.</td>
                                <td class="bold" rowspan="2" colspan="3">Product Description</td>
                                <td class="bold" rowspan="2" colspan="2">HSN/SAC Code</td>
                                <td class="bold" rowspan="2" colspan="1">Qty</td>
                                <td class="bold" rowspan="2" colspan="1">Rate</td>
                                <td class="bold" rowspan="2" colspan="1">Amt</td>
                                <td class="bold" rowspan="1" colspan="2">CGST</td>
                                <td class="bold" rowspan="1" colspan="2">SGST</td>
                                <td class="bold" rowspan="1" colspan="2">IGST</td>
                                <td class="bold" rowspan="2" colspan="1">Disc.(%)</td>
                                <td class="bold" rowspan="2" colspan="2">Total</td>
                            </tr>
                            <tr class="">
                                <td>Percent</td>
                                <td>Amt</td>
                                <td>Percent</td>
                                <td>Amt</td>
                                <td>Percent</td>
                                <td>Amt</td>
                            </tr>
                            @php
                                $cgst_amount_total = 0;
                                $sgst_amount_total = 0;
                                $igst_amount_total = 0;
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
                                    
                                @endphp
                                <tr>
                                    <td colspan="1">
                                        {{ $key + 1 }}
                                    </td>
                                    <td class="fw-bold" colspan="3">
                                        {{ $product_name ?? '-' }}
                                    </td>
                                    <td colspan="2">
                                        {{ $data->hsn_code ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->quantity . ' ' . $unit_name }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->rate ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->product_amount ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->cgst_percent ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->cgst_amount ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->sgst_percent ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->sgst_amount ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->igst_percent ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->igst_amount ?? '-' }}
                                    </td>
                                    <td colspan="1">
                                        {{ $data->discount ?? '-' }}
                                    </td>
                                    <td colspan="2">
                                        {{ $data->product_total_amount ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                no Products Available
                            @endforelse
                            <tr class="border_row">
                                <td colspan="8" class="bold">Total</td>
                                <td colspan="1" align="right" class="bold">{{ $invoice->base_amount ?? '' }}</td>
                                <td colspan="2" align="right" class="bold">{{ $cgst_amount_total ?? '' }}</td>
                                <td colspan="2" align="right" class="bold">{{ $sgst_amount_total ?? '' }}</td>
                                <td colspan="2" align="right" class="bold">{{ $igst_amount_total ?? '' }}</td>
                                <td colspan="3" align="right" class="bold">{{ $invoice->total_amount ?? '' }}</td>
                            </tr>


                            <tr>
                                <td colspan="9" style="text-align: right;" class="bold">Total (Without Tax)
                                </td>
                                <td align="right" colspan="9" style="width:10mm;border-bottom:1px solid #000;"
                                    class="bold">
                                    {{ $invoice->base_amount ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: right;" class="bold">IGST</td>
                                <td colspan="9" style="text-align: right;border-bottom:1px solid #000;"
                                    class="bold">
                                    {{ $igst_amount_total ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="9" style="text-align: right;" class="bold">CGST</td>
                                <td colspan="9" style="text-align: right;border-bottom:1px solid #000;"
                                    class="bold">
                                    {{ $cgst_amount_total ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="9" style="text-align: right;" class="bold">SGST</td>
                                <td colspan="9" style="text-align: right;border-bottom:1px solid #000;"
                                    class="bold">
                                    {{ $sgst_amount_total ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <td colspan="9" style="text-align: right;" class="bold">Grand Total (With Tax)
                                </td>
                                <td colspan="9" style="text-align: right;" class="bold">
                                    {{ $invoice->total_amount ?? '' }}
                                </td>
                            </tr>
                        @else
                            <tr class="">
                                <td class="bold" colspan="1">Sr NO.</td>
                                <td class="bold" colspan="4">Product Description</td>
                                <td class="bold" colspan="3">HSN/SAC Code</td>
                                <td class="bold" colspan="2">Qty</td>
                                <td class="bold" colspan="2">Rate</td>
                                <td class="bold" colspan="2">Amt</td>
                                <td class="bold" colspan="2">Disc.(%)</td>
                                <td class="bold" colspan="2">Total</td>
                            </tr>

                            
                            @php
                            $unit_name = '-';
                            
                            @endphp
                            @forelse($invoice->productsInvoice as $key => $data)
                                @php
                                    // Fetching products
                                    $product = Product::where('product_id', $data->product_id)->first();
                                    // dd($product);
                                    // if($product) {
                                    $product_name = $product->product_name ?? '-';
                                    // }
                                    
                                    $unit = Unit::where('P_unit_id', $data->p_unit)->first();
                                    if ($unit) {
                                        $unit_name = $unit->unit ?? '';
                                    }
                                @endphp
                                <tr>
                                    <td colspan="1">{{ $key + 1 }}</td>
                                    <td colspan="4">{{ $product_name }}</td>
                                    <td class="bold" colspan="3">
                                        {{ $data->hsn_code ?? '-' }}
                                    </td>
                                    <td class="bold" colspan="2">
                                        {{ $data->quantity . ' ' . $unit_name }}
                                    </td>
                                    <td class="bold" colspan="2">
                                        {{ $data->rate ?? '-' }}
                                    </td>
                                    <td colspan="2" align="right">
                                        {{ $data->product_amount ?? '-' }}
                                    </td>
                                    <td class="bold" colspan="2">
                                        {{ $data->discount ?? '-' }}

                                    </td>
                                    <td class="bold" colspan="2">
                                        {{ $data->product_total_amount ?? '-' }}

                                    </td>
                                </tr>
                            @empty
                                no Products Available
                            @endforelse

                            {{-- <tr>
                                <td colspan="16" align="right" class="bold" style="text-transform:uppercase;">
                                    DISCOUNT
                                </td>

                                <td colspan="2" align="right" class="bold">
                                    {{ $invoice->discount ?? '-' }}
                                </td>
                            </tr> --}}
                            <tr>
                                <td colspan="12" align="right" class="bold" style="text-transform:uppercase;">
                                    Total
                                </td>
                                <td colspan="2">
                                    {{ $invoice->base_amount ?? '-' }}

                                </td>
                                <td></td>

                                <td colspan="4" align="right" class="bold">
                                    {{ $invoice->total_amount ?? '-' }}
                                </td>
                            </tr>
                            @endif
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
                            <tr>
                                <td colspan="9" align="left"><b> Payment Mode :</b>
                                    {{ $payment_method ?? '-' }}
                                </td>
                                <td colspan="9"><b>Free of Charge :</b>
                                    @php
                                        $free_of_charge = $invoice->free_of_charge == 1 ? 'Yes' : 'No';
                                    @endphp
                                    {{ $free_of_charge }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="18" align="left" class="bold"><strong>Amount Chargeable ( in Words )
                                        :</strong><span class="bold" style="margin-left:5px;font-size:14px">
                                        {{ $invoice->amt_in_words }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="18" style="padding:0 !important;">
                                    <table style="width:100%; border-top:0;">
                                        <tr>
                                            <td colspan="9" rowspan="3"><span class="bold">
                                                    <strong>Terms & Conditions</strong><br>
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
                                                </span>
                                            </td>
                                            <td colspan="4" rowspan="2" align="center">
                                                <img style="width:150px;"
                                                    src="{{ asset('/storage/app') . $company->company_seal }}">
                                            </td>
                                            <td colspan="5" align="center"><strong>
                                                    {{ 'FOR ' . $company_name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="18">&nbsp;<br><br><br><br></td>
                                        </tr>
                                        <tr>
                                            <td align="center" colspan="4">
                                                <strong>Common Seal</strong>
                                            </td>
                                            <td colspan="6" align="center" valign="bottom">
                                                <strong>Authorised Signatory</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" rowspan="2" valign="top"><strong>REPORT</strong><br>
                                                {{ $invoice->remark }}
                                            </td>
                                            <td colspan="5" rowspan="2" valign="top">
                                                Customer Name: {{ $customer_name }}
                                                <br />
                                                Bank Name: {{ $customer->c_bank_name }}
                                                <br />
                                                Branch Name: {{ $customer->c_branch_name }}
                                                <br />
                                                Bank IFSC: {{ $customer->c_bank_ifsc }}
                                                <br />
                                                GSTIN: {{ $c_gst_no }}
                                                <br />
                                                PAN No: {{ $customer->c_pan_no }}
                                            </td>
                                            <td colspan="8"><br><br><br><br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" align="center"><strong>Customer Signature</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="" style="display:flex;justify-content:center;align-items:center; margin-top: 20px;">
                        <button id="table_print" class="btn btn-primary">Print</button>
                    </div>
                    {{--
                </form> --}}
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

            // $('.invoice_checkbox').change(function() {
            //     var cheakbox_val = $('.invoice_checkbox').val();
            //     console.log(cheakbox_val);

            // })


            $('#table_print').on('click', function() {
                // var cheakbox_val = $('.invoice_checkbox').val();
                // if(cheakbox_val == '0'){
                //     $(".checkbox2").addClass("d-none");
                // }
                // if(cheakbox_val == '1'){
                //     $('#checkbox1').hide();
                // }
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
