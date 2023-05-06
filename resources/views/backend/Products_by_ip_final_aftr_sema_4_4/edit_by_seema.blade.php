@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')

<!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
  <div class="col-lg-6 col-md-6 col-sm-12">
      <h4 class="text-white fw-bolder fs-2qx me-5">Edit Products</h4>
  </div>       
          {{-- @can('Create Admin Users') --}}
          <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
      <a href="{{ route('admin.products') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title="Back"><i class="fa fa-arrow-left"></i></a>
      </div>
</div>
<!--end::Toolbar-->

<section class="db-section admin-form">
  <div class="content">
    <div class="content-wrapper"> 
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        {{-- <h4 class="card-title">Edit Products</h4> --}}
        {{-- <div class="text-end" style="position: absolute;
            right: 50px;">
            <a href="{{ route('admin.products') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
            </div> --}}
        {{-- <p class="card-description">Edit Products</p> --}}
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
                          <div class="form-label-group mb-5">
                            {{ Form::hidden('product_id', $editdata->product_id) }}
                            {{ Form::label('product_name', 'product name *') }}
                            {{ Form::text('product_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Name', 'required' => true]) }}
                          </div>
                        </div>
  
  
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('company_name', 'company name *') }}
                            {{ Form::select('company_id',$company,$editdata->company_id,['class' => 'form-select', 'required' => true]) }}
                          </div>
                        </div>
  
                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('company_name', 'company name *') }}
                            {{ Form::select('company_name', ['0' => 'Thunder Kool', '1' => 'Infinity Solutions', '2' => 'Kool Air'], ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                          </div>
                        </div> --}}
  
                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_code', 'product code *') }}
                            {{ Form::text('product_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                          </div>
                        </div> --}}
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_rate', 'product rate *') }}
                            {{ Form::number('product_rate', null, ['class' => 'form-control', 'placeholder' => 'Enter Rate']) }}
                          </div>
                        </div>
            
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_stock', 'product stock *') }}
                            {{ Form::number('product_stock', null,  ['class' => 'form-control', 'placeholder' => 'Enter stock']) }}
                          </div>
                        </div>
                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_party', 'product party *') }}
                            {{ Form::text('product_party', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div> --}}
  
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('hsn_code', 'Hsn Code *') }}
                            {{ Form::number('hsn_code', null, ['class' => 'form-control', 'placeholder' => 'Enter hsn Code']) }}
                          </div>
                        </div>
  
                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('sac_code', 'sac_code *') }}
                            {{ Form::text('sac_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div> --}}
  
                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('tax_percent', 'tax percent *') }}
                            {{ Form::text('tax_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div> --}}
  
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_part_no', 'product part no *') }}
                            {{ Form::number('product_part_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Part No']) }}
                          </div>
                        </div>
  
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_part_no_custom', 'product part no custom *') }}
                            {{ Form::number('product_part_no_custom', null, ['class' => 'form-control', 'placeholder' => 'Enter Custom Part No']) }}
                          </div>
                        </div>
  
  
  
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_unit', 'product unit *') }}
                            {{ Form::select('product_unit', $unit, $editdata->product_unit, ['class' => 'form-select']) }}
                          </div>
                        </div>
  
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('gst_percent', 'gst percent *') }}
                            {{ Form::select('gst_percent', $gst_percent, $editdata->gst_percent,['class' => 'form-select']) }}
                          </div>
                        </div>
  
                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_unit', 'product unit *') }}
                            {{ Form::text('product_unit', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div>
  
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('gst_percent', 'gst percent *') }}
                            {{ Form::text('gst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div> --}}
                        <div class="col-12 d-flex justify-content-start">
                          {{ Form::submit('Save', array('class' => 'btn btn-primary mr-1 mb-1 me-5')) }}
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
    

@endsection
