@extends('backend.layouts.app')
@section('title', 'Update Company')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Edit Company</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.company') }}" class="btn btn-secondary my-2" title="Back" data-bs-toggle="tooltip"><i class="fa fa-arrow-left"></i></a>
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
                                {{-- <h4 class="card-title">Edit Company</h4> --}}
                                {{-- <div class="text-end" style="position: absolute;
                              right: 50px;">
      
                              <a href="{{ route('admin.company') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                              </div --}}
                                {{-- <p class="card-description">Edit Company</p> --}}
                                @include('backend.includes.errors')
                                {!! Form::model($editdata, [
                                    'method' => 'POST',
                                    'url' => ['admin/company/update'],
                                    'class' => 'form',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                {{ Form::hidden('company_id', $editdata->company_id) }}
                                                {{ Form::label('company_name', 'Company Name *') }}
                                                {{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Name', 'required' => true]) }}
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('company_address', 'Company Address*') }}
                                                {{ Form::text('company_address', null, ['class' => 'date form-control', 'placeholder' => 'Please Company Address', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_mobile', 'Company Mobile No*') }}
                                                {{ Form::text('cm_mobile', null, ['class' => 'date form-control', 'placeholder' => '', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('company_logo', 'Company Logo*') }}
                                                {{ Form::file('company_logo', ['class' => 'form-control', 'placeholder' => 'Company Logo']) }}
                                                {{-- {!! Form::file('stock_image') !!} --}}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('company_seal', 'Company Seal*') }}
                                                {{ Form::file('company_seal', ['class' => 'form-control', 'placeholder' => 'Company Seal']) }}
                                            </div>
                                        </div>



                                        <div class="col-md-6 col-12">
                                            <div class="checkbox checkbox-success">
                                                {{ Form::label('bill_gst', 'Gst or Non Gst *') }}
                                                {{ Form::select('bill_gst', ['1' => 'Gst Company', '0' => 'Non Gst Company'], $editdata->bill_gst, ['class' => 'form-select', 'id' => 'radioyes', 'placeholder' => 'Gst or Not']) }}
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 col-12">
                          <div class="form-group mb-5">
                              {{ Form::label('gst_no', 'Gst Company*') }}
                              {{ Form::text('gst_no', null, ['class' => 'form-control', 'placeholder' => '', 'required' => true]) }}
                          </div>
                        </div> --}}

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_gst_no', 'Gst No') }}
                                                {{ Form::text('cm_gst_no', null, ['class' => 'form-control', 'placeholder' => 'Gst No']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_bank_name', 'Bank Name') }}
                                                {{ Form::text('cm_bank_name', null, ['class' => 'form-control', 'placeholder' => 'Bank Name']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_branch_name', 'Branch Name') }}
                                                {{ Form::text('cm_branch_name', null, ['class' => 'form-control', 'placeholder' => 'Branch Name']) }}
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_bank_ifsc', 'Bank Ifsc') }}
                                                {{ Form::text('cm_bank_ifsc', null, ['class' => 'form-control', 'placeholder' => 'Bank Ifsc']) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('cm_account_no', 'Account Number') }}
                                                {{ Form::text('cm_account_no', null, ['class' => 'form-control', 'placeholder' => 'Account No']) }}
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
