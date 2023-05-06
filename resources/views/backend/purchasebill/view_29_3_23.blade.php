@extends('backend.layouts.app')
@section('content')

<div class="form-controll">
    <div class="text-end" style="margin-right: 20px">
        <a href="{{ route('admin.purchase.bill') }}" class="btn btn-inverse-primary float-right">
            <span class="align-middle ml-25">Back</span></a>
    </div>
</div>


    <div class="container-lg my-md-4 flex-grow-1">
        <div class="card shadow border-0">

            <div class="card-body">
                <main class="docs-main order-1">
    
                    <form method="post">
                        <div id="table-wraper">
                            <table class="table-bordered tbl-datatable" cellpadding="5" width="98%" style="">
                                <tr>
                                    <th colspan="14" align="center" class="bold" style="font-size:15px;">PURCHASE</th>
                                </tr>
        
                                <tr>
                                    <td colspan="5" rowspan="2" valign="top" class="bold"
                                        style="font-size: 16px;height:22mm;">{{ $purchase_bill->supplier->s_name }}
                                        </span><br>{{ $purchase_bill->supplier->s_address }}<br>GSTIN NO
                                        :{{ $purchase_bill->supplier->s_gstno }}
                                        &nbsp;<br>Mobile : {{ $purchase_bill->supplier->s_mobile_no }}
                                    </td>
                                    <td colspan="5" class="bold">Purchase No.<br>
                                        <span
                                            class="hide_name">{{ $purchase_bill->company->company_short_name . '00' . $purchase_bill->invoice_no . '-' . $purchase_bill->financial_year }}</span>
                                    </td>
                                    <td colspan="4" class="bold">Dated:{{ $purchase_bill->dated }}&nbsp;
                                    </td>
                                </tr>
        
                                <tr>
                                    <td colspan="9" valign="top">Mode/Terms of Payment <br>{{ $purchase_bill->payment_mode }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" valign="top" class="bold" style="height: 22mm;font-size: 16px;">
                                        <span>{{ $purchase_bill->company->company_name }}<br>{{ $purchase_bill->company->company_address }}<br>Mobile
                                            :{{ $purchase_bill->company->cm_mobile }}
                                    </td>
                                    <td colspan="5" valign="top">Supplier Bill No:
                                        <br />{{ $purchase_bill->supplier_bill_no }}
                                    </td>
                                    <td colspan="4" valign="top"></td>
                                </tr>
        
        
        
        
                                <tr>
                                    <td width="50" class="bold">Sr NO.</td>
                                    <td class="bold" width="250">Product Description</td>
                                    <td class="bold" width="100">HSN/SAC Code</td>
                                    <td class="bold">Quantity</td>
                                    <td class="bold">Rate</td>
                                    <!-- <td class="bold">Per</td> -->
                                    <td class="bold" colspan="" style="width:10mm;">Amount</td>
                                    <td style="width:10mm;" class="bold" colspan="2">CGST</td>
                                    <td class="bold" style="width:10mm;" colspan="2">SGST</td>
                                    <td class="bold" style="width:10mm;" colspan="2">IGST</td>
                                    <td class="bold" style="width:10mm;">Discount</td>
                                    <td class="bold" style="width:10mm;">Total</td>
                                </tr>
                                <tr>
                                    <td colspan="6"></td>
                                    <td>Rate</td>
                                    <td>Amount</td>
                                    <td>Rate</td>
                                    <td>Amount</td>
                                    <td>Rate</td>
                                    <td>Amount</td>
                                    <td></td>
                                    <td></td>
        
                                </tr>
        
                                @if (isset($purchase_bill->product_details) && count($purchase_bill->product_details) > 0)
                                @php $srno = 1; @endphp
                                    @foreach ($purchase_bill->product_details as $product_detail)
        
                                        <tr class="min_height"> 
                                            <td align="center">{{ $srno }}</td>
                                            <td width="250" class="fw-bold">{{ $product_detail->product_name }}</td>
                                            <td align="right">{{ $product_detail->hsn_code }}</td>
                                            <td align="right">{{ $product_detail->quantity." ".$product_detail->product_unit }}</td>
                                            <td align="right">{{ $product_detail->rate }}</td>
                                            <!-- <td align="right"</td> -->
                                            <td align="right" colspan="1" style="width:10mm;">{{ $product_detail->amount }}
                                            </td>
        
        
                                            <td align="right" style="width:10mm;">
                                                {{ $product_detail->cgst_percent != 0 ? $product_detail->cgst_percent . ' %' : '-' }}
                                            </td>
                                            <td align="right" style="width:10mm;">
                                                {{ $product_detail->cgst != 0 ? $product_detail->cgst : '-' }}</td>
        
                                            <td align="right" style="width:10mm;">
                                                {{ $product_detail->sgst_percent != 0 ? $product_detail->sgst_percent . ' %' : '-' }}
                                            </td>
                                            <td align="right" style="width:10mm;">
                                                {{ $product_detail->sgst != 0 ? $product_detail->sgst : '-' }}</td>
        
                                            <td align="right" style="width:10mm;">
                                                {{ $product_detail->igst_percent != 0 ? $product_detail->igst_percent . ' %' : '-' }}
                                            </td>
                                            <td align="right" style="width:10mm;">
                                                {{ $product_detail->igst != 0 ? $product_detail->igst : '-' }}</td>
                                            <td align="right" style="width:10mm;">
        
                                                {{ $product_detail->discount != 0 ? $product_detail->discount . ' %' : '-' }}</td>
                                            <td align="right" style="width:10mm;">{{ $product_detail->row_total_gst }}</td>
        
        
        
        
                                            {{-- <td align="right" style="width:10mm;">{{ $product_detail->cgst }}</td>
                                <td align="right" style="width:10mm;">{{ $product_detail->sgst }}</td>
                                <td align="right" style="width:10mm;">{{ $product_detail->igst }}</td>
                                <td align="right" style="width:10mm;">{{ $product_detail->discount }}</td>
                                <td align="right" style="width:10mm;">{{ $product_detail->row_total_gst }}</td>
                            </tr> --}}
        
                            @php $srno++; @endphp
                            @endforeach
                                @endif
        
        
                                <tr>
                                    <td colspan="3" align="right" class="bold">TOTAL</td>
                                    <td align="right"></td>
                                    <td></td>
        
                                    <td align="right" colspan="2" class="bold">{{ $product_detail->total_init_amount }}</td>
        
                                    <td align="right" class="bold">
                                        {{ $product_detail->cgst_total != 0 ? $product_detail->cgst_total : '-' }}</td>
                                    <td></td>
                                    <td align="right" class="bold">
                                        {{ $product_detail->sgst_total != 0 ? $product_detail->sgst_total : '-' }}</td>
                                    <td></td>
                                    <td align="right" class="bold">
                                        {{ $product_detail->igst_total != 0 ? $product_detail->igst_total : '-' }}</td>
                                    <td></td>
                                    <td align="right" class="bold">{{ $product_detail->total_amount }}</td>
        
                                </tr>
        
        
                                <tr>
                                    <td colspan="10" style="text-align: right;" class="bold">Total (Without GST)</td>
                                    <td align="right" colspan="4" style="width:10mm;" class="bold">
                                        {{ $product_detail->total_init_amount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align: right;" class="bold">IGST</td>
                                    <td colspan="4" style="text-align: right;" class="bold">
                                        {{ $product_detail->igst_total }}
                                    </td>
                                </tr>
        
                                <tr>
                                    <td colspan="10" style="text-align: right;" class="bold">CGST</td>
                                    <td colspan="4" style="text-align: right;" class="bold">
                                        {{ $product_detail->cgst_total }}
                                    </td>
                                </tr>
        
                                <tr>
                                    <td colspan="10" style="text-align: right;" class="bold">SGST</td>
                                    <td colspan="4" style="text-align: right;" class="bold">
                                        {{ $product_detail->sgst_total }}
                                    </td>
                                </tr>
        
        
                                <tr>
                                    <td colspan="10" style="text-align: right;" class="bold">Grand Total (With GST)</td>
                                    <td colspan="4" style="text-align: right;" class="bold">
                                        {{ $product_detail->total_amount }}
                                    </td>
                                </tr>
        
                                <tr>
                                    <td colspan="14" align="left" class="bold">Amount Chargeable ( in Words )<br><br><span
                                            class="bold">{{ $purchase_bill->amount_words }}</span></td>
                                </tr>
        
                                <tr>
                                    <td colspan="3" rowspan="3"><span class="bold">Our GSTIN No.
                                            :{{ $purchase_bill->supplier->s_gstno }}<br />
                                            <p>As per GST Law w.e.f ( 01/07/2017 )</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="11" align="right" valign="bottom"><br /><br /><br />
                                        {{ $purchase_bill->company->company_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="11" align="right">Authorised Signatory</td>
                                </tr>
                            </table>
                        </div>
        
                        <div class="text-center">
                            <span class="btn btn-danger print_btn text-center mt-2">Print</span>
                        </div>
                        <br />
                    </form>
        
                </main>
            </div>
        </div>
       
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.js"
        integrity="sha512-BaXrDZSVGt+DvByw0xuYdsGJgzhIXNgES0E9B+Pgfe13XlZQvmiCkQ9GXpjVeLWEGLxqHzhPjNSBs4osiuNZyg=="
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
                '<style>@page{margin: 1mm 5mm 0.5mm 5mm;}h3,h4,h5,p{margin:5px 0;} table tr td{border:1px solid black; border-collapse: collapse!important;} table{border-collapse: collapse!important; width:90% } table th{color:white; background-color:gray; border:1px solid black; .sr_no{ text-align:center!important }</style>'
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
