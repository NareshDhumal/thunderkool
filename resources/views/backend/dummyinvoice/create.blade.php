<?php
use App\Models\backend\DummyInvoive;
?>
@extends('backend.layouts.app')
@section('title', 'Create Quatation Approval')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <!--begin::Container-->
        {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
        {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Quotation/Approval</h4>
        </div>

        {{-- </div> --}}
        {{-- </div> --}}
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <div class="content">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 col-12">
                                {{-- <h4 class="card-title">Create Invoice</h4> --}}
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <select id="company_select" class="form-select" name="company_id_select" required>
                                    <option value="">Select a Company</option>
                                    @foreach ($companies as $key => $company)
                                        <option value="{{ $key }}">
                                            {{ $company }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        @include('backend.includes.errors')
                        {{ Form::open(['url' => 'admin/dummyinvoice/store', 'id' => 'invoice_form']) }}
                        @php
                            if (date('m') > 4) {
                                $year = date('Y', strtotime('+1 year')) . '-' . date('Y', strtotime('+2 year'));
                            } else {
                                $year = date('Y') . '-' . date('Y', strtotime('+1 year'));
                            }
                        @endphp
                        @csrf
                        {{-- <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Create Invoice</h4>
                        </div>

                    </div> --}}
                        <input type="hidden" id="financial_year" name="financial_year" value="{{ $year }}">
                        <input type="hidden" id="company_id" name="company_id" class="form-control">
                        <div class="form-body mb-5">
                            <div class="row mb-5">
                                <div style="text-align:left" class="col-md-6 col-12">
                                    {{-- <p style="font-weight:600">Company Logo</p> --}}
                                    <div id="company_logo">
                                        <p style="font-size:0.8em;color: rgb(158, 158, 158)">Select a Company to fill the
                                            data</p>
                                    </div>
                                </div>
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Company Information</p>
                                    <div id="company_info">
                                        <p style="font-size:0.8em;color: rgb(158, 158, 158)">Select a Company to fill the
                                            data</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 mb-5">
                                @php
                                    $last_invoice = DummyInvoive::orderBy('dummy_invoice_no_id', 'DESC')
                                        ->get('dummy_invoice_no_id')
                                        ->toArray();
                                    $last_invoice_id = '0001';
                                    if ($last_invoice) {
                                        $last_invoice_id = $last_invoice[0]['dummy_invoice_no_id'] + 1;
                                        $last_invoice_id = '000' . $last_invoice_id;
                                        // dd('hello');
                                    }
                                    // dd($last_invoice_id);
                                @endphp
                                <div class="mb-5">
                                    <div style="justify-content: center ;display:flex">
                                        <h5 style="text-align: center;">Quotation/Approval</h5>
                                    </div>
                                    {{-- <div> --}}

                                    {{-- <input type="checkbox" class="" name="invoice_cum_challan" value="1">
                                    <label style="font-weight:600">Select if creating INVOICE CUM CHALLAN</label> --}}
                                    {{--
                                </div> --}}
                                </div>
                                <div style="text-align:left" class="col-md-2 col-12">
                                    {{-- <input style="margin-top:5px;" class="form-check-input" type="checkbox"
                                        name="invoice_cum_challan" value="1" id="invoice_cum_challan">
                                    <label class="form-check-label" for="invoice_cum_challan">
                                        Select if creating INVOICE CUM CHALLAN
                                    </label> --}}
                                    <p style="font-weight:600">Quotation/Approval No.</p>
                                    <div style="min-height:100px" id="invoice_no">
                                        <input type="text" id="invoice_no" name="invoice_no"
                                            value="{{ $last_invoice_id }}" class="form-control disabled">
                                    </div>
                                </div>
                                <div style="text-align:left" class="col-md-3 col-12">
                                    <p style="font-weight:600">Date Of Issue</p>
                                    <div style="min-height:100px" id="date_of_issue">
                                        <input value="{{ date('Y-m-d') }}" type="date" id="date_of_issue_input"
                                            name="date_of_issue" class="form-control">
                                        {{-- <input type="date" /> --}}
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="row" style="display:none" id="customer">
                                        <div style="text-align:left" class="col-md-4 col-12">
                                            <p style="font-weight:600">Customer name</p>
                                            <div style="min-height:100px" id="user_id">
                                                {{ Form::select('customer_id', $customers, null, [
                                                    'class' => 'form-select',
                                                    'id' => 'customer_id',
                                                    'placeholder' => 'Select a Customer',
                                                ]) }}
                                            </div>
                                        </div>

                                        <div style="text-align:left" class="col-md-8 col-12">
                                            <p style="font-weight:600">Customer Details</p>
                                            <div style="min-height:100px" id="customer_details">
                                                <textarea class="form-control" style="height: 100px" id="customer_details_input" name="vehicle" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- <div class="row" style="display:none" id="customer">
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Customer name</p>
                                    <div style="min-height:100px" id="user_id">
                                        {{ Form::select('customer_id', $customers, null, [
                                            'class' => 'form-select',
                                            'id' => 'customer_id',
                                            'placeholder' => 'Select a Customer',
                                        ]) }}
                                    </div>
                                </div>
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Customer Details</p>
                                    <div style="min-height:100px" id="customer_details">
                                        <textarea class="form-control" id="customer_details_input" name="vehicle" readonly></textarea>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row" id="vehicle_container" style="display:none">
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <div class="d-flex align-items-center">
                                        <label class="d-flex align-items-center"><input type="checkbox" id="manual_invoice"
                                                value="1" name="manual_invoice" class="me-2 form-check-input">Manual
                                            Invoice</label>
                                    </div>
                                    <div class="row g-5 mt-2">
                                        <div class="col-6">
                                            <p style="font-weight:600">Vehicle Make</p>

                                            {{ Form::select('vehicle_make_id', ['' => 'Select a Vehicle Make'], null, [
                                                'class' => 'form-select',
                                                'id' => 'vehicle_make_id',
                                            ]) }}
                                        </div>
                                        <div class="col-6">
                                            <p style="font-weight:600">Vehicle Model</p>

                                            {{ Form::select('vehicle_model_id', ['' => 'Select a Vehicle Model'], null, ['class' => 'form-select', 'id' => 'vehicle_model_id']) }}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Vehicle Detailss</p>
                                    <div style="min-height:100px" id="vehicle_details">
                                        <textarea class="form-control" id="vehicle_details_input" name="vehicle"></textarea>
                                        <input placeholder="KM" type="number" name="km" class="form-control">
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <p style="font-weight:600">Vehicle Details</p>
                                    <div class="row" id="vehicle_details">
                                        <div class="col-9">
                                            <textarea class="form-control" style="height: 100px" id="vehicle_details_input" name="vehicle"></textarea>
                                        </div>
                                        <div class="col-3">
                                            <p style="font-weight:600">Km</p>
                                            <input placeholder="KM" type="number" name="km" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-5" id="product_table" style="display:none">
                                <div style="text-align:left" class="col-md-12 col-12">

                                    <span id="add_product" class="btn btn-secondary my-2 float-right">Add Product</span>
                                    {{-- For Company without gst --}}
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="thead_content" style="display:none">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product Description</th>
                                                    <th scope="col">Amt</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_product">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="display:none" id="tfoot_content">
                                            <tbody>
                                                <tr id="total" style="background:rgba(70,70,70,0.1)">
                                                    <td>Discount : <input name="discount" class="form-control"
                                                            onchange="getAmount()" id="product_discount" type="text">
                                                    </td>
                                                    <td colspan="2">Total : <input name="total_amount"
                                                            class="form-control" type="text" id="product_total_amount"
                                                            readonly></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- For Company with gst --}}
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="cwg_thead_content" style="display:none">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product Description</th>
                                                    <th scope="col" id="hsn_code">HSN Code</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Unit</th>
                                                    <th scope="col">Rate</th>
                                                    <th scope="col" hidden>Stock</th>

                                                    <th scope="col">Amount</th>
                                                    {{-- <th colspan="2">CGST</th>
                                                    <th colspan="2">SGST</th>
                                                    <th colspan="2">IGST</th> --}}
                                                    <th scope="col">Disc</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    {{-- <th>Percent</th>
                                                    <th>Amount</th>
                                                    <th>Percent</th>
                                                    <th>Amount</th>
                                                    <th>Percent</th>
                                                    <th>Amount</th> --}}
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="cwg_tbody_product">

                                            </tbody>
                                            <tfoot>
                                                <tr style="background:rgba(70,70,70,0.1)">
                                                    <td><strong>Total</strong></td>
                                                    <td></td>
                                                    {{-- <td>
                                                        <input style="min-width:60px !important;" name="total_quantity"
                                                            id="cwg_total_quantity" class="form-control" readonly>
                                                    </td> --}}
                                                    <td></td>
                                                    <td>
                                                        {{-- <input style="min-width:60px !important;" name="total_rate_all"
                                                        id="cwg_total_rate_all" class="form-control" readonly> --}}
                                                    </td>
                                                    <td>
                                                        <input style="min-width:60px !important;" name="total_amount_all"
                                                            id="cwg_total_amount_all" class="form-control" readonly>
                                                    </td>
                                                    {{-- <td>
                                                        <input style="min-width:60px !important;" name="total_cgst_all"
                                                            id="cwg_total_cgst_all" class="form-control" readonly>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input style="min-width:60px !important;" name="total_sgst_all"
                                                            id="cwg_total_sgst_all" class="form-control" readonly>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <input style="min-width:60px !important;" name="total_igst_all"
                                                            id="cwg_total_igst_all" class="form-control" readonly>
                                                    </td> --}}
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <input style="min-width:60px !important;"
                                                            name="total_amount_all_gst" id="cwg_total_amount_all_gst"
                                                            class="form-control" readonly>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="display:none" id="cwg_tfoot_content">
                                            <tbody>
                                                <tr id="cwg_total" style="background:rgba(70,70,70,0.1)">
                                                    <td>
                                                        <p>Total Amount without Tax</p>
                                                        <input style="min-width:60px !important;" name="total_amount_all"
                                                            id="cwg_total_amount_all_footer" class="form-control"
                                                            readonly>
                                                    </td>
                                                    {{-- <td>
                                                        <p>IGST</p>
                                                        <input style="width:60px !important;" name="total_igst_all"
                                                            id="cwg_total_igst_all_footer" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <p>CGST</p>
                                                        <input style="width:60px !important;" name="total_cgst_all"
                                                            id="cwg_total_cgst_all_footer" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <p>SGST</p>
                                                        <input style="width:60px !important;" name="total_sgst_all"
                                                            id="cwg_total_sgst_all_footer" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <p>Grand Total (With GST)</p>
                                                        <input name="cwg_total_amount" class="form-control"
                                                            type="text" id="cwg_total_amount_all_gst_footer" readonly>
                                                    </td> --}}
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="display:none"
                                            id="product_common_content">
                                            <tbody>
                                                <tr id="total" style="background:rgba(70,70,70,0.1)">
                                                    <td id="payment_method_cell" colspan="4">
                                                        <p>Payment Mode</p>
                                                        <div class="d-flex">
                                                            <div class="form-check me-4">
                                                                {{ Form::radio('payment_method', 'Cash', false, ['id' => 'cash', 'class' => 'form-check-input','required' => true]) }}
                                                                {{ Form::label('cash', 'Cash') }}
                                                            </div>
                                                            <div class="form-check me-4">
                                                                {{ Form::radio('payment_method', 'Cheque', false, ['id' => 'cheque', 'class' => 'form-check-input','required' => true]) }}
                                                                {{ Form::label('cheque', 'Cheque') }}
                                                            </div>
                                                            <div class="form-check me-4">
                                                                {{ Form::radio('payment_method', 'Electronic Transaction', false, ['id' => 'electronic_transaction', 'class' => 'form-check-input','required' => true]) }}
                                                                {{ Form::label('electronic_transaction', 'Electronic Transaction') }}
                                                            </div>
                                                            <div class="form-check me-4">
                                                                {{ Form::radio('payment_method', 'Pending', false, ['id' => 'pending', 'class' => 'form-check-input','required' => true]) }}
                                                                {{ Form::label('pending', 'Pending') }}
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin:10px 0px"
                                                            id="payment_method_input_fields">

                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="free_of_charge" value="1" id="free_of_charge">
                                                            <label class="form-check-label" for="free_of_charge">
                                                                Free of Charge
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="background:rgba(70,70,70,0.1)">
                                                        <div>
                                                            <p>Amount Chargable (in words)</p>
                                                            <input class="form-control" id="amt_in_words" type="text"
                                                                name="amt_in_words" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Terms & Conditions</p>
                                    <div style="min-height:100px" id="terms_and_conditions">
                                        <ol>
                                            <li>Subject to Kalyan Jurisdiction</li>
                                            <li>Vehicle Parked, Driven & worked under owners risk</li>
                                            <li>Goods once sold will not be taken back</li>
                                            <li>No Guarantee On Gas & Electronic Items</li>
                                            <li>KM is just mentioned for reference purpose</li>
                                        </ol>
                                    </div>
                                </div>
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Common Seal</p>
                                    <div style="min-height:200px" id="company_seal">
                                        <p style="font-size:0.8em;color: rgb(158, 158, 158)">Select a Company to fill the
                                            data</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style="text-align:left" class="col-md-12 col-12">
                                    <p style="font-weight:600">Remark</p>
                                    <textarea type="text" name="remark" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-start">
                                {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-5']) }}
                                <button type="reset" class="btn btn-primary mr-1 mb-1">Reset</button>
                            </div>
                        </div>
                        <input type="hidden" name="vehicle_number" id="vehicle_number">
                        <input type="hidden" name="product_counter" id="product_counter">
                        <input type="hidden" name="row_count" id="row_count">
                        <input type="hidden" name="gst_flag" id="gst_flag">
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}


    <script>
        var company_id;
        var customer_id;
        var vehicle_make_id;
        var vehicle_model_id;
        var row_count = 0;
        var product_counter = 0;
        var company_with_gst = 0;
        var products;
        var service_id = 0;
        var customer_state;
        $(document).ready(function() {


            $('#vehicle_container').hide();
            $('#product_table').hide();
            // to get Company Details
            company_id = $('#company_select').val();
            if (company_id) {
                getCompanyDetails(company_id);
            }

            // Check the radio button selection
            getInputFields(getSelectedRadio());

            // to get Company Details
            $('#company_select').change(function() {

                company_id = $(this).val();
                // console.log(company_id);
                if (company_id) {
                    getCompanyDetails(company_id);
                }
            });
            // To get customer details
            $('#customer_id').change(function() {
                customer_id = $(this).val();
                if (customer_id) {
                    getCustomerDetails(customer_id);
                }
            });

            // To get customer details
            $('#vehicle_model_id').change(function() {
                vehicle_model_id = $(this).val();
                // console.log(vehicle_model_id);
                if (vehicle_model_id) {
                    getVehicleDetails(vehicle_model_id);
                }

            });

            // To get Vehicle model
            $('#vehicle_make_id').change(function() {
                vehicle_make_id = $(this).val();
                // console.log(vehicle_make_id);
                if (vehicle_make_id) {
                    getVehicleModel(vehicle_make_id, customer_id);
                }
            });

            // If the checkbox is checked
            $("#manual_invoice").click(function() {
                if ($(this).is(':checked')) {
                    $('#vehicle_make_id').prop('disabled', true);
                    $('#vehicle_model_id').prop('disabled', true);
                    $('#vehicle_details_input').empty();
                    $('#vehicle_details_input').prop('readonly', false);
                } else {
                    $('#vehicle_make_id').prop('disabled', false);
                    $('#vehicle_model_id').prop('disabled', false);
                }
            });

            // When clicking on Add product
            $('#add_product').click(function() {
                // console.log(product_counter);
                // if (company_with_gst == 0) {
                //     // Without GST
                //     $('#thead_content').show();
                //     $('#tfoot_content').show();
                //     $('#product_common_content').show();
                //     $('#tbody_product').append(`
            //     <tr id="row_${product_counter}">
            //         <td>
            //             <select style="min-width:150px !important;"s class="form-select" name="product_description_${product_counter}" id="product_description_input_${product_counter}" >
            //             </select>
            //         </td>
            //         <td>
            //             <input class="product_amount form-control" id="product_amount" data-id="${product_counter}" type="text" onchange="getAmount()" name="product_amount_${product_counter}">
            //         </td>
            //         <td style="text-align:center;">
            //             <i onClick="removeProduct(${product_counter})" style="font-size:1.5em;cursor:pointer" class="far fa-minus-square text-danger"></i>
            //         </td>
            //     </tr>
            // `);
                //     getProducts(product_counter);
                // }
                if (company_with_gst == 1 || company_with_gst == 0) {
                    // With GST
                    $('#cwg_thead_content').show();
                    $('#cwg_tfoot_content').show();
                    $('#product_common_content').show();
                    var table_data = `
                    <tr id="cwg_row_${product_counter}">
                        
                        <td>
                            <select style="min-width:150px !important;"s class="form-select cwg_product_description_input" name="products[${product_counter}][product_description]" id="cwg_product_description_input_${product_counter}" onChange="getProduct(${product_counter});">
                            </select>
                        </td>`;
                    var company_id = $('#company_select').val();
                    if (company_id == '1') {

                        table_data += `<td id="hsn_code" class="hsn_code_td">
                                <input style="min-width:80px !important;" name="products[${product_counter}][hsn]" id="cwg_hsn_code_${product_counter}" class="form-control cwg_hsn_code">    
                            </td>`;
                    }
                    table_data += `<td>
                            <input style="min-width:80px !important;" name="products[${product_counter}][quantity]" id="cwg_quantity_${product_counter}" class="form-control cwg_quantity" onChange="getCWGAmount(${product_counter});">    
                        </td>
                        <td>
                            <select style="min-width:80px !important;" class="form-select unit_select_input" name="products[${product_counter}][unit]" id="cwg_p_unit_${product_counter}" onChange="calculateUnit(${product_counter})">
                            </select>
                          
                        </td>
                        <td>
                            <input style="min-width:80px !important;" name="products[${product_counter}][rate]" id="cwg_rate_${product_counter}" class="form-control cwg_rate" onChange="getrate(${product_counter})">    
                        </td>   
                        
                        <td hidden>
                            <input style="min-width:80px !important;" name="products[${product_counter}][stock]" id="product_stock_${product_counter}" class="form-control product_stock">    
                        </td>   

                        <td>
                            <input style="min-width:80px !important;" name="products[${product_counter}][amount]" id="cwg_amount_${product_counter}" class="form-control cwg_amount" onChange="getorignalamount(${product_counter})" readonly>    
                        </td>
                      
                        <td>
                            <input style="min-width:80px !important;" name="products[${product_counter}][discount]" id="cwg_discount_${product_counter}" class="form-control cwg_discount" onChange="getDiscountedAmount(${product_counter})">    
                        </td>
                        <td>
                            <input type="hidden" name="row_counter[${product_counter}]" value="${product_counter}">    
                            <input style="min-width:80px !important;" name="products[${product_counter}][totalamount]" id="cwg_total_amount_${product_counter}" class="form-control cwg_total_amount" readonly>    
                        </td>
                        <td style="text-align:center;">
                            <i onClick="removeProduct(${product_counter})" style="font-size:1.5em;cursor:pointer" class="far fa-minus-square text-danger"></i>
                        </td>
                    </tr>
                `;
                    $('#cwg_tbody_product').append(table_data);
                    // console.log(products);
                    getProducts(product_counter);
                    getUnits(product_counter);

                }
                product_counter++;
                row_count++;
                $('#product_counter').val(product_counter);
                $('#row_count').val(row_count);
            });






            // $('#company_select').change(function(){
            $(document).on('change', '#company_select', function() {
                var company_id = $(this).val();
                // console.log('fjlkjhf;s');
                if (company_id == '1') {
                    $('#hsn_code').show();
                    // $('.hsn_code_td').show();
                    // $('.cwg_hsn_code').hide();
                } else {
                    $('#hsn_code').hide();
                    // $('.hsn_code_td').show();
                    // $('.cwg_hsn_code').show();
                }
            });



        });

        // To remove the product row from the table
        function removeProduct(removeProduct) {
            if (company_with_gst == 0) {
                $(`#cwg_row_${removeProduct}`).remove();
                row_count--;
                // console.log(product_counter);
                $('#row_count').val(row_count);
                getAmount();
                getTotalAmount();

            } else {
                $(`#cwg_row_${removeProduct}`).remove();
                row_count--;
                // console.log(product_counter);
                $('#row_count').val(row_count);
                getTotalAmount();
            }
        }

        // To get the amount from the table field
        function getAmount() {
            var total_amount = 0;
            let total_amt = document.querySelectorAll(".product_amount");
            // console.log(product_discount);
            total_amt.forEach(input => {
                if (!input.value == '') {
                    total_amount = parseInt(total_amount) + parseInt(input.value);
                }
            });
            $('#product_total_amount').val(calculateDiscount(total_amount));
            $('#amt_in_words').val('INR ' + numberToWords.toWords(calculateDiscount(total_amount)).concat(' only')
                .toUpperCase());
        }

        // calculate discount 
        function calculateDiscount(total_amount) {
            let discount = 0;
            product_discount = $("#product_discount").val();
            discount = product_discount ? product_discount : 0;
            let calculated_amt = total_amount - discount;
            return calculated_amt;
        }

        // Check radio button for payment mehtod
        $("input[name=payment_method]").change(function() {
            $('#payment_method_input_fields').empty();
            // console.log(getSelectedRadio());
            getInputFields(getSelectedRadio());
        });


        // to get Company Details
        function getCompanyDetails(company_id) {
            let token = "{{ csrf_token() }}";
            if (company_id != "" && company_id != 0) {
                let send_data = {
                    'company_id': company_id,
                    '_token': token
                };
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/getCompanyDetails') }}",
                    data: send_data,
                    success: function(data) {
                        var response = JSON.parse(data)
                        if (Object.keys(response).length > 0) {
                            company_with_gst = response.bill_gst;
                            resetForm();
                            $('#gst_flag').val(company_with_gst);
                            $('#company_id').val(company_id);
                            $('#company_logo').append(
                                `<img style="width:200px;" src="{{ asset('/storage/app') }}${response.company_logo}">`
                            );
                            $('#company_seal').append(
                                `<img style="width:140px;" src="{{ asset('/storage/app') }}${response.company_seal}">`
                            );

                            $('#company_info').append(`
                            <p style="margin-bottom:2px;">${response.company_name}</p>
                            <p style="margin-bottom:2px;">${response.company_address}</p>
                        `);
                            $('#customer').show();
                        }
                    }
                });
            }
        }
        // To get customer details
        function getCustomerDetails(customer_id) {
            let token = "{{ csrf_token() }}";
            if (customer_id != "" && customer_id != 0) {
                let send_data = {
                    'customer_id': customer_id,
                    '_token': token
                };
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/getCustomerDetails') }}",
                    data: send_data,
                    success: function(data) {
                        var response = JSON.parse(data)
                        var customer = response.customer;
                        var vehicle_make = response.vehicle_make;
                        if (customer != null) {
                            $('#vehicle_container').show();
                            $('#product_table').show();
                            if (Object.keys(response).length > 0) {
                                $('#customer_details_input').prop('readonly', false);
                                $('#customer_details_input').empty();
                                customer_state = customer.state;
                                // console.log(customer_state_id);
                                $('#customer_details_input').append(
                                    `Name : ${customer.customer_name}\nAddress : ${customer.address}\nEmail : ${customer.email}\nMobile No : ${customer.mobile_no}\n`
                                );
                            }
                        }
                        if (vehicle_make != null) {
                            if (Object.keys(vehicle_make).length > 0) {
                                $('#vehicle_make_id').empty()
                                $('#vehicle_make_id').append(
                                    `<option value="">Select a Vehicle
                                        Make</option>`
                                );
                                Object.keys(vehicle_make).forEach(key => {
                                    // console.log(key, vehicle_make[key]);
                                    $('#vehicle_make_id').append(
                                        `<option value="${key}">${vehicle_make[key]}</option>`
                                    );
                                });
                            }
                        }
                    }
                });
            }
        }

        // To get Vehicle model
        function getVehicleModel(vehicle_make_id, customer_id) {
            // console.log(vehicle_make_id);
            let token = "{{ csrf_token() }}";
            if (vehicle_make_id != "" && vehicle_make_id != 0) {
                // console.log(vehicle_make_id);
                let send_data = {
                    'vehicle_make_id': vehicle_make_id,
                    'customer_id': customer_id,
                    '_token': token
                };
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/getVehicleModel') }}",
                    data: send_data,
                    success: function(data) {
                        var vehicle_model = JSON.parse(data)
                        // console.log(vehicle_model);
                        if (vehicle_model != null) {
                            if (Object.keys(vehicle_model).length > 0) {
                                $('#vehicle_model_id').empty()
                                $('#vehicle_model_id').append(
                                    `<option value="">Select a Vehicle
                                        Model</option>`
                                );
                                Object.keys(vehicle_model).forEach(key => {
                                    // console.log(key, vehicle_make[key]);
                                    $('#vehicle_model_id').append(
                                        `<option value="${key}">${vehicle_model[key]}</option>`
                                    );
                                });
                            }
                        }
                    }
                });
            }
        }

        function getVehicleDetails(vehicle_model_id) {
            let token = "{{ csrf_token() }}";
            if (vehicle_model_id != "" && vehicle_model_id != 0) {

                let send_data = {
                    'vehicle_model_id': vehicle_model_id,
                    'vehicle_make_id': vehicle_make_id,
                    'customer_id': customer_id,
                    '_token': token
                };
                // console.log(send_data);
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/getVehicleDetails') }}",
                    data: send_data,
                    success: function(data) {
                        // console.log(data);
                        var vehicle = JSON.parse(data)
                        // console.log(vehicle_model);
                        if (vehicle != null) {
                            if (Object.keys(vehicle).length > 0) {
                                $('#vehicle_details_input').empty();
                                $('#vehicle_number').empty();
                                $('#vehicle_details_input').append(
                                    `Vehicle No : ${vehicle.vehicle_no}\nChassis No : ${vehicle.chassis_no}\nSerial No : ${vehicle.serial_no}`
                                );
                                $('#vehicle_number').val(vehicle.vehicle_no);
                            }
                        }
                    }
                });
            }
        }

        // To get the selected radio input 
        function getSelectedRadio() {
            var ele = document.getElementsByName('payment_method');
            // console.log(ele);
            for (i = 0; i < ele.length; i++) {
                if (ele[i].checked)
                    return ele[i].value;
            }
        }

        //  Get the input fields according to which radio button is selected in payment method
        function getInputFields(selected) {
            if (selected == 'Cheque') {
                // console.log();
                $('#payment_method_input_fields').append(`
                <div class="col-4">
                    <input type="text" name="bank_name" placeholder="Enter Bank Name" class=" form-control">
                </div>
                <div class="col-4">
                    <input type="text" name="cheque_no" placeholder="Enter Cheque No." class=" form-control">
                </div>  
                <div class="col-4">
                    <input type="date" name="cheque_date" placeholder="Enter Cheque Date" class=" form-control">
                </div>  
            `);
            } else if (selected == 'Electronic Transaction') {
                $('#payment_method_input_fields').append(`
            <div class="col-8">
                    <input type="text" name="e_transaction_ref" placeholder="Enter e-payment reference" class="form-control">
            </div>
            `);
            }
        }


        function getorignalamount(product_counter) {
            var amount = $(`#cwg_amount_${product_counter}`).val();

            discount = $(`#cwg_discount_${product_counter}`).val();

            if (discount) {
                discount_percent = (amount * discount) / 100;

                var discounted_amount = (amount - discount_percent)
                console.log('DIS', discounted_amount);
                $(`#cwg_total_amount_${product_counter}`).val(parseFloat(discounted_amount).toFixed(2));

            } else {
                $(`#cwg_total_amount_${product_counter}`).val(parseFloat(amount).toFixed(2));
            }
            getTotalAmount();
        }



        // To get the products linked with selected company
        function getProducts(product_counter) {

            let token = "{{ csrf_token() }}";
            if (company_id != "" && company_id != 0) {
                let send_data = {
                    'company_id': company_id,
                    '_token': token
                };
                // console.log(send_data);
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/getProducts') }}",
                    data: send_data,
                    success: function(data) {
                        // console.log(data);
                        // $('.product_select_input').select2();
                        products = JSON.parse(data);
                        // console.log(products[0]);
                        // console.log(products);
                        if (products != null) {
                            $('.cwg_product_description_input').select2({
                                tags: true
                            });

                            if (company_with_gst == 0) {
                                $(`#cwg_product_description_input_${product_counter}`).append(`
                            <option value="">Select a product</option>
                            `);
                                Object.entries(products).forEach(entry => {
                                    const [key, value] = entry;
                                    // console.log(key, value);
                                    $(`#cwg_product_description_input_${product_counter}`).append(`
                                    <option value="${value.product_id}"  data-service_id="${value.service_id}">${value.product_name}</option>

                                `);

                                });
                            } else {

                                $(`#cwg_product_description_input_${product_counter}`).append(`
                            <option value="">Select a product</option>
                            `);
                                Object.entries(products).forEach(entry => {
                                    const [key, value] = entry;
                                    // console.log(key, value);
                                    $(`#cwg_product_description_input_${product_counter}`).append(`
                                    <option value="${value.product_id}" data-service_id="${value.service_id}">${value.product_name}</option>
                                `);

                                });
                            }
                        }
                    }
                });
            }
            //byip
        }

        function getProduct(pc) {
            let token = "{{ csrf_token() }}";
            let product_id = $(`#cwg_product_description_input_${pc}`).val();
            // console.log(product_id);
            // let product_id = $(`#cwg_product_list_${pc} option[value="${$(`#cwg_product_description_input_${pc}`).attr('data-id')}"]`).attr('data-id');
            // console.log(product_id);
            if (product_id != "" && product_id != 0) {
                let send_data = {
                    'product_id': product_id,
                    '_token': token
                };
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/getProduct') }}",
                    data: send_data,
                    success: function(data) {

                        $(`#cwg_hsn_code_${pc}`).val('');
                        $(`#cwg_quantity_${pc}`).val('');
                        $(`#cwg_unit_${pc}`).val('');
                        $(`#cwg_rate_${pc}`).val('');
                        $(`#cwg_amount_${pc}`).val('');
                        $(`#cwg_cgst_percent_${pc}`).val('');
                        $(`#cwg_cgst_amount_${pc}`).val('');
                        $(`#cwg_sgst_percent_${pc}`).val('');
                        $(`#cwg_sgst_amount_${pc}`).val('');
                        $(`#cwg_igst_percent_${pc}`).val('');
                        $(`#cwg_igst_amount_${pc}`).val('');
                        $(`#cwg_discount_${pc}`).val('');
                        $(`#cwg_total_amount_${pc}`).val('');
                        product = JSON.parse(data);
                        if (product != null) {

                            Object.entries(product).forEach(entry => {
                                const [key, value] = entry;
                                // console.log(value.product_name);
                                $(`#cwg_hsn_code_${pc}`).val(value.hsn_code);
                                $(`#cwg_p_unit_${pc}`).val(value.hsn_code);
                                $(`#cwg_rate_${pc}`).val(value.product_rate);
                                $(`#product_stock_${pc}`).val(value.product_stock);

                                service_id = value.service_id;
                                console.log(service_id);
                                if (service_id == '1') {

                                    $(`#cwg_amount_${pc}`).attr('readonly', false);
                                    $(`#cwg_quantity_${pc}`).prop('readonly', true);
                                    $(`#cwg_p_unit_${pc}`).prop('disabled', true);
                                    $(`#cwg_rate_${pc}`).prop('readonly', true);
                                    $(`#cwg_amount_${pc}`).attr('required',true);






                                } else {
                                    $(`#cwg_amount_${pc}`).attr('readonly', true);
                                    $(`#cwg_quantity_${pc}`).prop('readonly', false);
                                    $(`#cwg_p_unit_${pc}`).prop('disabled', false);
                                    $(`#cwg_rate_${pc}`).prop('readonly', false);
                                    $(`#cwg_amount_${pc}`).attr('required',false);
                                    $(`#cwg_p_unit_${pc}`).prop('required', true);
                                    $(`#cwg_quantity_${pc}`).prop('required', true);



                                }


                                if (value.product_unit == 'Nos') {

                                    $(`#cwg_p_unit_${pc} option`).prop('disabled', 'disabled');
                                    $(`#cwg_p_unit_${pc} option[value="1"]`).prop('disabled', false);

                                } else if (value.product_unit == 'Gm') {
                                    $(`#cwg_p_unit_${pc} option`).prop('disabled', 'disabled');
                                    $(`#cwg_p_unit_${pc} option[value="2"]`).prop('disabled', false);
                                    $(`#cwg_p_unit_${pc} option[value="4"]`).prop('disabled', false);


                                } else if (value.product_unit == 'Mil') {
                                    $(`#cwg_p_unit_${pc} option`).prop('disabled', 'disabled');
                                    $(`#cwg_p_unit_${pc} option[value="3"]`).prop('disabled', false);
                                    $(`#cwg_p_unit_${pc} option[value="5"]`).prop('disabled', false);


                                }


                                window[`product_stock_${pc}`] = value.product_stock;
                                let gst_percent = value.gst_percent;
                                if (gst_percent) {
                                    if (customer_state == '21') {
                                        // console.log(gst_percent);
                                        cgst_sgst_percent = gst_percent / 2;
                                        // console.log(cgst_sgst_percent);
                                        $(`#cwg_cgst_percent_${pc}`).val(cgst_sgst_percent);
                                        $(`#cwg_sgst_percent_${pc}`).val(cgst_sgst_percent);
                                    } else {
                                        $(`#cwg_igst_percent_${pc}`).val(gst_percent);
                                    }
                                }
                            });
                            service_id = 0;
                        }
                    }
                });
            }
            // getpro_unit(product_counter);

        }

        function getUnits(pc) {
            let token = "{{ csrf_token() }}";
            // let product_id = $(`#cwg_product_description_input_${pc}`).val();
            // console.log(product_id);
            let send_data = {
                '_token': token
            };
            $.ajax({
                type: 'post',
                url: "{{ url('admin/getUnits') }}",
                data: send_data,
                success: function(data) {
                    // console.log(data);
                    units = JSON.parse(data);
                    // console.log(data);
                    // console.log(units[0]);
                    if (units != null) {
                        Object.entries(units).forEach(entry => {
                            const [key, value] = entry;
                            // console.log(value.product_name);
                            $(`#cwg_p_unit_${pc}`).append(`
                            <option value="${value.P_unit_id}">${value.unit}</option>
                        `);

                        });
                    }
                }
            });
        }

        // Calculate Units
        // function calculateUnit(pc) {
        //     let selected_unit = $(`#cwg_p_unit_${pc}`).val();
        //     if (selected_unit == '2' || selected_unit == '3') {
        //         window[`cwg_divide_by_thousand_${pc}`] = true;
        //     } else {
        //         window[`cwg_divide_by_thousand_${pc}`] = false;
        //     }
        //     getCWGAmount(pc);
        // }



        // by ip

        function calculateUnit(pc) {
            let selected_unit = $(`#cwg_p_unit_${pc}`).val();
            var rate = $(`#cwg_rate_${pc}`).val();
            var quantity_value = $(`#cwg_quantity_${pc}`).val();


            if (selected_unit == '2' || selected_unit == '3') {

                // console.log('ok');
                $(`#cwg_amount_${pc}`).val(Number(rate));
                console.log('calculateUnit gm/ml', $(`#cwg_amount_${pc}`).val());
                // var amount = Number($(`#cwg_amount_${pc}`).val());

            } else {

                var amount = parseFloat(quantity_value) * parseFloat(rate);
                // console.log(amount);

                $(`#cwg_amount_${pc}`).val(amount);
                window[`cwg_og_amount_${pc}`] = amount;


            }
            getCWGAmount(pc);
        }



        // Check Stock
        function checkStock(pc, qv) {
            let current_product_stock = window[`product_stock_${pc}`];
            if (parseInt(current_product_stock) < parseInt(qv)) {
                $(`#cwg_quantity_${pc}`).val('');
                alert(`Available stock ${current_product_stock}`);
                return 0;
            } else {
                return $(`#cwg_quantity_${pc}`).val();
            }
        }

        // To calculate the amount of and gst amount
        function putAmount(pc, amount) {
            // If there is any value in amount field
            if (amount != '' && amount != 0) {

                console.log(amount);

                if (customer_state == '21') {

                    $(`#cwg_total_amount_${pc}`).val((amount).toFixed(2));


                } else {

                    $(`#cwg_total_amount_${pc}`).val((amount).toFixed(2));

                }
            }
            getTotalAmount();
        }

        //  To get quantity
        function getCWGAmount(pc) {

            var quantity_value = $(`#cwg_quantity_${pc}`).val();

            // Calling the checkStock function and assigning the returned value to the quantity_value_variable
            // console.log(window[`cwg_divide_by_thousand_${pc}`]);
            if (window[`cwg_divide_by_thousand_${pc}`] == true) {
                // quantity_value = parseInt(quantity_value) / 1000;
            } else {
                quantity_value = checkStock(pc, quantity_value);
            }
            // console.log(quantity_value);

            // by ip
            var unit = $(`#cwg_p_unit_${pc}`).val();
            var rate = $(`#cwg_rate_${pc}`).val();
            // var final_rate =  parseFloat(rate);

            if (unit == '2' || unit == '3') {

                $(`#cwg_amount_${pc}`).val(Number(rate));
                var amount = Number($(`#cwg_amount_${pc}`).val());
                // console.log(amount);



            } else {

                var amount = parseFloat(quantity_value) * parseFloat(rate);
                // console.log(amount);

                $(`#cwg_amount_${pc}`).val(amount);
                var amount = Number($(`#cwg_amount_${pc}`).val());

                // console.log(amount);
                window[`cwg_og_amount_${pc}`] = amount;

            }

            if (!getDiscountedAmount(pc)) {
                putAmount(pc, amount);
            }
            // getDiscountedAmount(pc)
            // putAmount(pc, amount);

            // var amount = parseFloat(quantity_value) * parseFloat($(`#cwg_rate_${pc}`).val());
            // console.log(amount);
            // $(`#cwg_amount_${pc}`).val(amount);
            // window[`cwg_og_amount_${pc}`] = amount;
            // let discount_percent = parseInt($(`#cwg_discount_${pc}`).val());


        }

        // To get the discounted amount
        // function getDiscountedAmount(pc) {

        //     var discount_percent = parseInt($(`#cwg_discount_${pc}`).val());
        //     // console.log(discount_percent);

        //     if (discount_percent) {
        //         let selected_unit = $(`#cwg_p_unit_${pc}`).val();
        //         if (selected_unit == '2' || selected_unit == '3') {
        //             var amount = $(`#cwg_rate_${pc}`).val();
        //         } else {

        //             var amount = parseInt(window[`cwg_og_amount_${pc}`]);
        //             // console.log('AMT',amount);
        //         }


        //         //NEW CHANGE BY IP
        //         if (amount) {
        //             discount_percent = (amount * discount_percent) / 100;
        //             // console.log(discount_percent);

        //             var discounted_amount = (amount - discount_percent)
        //             // console.log('DIS',discounted_amount);

        //             $(`#cwg_amount_${pc}`).val(discounted_amount);

        //             putAmount(pc, discounted_amount);
        //             return 1;
        //         }
        //     } else {
        //         return 0;
        //     }
        // }


        //by ip on 23_2_23
        function getDiscountedAmount(pc) {
            var service_id = $(`#cwg_product_description_input_${pc}`).find(':selected').data('service_id');
            console.log(service_id);
            if (service_id == null) {
                console.log(service_id, 'in if');

                var discount_percent = parseInt($(`#cwg_discount_${pc}`).val());
                // console.log(discount_percent);

                if (discount_percent) {
                    let selected_unit = $(`#cwg_p_unit_${pc}`).val();
                    if (selected_unit == '2' || selected_unit == '3') {
                        var amount = $(`#cwg_rate_${pc}`).val();
                    } else {

                        var amount = parseInt(window[`cwg_og_amount_${pc}`]);
                        // console.log('AMT',amount);
                    }


                    //NEW CHANGE BY IP
                    if (amount) {
                        discount_percent = (amount * discount_percent) / 100;
                        // console.log(discount_percent);

                        var discounted_amount = (amount - discount_percent)
                        // console.log('DIS',discounted_amount);

                        $(`#cwg_amount_${pc}`).val(discounted_amount);

                        putAmount(pc, discounted_amount);
                        return 1;
                    }
                } else if (discount_percent == 0 || discount_percent == '') {

                    var quantity_value = $(`#cwg_quantity_${pc}`).val();
                    let selected_unit = $(`#cwg_p_unit_${pc}`).val();
                    var rate = $(`#cwg_rate_${pc}`).val();

                    if (selected_unit == '2' || selected_unit == '3') {

                        // console.log('ok');
                        $(`#cwg_amount_${pc}`).val(Number(rate));
                        // var amount = Number($(`#cwg_amount_${pc}`).val());

                    } else {

                        var amount = parseFloat(quantity_value) * parseFloat(rate);
                        // console.log(amount);

                        $(`#cwg_amount_${pc}`).val(amount);
                        window[`cwg_og_amount_${pc}`] = amount;


                    }
                    putAmount(pc, amount);
                    return 0;
                }
            } else {
                console.log(service_id, 'in else');
                var amount = $(`#cwg_amount_${pc}`).val();
                var discount_percent = parseInt($(`#cwg_discount_${pc}`).val());


                discount_percent = (amount * discount_percent) / 100;

                var discounted_amount = (amount - discount_percent);

                $(`#cwg_total_amount_${pc}`).val(discounted_amount);
                // putAmount(pc, amount);
                getTotalAmount();



            }

        }


        //Calculation According to Rate
        function getrate(pc) {

            var unit = $(`#cwg_p_unit_${pc}`).val();
            var rate = $(`#cwg_rate_${pc}`).val();

            if (unit == '2' || unit == '3') {

                $(`#cwg_amount_${pc}`).val(Number(rate));
                var amount = Number($(`#cwg_amount_${pc}`).val());

            } else {

                var quantity_value = $(`#cwg_quantity_${pc}`).val();
                var amount = parseFloat(quantity_value) * parseFloat(rate);
                $(`#cwg_amount_${pc}`).val(amount);

            }

            // if (!getDiscountedAmount(pc)) {
            //     putAmount(pc, amount);
            // }
            calculateUnit(pc);

        }

        // by ip

        // function getDiscountedAmount(pc) {

        //     var discount_percent = parseInt($(`#cwg_discount_${pc}`).val());
        //     console.log(discount_percent);

        //     var amount = Number($(`#cwg_amount_${pc}`).val());
        //     console.log(amount);

        //     if (discount_percent != '' || amount != '') {

        //         discounted_amount = (amount * discount_percent) / 100;
        //         console.log(discounted_amount);

        //         var main_amount = (amount - discounted_amount);
        //         console.log(main_amount);

        //         $(`#cwg_amount_${pc}`).val(discounted_amount);

        //     }

        //     putAmount(pc, discounted_amount);

        // }










        // To get the total amoung 
        function getTotalAmount() {
            let cwg_quantity = document.querySelectorAll(".cwg_quantity");
            // let cwg_rate = document.querySelectorAll(".cwg_rate");
            let cwg_amount = document.querySelectorAll(".cwg_amount");
            let cwg_cgst_percent = document.querySelectorAll(".cwg_cgst_percent");
            let cwg_sgst_percent = document.querySelectorAll(".cwg_sgst_percent");
            let cwg_igst_percent = document.querySelectorAll(".cwg_igst_percent");
            let cwg_total_amount = document.querySelectorAll(".cwg_total_amount");

            let cwg_total_quantity = getTotal(cwg_quantity);
            // let cwg_total_rate_all = getTotal(cwg_rate);
            let cwg_total_amount_all = getTotal(cwg_amount);
            let cwg_total_cgst_all = getTotal(cwg_cgst_percent);
            let cwg_total_sgst_all = getTotal(cwg_sgst_percent);
            let cwg_total_igst_all = getTotal(cwg_igst_percent);
            let cwg_total_amount_all_gst = getTotal(cwg_total_amount);

            // cwg_total_amount_all_footer
            // cwg_total_igst_all_footer
            // cwg_total_cgst_all_footer
            // cwg_total_sgst_all_footer
            // cwg_total_amount_all_gst_footer


            // total
            $('#cwg_total_quantity').val(cwg_total_quantity);
            // $('#cwg_total_rate_all').val(cwg_total_rate_all);
            $('#cwg_total_amount_all').val(parseFloat(cwg_total_amount_all).toFixed(2));
            $('#cwg_total_cgst_all').val(cwg_total_cgst_all);
            $('#cwg_total_sgst_all').val(cwg_total_sgst_all);
            $('#cwg_total_igst_all').val(cwg_total_igst_all);
            $('#cwg_total_amount_all_gst').val(Math.floor(cwg_total_amount_all_gst));

            // Grand total
            $(`#cwg_total_amount_all_footer`).val(parseFloat(cwg_total_amount_all).toFixed(2));
            $('#cwg_total_igst_all_footer').val(cwg_total_igst_all);
            $('#cwg_total_cgst_all_footer').val(cwg_total_cgst_all);
            $('#cwg_total_sgst_all_footer').val(cwg_total_sgst_all);
            $('#cwg_total_amount_all_gst_footer').val(Math.floor(cwg_total_amount_all_gst));
            $('#amt_in_words').val('INR ' + numberToWords.toWords(cwg_total_amount_all_gst).concat(' only').toUpperCase());
        }

        function getTotal(obj) {
            var vn = 0;
            obj.forEach(input => {
                if (!input.value == '') {
                    vn = Number(vn) + Number(input.value);
                }
            });
            return vn;
        }

        function resetForm() {
            for (i = 0; i < product_counter; i++) {
                $(`#cwg_row_${i}`).remove();
                $(`#row_${i}`).remove();
            }
            product_counter = 0;
            $('#invoice_form').trigger('reset');
            $('#customer_details_input').empty();
            $('#vehicle_details_input').empty();

            $('#thead_content').hide();
            $('#tfoot_content').hide();
            $('#cwg_thead_content').hide();
            $('#cwg_tfoot_content').hide();
            $('#vehicle_container').hide();
            $('#product_table').hide();
            $('#product_common_content').hide();
            $('#company_logo').empty();
            $('#company_info').empty();
            $('#company_seal').empty();
        }


        // function getpro_unit(product_counter) {
        //     let token = "{{ csrf_token() }}";

        //     let product_id = $(`#cwg_product_description_input_${product_counter}`).val();
        //     let send_data = {
        //         'product_id': product_id,
        //         '_token': token
        //     };
        //     $.ajax({

        //         type: 'post',
        //         url: "{{ url('admin/invoice/defultunit') }}",
        //         data: send_data,
        //         uccess: function(data) {
        //             console.log('ok');
        //         }

        //     })
        // }
        function unit() {

            $('.cwg_product_description_select :selected').each(function() {
                let token = "{{ csrf_token() }}";
                var product_id = $(this).val();
                var product_unit = $(this).data('unit');
                var row_id = $(this).data('row_id');

                console.log('product_unit', product_unit);
                console.log('row', row_id);

                if (row_id == '0' || row_id > 0) {
                    if (product_unit == 'Nos') {


                        $(`#cwg_p_unit_${row_id} option`).prop('disabled', 'disabled');
                        $(`#cwg_p_unit_${row_id} option[value="1"]`).prop('disabled', false);

                    } else if (product_unit == 'Gm') {

                        $(`#cwg_p_unit_${row_id} option`).prop('disabled', 'disabled');
                        $(`#cwg_p_unit_${row_id} option[value="2"]`).prop('disabled', false);
                        $(`#cwg_p_unit_${row_id} option[value="4"]`).prop('disabled', false);


                    } else if (product_unit == 'Mil') {

                        $(`#cwg_p_unit_${row_id} option`).prop('disabled', 'disabled');
                        $(`#cwg_p_unit_${row_id} option[value="3"]`).prop('disabled', false);
                        $(`#cwg_p_unit_${row_id} option[value="5"]`).prop('disabled', false);


                    }

                } else {
                    console.log('in else');
                }

            });
        }
    </script>
@endsection
