@extends('backend.layouts.app')
@section('title', ' Update Tax')


@section('content')

<!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
  <div class="col-lg-6 col-md-6 col-sm-12">
      <h4 class="text-white fw-bolder fs-2qx me-5">Edit Tax</h4>
  </div>       
          {{-- @can('Create Admin Users') --}}
          <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
      <a href="{{ route('admin.tax') }}" class="btn btn-secondary my-2" title="Back" data-bs-toggle="tooltip"><i class="fa fa-arrow-left"></i></a>
      </div>
</div>
<!--end::Toolbar-->

<section class="db-section admin-form">
  <div class="content">
    
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        {{-- <h4 class="card-title">Edit Tax</h4> --}}
        {{-- <div class="text-end" style="position: absolute;
        right: 50px;">
          <a href="{{ route('admin.tax') }}" class="btn btn-inverse-danger btn-fw"><i
                  class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
  
      </div> --}}
        {{-- <p class="card-description">Edit Tax </p> --}}
                 @include('backend.includes.errors') 
                 {!! Form::model($editdata, [
                  'method' => 'POST',
                  'url' => ['admin/tax/update'],
                  'class' => 'form'
              ]) !!}
                  {{-- {{ Form::open(array('url' => 'admin/products/update/'.$editdata->product_id)) }} --}}
                  @csrf
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-label-group mb-5">
                          {{ Form::hidden('gst_id', $editdata->gst_id) }}
                          {{ Form::label('gst_name', 'Gst Name *') }}
                          {{ Form::text('gst_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Gst Name', 'required' => true]) }}
                        </div>
                      </div>
  
  
                      <div class="col-md-6 col-12">
                        <div class="form-label-group mb-5">
                          {{ Form::label('gst_value', 'Gst Value *') }}
                          {{ Form::number('gst_value', null, ['class' => 'form-control', 'placeholder' => 'Enter Gst Value', 'required' => true,'min' => 0]) }}
                        </div>
                      </div>
               
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
