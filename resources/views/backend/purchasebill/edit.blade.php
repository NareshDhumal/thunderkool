@extends('backend.layouts.app')
@section('title', 'Update Purchasebill')
@section('content')
    <style>
        input::-webkit-outer-spin-button,

        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;

        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;

        }
    </style>
    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Edit Purchase Bill</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.purchase.bill') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip"
                title="Back"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->
    <section class="db-section admin-form">
        <div class="main-panel">
            <div class="content-wrapper">

                {{-- {{ dd($data->Product_details->hsn_code) }} --}}
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                {{-- Add Products Button --}}
                                {{-- <div class="d-flex"> --}}
                                {{-- {!! Form::button('Add Products', ['type' => 'submit', 'class' => 'btn btn-danger', 'id' => 'add_btn']) !!} --}}
                                {{-- <button id="remove-btn" class="btn btn-danger ms-4" onclick="$(this).parents('#product_form').remove()">Remove</button> --}}
                                {{-- </div> --}}

                                {{-- <h4 class="card-title">Edit Purchase bill</h4>
                            <div class="text-end" style="position: absolute;
                            right: 50px;">
                                <a href="{{ route('admin.purchase.bill') }}" class="btn btn-inverse-primary float-right">
                                    <span class="align-middle ml-25">Back</span></a>
                            </div>
                            <p class="card-description">Edit Purchase bill</p> --}}
                                @include('backend.includes.errors')
                                {{-- {{ Form::open($editdata,['url' => 'admin/purchase/bill/store']) }} --}}



                                {{-- {{ dd($data->toarray()) }} --}}
                                {!! Form::model($data, [
                                    'method' => 'POST',
                                    'url' => ['admin/purchase/bill/update'],
                                    'class' => 'form',
                                ]) !!}
                                @csrf

                                <div class="form-body">
                                    <div class="row g-5 align-items-end">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group ">
                                                {{-- {{ Form::text('supplier_id',  $supplier->supplier_id)}} --}}
                                                {{ Form::hidden('invoice_no', $data->purchase_bill_no) }}
                                                {{ Form::hidden('supplier_state', null, ['class' => 'form-select supplier_state', 'placeholder' => '', 'id' => 'supplier_state']) }}
                                                {{ Form::label('supplier_id', 'Select Supplier *') }}
                                                {{ Form::Select('supplier_id', $supplier, $data->supplier_id, ['class' => 'form-select form-control supplier_select', 'placeholder' => 'Select Supplier', 'id' => 'supplier_id', 'required' => true]) }}

                                            </div>
                                        </div>


                                        {{-- for bank deatils --}}
                                        {{-- <table class="table table-bordered">
                                            <tr style="width:100">
                                                <th>Supplier Details</th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;white-space:break-spaces;" class="Supplier_details">
                                                </td>
                                                <td style="width:50%;white-space:break-spaces;" class="bank_details"></td>
                                            </tr>
                                        </table> --}}

                                        <div class="col-12">
                                            <table class="table-bordered " width="100%" style="width:100%">
                                                <tr style="border: 0;">
                                                    <th colspan="14"
                                                        style="font-size:15px;text-align: center; border: 0;">Supplier
                                                        Details</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" style="width: 50%; " class="Supplier_details"></td>
                                                    <td colspan="7" style="width: 50%; " class="bank_details"></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group ">
                                                {{ Form::label('company_id', 'Select Comapny *') }}
                                                {{ Form::Select('company_id', $comapany, $data->company_id, ['class' => 'form-select', 'disabled' => 'disabled']) }}
                                                {{ Form::hidden('company_id', $data->company_id, null, ['required' => true]) }}
                                            </div>
                                        </div>

                                        {{-- for company details --}}
                                        {{-- <table class="table table-bordered">
                                            <tr style="width:100">
                                                <th>Company Details</th>
                                            </tr>
                                            <tr>
                                                <td style="width:50%;white-space:break-spaces;" class="company_details">
                                                </td>
                                                <td style="width:50%;white-space:break-spaces;"
                                                    class="company_bank_details">
                                                </td>
                                            </tr>
                                        </table> --}}

                                        <div class="col-12">

                                            <table class="table-bordered " width="100%" style="width:100%">
                                                <tr style="border: 0;">
                                                    <th colspan="16"
                                                        style="font-size:15px;text-align: center; border: 0;">Company
                                                        Details</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="8" style="width: 50%; " class="company_details"></td>
                                                    <td colspan="8" style="width: 50%; " class="company_bank_details">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group ">
                                                {{ Form::label('purchase_bill_no', 'Purchase Bill No *') }}
                                                {{-- {{ Form::text('supplier_bill_no', $all_product+1 ,null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }} --}}
                                                {{ Form::hidden('supplier_bill_no', $data->supplier_bill_no, null, ['class' => 'form-control', 'placeholder' => '', 'required' => true]) }}

                                                <input value="{{ $data->invoice_no }}" type="text" id="purchase_bill_no"
                                                    name="purchase_bill_no" class="form-control">

                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 col-12">
                                            <div class="form-label-group ">
                                                {{ Form::label('supplier_bill_no', 'Supplier Bill No *') }}
                                                {{ Form::text('supplier_bill_no', $data->supplier_bill_no, null, ['class' => 'form-control', 'placeholder' => '', 'required' => true]) }}

                                            </div>
                                        </div> --}}

                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group ">
                                                {{ Form::label('dated', ' Dated *') }}
                                                {{-- {{ Form::date('dated',$data->dated, null, ['class' => 'form-date', 'placeholder' => 'Enter First Name', 'required' => true]) }} --}}
                                                <input value="{{ $data->dated }}" type="date" id="date_of_issue"
                                                    name="dated" class="form-control">


                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group ">
                                                {{ Form::label('payment_mode', 'Payment Mode *') }}
                                                {{ Form::Select('payment_mode', $payment_mode, $data->payment_mode, ['class' => 'form-select payment_mode', 'required' => true]) }}
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12" id="payment_m">
                                            <input type="number" class="cheque_no form-control" name="cheque_no"
                                                placeholder="Cheque No">
                                        </div>

                                        <div class="col-md-6 col-12 " id="bank_name">
                                            <input type="text" class="bank_name form-control" name="bank_name"
                                                placeholder="Bank Name">
                                        </div>

                                        <div class="col-md-6 col-12" id="cheque_date">
                                            <input type="date" class="cheque_date form-control" name="cheque_date"
                                                placeholder="Bank Name">
                                        </div>

                                        <div class="col-md-6 col-12" id="payment_electronic_ref">
                                            <input type="text" class=" form-control" name="electronic_payment_ref"
                                                value="{{ $data->electronic_payment_ref }}" id="electronic_payment_ref"
                                                placeholder="Payment Reference">
                                        </div>
                                    </div>

                                    {{-- 
                                    @if ($data->payment_mode == 'cheque')
                                        <div id="payment_m">
                                            <input type="text" name="cheque_no" placeholder="Cheque No">
                                        </div>
                                        <div id="bank_name">
                                            <input type="text" name="bank_name" placeholder="Bank Name">
                                        </div>
                                        <div id="cheque_date">
                                            <input type="date" name="cheque_date" placeholder="Bank Name">
                                        </div>
                                    @endif


                                    @if ($data->payment_mode == 'Epayment')
                                        <div id="payment_electronic_ref">
                                            <input type="text" name="electronic_payment_ref"
                                                placeholder="Payment Reference">
                                        </div>
                                    @endif --}}



                                    {{-- <div class="container"> --}}
                                    <div class="table-responsive  my-5">
                                        <table class="table table-bordered" style="width: auto">
                                            <thead>
                                                <tr class="d-flex" style="width: auto">
                                                    <th scope="col" style="width:250px">Description</th>
                                                    <th scope="col" style="width:140px">Hsn</th>
                                                    {{-- <th scope="col" style="width:140px">Comapny Part No</th>
                                                   F             <th scope="col" style="width:140px">Custom Part No</th> --}}
                                                    <th scope="col" style="width:140px">Qty</th>
                                                    <th scope="col" style="width:140px">Rate</th>
                                                    <th scope="col" style="width:140px">Value</th>
                                                    <th scope="col" style="width:110px">Unit</th>
                                                    <th scope="col" style="width:140px">Amt</th>
                                                    <th scope="col" style="width:110px">Disc</th>
                                                    <th scope="col" style="width:140px">Discounted Amt</th>
                                                    {{-- <th scope="col" style="width:140px">Grp</th> --}}
                                                    {{-- <th scope="col" style="width:140px">kg</th>
                                                                <th scope="col" style="width:140px">Mil</th>
                                                                <th scope="col" style="width:140px">Lit</th> --}}
                                                    <th scope="col" style="width:110px">Gst %</th>
                                                    <th scope="col" style="width:140px">Gst Amt</th>
                                                    <th scope="col" style="width:140px">Total Amt</th>







                                                    {{-- <th scope="col">Unit</th> --}}

                                                    {{-- <th scope="col">Gst</th>
                                                    <th scope="col">Unit</th>
                                                    <th scope="col">Total</th> --}}
                                                    {{-- <th><span class="btn btn-secondary" id="add_btn">Add</span>
                                                        </th> --}}

                                                    <th style="text-align: center; vertical-align: middle;">
                                                        <i class="fa fa-plus" id="add_btn"></i>
                                                    </th>
                                                </tr>
                                            </thead>
                                            {{-- {{ dd($data->toArray()) }} --}}
                                            @if (isset($data->Product_details))
                                                @foreach ($data->Product_details as $product_detail)
                                                    <tr class="d-flex" style="width: auto"
                                                        id="row{{ $row_id = $loop->iteration - 1 }}">


                                                        <th scope="col" style="width: 250px"><select
                                                                name="product_name[]" class="form-control product_name"
                                                                id="product_name_{{ $loop->iteration - 1 }}">
                                                                @foreach ($products as $index => $product)
                                                                    @if ($product_detail->product_name == $index)
                                                                        <option value="{{ $index }}"
                                                                            data-row_id="{{ $row_id }}" selected>
                                                                            {{ $product }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </th>


                                                        {{-- {{ print_r($product_detail->product_name) }} --}}
                                                        {{-- <th>
                                                            {{ Form::Select('product_name[]', $products, $product_detail->product_name,['class' => 'form-control product_name'.$product_detail->product_name, 'id' => 'product_name_'.($loop->iteration - 1) , 'required' => true]) }}
                                                        </th> --}}



                                                        <th scope="col" style="width: 140px"><input type="text"
                                                                name="hsn_code[]" id="hsn_code{{ $loop->iteration - 1 }}"
                                                                value="{{ $product_detail->hsn_code }}"
                                                                class="form-control hsn_code" placeholder="Enter hsn code"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                        </th>

                                                        @if ($product_detail->product_unit == 'Nos')
                                                            <th scope="col" style="width: 140px"><input type="number"
                                                                    name="quantity[]"
                                                                    id="quantity_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->quantity }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control quentity"
                                                                    placeholder="Enter quentity name"></th>
                                                        @elseif($product_detail->product_unit == 'Gm')
                                                            <th scope="col" style="width: 140px"><input type="number"
                                                                    name="quantity[]"
                                                                    id="quantity_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->stock }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control quentity"
                                                                    placeholder="Enter quentity name"></th>
                                                        @elseif($product_detail->product_unit == 'Mil')
                                                            <th scope="col" style="width: 140px"><input type="number"
                                                                    name="quantity[]"
                                                                    id="quantity_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->stock }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control quentity"
                                                                    placeholder="Enter quentity name"></th>
                                                        @elseif($product_detail->product_unit == 'Kg')
                                                            <th scope="col" style="width: 140px"><input type="number"
                                                                    name="quantity[]"
                                                                    id="quantity_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->stock }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control quentity"
                                                                    placeholder="Enter quentity name"></th>
                                                        @else
                                                            <th scope="col" style="width: 140px"><input type="number"
                                                                    name="quantity[]"
                                                                    id="quantity_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->stock }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control quentity"
                                                                    placeholder="Enter quentity name"></th>
                                                        @endif


                                                        <th scope="col" style="width: 140px"><input type="number"
                                                                name="rate[]"
                                                                id="product_rate_{{ $loop->iteration - 1 }}"
                                                                value="{{ $product_detail->rate }}"
                                                                data-myval="{{ $loop->iteration - 1 }}"
                                                                class="form-control product_rate"
                                                                placeholder="Enter rate"></th>

                                                        {{-- new changes by mahesh sir --}}
                                                        {{-- new changes --}}


                                                        @if ($product_detail->product_unit == 'Nos')
                                                            <th scope="col" style="width: 140px"><input type="float"
                                                                    name="grams[]" id="grams_{{ $loop->iteration - 1 }}"
                                                                    value=""
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control grams" placeholder="Enter Grams">
                                                            </th>
                                                        @elseif($product_detail->product_unit == 'Gm')
                                                            <th scope="col" style="width: 140px"><input type="float"
                                                                    name="grams[]" id="grams_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->quantity }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control grams" placeholder="Enter Grams">
                                                            </th>
                                                        @elseif($product_detail->product_unit == 'Mil')
                                                            <th scope="col" style="width: 140px"><input type="float"
                                                                    name="grams[]" id="grams_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->quantity }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control grams" placeholder="Enter Grams">
                                                            </th>
                                                        @elseif($product_detail->product_unit == 'Kg')
                                                            <th scope="col" style="width: 140px"><input type="float"
                                                                    name="grams[]" id="grams_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->quantity }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control grams" placeholder="Enter Grams">
                                                            </th>
                                                        @else
                                                            <th scope="col" style="width: 140px"><input type="float"
                                                                    name="grams[]" id="grams_{{ $loop->iteration - 1 }}"
                                                                    value="{{ $product_detail->quantity }}"
                                                                    data-myval="{{ $loop->iteration - 1 }}"
                                                                    class="form-control grams" placeholder="Enter Grams">
                                                            </th>
                                                        @endif

                                                        <th scope="col" style="width: 110px"><select
                                                                name="unit[]"class="form-control unit"
                                                                id="unit_{{ $loop->iteration - 1 }}" required>
                                                                @foreach ($p_unit as $unit)
                                                                    {{-- <option value="{{ $unit }}">{{ $unit }}</option> --}}
                                                                    @if ($product_detail->product_unit == $unit)
                                                                        <option value="{{ $unit }}" selected>
                                                                            {{ $unit }}</option>
                                                                    @else
                                                                        <option value="{{ $unit }}">
                                                                            {{ $unit }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select></th>

                                                        <th scope="col" style="width: 140px"><input type="number"
                                                                name="orignal_amount[]"
                                                                id="orignal_amount{{ $loop->iteration - 1 }}"
                                                                value="{{ $product_detail->orignal_amount }}"
                                                                data-myval="{{ $loop->iteration - 1 }}"
                                                                class="form-control orignal_amount"
                                                                placeholder="Enter amount"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                readonly></th>

                                                        <th scope="col" style="width: 110px"><input type="number"
                                                                name="discount[]"
                                                                id="discount_{{ $loop->iteration - 1 }}"
                                                                value="{{ $product_detail->discount }}"
                                                                class="form-control discount" placeholder="disc"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                                        </th>

                                                        <th scope="col" style="width: 140px"><input type="number"
                                                                name="amount[]"
                                                                id="product_amount{{ $loop->iteration - 1 }}"
                                                                value="{{ $product_detail->amount }}"
                                                                data-myval="{{ $loop->iteration - 1 }}"
                                                                class="form-control product_amount"
                                                                placeholder="Enter amount"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                readonly></th>

                                                        <th scope="col" style="width: 110px"><select
                                                                name="cgst_percent[]" class="form-control gst_percent"
                                                                id="gst_percent_{{ $loop->iteration - 1 }}">
                                                                @foreach ($gst_percent as $gst)
                                                                    @if ($product_detail->cgst_percent + $product_detail->sgst_percent + $product_detail->igst_percent == $gst)
                                                                        {{-- {{ print_r($product_detail->cgst_percent+$product_detail->sgst_percent) }}  --}}
                                                                        <option value="{{ $gst }}" selected>
                                                                            {{ $gst }}</option>
                                                                    @else
                                                                        <option value="{{ $gst }}">
                                                                            {{ $gst }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select></th>

                                                        <th scope="col" style="width: 140px"><input type="float"
                                                                name="gst_amount[]"
                                                                id="gst_amount{{ $loop->iteration - 1 }}"
                                                                value="{{ $product_detail->cgst + $product_detail->sgst + $product_detail->igst }}"
                                                                class="form-control gst_amount" placeholder="Gst Amount"
                                                                readonly>
                                                        </th>



                                                        <th scope="col" style="width: 140px"><input type="float"
                                                                name="total_amount[]"
                                                                id="total_amount{{ $loop->iteration - 1 }}"
                                                                value="{{ $product_detail->row_total_gst }}"
                                                                class="form-control total_amount"
                                                                placeholder="Total amount" readonly></th>

                                                        <th style="text-align: center; vertical-align: middle;">
                                                            <li id="{{ $loop->iteration - 1 }}"
                                                                class="fa-sharp fa fa-trash remove_row"></li>
                                                        </th>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            <tbody class="access_data">

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- </div> --}}

                                    {{-- readonly inputs --}}
                                    {{-- <td width="80">Quantity<input type="text"
                                                class="form-control finalquantity" name="finalquantity"
                                                readonly="readonly"></td>
                                        <td>Amount<input type="text" class="form-control finalamount"
                                                name="finalamount" readonly="readonly"></td>

                                        <td width="180">Total Amount<input type="text"
                                                class="form-control finalgstamount" name="finalgstamount"
                                                readonly="readonly"></td>
                                        </tr>

                                        <tr>
                                            <td colspan="12" align="right">Total Amount (Without GST)</td>
                                            <td><input type="text" class="form-control" name="total_without_tax"
                                                    id="total_without_tax" readonly="readonly"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" align="right">GST Amount</td>
                                            <td><input type="text" class="form-control" name="final_igst_amount"
                                                    id="gst_amount_of_all" readonly="readonly"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="12" align="right">Grand Total ( With GST )</td>
                                            <td><input type="text" class="form-control" name="grand_total_gst"
                                                    id="grand_total_gst" readonly="readonly"></td>
                                        </tr>


                                        <tr>
                                            <td colspan="15" align="left">Amount Chargeable ( in Words )<br />
                                            </td>
                                            <br /><input type="text" class="form-control" name="amount_words"
                                                id="amount_words" readonly="readonly">
                                        </tr> --}}

                                    <div class="row mb-5">
                                        <div class="col-md-4 col-12">
                                            Quantity
                                            <input type="text" class="form-control finalquantity" name="finalquantity"
                                                readonly="readonly">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            Amount
                                            <input type="text" class="form-control finalamount" name="finalamount"
                                                readonly="readonly">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            Total Amount
                                            <input type="text" class="form-control finalgstamount"
                                                name="finalgstamount" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-md-4 col-12">
                                            Total Amount (Without GST)
                                            <input type="text" class="form-control" name="total_without_tax"
                                                value="" id="total_without_tax" readonly="readonly">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            GST Amount
                                            <input type="text" class="form-control" name="final_igst_amount"
                                                value="" id="gst_amount_of_all" readonly="readonly">
                                        </div>
                                        <div class="col-md-4 col-12">
                                            Grand Total ( With GST )
                                            <input type="text" class="form-control" name="grand_total_gst"
                                                value="" id="grand_total_gst" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-md-12 col-12">
                                            Amount Chargeable ( in Words )
                                            <input type="text" class="form-control" name="amount_words"
                                                id="amount_words" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-start">
                                        {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-5']) }}
                                        <button type="reset" class="btn btn-primary mr-1 mb-1">Reset</button>
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

            calculateFinalAmount();
            unit();


            // $('#supplier_id').prepend('<option selected></option>').select2({
            //     allowClear: true
            // });

            $('#supplier_id').select2();

            //repeter
            // code 4
            var product_name_num = $('.product_name').length;
            // console.log("product_name_num", product_name_num);
            i = (product_name_num > 0) ? product_name_num : 0;
            // i = 0;
            jQuery('#add_btn').on('click', function() {
                // BindControls()
                var supplier_id = $('#supplier_id').val();
                var company_id = $('#company_id').val();
                if (supplier_id == '' || company_id == '') {
                    alert('Please select supplier and company first');
                } else {

                    i++;
                    let data = '';

                    data = '<div class="main_div row"> <div class="cart-title" data-myval="' + i + '">';

                    data = '<tr class="table_row d-flex" id="row' + i + '" style="width:auto">';
                    data +=
                        '<td style="width:250px"><select  name="product_name[]" class="form-control product_name" id="product_name_' +
                        i + '" style="width: 200px;"></select></td>';

                    data +=
                        '<td style="width:140px"><input type="text" name="hsn_code[]"  id="hsn_code' + i +
                        '" class="form-control hsn_code" placeholder="Enter hsn code" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>';

                    data +=
                        '<td style="width:140px"><input type="number" name="quantity[]"  id="quantity_' +
                        i +
                        '" data-myval="' + i +
                        '" class="form-control quentity" placeholder="Enter quentity name" required></td>';

                    data +=
                        '<td style="width:140px"><input type="number" name="rate[]"  id="product_rate_' +
                        i +
                        '" data-myval="' + i +
                        '" class="form-control product_rate" placeholder="Enter rate" required></td>';

                    //new changes givin by mahesh sir
                    data +=
                        '<td style="width:140px"><input type="float" name="grams[]"  id="grams_' + i +
                        '"  data-myval="' + i +
                        '" class="form-control grams" placeholder="Enter Grams"></td>';


                    data +=
                        '<td style="width:110px"><select  name="unit[]" class="form-control unit" id="unit_' +
                        i + '" required>';
                    data += '<option value="">UNIT</option>';
                    @foreach ($p_unit as $unit)
                        data += '<option value="{{ $unit }}">{{ $unit }}</option>';
                    @endforeach
                    data += '</select></td>';

                    data +=
                        '<td style="width:140px"><input type="number" name="orignal_amount[]"  id="orignal_amount' +
                        i +
                        '"  data-myval="' + i +
                        '" class="form-control orignal_amount" placeholder="Enter amount" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" readonly></td>';

                    data +=
                        '<td style="width:110px"><input type="number" name="discount[]"  id="discount_' +
                        i +
                        '" class="form-control discount" placeholder="disc" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>';

                    data +=
                        '<td style="width:140px"><input type="float" name="amount[]"  id="product_amount' +
                        i +
                        '"  data-myval="' + i +
                        '" class="form-control product_amount" placeholder="Enter amount" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"></td>';

                    data +=
                        '<td style="width:110px"><select  name="cgst_percent[]" class="form-control gst_percent" id="gst_percent_' +
                        i + '">';
                    data += '<option value="">GST</option>';
                    @foreach ($gst_percent as $gst)
                        data += '<option value="{{ $gst }}">{{ $gst }}</option>';
                    @endforeach

                    data += '</select></td>';


                    data +=
                        '<td style="width:140px"><input type="float" name="gst_amount[]"  id="gst_amount' +
                        i +
                        '" class="form-control gst_amount" placeholder="Gst Amount" readonly></td>';

                    data +=
                        '<td style="width:140px"><input type="float" name="total_amount[]"  id="total_amount' +
                        i +
                        '" class="form-control total_amount" placeholder="Total amount" readonly></td>';


                    // data += '<td><button type="button" id="' + i +
                    //     '" class="btn btn-danger remove_row">Delete</button></td>';
                    data += '<td style="text-align: center; vertical-align: middle;"><li id="' + i +
                        '" class="fa-sharp fa fa-trash remove_row"></li></td>';


                    data += '</tr>';
                    data += '</div></div>';
                    $('.access_data').append(data);


                    $(document).on('click', '.remove_row', function() {
                        var row_id = $(this).attr("id");
                        $('#row' + row_id + '').remove();

                        calculateFinalAmount()
                    });

                }





            });

            // $('.product_name').on('change', function() {
            $(document).on('change', '.product_name', function() {
                // $('#product_name' + i).on('change', function() {

                console.log('done');

                var row_id = $(this).attr('id');
                var row_count = row_id.split('_');
                var get_id = row_count[2];

                // change on 9_3_23
                var quentity = $('#quantity_' + get_id).val('');
                var amount_data = $('#product_amount' + get_id).val('');
                var gst_amount = $('#gst_amount' + get_id).val('');
                var discount = $('#discount_' + get_id).val('');
                var gst_percent = $('#gst_percent_' + get_id).val('');
                var total_amount = $('#total_amount' + get_id).val('');
                var unit = $('#unit_' + get_id).val('');
                var orignal_amount = $('#orignal_amount' + get_id).val('');

                $("#amount_words").val('Nill');

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

                        if (return_data['product_unit'] == 'Nos') {

                            $(`#unit_${get_id} option`).prop('disabled',
                                'disabled');
                            $(`#unit_${get_id} option[value="Nos"]`).prop(
                                'disabled', false);

                        } else if (return_data['product_unit'] == 'Gm') {

                            $(`#unit_${get_id} option`).prop('disabled',
                                'disabled');
                            $(`#unit_${get_id} option[value="Gm"]`).prop(
                                'disabled', false);
                            $(`#unit_${get_id} option[value="Kg"]`).prop(
                                'disabled', false);

                        } else if (return_data['product_unit'] == 'Mil') {

                            $(`#unit_${get_id} option`).prop('disabled',
                                'disabled');
                            $(`#unit_${get_id} option[value="Mil"]`).prop(
                                'disabled', false);
                            $(`#unit_${get_id} option[value="Lit"]`).prop(
                                'disabled', false);

                        }

                        $("#hsn_code" + get_id).val(return_data['hsn_code']);
                        $("#product_rate_" + get_id).val(return_data[
                            'product_rate']);


                        calculateFinalAmount();

                    }
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
                $('#orignal_amount' + get_id).val(amount);

                var product_amount = $('#orignal_amount' + get_id).val();
                var gst_percent = $('#gst_percent_' + get_id).val();
                var disc = $('#discount_' + get_id).val();


                var unit = $('#unit_' + get_id).val();

                // if (unit == 'Gm') {

                //     quentity = quentity / 1000;
                //     var amount = parseFloat(quentity) * parseFloat(product_rate);
                //     $('#product_amount' + get_id).val(amount);

                //     var gm_product_amount = $('#product_amount' + get_id).val();
                //     var gst_percent = $('#gst_percent_' + get_id).val();

                //     console.log(gm_product_amount);
                //     console.log(gst_percent);


                //     var gst_amount = (gm_product_amount * gst_percent) / 100;
                //     console.log(gst_amount);

                //     $('#gst_amount' + get_id).val(gst_amount);
                //     var row_total_gst = Number(gm_product_amount) + Number(gst_amount);
                //     $("#total_amount" + get_id).val(row_total_gst);


                // }

                // else {
                var amount = parseFloat(quentity) * parseFloat(product_rate);
                $('#orignal_amount' + get_id).val(amount);

                var gst_amount = (product_amount * gst_percent) / 100;
                $('#gst_amount' + get_id).val(gst_amount);
                var row_total_gst = Number(product_amount) + Number(gst_amount);
                $("#total_amount" + get_id).val(row_total_gst);

                // }
                calculateDiscount(get_id);
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
                $('#orignal_amount' + get_id).val(amount);

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
                // if (unit == 'Gm') {
                //     quentity = quentity / 1000;
                //     var amount = parseFloat(quentity) * parseFloat(rate);
                //     $('#product_amount' + get_id).val(amount);

                //     var gm_product_amount = $('#product_amount' + get_id).val();
                //     var gst_percent = $('#gst_percent_' + get_id).val();

                //     var gst_amount = (gm_product_amount * gst_percent) / 100;
                //     $('#gst_amount' + get_id).val(gst_amount);
                //     var row_total_gst = Number(gm_product_amount) + Number(gst_amount);
                //     $("#total_amount" + get_id).val(row_total_gst);

                // } else {

                var gst_amount = (product_amount * gst_percent) / 100;
                $('#gst_amount' + get_id).val(gst_amount);
                var row_total_gst = Number(product_amount) + Number(gst_amount);
                $("#total_amount" + get_id).val(row_total_gst);
                // }
                calculateDiscount(get_id);
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

                if (unit == 'Nos') {
                    $('#grams_' + get_id).val('');
                    $('#grams_' + get_id).attr('readonly', true);


                } else {
                    $('#grams_' + get_id).attr('readonly', false);

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
                calculateDiscount(get_id);

                calculateFinalAmount()
                amountWords()

            });


            function calculateDiscount(get_id) {

                var disc = $("#discount_" + get_id).val();

                var product_amount = $('#orignal_amount' + get_id).val();
                var product_rate = $('#product_rate_' + get_id).val();
                var gst_percent = $('#gst_percent_' + get_id).val();
                var quentity = $('#quantity_' + get_id).val();
                var unit = $('#unit_' + get_id).val();
                var total_amt = $('#total_amount' + get_id).val();

                if (quentity != '' && unit == 'Gm') {
                    // quentity = quentity / 1000;
                }
                var product_amount = parseFloat(quentity) * parseFloat(product_rate);


                if (disc != 0) {

                    var discount_val = product_amount * disc / 100;
                    var final = parseFloat(product_amount) - parseFloat(discount_val);

                    $('#product_amount' + get_id).val(final);

                    var product_amount = $('#product_amount' + get_id).val();

                    var gst_amount = (product_amount * gst_percent) / 100;
                    $('#gst_amount' + get_id).val(gst_amount);
                    var row_total_gst = Number(product_amount) + Number(gst_amount);
                    $("#total_amount" + get_id).val(row_total_gst);

                } else if (disc == '' || disc == 0) {

                    // console.log('no discount');
                    var amount = parseFloat(quentity) * parseFloat(product_rate);
                    $('#orignal_amount' + get_id).val(amount);
                    $('#product_amount' + get_id).val(amount);

                    var gst_amount = (product_amount * gst_percent) / 100;
                    $('#gst_amount' + get_id).val(gst_amount);
                    var row_total_gst = Number(product_amount) + Number(gst_amount);
                    $("#total_amount" + get_id).val(row_total_gst);

                } else {
                    console.log('else');
                }





            }


            $(document).on('change', '.discount', function() {

                var row_id = $(this).attr('id');
                var row_count = row_id.split('_');
                var get_id = row_count[1];
                var disc = $("#discount_" + get_id).val();
                var product_amount = $('#product_amount' + get_id).val();
                var gst_percent = $('#gst_percent_' + get_id).val();

                // if (disc != '') {
                //     var discount_val = product_amount * disc / 100;
                //     var final = parseFloat(product_amount) - parseFloat(discount_val);

                //     console.log(final);
                //     $('#product_amount' + get_id).val(final);

                //     var product_amount = $('#product_amount' + get_id).val();

                //     var gst_amount = (product_amount * gst_percent) / 100;
                //     $('#gst_amount' + get_id).val(gst_amount);
                //     var row_total_gst = Number(product_amount) + Number(gst_amount);
                //     console.log(row_total_gst);
                //     $("#total_amount" + get_id).val(row_total_gst);
                // }
                calculateDiscount(get_id);
                calculateFinalAmount()
            });



            // calling paymet function
            // $('#payment_m').hide();
            // $('#bank_name').hide();
            // $('#cheque_date').hide();
            // $('#payment_electronic_ref')
            //     .hide();

            $('#payment_mode').change(function() {
                // alert($(this).text());
                //  alert($("#payment_mode :selected").text())
                // if ($("#payment_mode :selected").text() == "cheque") {

                //     $('#payment_m').show();
                //     $('#bank_name').show();
                //     $('#cheque_date').show();
                //     $('#payment_electronic_ref').hide();


                // } else if ($("#payment_mode :selected").text() == "Epayment") {

                //     $('#payment_electronic_ref').show();
                //     $('#bank_name').hide();
                //     $('#cheque_date').hide();
                //     $('#payment_m').hide();

                // } else if ($("#payment_mode :selected").text() == "cash") {

                //     $('#payment_m').hide();
                //     $('#bank_name').hide();
                //     $('#cheque_date').hide();
                //     $('#payment_electronic_ref').hide();

                // }
                payment()
            });

            // $('#company_id').change(function() {

            if ($('.access_data').html() != '') {
                $('.access_data').html('');
            }

            let select_val = $("#company_id").find(':selected').val();

            var supplier_id = $('#supplier_id').val();
            // alert(select_val);

            var csrfName = '<?= csrf_token() ?>';
            // alert(select_val);
            if (supplier_id == '') {
                alert('Please Select Supplier Name');

            } else {
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

            // });




            //get supplier details automaticly

            let sup_val = $(".supplier_select").find(':selected').val();
            // console.log(sup_val);
            var csrfName = '<?= csrf_token() ?>';
            // alert(select_val);
            $.ajax({
                type: "post",
                url: "{{ url('/') }}/admin/purchase/bill/editsupdetails",
                // data: select_val,
                data: {
                    _token: csrfName,
                    sup_val: sup_val
                },
                // dataType: "dataType",
                success: function(response) {

                    $(".Supplier_details").html(response[0]);
                    $(".bank_details").html(response[1]);
                    $(".supplier_state").val(response[2]);


                }
            });





            //get supplier details on supplier change
            $('.supplier_select').change(function() {
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
                        $(".supplier_state").val(response[2]);
                        // console.log(response);


                    }
                });
            });

            //select2 request
            var csrfName = '<?= csrf_token() ?>';
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




            //payment mode
            $('#payment_m').hide();
            $('#bank_name').hide();
            $('#cheque_date').hide();
            $('#payment_electronic_ref').hide();

            function payment() {

                if ($("#payment_mode :selected").val() == "cheque") {

                    $('#payment_m').show();
                    $('#bank_name').show();
                    $('#cheque_date').show();

                    $('#electronic_payment_ref').val('');
                    $('#payment_electronic_ref').hide();


                } else if ($("#payment_mode :selected").val() == "Epayment") {
                    // console.log('ok');


                    $('#payment_electronic_ref').show();

                    $('.bank_name').val('');
                    $('#bank_name').hide();

                    $('.cheque_date').val('');
                    $('#cheque_date').hide();

                    $('.cheque_no').val('');
                    $('#payment_m').hide();

                } else if ($("#payment_mode :selected").val() == "cash") {

                    $('.cheque_no').val(null);
                    $('#payment_m').hide();

                    $('.bank_name').val('');
                    $('#bank_name').hide();

                    $('.cheque_date').val('');
                    $('#cheque_date').hide();

                    $('#electronic_payment_ref').val('');
                    $('#payment_electronic_ref').hide();


                } else if ($("#payment_mode :selected").val() == "pending") {

                    $('.cheque_no').val(null);
                    $('#payment_m').hide();

                    $('.bank_name').val('');
                    $('#bank_name').hide();

                    $('.cheque_date').val('');
                    $('#cheque_date').hide();

                    $('#electronic_payment_ref').val('');
                    $('#payment_electronic_ref').hide();


                }


                let Payment_val = $('#payment_mode').val();
                var csrfName = '<?= csrf_token() ?>';
                var invoice_no = "<?php echo $data->invoice_no; ?>";
                $.ajax({
                    type: "post",
                    url: "{{ url('/') }}/admin/purchase/bill/paymentdetails",
                    // data: select_val,
                    data: {
                        _token: csrfName,
                        Payment_val: Payment_val,
                        invoice_no: invoice_no
                    },
                    // dataType: "dataType",
                    success: function(response) {
                        $(".cheque_no").val(response[0]);
                        $(".bank_name").val(response[1]);
                        $(".cheque_date").val(response[2]);
                        $(".electronic_payment_ref").val(response[3]);

                    }
                });

            }

            payment();

            $(document).ready(function() {

                let select_val = $('#company_id').find(":selected").val();

                var row_id = $('.product_name').attr('id');
                var row_count = row_id.split('_');
                var get_id = row_count[2];

                // $('#product_name_'+ get_id).select2({
                $('.product_name').select2({

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



        });

        function amountWords(finalamount) {
            if (finalamount == 0) {
                $("#amount_words").val(finalamount);

            } else if (finalamount != '') {

                var value = Math.round(finalamount * 100 / 100).toFixed(2);

                var splitedValue = value.split(".");
                var value1 = splitedValue[0];
                var value2 = numberToWords.toWords(value1);
                var result = value2.toUpperCase();

                $("#amount_words").val(result)
            }

        }

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

        $(document).on('click', '.remove_row', function() {
            var row_id = $(this).attr("id");
            $('#row' + row_id + '').remove();
            calculateFinalAmount()
        });

        function unit() {
            var token = "{{ csrf_token() }}";
            $('.product_name :selected').each(function() {
                var product_unit = $(this).data('unit');
                var row_id = $(this).data('row_id');

                console.log('product_unit', product_unit);
                console.log('row', row_id);

                let token = "{{ csrf_token() }}";
                var product_name = $(this).val();
                $.ajax({
                    type: "post",
                    url: "{{ url('/') }}/admin/purchase/bill/getproducts",
                    data: {
                        _token: token,
                        product_name: product_name
                    },
                    success: function(data) {


                        if (data.product_unit == 'Nos') {

                            $(`#unit_${row_id} option`).prop('disabled',
                                'disabled');
                            $(`#unit_${row_id} option[value="Nos"]`).prop(
                                'disabled', false);

                        } else if (data.product_unit == 'Gm') {

                            $(`#unit_${row_id} option`).prop('disabled',
                                'disabled');
                            $(`#unit_${row_id} option[value="Gm"]`).prop(
                                'disabled', false);
                            $(`#unit_${row_id} option[value="Kg"]`).prop(
                                'disabled', false);

                        } else if (data.product_unit == 'Mil') {

                            $(`#unit_${row_id} option`).prop('disabled',
                                'disabled');
                            $(`#unit_${row_id} option[value="Mil"]`).prop(
                                'disabled', false);
                            $(`#unit_${row_id} option[value="Lit"]`).prop(
                                'disabled', false);

                        }

                    }
                });
            });
        }
    </script>
@endsection
