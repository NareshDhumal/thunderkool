@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')

<div class="main-panel">
  <div class="content-wrapper">
 
<div class="row">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Create Company</h4>
      <p class="card-description">Create Company</p>
               @include('backend.includes.errors') 
                {{ Form::open(array('url' => 'admin/company/store', 'enctype' => 'multipart/form-data')) }}
                @csrf
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('company_name', 'Comapny Name *') }}
                          {{ Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                        </div>
                      </div>


                      <div class="col-md-6 col-12">
                        <div class="form-group">
                            {{ Form::label('company_address', 'Comapny Address*') }}
                            {{ Form::text('company_address', null, ['class' => 'date form-control', 'placeholder' => 'Please Select Start Date',  'required' => true]) }}
                        </div>
                      </div>
                      
                      <div class="col-md-4 col-12">
                        <div class="form-group">
                            {{ Form::label('cm_mobile', 'Comapny Mobile No*') }}
                            {{ Form::text('cm_mobile', null, ['class' => 'date form-control', 'placeholder' => 'Please Select Start Date',  'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-4 col-12">
                        <div class="form-group">
                            {{ Form::label('company_logo', 'Comapny Logo*') }}
                            {{ Form::file('company_logo', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                            {{-- {!! Form::file('stock_image') !!} --}}
                          </div>
                      </div>

                      <div class="col-md-4 col-12">
                        <div class="form-group">
                            {{ Form::label('company_seal', 'Comapny Seal*') }}
                            {{ Form::file('company_seal', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                        </div>
                      </div>

                      {{-- <div class="col-md-4 col-12">
                        <div class="checkbox checkbox-success">
                          {{ Form::label('bill_gst', 'Gst or Non Gst') }}
                          {{ Form::checkbox('bill_gst','1',true,['id'=>'radioyes']) }}
                        </div>
                      </div>  --}}
                      <div class="col-md-4 col-12">
                        <div class="checkbox checkbox-success">
                          {{ Form::label('bill_gst', 'Gst or Non Gst *') }}
                          {{ Form::select('bill_gst',['1' => 'Gst Company', '0' => 'Non Gst Comapny'],['id'=>'radioyes']) }}
                        </div>
                      </div> 

                      {{-- <div class="col-md-4 col-12">
                        <div class="form-group">
                            {{ Form::label('gst_no', 'Gst Company*') }}
                            {{ Form::text('gst_no', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                        </div>
                      </div> --}}

                      <div class="col-md-4 col-12">
                        <div class="form-group">
                            {{ Form::label('cm_gst_no', 'Gst No*') }}
                            {{ Form::text('cm_gst_no', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-4 col-12">
                        <div class="form-group">
                            {{ Form::label('cm_bank_name', 'Bank Name*') }}
                            {{ Form::text('cm_bank_name', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                        </div>
                      </div>

                        <div class="col-md-4 col-12">
                          <div class="form-group">
                              {{ Form::label('cm_branch_name', 'Branch Name*') }}
                              {{ Form::text('cm_branch_name', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                          </div>
                        </div>


                        <div class="col-md-4 col-12">
                          <div class="form-group">
                              {{ Form::label('cm_bank_ifsc', 'Bank Ifsc*') }}
                              {{ Form::text('cm_bank_ifsc', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                          </div>
                        </div>

                        <div class="col-md-4 col-12">
                          <div class="form-group">
                              {{ Form::label('cm_account_no', 'Account Number*') }}
                              {{ Form::text('cm_account_no', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                          </div>
                        </div>
                         
                        <div class="col-md-4 col-12">
                          <div class="form-group">
                              {{ Form::label('cm_pan_no', 'Pan Number*') }}
                              {{ Form::text('cm_pan_no', null, ['class' => 'form-control', 'placeholder' => 'Please Select Start Date', 'required' => true]) }}
                          </div>
                        </div>
                      <div class="col-12 d-flex justify-content-start">
                        {{ Form::submit('Save', array('class' => 'btn btn-primary mr-1 mb-1')) }}
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



<script>

</script>
@endsection
