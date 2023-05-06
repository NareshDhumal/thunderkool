@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')
<div class="content">
  <div class="content-wrapper">
   
<div class="row">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Products</h4>
      <p class="card-description">Edit Products </p>
               @include('backend.includes.errors') 
               {!! Form::model($editdata, [
                'method' => 'POST',
                'url' => ['admin/products/update'],
                'class' => 'form'
            ]) !!}
                {{-- {{ Form::open(array('url' => 'admin/products/update/'.$editdata->product_id)) }} --}}
                @csrf
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::hidden('product_id', $editdata->product_id) }}
                          {{ Form::label('product_name', 'product name *') }}
                          {{ Form::text('product_name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('company_name', 'company name *') }}
                          {{ Form::select('company_name', ['0' => 'Thunder Kool', '1' => 'Infinity Solutions', '2' => 'Kool Air'], ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_code', 'product code *') }}
                          {{ Form::text('product_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_rate', 'product rate *') }}
                          {{ Form::text('product_rate', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) }}
                        </div>
                      </div>
          
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_stock', 'product stock *') }}
                          {{ Form::text('product_stock', null,  ['class' => 'form-control', 'placeholder' => 'Enter Password']) }}
                        </div>
                      </div>
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_party', 'product party *') }}
                          {{ Form::text('product_party', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('hsn_code', 'Hsn Code *') }}
                          {{ Form::text('hsn_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('sac_code', 'sac_code *') }}
                          {{ Form::text('sac_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('tax_percent', 'tax percent *') }}
                          {{ Form::text('tax_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_part_no', 'product part no *') }}
                          {{ Form::text('product_part_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_part_no_custom', 'product part no custom *') }}
                          {{ Form::text('product_part_no_custom', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('product_unit', 'product unit *') }}
                          {{ Form::text('product_unit', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('gst_percent', 'gst percent *') }}
                          {{ Form::text('gst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
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
    

@endsection
