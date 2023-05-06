<?php
use App\Models\backend\Invoice;
?>
@extends('backend.layouts.app')
@section('title', 'Edit Invoice')
@section('content')

    <div class="content">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <div class="text-end" style="position: absolute;
                        right: 50px;">
                            <a href="{{ route('admin.invoice.index') }}" class="btn btn-inverse-primary float-right">
                                <span class="align-middle ml-25">Back</span></a>
                        </div>

                        <div class="row">

                            <div class="col-md-6 col-12">
                                <h4 class="card-title">Edit Invoice</h4>
                            </div>
                            {{-- {{dd($invoice)}} --}}
                            <div class="col-md-6 col-12">
                                <select id="company_select" class="form-select" name="company_id_select" required>
                                    <option value="">Select a Company</option>
                                    @foreach ($companies as $key => $company)
                                        <option {{ $invoice->company_id == $key ? 'selected' : '' }}
                                            value="{{ $key }}">
                                            {{ $company }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @include('backend.includes.errors')
                        {{ Form::model($invoice, ['url' => 'admin/invoice/update', 'id' => 'invoice_form', 'method' => 'post']) }}
                        @csrf
                        {{-- <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Create Invoice</h4>
                        </div>

                    </div> --}}
                        <input type="hidden" id="company_id" value="{{ $invoice->company_id }}" name="company_id"
                            class="form-control">
                        <div class="form-body">
                            <div class="row">
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Company Logo</p>
                                    <div id="company_logo">

                                    </div>
                                </div>
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Company Information</p>
                                    <div id="company_info">

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                @php
                                    $last_invoice = Invoice::orderBy('invoice_id', 'DESC')
                                        ->get('invoice_id')
                                        ->toArray();
                                    $last_invoice_id = '0001';
                                    if ($last_invoice) {
                                        $last_invoice_id = $last_invoice[0]['invoice_id'] + 1;
                                        $last_invoice_id = '000' . $last_invoice_id;
                                        // dd('hello');
                                    }
                                    // dd($last_invoice_id);
                                @endphp
                                <div style="padding:0px 50px;display:flex;justify-content:space-between">
                                    <div>
                                        <h5 style="text-align:left;">INVOICE</h5>
                                    </div>
                                    {{-- <div>
                                        <input class="form-check-input" type="checkbox" name="invoice_cum_challan"
                                            {{ $invoice->invoice_cum_challan == 1 ? 'checked' : '' }} value="1"
                                            id="invoice_cum_challan">
                                        <label class="form-check-label" for="invoice_cum_challan">
                                            Select if creating INVOICE CUM CHALLAN
                                        </label> --}}
                                    {{-- <input type="checkbox" class="" name="invoice_cum_challan" value="1">
                                    <label style="font-weight:600">Select if creating INVOICE CUM CHALLAN</label> --}}
                                    {{-- </div> --}}
                                </div>
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Invoice No.</p>
                                    <div style="min-height:100px" id="invoice_no">
                                        <input type="text" id="invoice_no" name="invoice_no"
                                            value="{{ $invoice->invoice_no }}" class="form-control disabled" readonly>
                                    </div>
                                </div>
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Date Of Issue</p>
                                    <div style="min-height:100px" id="date_of_issue">
                                        <input value="{{ $invoice->date_of_issue }}" type="date" id="date_of_issue_input"
                                            name="date_of_issue" class="form-control">
                                        {{-- <input type="date" /> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display:none" id="customer">
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
                            </div>

                            {{-- {{dd($invoice->vehicle_model_id)}} --}}

                            <div class="row" id="vehicle_container" style="display:none">
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <div class="d-flex align-items-center">
                                        <label class="d-flex align-items-center"><input type="checkbox" id="manual_invoice"
                                                {{ $invoice->manual_invoice == '1' ? 'checked' : '' }} name="manual_invoice"
                                                value="1" class="me-2 form-check-input">Manual Invoice</label>
                                    </div>

                                    <div class="row g-2 mt-2">
                                        <div class="col-6">
                                            {{ Form::select('vehicle_make_id', [], null, [
                                                'class' => 'form-select',
                                                'id' => 'vehicle_make_id',
                                                'placeholder' => 'Select a Vehicle Make',
                                            ]) }}
                                            <input type="hidden" value="{{ $invoice->vehicle_make_id }}"
                                                id="selected_vehicle_make">
                                        </div>
                                        <div class=" col-6">
                                            {{ Form::select('vehicle_model_id', [], null, [
                                                'class' => 'form-select',
                                                'id' => 'vehicle_model_id',
                                                'placeholder' => 'Select a Vehicle Make',
                                            ]) }}
                                            <input type="hidden" value="{{ $invoice->vehicle_model_id }}"
                                                id="selected_vehicle_model">
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Vehicle Detailss</p>
                                    <div style="min-height:100px" id="vehicle_details">
                                        <textarea class="form-control" id="vehicle_details_input" name="vehicle">{{ $invoice->vehicle }}</textarea>
                                        <input placeholder="KM" type="number" name="km"
                                            value="{{ $invoice->km }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            {{-- {{ dd(count($invoice->productsInvoice)) }} --}}
                            {{-- {{dd($invoice->productsInvoice);}} --}}
                            {{-- {{dd($invoice->productsInvoice)}} --}}
                            {{-- {{dd(count($invoice->productsInvoice) > 0)}} --}}

                            <div class="row" id="product_table"
                                style="{{ count($invoice->productsInvoice) > 0 ? '' : 'display:none' }}">
                                {{-- {{count($invoice->productsInvoice) > 0 ? '' : 'display:none' }} --}}
                                <div style="text-align:left" class="col-md-12 col-12">

                                    <span id="add_product" class="btn btn-secondary my-2 float-right">Add Product</span>
                                    {{-- For Company without gst --}}
                                    @if ($invoice->gst_flag == 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="thead_content"
                                                style="{{ count($invoice->productsInvoice) > 0 ? '' : 'display:none' }}">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Product Description</th>
                                                        <th scope="col">HSN Code</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Unit</th>
                                                        <th scope="col">Rate</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Disc</th>
                                                        <th scope="col">Discounted Amt</th>
                                                        <th scope="col">Total</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_product">
                                                    @forelse ($invoice->productsInvoice as $key => $product)
                                                        {{-- @php $key++ @endphp --}}
                                                        <tr id="cwg_row_{{ $key }}">
                                                            <input type="hidden" class="product" id="product"
                                                                value="{{ $key }}">

                                                            <input type="hidden"
                                                                name="previous_quantity_{{ $key }}"
                                                                id="previous_quantity_{{ $key }}"
                                                                value="{{ $product->quantity }}">
                                                            <td>
                                                                <select style="min-width:150px !important;"
                                                                    class="form-select"
                                                                    name="product_description_{{ $key }}"
                                                                    id="cwg_product_description_input_{{ $key }}"
                                                                    onChange="getProduct({{ $key }});">
                                                                    @foreach ($products as $p)
                                                                        <option
                                                                            {{ $product->product_id == $p->product_id ? 'selected' : '' }}
                                                                            value="{{ $p->product_id }}">
                                                                            {{ $p->product_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>


                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="hsn_code_{{ $key }}"
                                                                    id="cwg_hsn_code_{{ $key }}"
                                                                    class="form-control cwg_hsn_code"
                                                                    value="{{ $product->hsn_code }}">
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="quantity_{{ $key }}"
                                                                    id="cwg_quantity_{{ $key }}"
                                                                    class="form-control cwg_quantity"
                                                                    onChange="getCWGAmount({{ $key }});"
                                                                    value="{{ $product->quantity }}">
                                                            </td>
                                                            <td>

                                                                <select style="min-width:80px !important;"
                                                                    class="form-select unit_select_input"
                                                                    name="p_unit_{{ $key }}"
                                                                    id="cwg_p_unit_{{ $key }}"
                                                                    onChange="calculateUnit({{ $key }});">
                                                                    @foreach ($units as $unit)
                                                                        <option
                                                                            {{ $unit->P_unit_id == $product->p_unit ? 'selected' : 'disabled' }}
                                                                            value="{{ $unit->P_unit_id }}">
                                                                            {{ $unit->unit }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="rate_{{ $key }}"
                                                                    id="rate_{{ $key }}"
                                                                    class="form-control cwg_rate"
                                                                    onChange="getrate({{ $key }});"
                                                                    value="{{ $product->rate }}">

                                                                <input type="hidden" style="min-width:80px !important;"
                                                                    name="cwg_rate_{{ $key }}"
                                                                    id="cwg_rate_{{ $key }}"
                                                                    value="{{ $product->orignal_hidden_rate }}"
                                                                    class="form-control cwg_rate">
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="orignal_amt_{{ $key }}"
                                                                    value="{{ $product->orignal_amt }}"
                                                                    id="cwg_orignal_amt_{{ $key }}"
                                                                    class="form-control cwg_orignal_amt"
                                                                    onChange="getorignalamount({{ $key }})">
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="discount_{{ $key }}"
                                                                    id="cwg_discount_{{ $key }}"
                                                                    value="{{ $product->discount }}"
                                                                    class="form-control cwg_discount"
                                                                    onChange="getDiscountedAmount({{ $key }})">
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="amount_{{ $key }}"
                                                                    value="{{ $product->product_amount }}"
                                                                    id="cwg_amount_{{ $key }}"
                                                                    class="form-control cwg_amount"
                                                                    onChange="getorignalamount({{ $key }})">
                                                            </td>




                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="total_amount_{{ $key }}"
                                                                    value="{{ $product->product_total_amount }}"
                                                                    id="cwg_total_amount_{{ $key }}"
                                                                    class="form-control cwg_total_amount" readonly>

                                                                <input type="hidden"
                                                                    name="product_invoice_id_{{ $key }}"
                                                                    value="{{ $product->product_invoice_id }}">
                                                            </td>

                                                            <td style="text-align:center;">
                                                                <i onClick="removeProduct({{ $key }})"
                                                                    style="font-size:1.5em;cursor:pointer"
                                                                    class="far fa-minus-square text-danger"></i>
                                                            </td>

                                                        </tr>
                                                    @empty
                                                    @endforelse
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
                                                        <td></td>


                                                        <td>
                                                            {{-- <input style="min-width:60px !important;" name="total_rate_all"
                                                            id="cwg_total_rate_all" class="form-control" readonly> --}}
                                                        </td>
                                                        <td>
                                                            <input style="min-width:60px !important;"
                                                                value="{{ $invoice->base_amount }}"
                                                                name="cwg_total_amount_all_without_gst"
                                                                id="cwg_total_amount_all"
                                                                class="form-control cwg_total_amount_all_without_gst"
                                                                readonly>
                                                        </td>
                                                        <td></td>
                                                        <td></td>

                                                        <td>
                                                            <input style="min-width:60px !important;"
                                                                value="{{ $invoice->total_amount }}"
                                                                name="total_amount_all_gst" id="cwg_total_amount_all_gst"
                                                                class="form-control cwg_total_amount_all_gst" readonly>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>

                                            </table>

                                        </div>
                                        {{-- <div class="table-responsive">
                                            <table class="table table-bordered"
                                                style="{{ count($invoice->productsInvoice) > 0 ? '' : 'display:none' }}"
                                                id="tfoot_content">
                                                <tbody>
                                                    <tr id="total" style="background:rgba(70,70,70,0.1)">
                                                        <td>Discount : <input name="discount" class="form-control"
                                                                onchange="getAmount()" id="product_discount"
                                                                type="text" value="{{ $invoice->discount }}"></td>
                                                        <td colspan="2">Total : <input name="total_amount"
                                                                class="form-control" type="text"
                                                                id="product_total_amount"
                                                                value="{{ $invoice->total_amount }}" readonly></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> --}}
                                    @else
                                        {{-- For Company with gst --}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="cwg_thead_content"
                                                style="{{ count($invoice->productsInvoice) > 0 ? '' : 'display:none' }}">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Product Description</th>
                                                        <th scope="col">HSN Code</th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Unit</th>
                                                        <th scope="col">Rate</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Disc</th>
                                                        <th scope="col">Discounted Amt</th>

                                                        <th colspan="2">CGST</th>
                                                        <th colspan="2">SGST</th>
                                                        <th colspan="2">IGST</th>

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
                                                        <th></th>
                                                        <th></th>

                                                        <th>Percent</th>
                                                        <th>Amount</th>
                                                        <th>Percent</th>
                                                        <th>Amount</th>
                                                        <th>Percent</th>
                                                        <th>Amount</th>

                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <script>
                                                    var pc_temp;
                                                    var stock_value;
                                                    var product_og_amount;
                                                </script>
                                                <tbody id="cwg_tbody_product">
                                                    @forelse ($invoice->productsInvoice as $key => $product)
                                                        @php
                                                            $product_og_amount = $product->product_amount;
                                                        @endphp
                                                        {{-- @php $key++ @endphp --}}
                                                        <tr id="cwg_row_{{ $key }}">
                                                            <input type="hidden" class="product" id="product"
                                                                value="{{ $key }}">
                                                            <input type="hidden"
                                                                name="previous_quantity_{{ $key }}"
                                                                id="previous_quantity_{{ $key }}"
                                                                value="{{ $product->quantity }}">
                                                            <td>
                                                                <select style="min-width:150px !important;"
                                                                    class="form-select"
                                                                    name="product_description_{{ $key }}"
                                                                    id="cwg_product_description_input_{{ $key }}"
                                                                    onChange="getProduct({{ $key }});">
                                                                    @foreach ($products as $p)
                                                                        @php
                                                                            if ($product->product_id == $p->product_id) {
                                                                                $stock = $p->product_stock;
                                                                                //
                                                                                // ddd($product_og_amount);
                                                                                // dump($product_og_amount);
                                                                            }
                                                                        @endphp
                                                                        <option
                                                                            {{ $product->product_id == $p->product_id ? 'selected' : '' }}
                                                                            value="{{ $p->product_id }}">
                                                                            {{ $p->product_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>

                                                            <script>
                                                                pc_temp = '{{ $key }}';
                                                                // console.log(pc_temp)
                                                                stock_value = '{{ $stock }}';
                                                                product_og_amount = '{{ $product_og_amount }}';
                                                                // console.log(stock_value)
                                                                window[`product_stock_${pc_temp}`] = stock_value;
                                                                window[`cwg_og_amount_${pc_temp}`] = product_og_amount;
                                                                // console.log(window[`product_stock_${pc_temp}`]);
                                                            </script>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="hsn_code_{{ $key }}"
                                                                    id="cwg_hsn_code_{{ $key }}"
                                                                    class="form-control cwg_hsn_code"
                                                                    value="{{ $product->hsn_code }}">
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="quantity_{{ $key }}"
                                                                    id="cwg_quantity_{{ $key }}"
                                                                    class="form-control cwg_quantity"
                                                                    onChange="getCWGAmount({{ $key }});"
                                                                    value="{{ $product->quantity }}">
                                                            </td>
                                                            {{-- {{dd($units)}} --}}
                                                            <td>

                                                                <select style="min-width:80px !important;"
                                                                    class="form-select unit_select_input"
                                                                    name="p_unit_{{ $key }}"
                                                                    id="cwg_p_unit_{{ $key }}"
                                                                    onChange="calculateUnit({{ $key }});">
                                                                    @foreach ($units as $unit)
                                                                        <option
                                                                            {{ $unit->P_unit_id == $product->p_unit ? 'selected' : 'disabled' }}
                                                                            value="{{ $unit->P_unit_id }}">
                                                                            {{ $unit->unit }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="rate_{{ $key }}"
                                                                    id="rate_{{ $key }}"
                                                                    class="form-control cwg_rate"
                                                                    onChange="getrate({{ $key }});"
                                                                    value="{{ $product->rate }}">

                                                                <input type="" style="min-width:80px !important;"
                                                                    name="cwg_rate_{{ $key }}"
                                                                    id="cwg_rate_{{ $key }}"
                                                                    value="{{ $product->orignal_hidden_rate }}"
                                                                    class="form-control cwg_rate">
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="orignal_amt_{{ $key }}"
                                                                    value="{{ $product->orignal_amt }}"
                                                                    id="cwg_orignal_amt_{{ $key }}"
                                                                    class="form-control cwg_orignal_amt"
                                                                    onChange="getorignalamount({{ $key }})">
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="discount_{{ $key }}"
                                                                    id="cwg_discount_{{ $key }}"
                                                                    value="{{ $product->discount }}"
                                                                    class="form-control cwg_discount"
                                                                    onChange="getDiscountedAmount({{ $key }})">
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="amount_{{ $key }}"
                                                                    value="{{ $product->product_amount }}"
                                                                    id="cwg_amount_{{ $key }}"
                                                                    class="form-control cwg_amount" readonly>
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="cgst_percent_{{ $key }}"
                                                                    value="{{ $product->cgst_percent }}"
                                                                    id="cwg_cgst_percent_{{ $key }}"
                                                                    class="form-control cwg_cgst_percent" readonly>
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="cgst_amount_{{ $key }}"
                                                                    value="{{ $product->cgst_amount }}"
                                                                    id="cwg_cgst_amount_{{ $key }}"
                                                                    class="form-control cwg_cgst_amount" readonly>
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="sgst_percent_{{ $key }}"
                                                                    value="{{ $product->sgst_percent }}"
                                                                    id="cwg_sgst_percent_{{ $key }}"
                                                                    class="form-control cwg_sgst_percent" readonly>
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="sgst_amount_{{ $key }}"
                                                                    value="{{ $product->sgst_amount }}"
                                                                    id="cwg_sgst_amount_{{ $key }}"
                                                                    class="form-control cwg_sgst_amount" readonly>
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="igst_percent_{{ $key }}"
                                                                    value="{{ $product->igst_percent }}"
                                                                    id="cwg_igst_percent_{{ $key }}"
                                                                    class="form-control cwg_igst_percent" readonly>
                                                            </td>
                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="igst_amount_{{ $key }}"
                                                                    value="{{ $product->igst_amount }}"
                                                                    id="cwg_igst_amount_{{ $key }}"
                                                                    class="form-control cwg_igst_amount" readonly>
                                                            </td>

                                                            <td>
                                                                <input style="min-width:80px !important;"
                                                                    name="total_amount_{{ $key }}"
                                                                    value="{{ $product->product_total_amount }}"
                                                                    id="cwg_total_amount_{{ $key }}"
                                                                    class="form-control cwg_total_amount" readonly>

                                                                <input type="hidden"
                                                                    name="product_invoice_id_{{ $key }}"
                                                                    value="{{ $product->product_invoice_id }}">
                                                            </td>
                                                            <td style="text-align:center;">
                                                                <i onClick="removeProduct({{ $key }})"
                                                                    style="font-size:1.5em;cursor:pointer"
                                                                    class="far fa-minus-square text-danger"></i>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                    @endforelse
                                                </tbody>
                                                <tfoot>
                                                    <tr style="background:rgba(70,70,70,0.1)">
                                                        <td><strong>Total</strong></td>
                                                        <td></td>
                                                        <td>
                                                            <input style="min-width:60px !important;"
                                                                name="total_quantity" id="cwg_total_quantity"
                                                                class="form-control" value="{{ $total_quantity }}"
                                                                readonly>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            {{-- <input style="min-width:60px !important;" name="total_rate_all"
                                                        id="cwg_total_rate_all" class="form-control" readonly> --}}
                                                        </td>
                                                        <td></td>

                                                        <td></td>

                                                        <td>
                                                            <input style="min-width:60px !important;"
                                                                name="total_amount_all" id="cwg_total_amount_all"
                                                                class="form-control" value="{{ $invoice->base_amount }}"
                                                                readonly>
                                                        </td>
                                                        <td>
                                                            <input style="min-width:60px !important;"
                                                                name="total_cgst_all" id="cwg_total_cgst_all"
                                                                class="form-control"
                                                                value="{{ $invoice->total_cgst_percent }}" readonly>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <input style="min-width:60px !important;"
                                                                name="total_sgst_all" id="cwg_total_sgst_all"
                                                                class="form-control"
                                                                value="{{ $invoice->total_sgst_percent }}" readonly>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <input style="min-width:60px !important;"
                                                                name="total_igst_all" id="cwg_total_igst_all"
                                                                class="form-control"
                                                                value="{{ $invoice->total_igst_percent }}" readonly>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <input style="min-width:60px !important;"
                                                                name="total_amount_all_gst" id="cwg_total_amount_all_gst"
                                                                class="form-control"
                                                                value="{{ $invoice->total_amount }}" readonly>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered"
                                                style="{{ count($invoice->productsInvoice) > 0 ? '' : 'display:none' }}"
                                                id="cwg_tfoot_content">
                                                <tbody>
                                                    <tr id="cwg_total" style="background:rgba(70,70,70,0.1)">
                                                        <td>
                                                            <p>Total Amount without Tax</p>
                                                            <input style="min-width:60px !important;"
                                                                name="total_amount_all" id="cwg_total_amount_all_footer"
                                                                class="form-control" value="{{ $invoice->base_amount }}"
                                                                readonly>
                                                        </td>
                                                        <td>
                                                            <p>IGST</p>
                                                            <input style="width:60px !important;" name="total_igst_all"
                                                                id="cwg_total_igst_all_footer" class="form-control"
                                                                value="{{ $invoice->total_igst_percent }}" readonly>
                                                        </td>
                                                        <td>
                                                            <p>CGST</p>
                                                            <input style="width:60px !important;" name="total_cgst_all"
                                                                id="cwg_total_cgst_all_footer" class="form-control"
                                                                value="{{ $invoice->total_cgst_percent }}" readonly>
                                                        </td>
                                                        <td>
                                                            <p>SGST</p>
                                                            <input style="width:60px !important;" name="total_sgst_all"
                                                                id="cwg_total_sgst_all_footer" class="form-control"
                                                                value="{{ $invoice->total_sgst_percent }}" readonly>
                                                        </td>
                                                        <td>
                                                            <p>Grand Total (With GST)</p>
                                                            <input name="cwg_total_amount" class="form-control"
                                                                type="text" id="cwg_total_amount_all_gst_footer"
                                                                value="{{ $invoice->total_amount }}" readonly>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-bordered"
                                            style="{{ count($invoice->productsInvoice) > 0 ? '' : 'display:none' }}"
                                            id="product_common_content">
                                            <tbody>
                                                <tr id="total" style="background:rgba(70,70,70,0.1)">
                                                    <td id="payment_method_cell" colspan="4">
                                                        <p>Payment Mode</p>
                                                        <div class="d-flex">
                                                            <div class="form-check me-4">
                                                                {{ Form::radio('payment_method', 'Cash', false, ['id' => 'cash', 'class' => 'form-check-input']) }}
                                                                {{ Form::label('cash', 'Cash') }}
                                                            </div>
                                                            <div class="form-check me-4">
                                                                {{ Form::radio('payment_method', 'Cheque', false, ['id' => 'cheque', 'class' => 'form-check-input']) }}
                                                                {{ Form::label('cheque', 'Cheque') }}
                                                            </div>
                                                            <div class="form-check me-4">
                                                                {{ Form::radio('payment_method', 'Electronic Transaction', false, ['id' => 'electronic_transaction', 'class' => 'form-check-input']) }}
                                                                {{ Form::label('electronic_transaction', 'Electronic Transaction') }}
                                                            </div>
                                                            <div class="form-check me-4">
                                                                {{ Form::radio('payment_method', 'Pending', false, ['id' => 'pending', 'class' => 'form-check-input']) }}
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
                                                                name="free_of_charge" value="1"
                                                                {{ $invoice->free_of_charge == 1 ? 'checked' : '' }}
                                                                id="free_of_charge">
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
                                                                name="amt_in_words" value="{{ $invoice->amt_in_words }}"
                                                                readonly>
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
                                            <li>No Guarantee or Gas & Electronic Items</li>
                                            <li>KM is just mentioned for reference purpose</li>
                                        </ol>
                                    </div>
                                </div>
                                <div style="text-align:left" class="col-md-6 col-12">
                                    <p style="font-weight:600">Common Seal</p>
                                    <div style="min-height:200px" id="company_seal">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div style="text-align:left" class="col-md-12 col-12">
                                    <p style="font-weight:600">Remark</p>
                                    <textarea type="text" name="remark" class="form-control">{{ $invoice->remark }}</textarea>
                                </div>
                            </div>
                        </div>
                        @php
                            $product_count = count($invoice->productsInvoice);
                        @endphp
                        <div class="row">
                            <div class="col-12 d-flex justify-content-start">
                                {{ Form::submit('Edit', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                            </div>
                        </div>
                        <input type="hidden" value="{{ $invoice->vehicle_number }}" name="vehicle_number"
                            id="vehicle_number">
                        <input type="hidden" value="{{ $product_count }}" name="product_counter"
                            id="product_counter">
                        <input type="hidden" value="{{ $product_count }}" name="row_count" id="row_count">
                        <input type="hidden" value="{{ $invoice->gst_flag }}" name="gst_flag" id="gst_flag">
                        <input type="hidden" value="{{ $invoice->invoice_id }}" name="invoice_id" id="invoice_id">
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        // Global Variables
        // ------------------------------------------------
        var company_id;
        var customer_id;
        var old_customer_id;
        var vehicle_make_id;
        var vehicle_model_id;
        var row_count = $('#product_counter').val() ? $('#product_counter').val() : 0;
        var product_counter = $('#product_counter').val() ? $('#product_counter').val() : 0;
        // console.log(product_counter);
        var company_with_gst = $('#gst_flag').val() ? $('#gst_flag').val() : 0;
        var service_id = 0;
        // console.log(company_with_gst);
        var products;
        var customer_state;
        var for_customer_edit_flag = 1;
        // ------------------------------------------------

        // ------------------------------------------------
        $(document).ready(function() {
            // After page is ready 
            // --------------------------------------------

            $('#vehicle_container').hide();
            $('#product_table').hide();

            // to get Company Details
            company_id = $('#company_select').val();
            if (company_id) {
                getCompanyDetails(company_id)
            }


            // To get customer details
            function getCustomer() {
                customer_id = $('#customer_id').val()
                if (customer_id) {
                    old_customer_id = customer_id;
                    getCustomerDetails(customer_id);
                }
            }
            setTimeout(getCustomer, 1500);

            // To get Vehicle model
            function getVehicleM() {
                vehicle_make_id = $('#vehicle_make_id').val();
                if (vehicle_make_id) {
                    // old_customer_id = customer_id;
                    getVehicleModel(vehicle_make_id, customer_id);
                }
            }

            setTimeout(function() {
                if ($("#manual_invoice").is(':checked')) {
                    $('#vehicle_make_id').prop('disabled', true);
                    $('#vehicle_model_id').prop('disabled', true);
                    $('#vehicle_details_input').prop('readonly', false);
                } else {
                    $('#vehicle_make_id').prop('disabled', false);
                    $('#vehicle_model_id').prop('disabled', false);
                }
            }, 3000);
            // $("#manual_invoice").click();

            // Check the radio button selection
            getInputFields(getSelectedRadio());
            // --------------------------------------------

            // OnChange
            // --------------------------------------------
            // to get Company Details
            $('#company_select').change(function() {
                company_id = $(this).val();
                // console.log(company_id);
                if (company_id) {
                    resetForm();
                    getCompanyDetails(company_id);
                }
            });
            // To get customer details
            $('#customer_id').change(function() {
                customer_id = $(this).val();
                if (old_customer_id == customer_id) {
                    for_customer_edit_flag = 1;
                } else {
                    for_customer_edit_flag = 0;
                }
                if (customer_id) {
                    getCustomerDetails(customer_id);
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

            // To get customer details
            $('#vehicle_model_id').change(function() {
                vehicle_model_id = $(this).val();
                // console.log(vehicle_model_id);
                if (vehicle_model_id) {
                    getVehicleDetails(vehicle_model_id);
                }
            });
            // --------------------------------------------

            // OnClick
            // --------------------------------------------
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
            $('#add_product').click(addProduct);


            $("#invoice_form").submit(function(event) {
                event.preventDefault();
                url = $(this).attr("action");
                var postData = $(this).serializeArray();
                // passing the data to the controller
                let products = document.querySelectorAll(".product");
                console.log(products);

                let editData = {};
                let c = 0;
                products.forEach(input => {
                    if (!input.value == '') {
                        editData[c] = input.value;
                        console.log(editData[c]);

                    }
                    c++;
                });
                postData.push({
                    name: 'editData',
                    value: JSON.stringify(editData)
                });
                // console.log(postData);
                // console.log(url);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: postData,
                    success: function(data) {
                        if (data == 'Success') {
                            // console.log('succses');
                            // window.location.href = "{{ url('admin/invoice/') }}";
                            toastr.success(
                                'Have fun!',
                                'Miracle Max Says', {
                                    timeOut: 200,
                                    fadeOut: 200,
                                    onHidden: function() {
                                        window.location.href =
                                            "{{ url('admin/invoice/') }}";

                                    }
                                }
                            );
                        }
                        if (data == 'nosuccess') {
                            // console.log('no success');
                            alert('please select the row');
                            // window.location.href = "{{ url('admin/invoice/edit') }}";
                            return false;
                        }
                    }
                });

            });

            // --------------------------------------------
        });
        // ------------------------------------------------

        // User-defined Functions
        // ------------------------------------------------

        // Add product
        function addProduct() {
            if (company_with_gst == 0) {
                // Without GST
                $('#thead_content').show();
                $('#tfoot_content').show();
                $('#product_common_content').show();
                $('#tbody_product').append(`
                    <tr id="cwg_row_${product_counter}">
                        <input type="hidden" class="product" id="product" value="${product_counter}">

                        <td>
                            <select style="min-width:150px !important;"s class="form-select" name="product_description_${product_counter}" id="cwg_product_description_input_${product_counter}" onChange="getProduct(${product_counter});">
                            </select>
                        </td>
                        
                        <td>
                            <input type="hidden" style="min-width:80px !important;"  name="product_row_counter[${product_counter}]" value="${product_counter}"> 
                            <input style="min-width:80px !important;" name="hsn_code_${product_counter}" id="cwg_hsn_code_${product_counter}" class="form-control cwg_hsn_code">    
                        </td>
                        <td>
                            <input style="min-width:80px !important;" name="quantity_${product_counter}" id="cwg_quantity_${product_counter}" class="form-control cwg_quantity" onChange="getCWGAmount(${product_counter});">    
                        </td>
                        <td>
                            <select style="min-width:80px !important;" class="form-select unit_select_input" name="p_unit_${product_counter}" id="cwg_p_unit_${product_counter}" onChange="calculateUnit(${product_counter})">
                            </select>
                        </td>
                        <td>
                            <input style="min-width:80px !important;" name="rate_${product_counter}" id="rate_${product_counter}" class="form-control cwg_rate" onChange="getrate(${product_counter})">    
                            <input type="hidden" style="min-width:80px !important;" name="cwg_rate_${product_counter}" id="cwg_rate_${product_counter}" class="form-control cwg_rate">       
                        </td>   
                        <td>
                            <input style="min-width:80px !important;" name="orignal_amt_${product_counter}" id="cwg_orignal_amt_${product_counter}" class="form-control cwg_orignal_amt" onChange="getorignalamount(${product_counter})">    
                        </td>


                        <td>
                            <input style="min-width:80px !important;" name="discount_${product_counter}" id="cwg_discount_${product_counter}" class="form-control cwg_discount" onChange="getDiscountedAmount(${product_counter})">    
                        </td>
                        <td>
                            <input style="min-width:80px !important;" name="amount_${product_counter}" id="cwg_amount_${product_counter}" class="form-control cwg_amount" onChange="getorignalamount(${product_counter})" readonly>    
                        </td>
                        <td>
                            <input style="min-width:80px !important;" name="total_amount_${product_counter}" id="cwg_total_amount_${product_counter}" class="form-control cwg_total_amount" readonly> 
                        </td>
                        

                        <td style="text-align:center;">
                            <i onClick="removeProductorignal(${product_counter})" style="font-size:1.5em;cursor:pointer" class="far fa-minus-square text-danger"></i>
                        </td>
                    </tr>
                `);
                getUnits(product_counter);

            } else {
                console.log('in els');
                // With GST
                $('#cwg_thead_content').show();
                $('#cwg_tfoot_content').show();
                $('#product_common_content').show();
                $('#cwg_tbody_product').append(`
                <tr id="cwg_row_${product_counter}">
                    <input type="hidden" class="product" id="product" value="${product_counter}">
                    <td>
                        <select style="min-width:150px !important;" class="form-select" name="product_description_${product_counter}" id="cwg_product_description_input_${product_counter}" onChange="getProduct(${product_counter});">
                        </select>
                    </td>
                    <td>
                        <input style="min-width:80px !important;" name="hsn_code_${product_counter}" id="cwg_hsn_code_${product_counter}" class="form-control cwg_hsn_code">    
                    </td>
                    <td>
                        <input style="min-width:80px !important;" name="quantity_${product_counter}" id="cwg_quantity_${product_counter}" class="form-control cwg_quantity" onChange="getCWGAmount(${product_counter});" onChange="calculateUnit(${product_counter});">    
                    </td>
                    <td>
                        <select style="min-width:80px !important;" class="form-select unit_select_input" name="p_unit_${product_counter}" id="cwg_p_unit_${product_counter}" onChange="calculateUnit(${product_counter});">
                        </select>
                    </td>


                    <td>
                        <input style="min-width:80px !important;" name="rate_${product_counter}" id="rate_${product_counter}" class="form-control cwg_rate" onChange="getrate(${product_counter})">    
                       
                        <input type="" style="min-width:80px !important;" name="cwg_rate_${product_counter}" id="cwg_rate_${product_counter}" class="form-control cwg_rate">            
                    </td>   
                    <td>
                            <input style="min-width:80px !important;" name="orignal_amt_${product_counter}" id="cwg_orignal_amt_${product_counter}" class="form-control cwg_orignal_amt readonly">    
                    </td>   
                    <td>
                        <input style="min-width:80px !important;" name="discount_${product_counter}" id="cwg_discount_${product_counter}" class="form-control cwg_discount" onChange="getDiscountedAmount(${product_counter})">    
                    </td>
                    <td>
                        <input style="min-width:80px !important;" name="amount_${product_counter}" id="cwg_amount_${product_counter}" class="form-control cwg_amount" readonly>    
                    </td>
                   



                    <td>
                        <input style="min-width:80px !important;" name="cgst_percent_${product_counter}" id="cwg_cgst_percent_${product_counter}" class="form-control cwg_cgst_percent" readonly>    
                    </td>
                    <td>
                        <input style="min-width:80px !important;" name="cgst_amount_${product_counter}" id="cwg_cgst_amount_${product_counter}" class="form-control cwg_cgst_amount" readonly>    
                    </td>
                    <td>
                        <input style="min-width:80px !important;" name="sgst_percent_${product_counter}" id="cwg_sgst_percent_${product_counter}" class="form-control cwg_sgst_percent" readonly>    
                    </td>
                    <td>
                        <input style="min-width:80px !important;" name="sgst_amount_${product_counter}" id="cwg_sgst_amount_${product_counter}" class="form-control cwg_sgst_amount" readonly>    
                    </td>
                    <td>
                        <input style="min-width:80px !important;" name="igst_percent_${product_counter}" id="cwg_igst_percent_${product_counter}" class="form-control cwg_igst_percent" readonly>    
                    </td>
                    <td>
                        <input style="min-width:80px !important;" name="igst_amount_${product_counter}" id="cwg_igst_amount_${product_counter}" class="form-control cwg_igst_amount" readonly>    
                    </td>
                
                    <td>
                        <input style="min-width:80px !important;" name="total_amount_${product_counter}" id="cwg_total_amount_${product_counter}" class="form-control cwg_total_amount" readonly>    
                    </td>
                    <td style="text-align:center;">
                        <i onClick="removeProductorignal(${product_counter})" style="font-size:1.5em;cursor:pointer" class="far fa-minus-square text-danger"></i>
                    </td>
                </tr>
            `);

                // console.log(products);
                getUnits(product_counter);
            }
            getProducts(product_counter);
            product_counter++;
            row_count++;
            $('#product_counter').val(product_counter);
            $('#row_count').val(row_count);
        }

        // To remove the product row from the table
        function removeProductorignal(removeProduct) {
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




        //by ip
        function removeProduct(removeProduct) {
            let token = "{{ csrf_token() }}";
            if (company_with_gst == 0) {
                let product_id = $(`#cwg_product_description_input_${removeProduct}`).val();
                var quantity_value = $(`#cwg_quantity_${removeProduct}`).val();
                let unit = $(`#cwg_p_unit_${removeProduct}`).val();

                let send_data = {
                    'product_id': product_id,
                    'quantity_value': quantity_value,
                    'unit': unit,
                    '_token': token
                };
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/invoice/updateqty') }}",
                    data: send_data,
                    success: function(data) {
                        console.log('ok');
                    }
                })

                $(`#cwg_row_${removeProduct}`).remove();
                row_count--;
                // console.log(product_counter);
                $('#row_count').val(row_count);
                console.log($('#row_count').val());
                getAmount();
                getTotalAmount();

            } else {
                let product_id = $(`#cwg_product_description_input_${removeProduct}`).val();
                var quantity_value = $(`#cwg_quantity_${removeProduct}`).val();
                let unit = $(`#cwg_p_unit_${removeProduct}`).val();

                let send_data = {
                    'product_id': product_id,
                    'quantity_value': quantity_value,
                    'unit': unit,
                    '_token': token
                };
                $.ajax({
                    type: 'post',
                    url: "{{ url('admin/invoice/updateqty') }}",
                    data: send_data,
                    success: function(data) {
                        console.log('ok');
                    }
                })

                console.log(product_id);

                $(`#cwg_row_${removeProduct}`).remove();
                row_count--;
                // console.log(product_counter);
                $('#row_count').val(row_count);
                getTotalAmount();
            }

        }
        // function removeProduct(removeProduct) {

        //     let token = "{{ csrf_token() }}";
        //     let product_id = $(`#cwg_product_description_input_${removeProduct}`).val();

        //     var quantity_value = $(`#cwg_quantity_${removeProduct}`).val();
        //     let unit = $(`#cwg_p_unit_${removeProduct}`).val();

        //     let send_data = {
        //         'product_id': product_id,
        //         'quantity_value': quantity_value,
        //         'unit': unit,
        //         '_token': token
        //     };
        //     $.ajax({
        //         type: 'post',
        //         url: "{{ url('admin/invoice/updateqty') }}",
        //         data: send_data,
        //         success: function(data) {
        //             console.log('ok');
        //         }
        //     })


        //     $(`#cwg_row_${removeProduct}`).remove();
        //     row_count--;
        //     // console.log(product_counter);
        //     $('#row_count').val(row_count);
        //     getTotalAmount();
        // }



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
                        vehicle_make_id = $('#selected_vehicle_make').val();
                        if (vehicle_make != null) {
                            if (Object.keys(vehicle_make).length > 0) {
                                $('#vehicle_make_id').empty()
                                $('#vehicle_make_id').append(
                                    `<option value="">Select a Vehicle
                                        Make</option>`
                                );
                                Object.keys(vehicle_make).forEach(key => {
                                    let selected;
                                    if (for_customer_edit_flag == 1) {
                                        if (key == vehicle_make_id) {
                                            selected = "selected";
                                        } else {
                                            selected = "";
                                        }
                                    }
                                    // console.log(key, vehicle_make[key]);
                                    $('#vehicle_make_id').append(
                                        `<option ${selected} value="${key}">${vehicle_make[key]}</option>`
                                    );
                                });
                                if (for_customer_edit_flag == 1) {
                                    getVehicleModel(vehicle_make_id, customer_id);
                                }

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
                        let selected_vehicle_model = $('#selected_vehicle_model').val();
                        // console.log(selected_vehicle_model);
                        if (vehicle_model != null) {
                            if (Object.keys(vehicle_model).length > 0) {
                                $('#vehicle_model_id').empty()
                                $('#vehicle_model_id').append(
                                    `<option value="">Select a Vehicle
                                        Model</option>`
                                );
                                Object.keys(vehicle_model).forEach(key => {
                                    let selected;
                                    if (for_customer_edit_flag == 1) {
                                        if (key == selected_vehicle_model) {
                                            selected = "selected";
                                        } else {
                                            selected = "";
                                        }
                                    }
                                    // console.log(key, vehicle_make[key]);
                                    $('#vehicle_model_id').append(
                                        `<option ${selected} value="${key}">${vehicle_model[key]}</option>`
                                    );
                                });
                                if (for_customer_edit_flag == 1) {
                                    getVehicleDetails(selected_vehicle_model);
                                }
                            }
                        }
                    }
                });
            }
        }

        function getVehicleDetails(vehicle_model_id) {
            // console.log(vehicle_model_id)
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
                    <input type="text" value="{{ $invoice->bank_name }}" name="bank_name" placeholder="Enter Bank Name" class=" form-control">
                </div>
                <div class="col-4">
                    <input type="text" value="{{ $invoice->cheque_no }}" name="cheque_no" placeholder="Enter Cheque No." class="form-control">
                </div>  
                <div class="col-4">
                    <input type="date" value="{{ $invoice->cheque_date }}" name="cheque_date" placeholder="Enter Cheque Date" class=" form-control">
                </div>  
            `);
            } else if (selected == 'Electronic Transaction') {
                $('#payment_method_input_fields').append(`
            <div class="col-8">
                    <input type="text" value="{{ $invoice->e_transaction_ref }}" name="e_transaction_ref" placeholder="Enter e-payment reference (eg : Paytm)" class="form-control">
            </div>
            `);
            }


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
                        $('.product_select_input').select2();
                        products = JSON.parse(data);
                        // console.log(products[0]);
                        if (products != null) {
                            if (company_with_gst == 0) {
                                $(`#cwg_product_description_input_${product_counter}`).append(`
                            <option value="">Select a product</option>
                            `);
                                Object.entries(products).forEach(entry => {
                                    const [key, value] = entry;
                                    // console.log(key, value);
                                    $(`#cwg_product_description_input_${product_counter}`).append(`
                                    <option value="${value.product_id}">${value.product_name}</option>
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
                                    <option value="${value.product_id}">${value.product_name}</option>
                                `);

                                });
                            }
                        }
                    }
                });
            }
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
                        $(`#cwg_orignal_amt_${pc}`).val('');

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
                                $(`#rate_${pc}`).val(value.product_rate);

                                window[`product_stock_${pc}`] = value.product_stock;

                                service_id = value.service_id;
                                //changes on 15_2_23
                                if (service_id == '1') {

                                    $(`#cwg_amount_${pc}`).attr('readonly', false);
                                    $(`#cwg_hsn_code_${pc}`).prop('readonly', true);
                                    $(`#cwg_quantity_${pc}`).prop('readonly', true);
                                    $(`#cwg_unit_${pc}`).prop('disabled', true);
                                    $(`#cwg_rate_${pc}`).prop('readonly', true);
                                    $(`#rate_${pc}`).prop('readonly', true);
                                    $(`#cwg_orignal_amt_${pc}`).val('');
                                    $(`#cwg_orignal_amt_${pc}`).attr('readonly', false);

                                }else{
                                    $(`#cwg_quantity_${pc}`).prop('readonly', false);

                                }

                                // by ip
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
                        }
                        getTotalAmount();
                    }
                });
            }
        }

        // function getorignalamount(product_counter) {
        //     amount = $(`#cwg_amount_${product_counter}`).val();
        //     console.log(amount);
        //     discount = $(`#cwg_discount_${product_counter}`).val();
        //     console.log(discount);

        //     if (amount) {
        //         discount_percent = (amount * discount) / 100;
        //         console.log(discount_percent);

        //         var discounted_amount = (amount - discount_percent)
        //         console.log('DIS', discounted_amount);
        //         $(`#cwg_total_amount_${product_counter}`).val(parseFloat(discounted_amount).toFixed(2));

        //     }
        //     getTotalAmount();
        // }

        function getorignalamount(product_counter) {
            var amount = $(`#cwg_orignal_amt_${product_counter}`).val();

            discount = $(`#cwg_discount_${product_counter}`).val();

            if (discount) {
                discount_percent = (amount * discount) / 100;

                var discounted_amount = (amount - discount_percent)
                console.log('DIS', discounted_amount);
                $(`#cwg_amount_${product_counter}`).val(parseFloat(discounted_amount).toFixed(2));
                $(`#cwg_total_amount_${product_counter}`).val(parseFloat(discounted_amount).toFixed(2));

            } else {
                $(`#cwg_amount_${product_counter}`).val(parseFloat(amount).toFixed(2));
                $(`#cwg_total_amount_${product_counter}`).val(parseFloat(amount).toFixed(2));
            }
            getTotalAmount();
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




        //by ip
        function calculateUnit(pc) {
            let selected_unit = $(`#cwg_p_unit_${pc}`).val();
            var rate = $(`#cwg_rate_${pc}`).val();
            var quantity_value = $(`#cwg_quantity_${pc}`).val();

            if (company_with_gst == '1') {

                if (selected_unit == '2' || selected_unit == '3') {

                    // console.log('ok');
                    // $(`#cwg_amount_${pc}`).val(Number(rate));
                    // console.log('calculateUnit gm/ml', $(`#cwg_amount_${pc}`).val());
                    // var amount = Number($(`#cwg_amount_${pc}`).val());

                    var rate = parseFloat(rate) / parseFloat(Number(quantity_value));
                    $(`#rate_${pc}`).val(rate);
                    var rate = $(`#rate_${pc}`).val();

                    var amount = parseFloat(quantity_value) * parseFloat(Number(rate));
                    $(`#cwg_orignal_amt_${pc}`).val(Number(amount));
                    $(`#cwg_amount_${pc}`).val(amount);

                } else {
                    $(`#rate_${pc}`).val(rate);

                    var amount = parseFloat(quantity_value) * parseFloat(rate);
                    $(`#cwg_orignal_amt_${pc}`).val(amount);
                    $(`#cwg_amount_${pc}`).val(amount);

                    // console.log(amount);

                    // $(`#cwg_amount_${pc}`).val(amount);
                    // window[`cwg_og_amount_${pc}`] = amount;


                }
            } else {
                if (selected_unit == '2' || selected_unit == '3') {

                    var rate = parseFloat(rate) / parseFloat(Number(quantity_value));
                    $(`#rate_${pc}`).val(rate);
                    var rate = $(`#rate_${pc}`).val();

                    var amount = parseFloat(quantity_value) * parseFloat(Number(rate));
                    $(`#cwg_orignal_amt_${pc}`).val(Number(amount));
                    $(`#cwg_amount_${pc}`).val(amount);



                    // console.log('calculateUnit gm/ml', $(`#cwg_amount_${pc}`).val());
                    // var amount = Number($(`#cwg_amount_${pc}`).val());

                } else {
                    $(`#rate_${pc}`).val(rate);
                    var amount = parseFloat(quantity_value) * parseFloat(Number(rate));
                    // console.log(amount);

                    $(`#cwg_orignal_amt_${pc}`).val(amount);
                    $(`#cwg_amount_${pc}`).val(amount);

                    // window[`cwg_og_amount_${pc}`] = amount;


                }
                getDiscountedAmount(pc);
            }
            putAmount(pc, amount);
            getDiscountedAmount(pc);
            // getCWGAmount(pc);
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
            console.log('in putamount');

            // If there is any value in amount field
            if (company_with_gst == '1') {

                if (amount != '' && amount != 0) {
                    if (customer_state == '21') {
                        let cgst_percent = parseInt($(`#cwg_cgst_percent_${pc}`).val());
                        let sgst_percent = parseInt($(`#cwg_sgst_percent_${pc}`).val());

                        let cgst_amount = (amount * cgst_percent) / 100;
                        let sgst_amount = (amount * sgst_percent) / 100;

                        $(`#cwg_cgst_amount_${pc}`).val(parseFloat(cgst_amount).toFixed(2));
                        $(`#cwg_sgst_amount_${pc}`).val(parseFloat(sgst_amount).toFixed(2));

                        let total_gst_amount = cgst_amount + sgst_amount;
                        let total_amount = total_gst_amount + amount;

                        $(`#cwg_total_amount_${pc}`).val(parseFloat(total_amount).toFixed(2));

                    } else {
                        let igst_percent = parseInt($(`#cwg_igst_percent_${pc}`).val());
                        let igst_amount = (amount * igst_percent) / 100;
                        $(`#cwg_igst_amount_${pc}`).val(parseFloat(igst_amount).toFixed(2));

                        let total_amount = amount + igst_amount;
                        $(`#cwg_total_amount_${pc}`).val(parseFloat(total_amount).toFixed(2));
                    }
                }
            } else {
                if (amount) {
                    var discount_percent = parseInt($(`#cwg_discount_${pc}`).val());
                    if (discount_percent) {
                        discount_percent = (amount * discount_percent) / 100;

                        var discounted_amount = (amount - discount_percent);

                        $(`#cwg_total_amount_${pc}`).val(parseFloat(discounted_amount).toFixed(2));
                        $(`#cwg_amount_${pc}`).val(parseFloat(discounted_amount).toFixed(2));

                    } else {

                        $(`#cwg_total_amount_${pc}`).val(parseFloat(amount).toFixed(2));
                        $(`#cwg_amount_${pc}`).val(parseFloat(amount).toFixed(2));

                    }

                }
            }

            getTotalAmount();
        }



        //by ip
        function getCWGAmount(pc) {
            var quantity_value = $(`#cwg_quantity_${pc}`).val();
            var discount_percent = parseInt($(`#cwg_discount_${pc}`).val());


            if (company_with_gst == '1') {
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

                    // $(`#cwg_amount_${pc}`).val(Number(rate));
                    // var amount = Number($(`#cwg_amount_${pc}`).val());
                    // console.log(amount);

                    var rate = parseFloat(rate) / parseFloat(Number(quantity_value));
                    $(`#rate_${pc}`).val(rate);
                    var rate = $(`#rate_${pc}`).val();


                    var amount = parseFloat(quantity_value) * parseFloat(Number(rate));
                    $(`#cwg_orignal_amt_${pc}`).val(Number(amount));
                    $(`#cwg_amount_${pc}`).val(amount);


                } else {

                    // var amount = parseFloat(quantity_value) * parseFloat(rate);
                    // console.log(amount);
                    // $(`#cwg_amount_${pc}`).val(amount);
                    // window[`cwg_og_amount_${pc}`] = amount;

                    $(`#rate_${pc}`).val(rate);
                    var amount = parseFloat(quantity_value) * parseFloat(rate);
                    $(`#cwg_orignal_amt_${pc}`).val(amount);
                    $(`#cwg_amount_${pc}`).val(amount);

                }

                if (!getDiscountedAmount(pc)) {
                    putAmount(pc, amount);
                }
            } else {
                var quantity_value = $(`#cwg_quantity_${pc}`).val();
                var unit = $(`#cwg_p_unit_${pc}`).val();
                var rate = $(`#cwg_rate_${pc}`).val();

                if (unit == '2' || unit == '3') {

                    // $(`#cwg_amount_${pc}`).val(Number(rate));
                    // var amount = Number($(`#cwg_amount_${pc}`).val());

                    var rate = parseFloat(rate) / parseFloat(Number(quantity_value));
                    $(`#rate_${pc}`).val(rate);
                    var rate = $(`#rate_${pc}`).val();

                    var amount = parseFloat(quantity_value) * parseFloat(Number(rate));
                    $(`#cwg_orignal_amt_${pc}`).val(Number(amount));
                    $(`#cwg_amount_${pc}`).val(amount);

                    getDiscountedAmount(pc);

                } else {

                    // var amount = parseFloat(quantity_value) * parseFloat(rate);
                    // $(`#cwg_amount_${pc}`).val(amount);

                    $(`#rate_${pc}`).val(rate);
                    var amount = parseFloat(quantity_value) * parseFloat(rate);
                    $(`#cwg_orignal_amt_${pc}`).val(amount);
                    $(`#cwg_amount_${pc}`).val(amount);
                    $(`#cwg_total_amount_${pc}`).val(amount);


                    getDiscountedAmount(pc);
                }
                // putAmount(pc, amount);
            }


        }


        //by ip
        function getrate(pc) {

            var quantity_value = $(`#cwg_quantity_${pc}`).val();

            var unit = $(`#cwg_p_unit_${pc}`).val();
            var rate = $(`#rate_${pc}`).val();
            var rate = $(`#cwg_rate_${pc}`).val(rate);


            if (unit == '2' || unit == '3') {

                // $(`#cwg_amount_${pc}`).val(Number(rate));
                // var amount = Number($(`#cwg_amount_${pc}`).val());

                var rate = parseFloat(rate) / parseFloat(Number(quantity_value));
                $(`#rate_${pc}`).val(rate);
                var rate = $(`#rate_${pc}`).val();
                var amount = parseFloat(quantity_value) * parseFloat(Number(rate));
                $(`#cwg_orignal_amt_${pc}`).val(Number(amount));


            } else {

                var quantity_value = $(`#cwg_quantity_${pc}`).val();
                var amount = parseFloat(quantity_value) * parseFloat(rate);
                $(`#cwg_orignal_amt_${pc}`).val(Number(amount));
                $(`#cwg_amount_${pc}`).val(amount);


            }

            // if (!getDiscountedAmount(pc)) {
            //     putAmount(pc, amount);
            calculateUnit(pc);

        }



        // To get the discounted amount
        // function getDiscountedAmount(pc) {
        //     var discount_percent = parseInt($(`#cwg_discount_${pc}`).val());
        //     // console.log(discount_percent);
        //     if (discount_percent) {
        //         var amount = parseInt(window[`cwg_og_amount_${pc}`]);
        //         // console.log(amount);
        //         if (amount) {
        //             discount_percent = (amount * discount_percent) / 100;
        //             var discounted_amount = (amount - discount_percent)
        //             $(`#cwg_amount_${pc}`).val(discounted_amount);
        //             putAmount(pc, discounted_amount);
        //             return 1;
        //         }
        //     } else {
        //         return 0;
        //     }
        // }

        //by ip
        function getDiscountedAmount(pc) {

            var discount_percent = parseInt($(`#cwg_discount_${pc}`).val());
            var amount = $(`#cwg_orignal_amt_${pc}`).val();

            // console.log(discount_percent);
            if (company_with_gst == '1') {

                if (discount_percent) {
                    // let selected_unit = $(`#cwg_p_unit_${pc}`).val();
                    // if (selected_unit == '2' || selected_unit == '3') {
                    //     var amount = $(`#cwg_rate_${pc}`).val();
                    // } else {

                    //     var amount = parseInt(window[`cwg_og_amount_${pc}`]);
                    //     // console.log('AMT',amount);
                    // }


                    //NEW CHANGE BY IP
                    if (amount) {
                        console.log('amount', amount);
                        console.log('dicount percent', discount_percent);

                        discount_percent = (amount * discount_percent) / 100;


                        var discounted_amount = (amount - discount_percent)
                        console.log('Dicount amount', discounted_amount);


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
                        var amt = $(`#cwg_amount_${pc}`).val();
                        var amount = Number(amt);
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
                // discount_percent = (amount * discount_percent) / 100;
                // console.log(discount_percent);

                // var discounted_amount = (amount - discount_percent);
                // console.log('DIS', discounted_amount);

                // $(`#cwg_total_amount_${pc}`).val(parseFloat(discounted_amount).toFixed(2));
                // putAmount(pc, amount);

                var amount = $(`#cwg_orignal_amt_${pc}`).val();


                putAmount(pc, amount);

            }


        }


        // To get the total amoung 
        function getTotalAmount() {

            if (company_with_gst == '1') {

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
                $('#amt_in_words').val('INR ' + numberToWords.toWords(cwg_total_amount_all_gst).concat(' only')
                    .toUpperCase());
            } else {
                let cwg_orignal_amt = document.querySelectorAll(".cwg_orignal_amt");
                let cwg_total_amount = document.querySelectorAll(".cwg_total_amount");

                let cwg_total_amount_all = getTotal(cwg_orignal_amt);
                let cwg_total_amount_all_gst = getTotal(cwg_total_amount);


                $('.cwg_total_amount_all_without_gst').val(parseFloat(cwg_total_amount_all).toFixed(2));
                $('.cwg_total_amount_all_gst').val(Math.floor(cwg_total_amount_all_gst));
            }
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



        // ------------------------------------------------
    </script>
@endsection
