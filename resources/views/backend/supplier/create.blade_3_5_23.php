@extends('backend.layouts.app')
@section('title', 'Create Supplier')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Create Supplier</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.supplier') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title="Back"><i
                    class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->


    <section class="db-section admin-form">

        <div class="content">

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title">Create Supplier</h4> --}}
                            {{-- <div class="text-end" style="position: absolute;
      right: 50px;">
                        <a href="{{ route('admin.supplier') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>

      </div> --}}

                            {{-- <p class="card-description">Create Supplier</p> --}}
                            @include('backend.includes.errors')
                            {{ Form::open(['url' => 'admin/supplier/store']) }}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('s_name', 'Supplier Name *') }}
                                            {{ Form::text('s_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'required' => true]) }}
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_email', 'Email*') }}
                                            {{ Form::text('s_email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_mobile_no', 'Supplier Mobile No*') }}
                                            {{ Form::text('s_mobile_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Mobile', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_address', 'Supplier Address *') }}
                                            {{ Form::text('s_address', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_gstno', 'Gst No') }}
                                            {{ Form::text('s_gstno', null, ['class' => 'form-control', 'placeholder' => 'Enter Gst No', 'required' => true]) }}
                                        </div>
                                    </div>


                                    {{-- <div class="col-md-6 col-12">
                        <div class="checkbox checkbox-success">
                          {{ Form::label('s_pin_code', 'Pin Code *') }}
                          {{ Form::text('s_pin_code', null, ['class' => 'form-control', 'placeholder' => 'Enter ', 'required' => true]) }}
                        </div>
                      </div>  --}}


                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_state', 'State* ') }}
                                            {{ Form::select('s_state', $state_data, null, ['class' => 'form-select state_selection', 'placeholder' => 'Select State']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_pin_code', 'Pin Code *') }}
                                            {{ Form::text('s_pin_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Pin Code', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_bank_name', 'Bank Name ') }}
                                            {{ Form::text('s_bank_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Bank Name', 'required' => true]) }}
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_branch_name', 'Branch Name') }}
                                            {{ Form::text('s_branch_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Branch Name', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_account_no', 'Account Number') }}
                                            {{ Form::text('s_account_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Account Number', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_bank_ifsc', 'Bank Ifsc ') }}
                                            {{ Form::text('s_bank_ifsc', null, ['class' => 'form-control', 'placeholder' => 'Enter Bank Ifsc', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group mb-5">
                                            {{ Form::label('s_pan_no', 'Pan No ') }}
                                            {{ Form::text('s_pan_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Pan No', 'required' => true]) }}
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-12">
                          <div class="form-group mb-5">
                              {{ Form::label('s_vat_no', 'Vat No *') }}
                              {{ Form::text('s_vat_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Vat No', 'required' => true]) }}
                          </div>
                        </div> --}}


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

    </section>



    <script>
        $(document).ready(function() {

            $('#reset').click(function(e) {
                location.reload();
            });

            $('.state_selection').select2();

        });
    </script>
@endsection
