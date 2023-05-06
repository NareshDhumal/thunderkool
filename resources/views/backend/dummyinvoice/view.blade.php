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
@section('title', 'View Quotation Approval')
@section('styles')
@endsection
@section('content')
    <style>
@media print
{
      /* .page-break  { display:block; page-break-before:always; } */

}
    </style>
    <div class="container-fluid my-md-4 flex-grow-1">
        <div class="card shadow border-0">
            <div class="card-body">
                <main class="docs-main order-1">
                    {{-- <form method="post"> --}}
                    <div id="table-wraper">
                        <table class="table-bordered tbl-datatable" cellpadding="5" width="100%" style="">
                            <tr>
                                <td colspan="3" align="center"><img
                                        src="{{ asset('/storage/app') . $company_details->company_logo }}" width="200">
                                </td>
                                <td style="width:400px" colspan="8" class="company_nm" align="center">
                                    <h4 style="margin-bottom:10px;font-size:17px;"> {{ $company_details->company_name }}
                                    </h4>
                                    <h5 style="font-size:14px;">{{ $company_details->company_address }}<br>
                                        {{-- @if ($invoice_data['gst_flag'] == 1) --}}
                                        Mobile : {{ $company_details->cm_mobile }}<br>
                                        GSTIN :{{ $company_details->gst_no }} <br>
                                        State : Maharashtra, State Code : 27<br>
                                        Bank Name : {{ $company_details->cm_bank_name }} ,&nbsp;
                                        Branch Name : {{ $company_details->cm_branch_name }}<br>
                                        Ifsc Code : {{ $company_details->cm_bank_ifsc }} ,&nbsp;
                                        Account Number : {{ $company_details->cm_account_no }}

                                    </h5>
                                    {{-- @endif --}}
                                </td>
                                <td colspan="3" align="center">
                                    <div class="hide_print" id="checkbox1">
                                        <input class="invoice_checkbox no-print cp_type" type="checkbox" value="0"
                                            id='oc' checked>Original
                                        Copy
                                    </div>
                                    <div class="hide_print" id="checkbox2">

                                        <input class="invoice_checkbox no-print cp_type" type="checkbox" value="1"
                                            id='cc'>Customer
                                        Copy
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="14" align="center" class="bold" style="font-size:15px;text-align: center;">
                                    @if ($invoice_data['gst_flag'] == 1)
                                        {{ 'Quotation/Approval' }}
                                    @else
                                        {{ 'QuotationApproval' }}
                                    @endif
                                </th>
                            </tr>

                            <tr>
                                <td colspan="14" class="bold">Quotation/Approval No:
                                    {{ $company_details->company_short_name . $invoice_data['invoice_no'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="14" class="bold">Dated: {{ $invoice_data['date_of_issue'] }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" valign="top" align="center" style="text-transform:uppercase;">
                                    <strong>Customer
                                        Details</strong>
                                </td>
                                <td colspan="8" valign="top" align="center" style="text-transform:uppercase;">
                                    <strong>Vehicle
                                        Details</strong>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td colspan="6" style="text-transform:uppercase;">Name : {{ $customers->customer_name }}
                                </td>
                                <td colspan="4" style="text-transform:uppercase;">Make :
                                    {{ $vehicle_make->vehicle_make_name ?? '-' }}</td>
                                <td colspan="4" style="text-transform:uppercase;">Chassis No :
                                    {{ $vehicle->chassis_no ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" rowspan="2" style="text-transform:uppercase;">
                                    Address : {{ $customers->address }}<br>
                                    Pin Code : {{ $customers->pin_code }}<br>
                                    GST NO : </td>
                                <td colspan="4" style="text-transform:uppercase;">Vehicle No :
                                    {{ $invoice_data['vehicle_number'] }}</span></td>
                                <td colspan="4" style="text-transform:uppercase;">Serial No :
                                    {{ $vehicle->serial_no ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-transform:uppercase;">Model :
                                    {{ $vehicle_model->vehicle_model_name ?? '-' }}</span>
                                </td>
                                <td colspan="4" style="text-transform:uppercase;">Cab No : {{ $vehicle->cab_no ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-transform:uppercase;">Mobile :
                                    {{ $customers->mobile_no ?? '-' }}
                                </td>
                                <td colspan="4" style="text-transform:uppercase;">KM : {{ $invoice_data['km'] }}</td>
                                <td colspan="4" style="text-transform:uppercase;">Loco No :
                                    {{ $vehicle->loco_no ?? '-' }}</td>
                            </tr>
                            <tr>
                            <tr class="">
                                <td class="bold">Sr NO.</td>
                                <td width="300" colspan="4" class="bold" colspan="1">Product Description</td>
                                <td class="bold" colspan="3">HSN/SAC Code</td>
                                <td class="bold">Qty</td>
                                <td class="bold" colspan="2">Rate</td>
                                <!-- <td class="bold">Per</td> -->
                                <td class="bold">Amt</td>
                                <td class="bold">Disc.(%)</td>
                                <td class="bold">Total</td>
                            </tr>


                            @php $srno = 1; @endphp
                            @foreach ($data as $product)
                                {{-- {{dd($product_name->product_name)}} --}}
                                <tr>
                                    <td>
                                        {{ $srno }}
                                    </td>

                                    <td class="fw-bold" colspan="4">
                                        {{ $product['product_name'] ?? '-' }}
                                    </td>


                                    <td colspan="3">
                                        {{ $product['hsn'] ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $product['quantity'] ?? '-' }} {{ $product['product_unit'] ?? '-' }}

                                    </td>

                                    <td colspan="2">
                                        {{ $product['rate'] ?? '-' }}

                                    </td>
                                    <td>
                                        {{ $product['amount'] ?? '-' }}

                                    </td>
                                    <td>
                                        {{ $product['discount'] ?? '-' }}

                                    </td>
                                    <td>
                                        {{ $product['totalamount'] ?? '-' }}
                                    </td>

                                </tr>

                                @php $srno++; @endphp
                            @endforeach

                            <tr class="border_row">
                                <td colspan="11" align="right" class="bold">Total</td>
                                <td align="right" class="bold" colspan="3">{{ $invoice_data['total_amount_all'] }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="11" style="text-align: right;" class="bold">Total (Without Tax)
                                </td>
                                <td align="right" colspan="3" style="width:10mm;border-bottom:1px solid #000;"
                                    class="bold">
                                    {{ $invoice_data['total_amount_all'] ?? '' }}
                                </td>
                            </tr>


                            </tr>


                            {{-- @php
                            if($invoice->payment_method == 'Pending') {
                            $payment_method = 'Pending';
                            } else if($invoice->payment_method == 'Cheque') {
                            $payment_method = 'Cheque, Bank Name :'. $invoice->bank_name.', Cheque No :'.
                            $invoice->cheque_no;
                            } else if($invoice->payment_method == 'Electronic Transaction') {
                            $payment_method = 'Electronic Transaction, Electronic Payment Ref :'.
                            $invoice->e_transaction_ref;
                            } else if($invoice->payment_method == 'Cash') {
                            $payment_method = 'Cash';
                            }
                            @endphp --}}
                            <tr>
                                <td colspan="10" align="left"><b> Payment Mode
                                        :{{ $invoice_data['payment_method'] }}</b>

                                </td>
                                <td colspan="4"><b>Free of Charge :</b>

                                    {{-- {{ $invoice_data['free_of_charge'] == 1 ? 'Yes' : 'No' }} --}}

                                </td>
                            </tr>
                            <tr>
                                <td colspan="14" align="left" class="bold"><strong>Amount Chargeable ( in Words )
                                        :</strong><span class="bold" style="margin-left:5px;font-size:14px">
                                        {{ $invoice_data['amt_in_words'] }}
                                    </span>
                                </td>
                            </tr>

                            <tr style="page-break-after: always;"></tr>

                            <tr>
                                <td colspan="6" rowspan="3"><span class="bold">
                                        <strong>Terms & Conditions</strong><br>
                                        <p style="margin-bottom:3px;">1. Subject to Kalyan Jurisdiction</p>
                                        <p style="margin-bottom:3px;">2. Vehicle Parked, Driven & Worked under
                                            owners
                                            risk.
                                        </p>
                                        <p style="margin-bottom:3px;">3. Goods once sold will not be taken back.</p>
                                        <p style="margin-bottom:3px;">4. No Guarantee on Gas & Electronic Items.</p>
                                        <p style="margin-bottom:3px;">5. KM is just mentioned for reference purpose.
                                        </p>
                                    </span>
                                </td>

                                <td colspan="4" rowspan="2" align="center">
                                    <img src="{{ asset('/storage/app') . $company_details->company_seal }}"
                                        width="200">
                                </td>
                                <td colspan="6" align="center">
                                    <strong>{{ 'FOR ' . $company_details->company_name }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">&nbsp;<br><br><br><br></td>
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
                                <td colspan="10" rowspan="2" valign="top"><strong>REPORT</strong><br>
                                    {{ $invoice_data['remark'] }}
                                </td>
                                <td colspan="6"><br><br><br><br>
                                </td>
                            </tr>
                            <tr>

                                <td colspan="6" align="center"><strong>Customer Signature</strong>
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

            $('#table_print').on('click', function() {
                printData('#table-wraper');
            });

        });

        function printData(elem, inv_no, data_type) {
            Popup(jQuery(elem).html());
        }

        function Popup(data) {
            //    console.log($('.no-print').attr());




            var mywindow = window.open('', 'Print');
            mywindow.document.write('<html><head><title>Dashboard</title>');
            //mywindow.document.write('<style>@page{margin: 1mm 5mm 0.5mm 5mm;}h3,h4,h5,p{margin:5px 0;} .print-wrapper{border:1px solid #000;padding:0px 20px;margin-bottom:30px;font-family: Arial;}table tr td{font-size:14px;}.fee-content{ border-collapse: collapse;}.fee-content tr td{padding:4px;border:1px solid #000;}.fee-content tr th{border:1px solid #000;font-size:14px;}.last-td{padding-bottom:5px;}.hide-on-print{display:none;}</style>');
            // mywindow.document.write(
            //     '<style>@page{margin: 1mm 5mm 0.5mm 5mm;}h3,h4,h5,p{margin:5px 0;} table tr td{font-size:14px; border:1px solid black; border-collapse: collapse!important;} table{border-collapse: collapse!important; width:100% } table th{color:white; background-color:gray; border:1px solid black; .sr_no{ text-align:center!important }</style>'
            // );

            mywindow.document.write(
                '<style>@page{margin: 1mm 1mm 0.5mm 5mm;}h3,h4,h5,p{margin:5px 0;} table tr td{border:1px solid black; border-collapse: collapse!important;} table{border-collapse: collapse!important; width:90% } table th{color:white; background-color:gray; border:1px solid black; .sr_no{ text-align:center!important } .page-break{ page-break-after:always; }</style>'
            );
            $(".invoice_checkbox").each(function() {
                if ($(this).is(':checked')) {
                    if ($(this).attr('id') == 'oc') {
                        mywindow.document.write('<style>#checkbox2{display:none}</style>');
                        console.log('ok');
                    } else if ($(this).attr('id') == 'cc') {
                        mywindow.document.write('<style>#checkbox1{display:none}</style>');
                        console.log('ok');
                    } else {
                        if (($(this).attr('id') == 'cc') && ($(this).attr('id') == 'oc')) {
                            mywindow.document.write('<style>#checkbox2{display:none}</style>');
                            mywindow.document.write('<style>#checkbox1{display:block}</style>');
                        }
                    }

                }
            });
            //let c_val = $('.cp_type').hide();
            // mywindow.document.write(
            //     '<style>.cp_type{display:none}</>'
            // );
            // var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            // for (var checkbox of checkboxes) {
            //     console.log($(this).val());
            // }

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
                mywindow.close();
            }, 250);

            return true;
        }
    </script>
@endsection
