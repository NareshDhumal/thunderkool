@extends('backend.layouts.app')
@section('title', 'Create Vehicle Model')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <!--begin::Container-->
        {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
        {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Create Vehicle Model</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.vehiclemodel', $make_id) }}" class="btn  btn-secondary my-2" data-bs-toggle="tooltip"
                title="Back"><i class="fa fa-arrow-left"></i></a>
        </div>
        >
        {{-- </div> --}}
        {{-- </div> --}}
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <div class="content">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        {{-- <h4 class="card-title">Vehicle Model</h4> --}}
                        {{-- <div class="text-end" style="position: absolute;
      right: 50px;">
                            <a href="{{ route('admin.vehiclemodel', $make_id) }}" class="btn btn-inverse-danger btn-fw"><i class="fa fa-arrow-left"></i></a>

                        </div> --}}
                        {{-- <p class="card-description">Vehicle Model</p> --}}
                        @include('backend.includes.errors')
                        {{ Form::open(['url' => 'admin/vehiclemodel/store']) }}
                        @csrf
                        <div class="form-body">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-label-group mb-5">
                                        {{ Form::label('vehicle_model_name', 'Vehicle Model *') }}
                                        {{ Form::hidden('vehicle_make_id', $make_id, null, ['class' => 'form-control', 'required' => true]) }}

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
                                    {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-5']) }}
                                    <button type="reset" class="btn btn-primary mr-1 mb-1" id="reset">Reset</button>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('#reset').click(function(e) {
                location.reload();
            });
        });
    </script>
@endsection
