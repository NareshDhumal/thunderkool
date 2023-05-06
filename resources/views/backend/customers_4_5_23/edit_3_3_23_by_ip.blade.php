@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Customers</h4>
                            <div class="text-end" style="position: absolute;
      right: 50px;">
                                <a href="{{ route('admin.customers') }}" class="btn btn-inverse-danger btn-fw"><i
                                        class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>

                            </div>
                            <p class="card-description">Edit Customers</p>
                            @include('backend.includes.errors')
                            {!! Form::model($editdata, [
                                'method' => 'POST',
                                'url' => ['admin/customer/update'],
                                'class' => 'form',
                            ]) !!}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            {{ Form::hidden('customer_id', $editdata->customer_id) }}
                                            {{ Form::label('customer_name', 'Customer Name *') }}
                                            {{ Form::text('customer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'required' => true]) }}
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('address', 'Customer Address*') }}
                                            {{ Form::text('address', null, ['class' => 'date form-control', 'placeholder' => 'Enter Address', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('mobile_no', 'Mobile Number*') }}
                                            {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Mobile No', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('email', 'Email*') }}
                                            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('pin_code', 'Pin Code*') }}
                                            {{ Form::text('pin_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Pin', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('state', 'State*') }}
                                            {{ Form::select('state', $state, $editdata->state, ['class' => 'form-control', 'placeholder' => 'Enter State', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('c_gst_no', 'Gst In*') }}
                                            {{ Form::text('c_gst_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Gst No', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('c_bank_name', 'Bank Name*') }}
                                            {{ Form::text('c_bank_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Bank', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('c_branch_name', 'Branch Name*') }}
                                            {{ Form::text('c_branch_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Branch', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('c_bank_ifsc', 'Bank Ifsc*') }}
                                            {{ Form::text('c_bank_ifsc', null, ['class' => 'form-control', 'placeholder' => 'Enter Ifsc', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('c_account_no', 'Account Number*') }}
                                            {{ Form::text('c_account_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Account No', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            {{ Form::label('c_pan_no', 'Pan Number*') }}
                                            {{ Form::text('c_pan_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Pan No', 'required' => true]) }}
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-start">
                                        {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                        <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script></script>
@endsection
