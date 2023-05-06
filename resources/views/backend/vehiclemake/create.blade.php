@extends('backend.layouts.app')
@section('title', 'Create Vehicle Make')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Create Vehicle Make</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.vehiclemake') }}" class="btn btn-secondary my-2" title="Back" data-bs-toggle="tooltip"><i
                    class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->

    <section class="section db-section admin-form">
        <div class="content">

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title">Vehicle Make</h4>
        <div class="text-end" style="position: absolute;
        right: 50px;">
                          <a href="{{ route('admin.vehiclemake') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
  
        </div> --}}
                            {{-- <p class="card-description">Vehicle Make </p> --}}
                            @include('backend.includes.errors')
                            {{ Form::open(['url' => 'admin/vehiclemake/store']) }}
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('vehicle_make_name', 'Vehicle Make  *') }}
                                            {{ Form::text('vehicle_make_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Vehicle Make Name', 'required' => true]) }}
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
    </section>

    <script>
        $(document).ready(function() {

            $('#reset').click(function(e) {
                location.reload();
            });
        });
    </script>
@endsection
