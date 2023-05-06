@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')

    <div class="content">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Vehicle Make</h4>
                        <div class="text-end" style="position: absolute;
      right: 50px;">
                            <a href="{{ route('admin.vehiclemake') }}" class="btn btn-inverse-danger btn-fw"><i
                                    class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>

                        </div>
                        <p class="card-description">Vehicle Make </p>
                        @include('backend.includes.errors')
                        {{ Form::open(['url' => 'admin/vehiclemake/store']) }}
                        @csrf
                        <div class="form-body">
                            <div class="row">

                                <div class="col-md-6 col-12">
                                    <div class="form-label-group">
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
                                    {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1']) }}
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
