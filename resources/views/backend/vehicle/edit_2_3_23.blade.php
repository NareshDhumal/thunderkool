@extends('backend.layouts.app')
@section('title', 'Create Vehicle')

@section('content')

  <div class="content">
    
<div class="row">
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Vehicle</h4>
      <div class="text-end" style="position: absolute;
      right: 50px;">
      <a href="{{ route('admin.vehicle') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
      </div>
      <p class="card-description">Edit Vehicle </p>
               @include('backend.includes.errors') 
               {!! Form::model($editdata, [
                'method' => 'POST',
                'url' => ['admin/vehicle/update/'],
                'class' => 'form'
            ]) !!}
                @csrf
                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::hidden('vehicle_id', $editdata->vehicle_id) }}
                          {{ Form::label('vehicle_make_id', 'Vehicle Make *') }}
                          {{ Form::select('vehicle_make_id', $make ,$editdata->vehicle_make_name,['class' => 'form-control', 'placeholder' => 'Enter Vehicle Name', 'required' => true]) }}
                        </div>
                      </div>
                    

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('vehicle_make_id', 'Vehicle Model *') }}
                          {{ Form::select('vehicle_model_id', $model ,$editdata->vehicle_model_name,['class' => 'form-control', 'placeholder' => 'Enter Model', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('vehicle_no', 'Vehicle No *') }}
                          {{ Form::text('vehicle_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Vehicle No', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('chassis_no', 'Chassis No *') }}
                          {{ Form::text('chassis_no', null, ['class' => 'form-control', 'placeholder' => 'Chassis No', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('serial_no', 'Serial No *') }}
                          {{ Form::text('serial_no', null, ['class' => 'form-control', 'placeholder' => 'Serial No', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('cab_no', 'Cab No *') }}
                          {{ Form::text('cab_no', null, ['class' => 'form-control', 'placeholder' => 'Cab No', 'required' => true]) }}
                        </div>
                      </div>

                      <div class="col-md-6 col-12">
                        <div class="form-label-group">
                          {{ Form::label('loco_no', 'Loco No *') }}
                          {{ Form::text('loco_no', null, ['class' => 'form-control', 'placeholder' => 'Loco No', 'required' => true]) }}
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
