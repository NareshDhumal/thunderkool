@extends('backend.layouts.app')
@section('title', 'Update State')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Edit State</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.state') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title="Back"><i
                    class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->

    <section class="db-section admin-form">

        <div class="content">

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title">Edit State</h4>
      <div class="text-end" style="position: absolute;
      right: 50px;">
      <a href="{{ route('admin.state') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
      </div> --}}
                            {{-- <p class="card-description">Edit State</p> --}}
                            @include('backend.includes.errors')
                            {!! Form::model($editdata, [
                                'method' => 'POST',
                                'url' => ['admin/state/update'],
                                'class' => 'form',
                            ]) !!}
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::hidden('state_id', $editdata->state_id) }}
                                            {{ Form::label('state_name', 'State Name *') }}
                                            {{ Form::text('state_name', null, ['class' => 'form-control', 'placeholder' => 'Enter State', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('pincode', 'Pin code *') }}
                                            {{ Form::text('pincode', null, ['class' => 'form-control', 'placeholder' => 'Enter Pincode', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-start">
                                        {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-5']) }}
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
