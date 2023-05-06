@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')

<!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
  <div class="col-lg-6 col-md-6 col-sm-12">
      <h4 class="text-white fw-bolder fs-2qx me-5">Create Vehicle Model</h4>
  </div>       
          {{-- @can('Create Admin Users') --}}
      <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
      <a href="{{ route('admin.vehiclemodel') }}" class="btn btn-secondary my-2"><i class="bx bx-plus"></i>Back</a>
      </div>
</div>
<!--end::Toolbar-->

<section class="db-section admin-form">
  <div class="content">
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        {{-- <h4 class="card-title">Vehicle Model</h4>
        <div class="text-end" style="position: absolute;
        right: 50px;">
                          <a href="{{ route('admin.vehiclemodel') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
  
        </div>
        <p class="card-description">Vehicle Model</p> --}}
                 @include('backend.includes.errors') 
                  {{ Form::open(array('url' => 'admin/vehiclemodel/store')) }}
                  @csrf
                    <div class="form-body">
                      <div class="row">
                       
                        <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('vehicle_model_name', 'Vehicle Model *') }}
                            {{ Form::text('vehicle_model_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Vehicle Model Name', 'required' => true]) }}
                          </div>
                        </div>
  
                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group">
                            {{ Form::label('vehicle_modal', 'Vehicle Modal  *') }}
                            {{ Form::text('vehicle_modal', null, ['class' => 'form-control', 'placeholder' => 'Enter Vehicle Modal Name', 'required' => true]) }}
                          </div>
                        </div> --}}
  
                        <div class="col-12 d-flex justify-content-start">
                          {{ Form::submit('Save', array('class' => 'btn btn-primary mr-1 mb-1 me-5')) }}
                          <button type="reset" class="btn btn-secondary mr-1 mb-1">Reset</button>
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
