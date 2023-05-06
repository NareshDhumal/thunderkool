@extends('backend.layouts.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                            {{ Form::label('supplier_bill_no', 'Supplier Bill No *') }}
                                            {{ Form::text('supplier_bill_no', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            {{ Form::label('dated', ' Dated *') }}
                                            {{ Form::date('dated', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
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
                                                    <th scope="col">Gst %</th>
                                                    <th scope="col">Gst Amount</th>
                                                    <th scope="col">Total Amount</th>





                                                    {{-- <th scope="col">Unit</th> --}}

                                                    {{-- <th scope="col">Gst</th>
                                                    <th scope="col">Unit</th>
                                                    <th scope="col">Total</th> --}}
                                                    <th><button class="btn btn-secondary" id="add_btn">Add</button>
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

                                    <td width="180">Total Amount<input type="text" class="form-control finalgstamount"
                                            name="finalgstamount" value="" readonly="readonly"></td>
                                    </tr>

                                    <tr>
                                        <td colspan="12" align="right">Total Amount (Without GST)</td>
                                        <td><input type="text" class="form-control" name="total_without_tax"
                                                value="" id="total_without_tax" readonly="readonly"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="12" align="right">GST Amount</td>
                                        <td><input type="text" class="form-control" name="final_igst_amount"
                                                value="" id="gst_amount" readonly="readonly"></td>
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



    <script>
        $(document).ready(function() {
            alert('ok');
            // $('.product_form').hide()
            //   $('.repeater').hide()
            //   jQuery('#add_btn').on('click',function(){
            // console.log('ok');
            // jQuery('.product_form').toggle();
            // });

            $('#supplier_id').select2();
            $('#company_id').select2();


            //repeter
            // code 4
            i = 0;
            jQuery('#add_btn').on('click', function() {
                // BindControls()
                i++;
                let data = '';

                data = '<div class="main_div row"> <div class="cart-title" data-myval="' + i + '">';


                //  let abc = "{{ $products }}";
                //  data+='<input type="select" name="product_name[]"  id="option_1" class="form-control option_text" placeholder="Enter product name" required></div>';

                data = '<tr class="table_row" id="row' + i + '">';
                data +=
                    // '<td><select name="product_name[]" id="product_name" class="form-control product_name" placeholder="Enter product name"></select></td>';
                    '<td><select  name="product_name[]" class="form-control product_name" id="product_name' +
                    i + '" style="width: 200px;"></select></td>';


                data +=
                    '<td><input type="text" name="hsn_code[]"  id="hsn_code' + i +
                    '" class="form-control hsn_code" placeholder="Enter hsn code"></td>';


                // data += '<td>{{ Form::text('p_part_no[]', null, ['class' => 'from-control']) }}</td>';
                // data +=
                //     '<td>{{ Form::text('p_custom_port_no[]', null, ['class' => 'from-control']) }}</td>';
                data +=
                    '<td><input type="text" name="quantity[]"  id="quantity_' + i +
                    '" data-myval="' + i +
                    '" class="form-control quentity" placeholder="Enter quentity name"></td>';
                // data +=
                //     '<td>{{ Form::text('amount[]', null, ['class' => 'from-control amount product_rate']) }}</td>';

                data +=
                    '<td><input type="text" name="rate[]"  id="product_rate' + i +
                    '" data-myval="' + i +
                    '" class="form-control product_rate" placeholder="Enter rate"></td>';


                data +=
                    '<td><input type="text" name="amount[]"  id="product_amount' + i +
                    '"  data-myval="' + i +
                    '" class="form-control product_amount" placeholder="Enter amount"></td>';



                // data +=
                //     '<td>{{ Form::select('unit[]', $p_unit, null, ['class' => "from-control unit'+ i +'"]) }}</td>';

                data +=
                    '<td>{{ Form::select('cgst_percent[]', $gst_percent, null, ['class' => 'from-control gst_percent', 'placeholder' => 'Gst']) }}</td>';


                data +=
                    '<td><input type="text" name="gst_amount[]"  id="gst_amount' + i +
                    '" class="form-control gst_amount" placeholder="Gst Amount"></td>';


                data +=
                    '<td><input type="text" name="total_amount[]"  id="total_amount' + i +
                    '" class="form-control total_amount" placeholder="Total amount"></td>';






                // data += '<td>{{ Form::text('rate[]', null, ['class' => 'from-control rate']) }}</td>';

                // data +=
                //     '<td>{{ Form::select('cgst_percent[]', $gst_percent, null, ['class' => 'from-control gst_percent']) }}</td>';

                // data += '<td>{{ Form::text('product_unit[]', null, ['class' => 'from-control']) }}</td>';
                // data +=
                //     '<td>{{ Form::text('total_amount[]', null, ['class' => 'from-control total_amount']) }}</td>';
                data += '<td><button type="button" id="' + i +
                    '" class="btn btn-danger remove_row">Delete</button></td>';
                data += '</tr>';
                data += '</div></div>';
                $('.access_data').append(data);


                $(document).on('click', '.remove_row', function() {
                    var row_id = $(this).attr("id");
                    $('#row' + row_id + '').remove();
                });

                $('#product_name' + i).on('change', function() {
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
                            console.log(return_data);
                            $("#hsn_code" + i).val(return_data['hsn_code']);
                            $("#product_rate" + i).val(return_data['product_rate']);

                        }
                    });
                });




            });


            //calculate amount according to quentity
            // $(document).on('change', '#quentity', function() {

            //     // var row_id = $('#row'+i).data('myval');
            //     var quentity = $(this).val();
            //     var product_rate = $('#product_rate' + i).val();

            //     console.log('#quantity' + i);
            //     console.log('#product_rate' + i);
            //     console.log('#product_amount' + i);
            //     var amount = parseFloat(quentity) * parseFloat(product_rate);
            //     $('#product_amount' + i).val(amount);


            // });

            $(document).on('change', '.quentity', function() {
                var quentity = $(this).val();
                var row_id = $(this).attr('id');
                var row_count = row_id.split('_');
                // console.log(row_count);
                var test = row_count[1];

                var product_rate = $('#product_rate' + test).val();
             
                var amount = parseFloat(quentity) * parseFloat(product_rate);
                $('#product_amount' + test).val(amount);


            });

            // calculate amount on rate change
            $(document).on('change', '.product_rate', function() {
                var rate = $(this).val();

                var row_id = $(this).attr('id');
                var row_count = row_id.split('_');
                console.log(row_count);
                var test = row_count[2];

                // console.log('#quantity_' + row_count[2]);
                var quentity = $('#quantity_' + test).val();

             
            //     // var amount = parseFloat(quentity) * parseFloat(rate);
            //     // $('#product_amount' + test).val(amount);


            });





            $(document).on('blur', '.quentity', function() {
                var total_quentity = $(document).find('.quentity').get();

                var total = 0;
                $(total_quentity).each(function() {
                    total += parseInt($(this).val());
                    // console.log(total);
                    $('.finalquantity').val(total);

                });

            });

            $(document).on('blur', '.amount', function() {
                var amount = $(document).find('.amount').get();

                var total = 0;
                $(amount).each(function() {
                    total += parseInt($(this).val());
                    // console.log(total);
                    $('.finalamount').val(total);

                });

            });


            //calculating gst amount according to gst percent
            $(document).on('change', '.gst_percent', function() {

                var gst_percent = $(this).val();
                var amount_data = $('#product_amount' + i).val();


                var gst_amount = (amount_data * gst_percent) / 100;

                $('#gst_amount' + i).val(gst_amount);


                var row_total_gst = Number(amount_data) + Number(gst_amount);

                $("#total_amount" + i).val(row_total_gst);
                $('myval' + i).val(row_total_gst);


            });

            // $(document).on('change', '.p_unit' + i, function() {

            //     var unit = $(this).val();
            //     console.log(unit);

            // });











            //calculating full single row
            // $(document).on('change', '.gst_percent', function() {

            // var amount_data = $('#product_amount' + i).val();

            // var gst_amount = $("#gst_amount" + i).val();

            // var row_total_gst = (amount_data + gst_amount)

            // $("#total_amount" + i).val(row_total_gst.toFixed(2));
            // amountWords(row_total_gst);
            // });


            // payment mode
            $('#payment_m').hide();
            $('#bank_name').hide();
            $('#cheque_date').hide();
            $('#payment_electronic_ref').hide();

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
                // alert(select_val);

                var csrfName = '<?= csrf_token() ?>';
                // alert(select_val);
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

                $('#product_name' + i).select2({

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


            // $(document).on('change', '#company_id', function() {
            //     let select_val = $('#company_id').find(":selected").val();
            //     $('#product_name' + i).select2({
            //         ajax: {
            //             type: "post",
            //             dataType: 'json',
            //             url: "{{ url('/') }}/admin/purchase/bill/productdetails",

            //             data: function(params) {

            //                 return {
            //                     select_val: select_val,
            //                     // _token: csrfName,

            //                     q: params.term,
            //                     page: params.page,
            //                     _token: csrfName

            //                 };

            //             },
            //             processResults: function(response, params) {
            //                 params.page = params.page || 1;

            //                 var arr = []
            //                 $.each(response, function(index, value) {
            //                     arr.push({
            //                         id: index,
            //                         text: value
            //                     })
            //                 })
            //                 return {
            //                     results: arr
            //                 };
            //             },
            //             cache: true
            //         }
            //     });
            // });

            // $(document).on('change', '#company_id', function() {
            //     $('.table_row').remove();

            // });

            // $(document).on('change', '#product_name', function() {
            // alert('ok');


            //     var a = $('#product_name').val();
            //     alert(a)
            //     var csrfName = '<?= csrf_token() ?>';
            //     // alert(select_val);
            //     $.ajax({
            //         type: "post",
            //         url: "{{ url('/') }}/admin/purchase/bill/producthsn",
            //         // data: select_val,
            //         data: {
            //             _token: csrfName,
            //             a: a
            //         },
            //         // dataType: "dataType",
            //         success: function(response) {
            //             console.log(response['hsn_code']);

            //             $(".hsn_code").val(response['hsn_code']);
            //             $(".product_rate").val(response['product_rate']);

            //         }
            //     });
            // });

        });
    </script>
@endsection
