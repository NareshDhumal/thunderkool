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
    <main class="docs-main order-1">
        {{-- <form method="post"> --}}
            <div id="table-wraper">
                <table class="table-bordered tbl-datatable" cellpadding="5" width="100%" style="">
                    @php
                    $company = Company::where('company_id',$challan->company_id)->first();
                    // if($company) {
                    $company_name = $company->company_name ?? '';
                    $company_address = $company->company_address ?? '';
                    $cm_mobile = $company->cm_mobile ?? '';
                    $gst_no = $company->gst_no ?? '';
                    // }
                    @endphp
                    <tr>
                        <th colspan="14" align="center" class="bold" style="font-size:15px;">DELIVERY CHALLAN</th>
                    </tr>
                    <tr>
                        <td colspan="5" style="width:50%" rowspan="2" valign="top" class="bold">
                            {{ $company_name }}<br>
                            {{ $company_address }}<br>Mobile No:
                            {{ $cm_mobile }} State : Maharashtra, State Code : 27
                        </td>
                        <td colspan="3" class="bold">Challan No.<br>
                            <b><span class="hide_name">C</span>
                                {{ $challan->challan_no }}
                            </b>
                        </td>
                        <td style="width:200px;" colspan="5" class="bold">Dated:&nbsp;
                            {{ date("d-m-Y", strtotime($challan->date_of_issue)) }}
                        </td>
                    </tr>
                    <tr>
                        @php
                        if($challan->payment_method == 'Pending') {
                        $payment_method = 'Pending';
                        } else if($challan->payment_method == 'Cheque') {
                        $payment_method = 'Cheque, Bank Name :'. $challan->bank_name.', Cheque No :'.
                        $challan->cheque_no;
                        } else if($challan->payment_method == 'Electronic Transaction') {
                        $payment_method = 'Electronic Transaction, Electronic Payment Ref :'.
                        $challan->e_transaction_ref;
                        } else if($challan->payment_method == 'Cash') {
                        $payment_method = 'Cash';
                        }
                        @endphp
                        <td colspan="9" valign="top">Mode/Terms of Payment <br>
                            <b>
                                {{ $payment_method }}
                            </b>
                        </td>
                    </tr>
                    <tr>
                        @php
                        // Fetching Customer
                        $customer = Customers::where('customer_id',$challan->customer_id)->first();
                        // if($company) {
                        $customer_name = $customer->customer_name ?? '';
                        $address = $customer->address ?? '';
                        $c_gst_no = $customer->c_gst_no ?? '';
                        $pin_code = $customer->pin_code ?? '';
                        $mobile_no = $customer->mobile_no ?? '';
                        // }
                        // Fetching Vehicle make
                        $vehicle_make = VehicleMake::where('vehicle_make_id',$challan->vehicle_make_id)->first();
                        // if($vehicle_make) {
                        $vehicle_make_name = $vehicle_make->vehicle_make_name ?? '';
                        // }
                        // Fetching Vehicle Model
                        $vehicle_model = VehicleModel::where('vehicle_model_id',$challan->vehicle_model_id)->first();
                        // if($vehicle_model) {
                        $vehicle_model_name = $vehicle_model->vehicle_model_name ?? '';
                        // }
                        // Fetching Vehicle
                        $vehicle = Vehicle::where('customer_id', $challan->customer_id)->where('vehicle_make_id',
                        $challan->vehicle_make_id)->where('vehicle_model_id', $challan->vehicle_model_id)->first();
                        // if($vehicle) {
                        $chassis_no = $vehicle->chassis_no ?? '';
                        $serial_no = $vehicle->serial_no ?? '';
                        $cab_no = $vehicle->cab_no ?? '';
                        $loco_no = $vehicle->loco_no ?? '';
                        // }
                        @endphp
                        <td colspan="5" valign="top" class="bold">{{ $customer_name }}<br>
                            {{ $address }}<br>Mobile :
                            {{ $mobile_no }}
                        </td>
                        <td style="width:400px" colspan="4" valign="top" class="bold">Vehicle Make:
                            {{ $vehicle_make_name }}<br>Vehicle Model:
                            {{ $vehicle_model_name }}<br>Vehicle No :
                            {{ $challan->vehicle_number }}<br>KM :
                            {{ $challan->km }}
                        </td>
                        <td style="width:250px" colspan="5" valign="top" class="bold">Chasssis No:
                            {{ $chassis_no }}<br>Cab No :
                            {{ $cab_no }}<br>Loco No :
                            {{ $loco_no }}<br>Serial No :
                            {{ $serial_no }}
                        </td>
                    </tr>
                    @if($challan->gst_flag == 1)
                    <tr colspan="14">
                        <td width="50" class="bold">Sr NO.</td>
                        <td class="bold" width="200">Description Of Goods</td>
                        <td class="bold" width="80">Quantity</td>

                        <td class="bold" width="100">Rate</td>
                        <!-- <td class="bold">Per</td> -->
                        <td class="bold" colspan="" style="width:10mm;">Amount</td>
                        <td style="width:10mm;" class="bold" colspan="2">CGST</td>
                        <td class="bold" style="width:10mm;" colspan="2">SGST</td>
                        <td class="bold" style="width:10mm;" colspan="2">IGST</td>
                        <td class="bold" style="width:10mm;">Total</td>
                        <!-- <td class="bold" colspan="1">Rate</td>
                        <td class="bold">Per</td>
                        <td class="bold" style="width:10mm;">Amount</td>
                        <td style="width:10mm;" class="bold">VAT</td>
                        <td class="bold" style="width:10mm;">VAT in Rs</td>
                        <td class="bold" style="width:10mm;">Amount + VAT</td> -->
                    </tr>
                    @php
                    $cgst_amount_total = 0;
                    $sgst_amount_total = 0;
                    $igst_amount_total = 0;
                    $total_quantity = 0;
                    @endphp
                    @forelse($challan->productsChallan as $key => $data)
                    @php
                    $cgst_amount_total += $data->cgst_amount;
                    $sgst_amount_total += $data->sgst_amount;
                    $igst_amount_total += $data->igst_amount;
                    $total_quantity += $data->quantity;
                    // Fetching products
                    $product = Product::where('product_id',$data->product_id)->first();
                    // if($product) {
                    $product_name = $product->product_name ?? '';
                    // }
                    // Fetching unit
                    $unit = Unit::where('P_unit_id',$data->p_unit)->first();
                    if($unit) {
                    $unit_name = $unit->unit ?? '';
                    }

                    @endphp
                    <tr colspan="14">
                        <td>
                            {{$key + 1}}
                        </td>
                        <td>
                            {{ $product_name ?? '-' }}
                        </td>
                        {{-- <td>
                            {{ $data->hsn_code ?? '-' }}
                        </td> --}}
                        <td>
                            {{ $data->quantity .' '. $unit_name }}
                        </td>

                        <td>
                            {{ $data->rate ?? '-' }}
                        </td>
                        <td>
                            {{ $data->product_amount ?? '-' }}
                        </td>
                        <td>
                            {{ $data->cgst_percent ?? '-' }}
                        </td>
                        <td>
                            {{ $data->cgst_amount ?? '-' }}
                        </td>
                        <td>
                            {{ $data->sgst_percent ?? '-' }}
                        </td>
                        <td>
                            {{ $data->sgst_amount ?? '-' }}
                        </td>
                        <td>
                            {{ $data->igst_percent ?? '-' }}
                        </td>
                        <td>
                            {{ $data->igst_amount ?? '-' }}
                        </td>
                        {{-- <td>
                            {{ $data->discount ?? '-' }}
                        </td> --}}
                        <td>
                            {{ $data->product_total_amount ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    no Products Available
                    @endforelse
                    <tr class="border_row">
                        <td colspan="2" align="right" class="bold">Total</td>
                        <td>{{ $total_quantity }}</td>
                        <td></td>
                        <td align="right" class="bold">{{$challan->base_amount ?? ''}}</td>
                        <td></td>
                        <td align="right" class="bold">{{$cgst_amount_total ?? ''}}</td>
                        <td></td>
                        <td align="right" class="bold">{{$sgst_amount_total ?? ''}}</td>
                        <td></td>
                        <td align="right" class="bold">{{$igst_amount_total ?? ''}}</td>
                        <td align="right" class="bold">{{$challan->total_amount ?? ''}}</td>
                    </tr>
                    <tr>
                        <td colspan="11" style="text-align: right;" class="bold">Total (Without Tax)
                        </td>
                        <td align="right" colspan="4" style="width:10mm;border-bottom:1px solid #000;" class="bold">
                            {{ $challan->base_amount ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11" style="text-align: right;" class="bold">IGST</td>
                        <td colspan="4" style="text-align: right;border-bottom:1px solid #000;" class="bold">
                            {{ $igst_amount_total ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="11" style="text-align: right;" class="bold">CGST</td>
                        <td colspan="4" style="text-align: right;border-bottom:1px solid #000;" class="bold">
                            {{ $cgst_amount_total ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <td colspan="11" style="text-align: right;" class="bold">SGST</td>
                        <td colspan="4" style="text-align: right;border-bottom:1px solid #000;" class="bold">
                            {{ $sgst_amount_total ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11" style="text-align: right;" class="bold">Grand Total (With Tax)
                        </td>
                        <td colspan="4" style="text-align: right;" class="bold">
                            {{ $challan->total_amount ?? '' }}
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td>Sr NO.</td>
                        <td colspan="10" class="bold">Description Of Goods</td>
                        <td class="bold">Amount</td>
                    </tr>
                    @forelse($challan->productsChallan as $key => $data)
                    @php
                    // Fetching products
                    $product = Product::where('product_id',$data->product_id)->first();
                    // dd($product);
                    // if($product) {
                    $product_name = $product->product_name ?? '-';
                    // }
                    @endphp
                    <tr>
                        <td>
                            {{$key + 1}}
                        </td>
                        <td colspan="10">
                            {{$product_name}}
                        </td>
                        <td>
                            {{$data->product_amount ?? '-'}}
                        </td>
                    </tr>
                    @empty
                    no Products Available
                    @endforelse
                    @endif
                    <tr>
                        <td colspan="3" width="300">Company Name:
                            {{ $company_name }}<br />
                            Bank Name: <br />
                            Branch Name: <br />
                            Bank IFSC: <br />
                            GSTIN: <br />
                            PAN No:

                        </td>
                        <td colspan="4" width="300">Customer Name:
                            <br />
                            Bank Name:
                            <br />
                            Branch Name:
                            <br />
                            Bank IFSC:
                            <br />
                            GSTIN:
                            <br />
                            PAN No:

                        </td>
                        <td colspan="5" align="right" valign="bottom"><br /><br /><br />
                            {{ $company_name }}<br />
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
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.js"
    integrity="sha512-/fgTphwXa3lqAhN+I8gG8AvuaTErm1YxpUjbdCvwfTMyv8UZnFyId7ft5736xQ6CyQN4Nzr21lBuWWA9RTCXCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        console.log('ok');

        $('#table_print').on('click', function() {
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
            //  mywindow.close(); // change window to winPrint
        }, 250);

        return true;
    }
</script>
@endsection