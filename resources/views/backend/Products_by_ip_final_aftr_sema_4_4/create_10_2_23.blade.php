@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Products</h4>
          <div class="text-end" style="position: absolute;
          right: 50px;">
          <a href="{{ route('admin.products') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
          </div>
          <p class="card-description">Create Products </p>
                   @include('backend.includes.errors') 
                    {{ Form::open(array('url' => 'admin/products/store')) }}
                    @csrf
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('product_name', 'product name *') }}
                              {{ Form::text('product_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Name', 'required' => true]) }}
                            </div>
                          </div>
    
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('company_name', 'company name *') }}
                              {{ Form::select('company_id',$company,null,['class' => 'form-control', 'required' => true]) }}
                            </div>
                          </div>
    
                          {{-- <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('product_code', 'product code *') }}
                              {{ Form::text('product_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                            </div>
                          </div> --}}

                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('product_rate', 'product rate *') }}
                              {{ Form::text('product_rate', null, ['class' => 'form-control', 'placeholder' => 'Enter Rate']) }}
                            </div>
                          </div>
              
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('product_stock', 'product stock') }}
                              {{ Form::text('product_stock', null,  ['class' => 'form-control', 'placeholder' => 'Enter Stock']) }}
                            </div>
                          </div>

                          {{-- <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('product_party', 'product party *') }}
                              {{ Form::text('product_party', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                            </div>
                          </div> --}}
    
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('hsn_code', 'Hsn Code *') }}
                              {{ Form::text('hsn_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Hsn']) }}
                            </div>
                          </div>
    
                          {{-- <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('sac_code', 'sac_code *') }}
                              {{ Form::text('sac_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                            </div>
                          </div> --}}
    
                          {{-- <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('tax_percent', 'tax percent *') }}
                              {{ Form::text('tax_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                            </div>
                          </div> --}}
    
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('product_part_no', 'product part no') }}
                              {{ Form::text('product_part_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Part no']) }}
                            </div>
                          </div>
    
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('product_part_no_custom', 'product part no custom') }}
                              {{ Form::text('product_part_no_custom', null, ['class' => 'form-control', 'placeholder' => 'Enter Custom Part No']) }}
                            </div>
                          </div>
    
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('product_unit', 'product unit *') }}
                              {{ Form::select('product_unit', $unit, null, ['class' => 'form-control']) }}
                            </div>
                          </div>
    
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::label('gst_percent', 'gst percent *') }}
                              {{ Form::select('gst_percent', $gst_percent, null,['class' => 'form-control']) }}
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
