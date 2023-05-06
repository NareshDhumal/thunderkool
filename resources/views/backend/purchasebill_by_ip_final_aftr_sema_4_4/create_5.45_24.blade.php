@extends('backend.layouts.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Purchase bill</h3>
                <nav aria-label="breadcrumb">
                    <div class="card-header">
                        <a href="{{ route('admin.purchase.bill') }}" class="btn btn-btn-primary float-right"><i
                                class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                    </div>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- Add Products Button --}}
                            <div class="d-flex">
                                {{-- {!! Form::button('Add Products', ['type' => 'submit', 'class' => 'btn btn-danger', 'id' => 'add_btn']) !!} --}}
                                {{-- <button id="remove-btn" class="btn btn-danger ms-4" onclick="$(this).parents('#product_form').remove()">Remove</button> --}}
                            </div>

                            <h4 class="card-title">Purchase bill</h4>
                            <p class="card-description">Purchase bill </p>
                            @include('backend.includes.errors')
                            {{ Form::open(['url' => 'admin/purchase/bill/store']) }}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            {{-- {{ Form::text('supplier_id',  $supplier->supplier_id)}} --}}

                                            {{ Form::label('supplier_id', 'Select Supplier *') }}
                                            {{ Form::Select('supplier_id', $supplier, ['class' => 'form-control supplier_select', 'placeholder' => 'Select Supplier', 'id' => 'yourid', 'required' => true]) }}
                                        </div>
                                    </div>

                                    {{-- for bank deatils --}}
                                    <table class="table table-bordered">
                                        <tr style="width:100">
                                            <th>Supplier Details</th>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;white-space:break-spaces;" class="Supplier_details"></td>
                                            <td style="width:50%;white-space:break-spaces;" class="bank_details"></td>
                                        </tr>
                                    </table>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            {{ Form::label('company_id', 'Select Comapny *') }}
                                            {{ Form::Select('company_id', $comapany, ['class' => 'form-control', 'placeholder' => 'Select Company', 'required' => true]) }}
                                        </div>
                                    </div>

                                    {{-- for company details --}}
                                    <table class="table table-bordered">
                                        <tr style="width:100">
                                            <th>Company Details</th>
                                        </tr>
                                        <tr>
                                            <td style="width:50%;white-space:break-spaces;" class="company_details"></td>
                                            <td style="width:50%;white-space:break-spaces;" class="company_bank_details">
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            {{ Form::label('purchase_bill_no', 'Purchase Bill No *') }}
                                            {{-- {{ Form::text('supplier_bill_no', $all_product+1 ,null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }} --}}
                                            <input value="{{ $all_product + 1 }}" type="text" id="purchase_bill_no"
                                                name="purchase_bill_no" class="form-control">

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            {{ Form::label('supplier_bill_no', 'Supplier Bill No *') }}
                                            {{ Form::text('supplier_bill_no', null, ['class' => 'form-control', 'placeholder' => '', 'required' => true]) }}

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            {{ Form::label('dated', ' Dated *') }}
                                            {{-- {{ Form::date('dated', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }} --}}
                                            <input value="{{ date('Y-m-d') }}" type="date" id="date_of_issue"
                                                name="dated" class="form-control">


                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            {{ Form::label('payment_mode', 'Payment Mode *') }}
                                            {{ Form::Select('payment_mode', $payment_mode, ['class' => 'form-control payment_mode', 'placeholder' => 'Select Company', 'required' => true]) }}
                                        </div>
                                    </div>


                                    <div id="payment_m">
                                        <input type="text" name="cheque_no" placeholder="Cheque No">
                                    </div>
                                    <div id="bank_name">
                                        <input type="text" name="bank_name" placeholder="Bank Name">
                                    </div>
                                    <div id="cheque_date">
                                        <input type="date" name="cheque_date" placeholder="Bank Name">
                                    </div>
                                    <div id="payment_electronic_ref">
                                        <input type="text" name="electronic_payment_ref" placeholder="Payment Reference">
                                    </div>





                                    {{-- <div class="container"> --}}
                                    <div class="table-responsive">
                                        <table class="table table-bordered w-100">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Hsn Code</th>
                                                    {{-- <th scope="col">Comapny Part No</th>
                                                    <th scope="col">Custom Part No</th> --}}
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Rate</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Unit</th>
                                                    <th scope="col">Gst %</th>
                                                    <th scope="col">Gst Amount</th>
                                                    <th scope="col">Disc</th>
                                                    <th scope="col">Total Amount</th>





                                                    {{-- <th scope="col">Unit</th> --}}

                                                    {{-- <th scope="col">Gst</th>
                                                    <th scope="col">Unit</th>
                                                    <th scope="col">Total</th> --}}
                                                    <th><span class="btn btn-secondary" id="add_btn">Add</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="access_data">

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- </div> --}}

                                    {{-- readonly inputs --}}
                                    <td width="80">Quantity<input type="text" class="form-control finalquantity"
                                            name="finalquantity" value="" readonly="readonly"></td>
                                    <td>Amount<input type="text" class="form-control finalamount" name="finalamount"
                                            value="" readonly="readonly"></td>

                                    <td width="180">Total Amount<input type="text"
                                            class="form-control finalgstamount" name="finalgstamount" value=""
                                            readonly="readonly"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="12" align="right">Total Amount (Without GST)</td>
                                        <td><input type="text" class="form-control" name="total_without_tax"
                                                value="" id="total_without_tax" readonly="readonly"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" align="right">GST Amount</td>
                                        <td><input type="text" class="form-control" name="final_igst_amount"
                                                value="" id="gst_amount_of_all" readonly="readonly"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" align="right">Grand Total ( With GST )</td>
                                        <td><input type="text" class="form-control" name="grand_total_gst"
                                                value="" id="grand_total_gst" readonly="readonly"></td>
                                    </tr>


                                    <tr>
                                        <td colspan="15" align="left">Amount Chargeable ( in Words )<br />
                                        </td>
                                        <br /><input type="text" class="form-control" name="amount_words"
                                            value="Nill" id="amount_words" readonly="readonly">
                                    </tr>



                                    <div class="col-12 d-flex justify-content-start">
                                        {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                        <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>





    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {


                    // $('#exampleModal').on('show.bs.modal', function(event) {
                    //     var button = $(event.relatedTarget) // Button that triggered the modal
                    //     var recipient = button.data('whatever') // Extract info from data-* attributes
                    //     // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    //     // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    //     var modal = $(this)
                    //     modal.find('.modal-title').text('New message to ' + recipient)
                    //     modal.find('.modal-body input').val(recipient)
                    // })




                    alert('ok');
                    // $('.product_form').hide()
                    //   $('.repeater').hide()
                    //   jQuery('#add_btn').on('click',function(){
                    // console.log('ok');
                    // jQuery('.product_form').toggle();
                    // });




                    // $('#supplier_id').select2();
                    // $('#company_id').select2();
                    $('#supplier_id').prepend('<option selected></option>').select2({
                        placeholder: "Select supplier",
                        allowClear: true
                    });
                    $('#company_id').prepend('<option selected></option>').select2({
                        placeholder: "Select Company",
                        allowClear: true
                    });

                    //repeter
                    // code 4
                    i = 0;
                    jQuery('#add_btn').on('click', function() {
                        // BindControls()
                        i++;
                        let data = '';

                        data = '<div class="main_div row"> <div class="cart-title" data-myval="' + i + '">';

                        data = '<tr class="table_row" id="row' + i + '">';
                        data +=
                            '<td><select  name="product_name[]" class="form-control product_name" id="product_name_' +
                            i + '" style="width: 200px;"></select></td>';

                        data +=
                            '<td><input type="text" name="hsn_code[]"  id="hsn_code' + i +
                            '" class="form-control hsn_code" placeholder="Enter hsn code"></td>';

                        data +=
                            '<td><input type="text" name="quantity[]"  id="quantity_' + i +
                            '" data-myval="' + i +
                            '" class="form-control quentity" placeholder="Enter quentity name"></td>';

                        data +=
                            '<td><input type="text" name="rate[]"  id="product_rate_' + i +
                            '" data-myval="' + i +
                            '" class="form-control product_rate" placeholder="Enter rate"></td>';


                        data +=
                            '<td><input type="text" name="amount[]"  id="product_amount' + i +
                            '"  data-myval="' + i +
                            '" class="form-control product_amount" placeholder="Enter amount"></td>';

                        data +=
                            '<td><select  name="unit[]" class="form-control unit" id="unit_' +
                            i + '" style="width: 80px">';
                        data += '<option value="">UNIT</option>';
                        @foreach ($p_unit as $unit)
                            data += '<option value="{{ $unit }}">{{ $unit }}</option>';
                        @endforeach
                        data += '</select></td>';


                        data +=
                            '<td><select  name="cgst_percent[]" class="form-control gst_percent" id="gst_percent_' +
                            i + '" style="width: 80px">';
                        data += '<option value="">GST</option>';
                        @foreach ($gst_percent as $gst)
                            data += '<option value="{{ $gst }}">{{ $gst }}</option>';
                        @endforeach

                        data += '</select></td>';


                        data +=
                            '<td><input type="text" name="gst_amount[]"  id="gst_amount' + i +
                            '" class="form-control gst_amount" placeholder="Gst Amount"></td>';


                        data +=
                            '<td><input type="text" name="discount[]"  id="discount_' + i +
                            '" class="form-control discount" placeholder="disc"></td>';


                        data +=
                            '<td><input type="text" name="total_amount[]"  id="total_amount' + i +
                            '" class="form-control total_amount" placeholder="Total amount"></td>';


                        data += '<td><button type="button" id="' + i +
                            '" class="btn btn-danger remove_row">Delete</button></td>';
                        data += '</tr>';
                        data += '</div></div>';
                        $('.access_data').append(data);


                        $(document).on('click', '.remove_row', function() {
                            var row_id = $(this).attr("id");
                            $('#row' + row_id + '').remove();
                        });



                        $('.product_name').on('change', function() {
                            // $('#product_name' + i).on('change', function() {

                            var row_id = $(this).attr('id');
                            var row_count = row_id.split('_');
                            var get_id = row_count[2];


                            var select2_val = $(this).find(":selected").val();
                            var csrfName = '<?= csrf_token() ?>';

                            $.ajax({
                                type: "post",
                                url: "{{ url('/') }}/admin/purchase/bill/producthsn",
                                data: {
                                    _token: csrfName,
                                    select2_val: select2_val
                                },
                                success: function(response) {
                                    console.log(response);
                                    var return_data = JSON.parse(response);
                                    // console.log(return_data);


                                    $("#hsn_code" + get_id).val(return_data['hsn_code']);
                                    $("#product_rate_" + get_id).val(return_data[
                                        'product_rate']);

                                }
                            });
                        });




                    });


                    // change amount, gst amount, total amount, according to quantity and based on Gm
                    $(document).on('change', '.quentity', function() {
                        var quentity = $(this).val();
                        var row_id = $(this).attr('id');
                        var row_count = row_id.split('_');
                        var get_id = row_count[1];
                        var product_rate = $('#product_rate_' + get_id).val();

                        var amount = parseFloat(quentity) * parseFloat(product_rate);
                        $('#product_amount' + get_id).val(amount);

                        var product_amount = $('#product_amount' + get_id).val();
                        var gst_percent = $('#gst_percent_' + get_id).val();
                        var disc = $('#discount_' + get_id).val();


                        var unit = $('#unit_' + get_id).val();

                        if (unit == 'Gm') {

                            quentity = quentity / 1000;
                            var amount = parseFloat(quentity) * parseFloat(product_rate);
                            $('#product_amount' + get_id).val(amount);

                            var gm_product_amount = $('#product_amount' + get_id).val();
                            var gst_percent = $('#gst_percent_' + get_id).val();

                            console.log(gm_product_amount);
                            console.log(gst_percent);


                            var gst_amount = (gm_product_amount * gst_percent) / 100;
                            console.log(gst_amount);

                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(gm_product_amount) + Number(gst_amount);
                            $("#total_amount" + get_id).val(row_total_gst);


                        }
                        // if (disc != '') {

                        //     var gst_amount = (product_amount * gst_percent) / 100;
                        //     $('#gst_amount' + get_id).val(gst_amount);
                        //     var row_total_gst = Number(product_amount) + Number(gst_amount);
                        //     var final_amount = Number(row_total_gst) - Number(disc);
                        //     console.log(final_amount);
                        //     $("#total_amount" + get_id).val(final_amount);
                        // } 
                        else {
                            var amount = parseFloat(quentity) * parseFloat(product_rate);
                            $('#product_amount' + get_id).val(amount);

                            var gst_amount = (product_amount * gst_percent) / 100;
                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(product_amount) + Number(gst_amount);
                            $("#total_amount" + get_id).val(row_total_gst);

                        }
                        calculateFinalAmount()
                        amountWords()

                    });

                    // calculate amount, gst amount, total amount, on rate change
                    $(document).on('change', '.product_rate', function() {
                        var rate = $(this).val();
                        var row_id = $(this).attr('id');
                        var row_count = row_id.split('_');
                        var get_id = row_count[2];
                        // console.log('#quantity_' + row_count[2]);
                        var quentity = $('#quantity_' + get_id).val();
                        var amount = parseFloat(quentity) * parseFloat(rate);
                        $('#product_amount' + get_id).val(amount);

                        var product_amount = $('#product_amount' + get_id).val();
                        var gst_percent = $('#gst_percent_' + get_id).val();
                        var disc = $('#discount_' + get_id).val();


                        if (gst_percent == '') {
                            var gst_amount = (product_amount * gst_percent) / 100;
                            var row_total_gst = Number(product_amount) + Number(gst_amount);
                            $("#total_amount" + get_id).val(row_total_gst);

                        } else {

                            var gst_amount = (product_amount * gst_percent) / 100;
                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(product_amount) + Number(gst_amount);
                            $("#total_amount" + get_id).val(row_total_gst);

                        }

                        var unit = $('#unit_' + get_id).val();
                        if (unit == 'Gm') {
                            quentity = quentity / 1000;
                            var amount = parseFloat(quentity) * parseFloat(rate);
                            $('#product_amount' + get_id).val(amount);

                            var gm_product_amount = $('#product_amount' + get_id).val();
                            var gst_percent = $('#gst_percent_' + get_id).val();

                            var gst_amount = (gm_product_amount * gst_percent) / 100;
                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(gm_product_amount) + Number(gst_amount);
                            $("#total_amount" + get_id).val(row_total_gst);

                        } else {

                            var gst_amount = (product_amount * gst_percent) / 100;
                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(product_amount) + Number(gst_amount);
                            $("#total_amount" + get_id).val(row_total_gst);
                        }
                        calculateFinalAmount()
                        amountWords()

                    });

                    //change gst amount and total amount according to gst %
                    $(document).on('change', '.gst_percent', function() {
                        var gst_percent = $(this).val();
                        var row_id = $(this).attr('id');
                        var row_count = row_id.split('_');
                        var get_id = row_count[2];
                        var amount_data = $('#product_amount' + get_id).val();
                        var gst_amount = (amount_data * gst_percent) / 100;
                        $('#gst_amount' + get_id).val(gst_amount);
                        var row_total_gst = Number(amount_data) + Number(gst_amount);
                        $("#total_amount" + get_id).val(row_total_gst);

                        calculateFinalAmount()
                        amountWords()

                    });

                    //change gst amount gst amount and total amount according to gst %
                    $(document).on('change', '.unit', function() {
                        var unit = $(this).val();
                        var row_id = $(this).attr('id');
                        var row_count = row_id.split('_');
                        var get_id = row_count[1];
                        var quentity = $('#quantity_' + get_id).val();
                        var product_rate = $('#product_rate_' + get_id).val();
                        var gst_percent = $('#gst_percent_' + get_id).val();
                        var product_amount = $('#product_amount' + get_id).val();

                        if (unit == 'Gm') {

                            quentity = quentity / 1000;
                            var amount = parseFloat(quentity) * parseFloat(product_rate);
                            $('#product_amount' + get_id).val(amount);


                            var gm_product_amount = $('#product_amount' + get_id).val();
                            var gst_percent = $('#gst_percent_' + get_id).val();

                            var gst_amount = (gm_product_amount * gst_percent) / 100;
                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(gm_product_amount) + Number(gst_amount);
                            $("#total_amount" + get_id).val(row_total_gst);


                        } else {


                            var amount = parseFloat(quentity) * parseFloat(product_rate);
                            console.log(amount);
                            $('#product_amount' + get_id).val(amount);


                            var gst_percent = $('#gst_percent_' + get_id).val();
                            var product_amount = $('#product_amount' + get_id).val();
                            var gst_amount = (product_amount * gst_percent) / 100;
                            console.log(gst_amount);

                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(product_amount) + Number(gst_amount);
                            console.log(row_total_gst);

                            $("#total_amount" + get_id).val(row_total_gst);

                        }

                        calculateFinalAmount()
                        amountWords()

                    });

                    //get total amount on discount 
                    $(document).on('change', '.discount', function() {
                        var disc = $(this).val();
                        var row_id = $(this).attr('id');
                        var row_count = row_id.split('_');
                        var get_id = row_count[1];

                        var product_amount = $('#product_amount' + get_id).val();
                        var gst_percent = $('#gst_percent_' + get_id).val();
                        var quentity = $('#quantity_' + get_id).val();
                        var unit = $('#unit_' + get_id).val();
                        var product_rate = $('#product_rate_' + get_id).val();

                        if (disc != '') {
                            var gst_amount = (product_amount * gst_percent) / 100;
                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(product_amount) + Number(gst_amount);
                            var final_amount = Number(row_total_gst) - Number(disc);
                            $("#total_amount" + get_id).val(final_amount);
                        } else {

                            var gst_amount = (product_amount * gst_percent) / 100;
                            $('#gst_amount' + get_id).val(gst_amount);
                            var row_total_gst = Number(product_amount) + Number(gst_amount);
                            $("#total_amount" + get_id).val(row_total_gst);
                        }


                        calculateFinalAmount()
                        amountWords()

                    });

                    // $(document).on('blur', '.quentity', function() {
                    //     var total_quentity = $(document).find('.quentity').get();

                    //     var total = 0;
                    //     $(total_quentity).each(function() {
                    //         total += parseInt($(this).val());
                    //         // console.log(total);
                    //         $('.finalquantity').val(total);

                    //     });

                    // });

                    // $(document).on('blur', '.amount', function() {
                    //     var amount = $(document).find('.amount').get();

                    //     var total = 0;
                    //     $(amount).each(function() {
                    //         total += parseInt($(this).val());
                    //         // console.log(total);
                    //         $('.finalamount').val(total);

                    //     });

                    // });


                    //readonly feidls
                    function calculateFinalAmount() {

                        var textboxcount = new Array();
                        var textboxcount = jQuery('input[name="amount-vat[]"]').length;
                        var finalamount = 0;
                        var quantitytotal = 0;
                        var amount = 0;
                        var gst_amount = 0;
                        var row_total_amount = 0;
                        var finaldiscount = 0;
                        var finaltaxableamount = 0;

                        $('input[name="quantity[]"]').each(function(input) {
                            var value = $(this).val();
                            if (value != '') {
                                quantitytotal = parseFloat(quantitytotal) + parseFloat(value);
                                // console.log(quantitytotal);
                            }
                        });

                        $('input[name="amount[]"]').each(function(input) {
                            var value = $(this).val();

                            finalamount = parseFloat(finalamount) + parseFloat(value);
                            // console.log(finalamount);

                        });

                        $('input[name="gst_amount[]"]').each(function(input) {
                            var value = $(this).val();

                            gst_amount = parseFloat(gst_amount) + parseFloat(value);
                        });

                        $('input[name="total_amount[]"]').each(function(input) {
                            var value = $(this).val();
                            row_total_amount = parseFloat(row_total_amount) + parseFloat(value);
                        });


                        $('input[name="finalquantity"]').val(quantitytotal);
                        $('input[name="finalamount"]').val(Math.round(finalamount * 100 / 100));
                        $('input[name="total_without_tax"]').val(Math.round(finalamount * 100 / 100));
                        $('input[name="finalcgstamount"]').val(Math.round(gst_amount * 100) / 100);
                        $('input[name="finalgstamount"]').val(Math.round(row_total_amount * 100 / 100));

                        // console.log(gst_amount * 100 / 100);
                        $('#gst_amount_of_all').val(Math.round(gst_amount * 100) / 100);
                        $('#grand_total_gst').val(Math.round(row_total_amount * 100 / 100));

                        var value = Math.round(row_total_amount * 100 / 100).toFixed(2);

                        amountWords(value)
                    }


                    function amountWords(finalamount) {
                        var value = Math.round(finalamount * 100 / 100).toFixed(2);

                        var splitedValue = value.split(".");
                        var value1 = splitedValue[0];
                        var value2 = numberToWords.toWords(value1);
                        var result = value2.toUpperCase();

                        $("#amount_words").val(result)


                    }


                    // payment mode
                    $('#payment_m').hide();
                    $('#bank_name').hide();
                    $('#cheque_date').hide();
                    $('#payment_electronic_ref')
                        .hide();

                    $('#payment_mode').change(function() {
                        // alert($(this).text());
                        //  alert($("#payment_mode :selected").text())
                        if ($("#payment_mode :selected").text() == "cheque") {

                            $('#payment_m').show();
                            $('#bank_name').show();
                            $('#cheque_date').show();
                            $('#payment_electronic_ref').hide();


                        } else if ($("#payment_mode :selected").text() == "Epayment") {

                            $('#payment_electronic_ref').show();
                            $('#bank_name').hide();
                            $('#cheque_date').hide();
                            $('#payment_m').hide();

                        } else if ($("#payment_mode :selected").text() == "cash") {

                            $('#payment_m').hide();
                            $('#bank_name').hide();
                            $('#cheque_date').hide();
                            $('#payment_electronic_ref').hide();

                        }
                    });


                    $('#company_id').change(function() {
                            let select_val = $(this).val();
                            var supplier_id = $('#supplier_id').val();
                            // alert(select_val);

                            var csrfName = '<?= csrf_token() ?>';
                            // alert(select_val);
                            if (supplier_id == '') {
                                alert('Please Select Supplier Name');
                                //$("#customerList").val('');
                                //	$("#company_id option[value='na']").attr('selected', true)

                            } else{
                                $.ajax({

                                    type: "post",
                                    url: "{{ url('/') }}/admin/purchase/bill/companydetails",
                                    // data: select_val,
                                    data: {
                                        _token: csrfName,
                                        select_val: select_val
                                    },
                                    // dataType: "dataType",
                                    success: function(response) {
                                        $(".company_details").html(response[0]);
                                        $(".company_bank_details").html(response[1]);
                                    }
                                });
                            }
                            });



                        $('#supplier_id').change(function() {
                            let select_val = $(this).val();
                            var csrfName = '<?= csrf_token() ?>';
                            // alert(select_val);
                            $.ajax({
                                type: "post",
                                url: "{{ url('/') }}/admin/purchase/bill/suppllierdetails",
                                // data: select_val,
                                data: {
                                    _token: csrfName,
                                    select_val: select_val
                                },
                                // dataType: "dataType",
                                success: function(response) {
                                    $(".Supplier_details").html(response[0]);
                                    $(".bank_details").html(response[1]);

                                }
                            });
                        });

                        //select2 request
                        var csrfName = '<?= csrf_token() ?>';
                        // $(document).on('change', '#company_id', function() {
                        $('#add_btn').on('click', function() {

                            let select_val = $('#company_id').find(":selected").val();

                            $('#product_name_' + i).select2({
                                tags: true,


                                ajax: {
                                    type: "post",
                                    dataType: 'json',
                                    url: "{{ url('/') }}/admin/purchase/bill/productdetails",

                                    data: function(params) {

                                        return {
                                            select_val: select_val,
                                            // _token: csrfName,
                                            q: params.term,
                                            page: params.page,
                                            _token: csrfName

                                        };

                                    },
                                    processResults: function(response, params) {
                                        params.page = params.page || 1;

                                        var arr = []
                                        $.each(response, function(index, value) {
                                            arr.push({
                                                id: index,
                                                text: value
                                            })
                                        })
                                        return {
                                            results: arr
                                        };
                                    },
                                    cache: true
                                }
                            });
                        });
                        // });


















                        // $('#submit_product').on('click', function() {
                        //     var product_name = $("#product_name", $('#exampleModal')).val();
                        //     var company_name = $("#company_name", $('#exampleModal')).val();
                        //     if (product_name != '') {
                        //         console.log('ok');
                        //         $.ajax({
                        //             url: '{{ url('admin/purchase/bill/productdetails') }}',
                        //             type: 'post',
                        //             data: {
                        //                 product_name: product_name,
                        //                 company_name: company_name,
                        //                 _token: "{{ csrf_token() }}",
                        //                 form_type: 'brand_modal',
                        //             },
                        //             dataType: 'json',
                        //             success: function(data) {
                        //                 var arr = []
                        //                                 $.each(data, function(index, value) {
                        //                                     arr.push({
                        //                                         id: index,
                        //                                         text: value
                        //                                     })
                        //                                 })
                        //                                 $('#product_name_' + i).html(arr);
                        //             }
                        //         });
                        //         // $('#add_brand_modal').modal('show');
                        //     }
                        // });
                        // $('#product_name_' + i).select2();
                        // var branddropdowncnt = 1;
                        // $('#product_name_' + i).on('select2:open', function() {
                        //     let brand_options = $(this).data('select2');
                        //     if (!$('.select2-link').length) {
                        //         if (branddropdowncnt == 1) {
                        //             brand_options.$results.parents('.select2-results')
                        //                 .append(
                        //                     '<div class="select2-link2 select2-close text-right"><button id="open_brand_modal" class="btn btn-secondary">Add New Item +</button></div>'
                        //                 )
                        //                 .on('click', function(b) {
                        //                     // $('#add_brand_modal').modal('show');
                        //                 });
                        //             branddropdowncnt++;
                        //         }
                        //     }

                        // });



                    });
    </script>
@endsection
