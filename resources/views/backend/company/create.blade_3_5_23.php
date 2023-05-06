@extends('backend.layouts.app')
@section('title', 'Create Company')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Create Company</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.company') }}" class="btn btn-secondary my-2" title="Back" data-bs-toggle="tooltip"><i
                    class="fa fa-arrow-left"></i></a>
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
                                {{-- <h4 class="card-title">Create Company</h4>
                            <div class="text-end" style="position: absolute;
                            right: 50px;">
    
                            <a href="{{ route('admin.company') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                            </div>
                            <p class="card-description">Create Company</p> --}}
                                @include('backend.includes.errors')
                                {{ Form::open(['url' => 'admin/company/store', 'enctype' => 'multipart/form-data']) }}
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('company_name', 'Comapny Name *') }}
                                                {{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'required' => true]) }}
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('company_address', 'Comapny Address*') }}
                                                {{ Form::text('company_address', null, ['class' => 'date form-control', 'placeholder' => 'Company Address', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_mobile', 'Comapny Mobile No*') }}
                                                {{ Form::text('cm_mobile', null, ['class' => 'date form-control', 'placeholder' => 'Company Mobile No', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                <label for="company_logo">Company Logo *</label>
                                                <input type="file" class="form-control" name="company_logo" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                <label for="company_seal">Company Seal *</label>
                                                <input type="file" class="form-control" name="company_seal" required>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 col-12">
                            <div class="checkbox checkbox-success">
                              {{ Form::label('bill_gst', 'Gst or Non Gst') }}
                                    {{ Form::checkbox('bill_gst','1',true,['id'=>'radioyes']) }}
                                </div>
                            </div> --}}
                                        <div class="col-md-6 col-12">
                                            <div class="checkbox checkbox-success">
                                                {{ Form::label('bill_gst', 'Gst or Non Gst *') }}
                                                {{ Form::select('bill_gst', ['1' => 'Gst Company', '0' => 'Non Gst Comapny'], null, ['id' => 'Bill_gst', 'class' => 'form-select']) }}
                                            </div>
                                        </div>


                                        {{-- <div class="col-md-6 col-12">
                            <div class="form-group mb-5">
                                {{ Form::label('gst_no', 'Gst Company*') }}
                            {{ Form::text('gst_no', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                        </div>
                    </div> --}}

                                        <div class="col-md-6 col-12 cm_gst_no">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_gst_no', 'Gst No') }}
                                                {{ Form::text('cm_gst_no', null, ['class' => 'form-control gst_no', 'placeholder' => 'Gst No']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_bank_name', 'Bank Name*') }}
                                                {{ Form::text('cm_bank_name', null, ['class' => 'form-control', 'placeholder' => 'Bank Name', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_branch_name', 'Branch Name*') }}
                                                {{ Form::text('cm_branch_name', null, ['class' => 'form-control', 'placeholder' => 'Branch Name', 'required' => true]) }}
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_bank_ifsc', 'Bank Ifsc*') }}
                                                {{ Form::text('cm_bank_ifsc', null, ['class' => 'form-control', 'placeholder' => 'Bank Ifsc', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_account_no', 'Account Number*') }}
                                                {{ Form::text('cm_account_no', null, ['class' => 'form-control', 'placeholder' => 'Account No', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_pan_no', 'Pan Number') }}
                                                {{ Form::text('cm_pan_no', null, ['class' => 'form-control', 'placeholder' => 'Pan No']) }}
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-start">
                                            {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-5']) }}
                                            <button type="reset" class="btn btn-primary mr-1 mb-1"
                                                id="reset">Reset</button>
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



    <script>
        // $(document).ready(function () {
        //     $('.cm_gst_no').hide();

        //    $('#Bill_gst').change(function (e) { 

        //        console.log($(this).val());
        //         if ($("#Bill_gst :selected").val() == "1") {
        //             $('.cm_gst_no').show();
        //         }else{
        //             $('.gst_no').val('');
        //             $('.cm_gst_no').hide();
        //         }
        //     });
        // });

        $(document).ready(function() {

            $('#reset').click(function(e) {
                location.reload();
            });
            $('#Bill_gst').click(function() {
                var gst_or_non_gst = $(this).val();
                if (gst_or_non_gst == '0') {
                    $('#cm_gst_no').attr('readonly', 'readonly');
                }
                if (gst_or_non_gst == '1') {

                    $('#cm_gst_no').val('');
                    $('#cm_gst_no').removeAttr('readonly');
                }
            });
        });
    </script>
@endsection
