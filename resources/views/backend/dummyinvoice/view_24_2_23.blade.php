@extends('backend.layouts.app')

@section('content')
    <div id="table-wraper">
        <table class=" table printable table-bordered w-100" cellpadding="5" style="margin: 0px 20px">
         
            <tr>
                <td colspan="4" align="center"><img style="width: 215px"
                        src="{{ asset('storage/app/' . $company_details->company_logo) }}" alt=""></td>
                <td colspan="" class="company_nm" align="center">
                    <h3 style="margin-bottom:10px;font-size:17px;">{{ $company_details->company_name }}</h3>
                    <h4 style="font-size:14px;">{{ $company_details->company_address }}
                    </h4>
                </td>


                <td colspan="3" align="center">
                    <div class="hide_print"><input class="invoice_checkbox" type="checkbox" value="0" checked>Original
                        Copy<br /><input class="invoice_checkbox" type="checkbox" value="1">Customer Copy</div>
                </td>
            </tr>

            <tr>
                <th colspan="14" align="center" class="bold" style="font-size:15px;text-align: center;">INVOICE</th>
            </tr>
            <tr>
                <td colspan="14" class="bold">Invoice No:{{ $invoice_data['invoice_no'] }}</td>
            </tr>
            <tr>
                <td colspan="14" class="bold">Dated: {{ $invoice_data['date_of_issue'] }}</td>
            </tr>
            <tr>
                <td colspan="6" valign="top" align="center" style="text-transform:uppercase;">Customer Details</td>
                <td colspan="8" valign="top" align="center" style="text-transform:uppercase;">Vehicle Details</td>
            </tr>
          
            <tr>
                <td colspan="6" style="text-transform:uppercase;">Name : {{ $customers->customer_name }}</td>
                <td colspan="4" style="text-transform:uppercase;">Make : {{ $vehicle_make->vehicle_make_name }}</td>
                {{-- <td colspan="4" style="text-transform:uppercase;">Chassis No : </td> --}}
            </tr>
            <tr>
                <td colspan="6" rowspan="2" style="text-transform:uppercase;">Address :
                    {{ $customers->address }}<br>Pin
                    Code : {{ $customers->pin_code }}</td>
                <td colspan="4" style="text-transform:uppercase;">Vehicle No :
                    {{ $invoice_data['vehicle_number'] }}</span>
                </td>
                {{-- <td colspan="4" style="text-transform:uppercase;">Serial No : </td> --}}
            </tr>
            <tr>
                <td colspan="4" style="text-transform:uppercase;">Model :
                    {{ $vehicle_model->vehicle_model_name }}</span>
                </td>
                {{-- <td colspan="4" style="text-transform:uppercase;">Cab No : </td> --}}
            </tr>
            <tr>
                <td colspan="6" style="text-transform:uppercase;">Mobile : {{ $customers->mobile_no }}</td>
                <td colspan="4" style="text-transform:uppercase;">KM : {{ $invoice_data['km'] }}</td>
                {{-- <td colspan="4" style="text-transform:uppercase;">Loco No : </td> --}}
            </tr>


            <tr class="" style="text-transform:uppercase;">
                <td width="60" class="bold" rowspan="2">Sr NO.</td>
                <td style="width:90mm;height:40px;" class="bold" colspan="8" rowspan="2">Job Description
                </td>
                <td class="bold" style="width:5mm;height:40px;" colspan="2" rowspan="2">Amount</td>
            </tr>

                @php $srno = 1; @endphp
                @foreach ($row as $row_data => $data)
            <tr class="">
                <td align="center">{{ $srno }}</td>
                <td colspan="8" style="text-transform:uppercase">{{ $data['product_description'] }}</td>

                <td align="right" style="width:5mm;" colspan="2">{{ $data['product_amount'] }}</td>

            </tr>
            @php $srno++; @endphp
            @endforeach

            <tr class="border_row">
                <td colspan="9" align="right" class="bold" style="text-transform:uppercase;">DISCOUNT</td>

                @if ($invoice_data['discount'] != '')
                <td align="right" class="bold">{{ $invoice_data['discount'] }}</td>
                @else
                <td align="right" class="bold">{{ '-' }}</td>
                @endif

                {{-- <td align="right" class="bold"></td> --}}
            </tr>

            <tr class="border_row">
                <td colspan="9" align="right" class="bold" style="text-transform:uppercase;">Total</td>

                <td align="right" class="bold">{{ $invoice_data['total_amount'] }}</td>

                {{-- <td align="right" class="bold"></td> --}}
            </tr>



            <tr>
                <td colspan="11" align="left"><b> Payment Mode :{{ $invoice_data['payment_method'] }}</b>
                </td>

                    
                {{-- <td colspan="5"><b>Free of Charge : <td>{{ ($invoice_data['free_of_charge'] == 1)?'Yes':'No' }}</td> --}}
            </tr>
            <tr>
                <td colspan="16" align="left" class="bold">Amount Chargeable ( in Words )<br><span
                        class="bold">{{ $invoice_data['amt_in_words'] }}</span></td>
            </tr>

            <tr>
                <td colspan="6" rowspan="3"><span class="bold">
                        <strong>Terms & Conditions</strong><br><br>
                        <p>1. Subject to Kalyan Jurisdiction</p>
                        <p>2. Vehicle Parked, Driven & Worked under owners risk.</p>
                        <p>3. Goods once sold will not be taken back.</p>
                        <p>4. No Guarantee on Gas & Electronic Items.</p>
                        <p>5. KM is just mentioned for reference purpose.</p>
                    </span>
                </td>
                <td colspan="4" rowspan="2" align="center"><img style="width: 215px"
                        src="{{ asset('storage/app/' . $company_details->company_seal) }}" alt=""></td>
                <td colspan="6" align="center"></td>
            </tr>
            <tr>
                <td colspan="6">&nbsp;<br><br><br><br></td>
            </tr>
            <tr>
                <td align="center" colspan="4">
                    Common Seal
                </td>
                <td colspan="6" align="center" valign="bottom">
                    Authorised Signatory
                </td>
            </tr>
            <tr>
                <td colspan="10" rowspan="2" valign="top">REPORT<br></td>
                <td colspan="6"><br><br><br><br>
                </td>
            </tr>
            <tr>

                <td colspan="6" align="center">Customer Signature
                </td>
            </tr>

        </table>
    </div>




 


    <div class="text-center">
        <span class="btn btn-danger print_btn text-center mt-2">Print</span>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>



{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"
integrity="sha512-BaXrDZSVGt+DvByw0xuYdsGJgzhIXNgES0E9B+Pgfe13XlZQvmiCkQ9GXpjVeLWEGLxqHzhPjNSBs4osiuNZyg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
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
            //  mywindow.close(); // change window to winPrint
        }, 250);

        return true;
    }
</script>
