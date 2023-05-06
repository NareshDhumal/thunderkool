@extends('backend.layouts.app')
@section('title', 'Update Customers')


@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Edit Customers</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.customers') }}" class="btn btn-secondary my-2" title="Back" data-bs-toggle="tooltip"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->

    <section class="db-section admin-form">
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h4 class="card-title">Edit Customers</h4>
        <div class="text-end" style="position: absolute;
        right: 50px;">
                          <a href="{{ route('admin.customers') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
  
        </div> --}}
                                {{-- <p class="card-description">Edit Customers</p> --}}
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
                                            <div class="form-label-group mb-5">
                                                {{ Form::hidden('customer_id', $editdata->customer_id) }}
                                                {{ Form::label('customer_name', 'Customer Name *') }}
                                                {{ Form::text('customer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'required' => true]) }}
                                            </div>
                                        </div>


                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('address', 'Customer Address*') }}
                                                {{ Form::text('address', null, ['class' => 'date form-control', 'placeholder' => 'Enter Address', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('mobile_no', 'Mobile Number*') }}
                                                {{ Form::text('mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Mobile No', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('email', 'Email') }}
                                                {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('pin_code', 'Pin Code*') }}
                                                {{ Form::text('pin_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Pin']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('state', 'State*') }}
                                                {{ Form::select('state', $state, $editdata->state, ['class' => 'form-control', 'placeholder' => 'Enter State']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('c_gst_no', 'Gst In*') }}
                                                {{ Form::text('c_gst_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Gst No']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('c_bank_name', 'Bank Name') }}
                                                {{ Form::text('c_bank_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Bank']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('c_branch_name', 'Branch Name') }}
                                                {{ Form::text('c_branch_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Branch']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('c_bank_ifsc', 'Bank Ifsc') }}
                                                {{ Form::text('c_bank_ifsc', null, ['class' => 'form-control', 'placeholder' => 'Enter Ifsc']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('c_account_no', 'Account Number') }}
                                                {{ Form::text('c_account_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Account No']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('c_pan_no', 'Pan Number') }}
                                                {{ Form::text('c_pan_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Pan No']) }}
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-start">
                                            {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-5']) }}
                                            <button type="reset" class="btn btn-primary mr-1 mb-1">Reset</button>
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
    </section>



    <script></script>
@endsection
