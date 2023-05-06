@extends('backend.layouts.app')
@section('title', 'Create User')
@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <!--begin::Container-->
        {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
        {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Create Admin User</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.adminusers') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title="Back"><i
                    class="fa fa-arrow-left"></i></a>
        </div>
        {{-- </div> --}}
        {{-- </div> --}}
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->

    <section class="db-section admin-form">
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h4 class="card-title">Create Admin User</h4>
                          <div class="text-end" style="position: absolute;
        right: 50px;">
                              <a href="{{ route('admin.adminusers') }}" class="btn btn-inverse-danger btn-fw"><i
                                      class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                          </div> --}}
                                {{-- <p class="card-description mb-4">Create User </p> --}}
                                @include('backend.includes.errors')
                                {{ Form::open(['url' => 'admin/adminusers/store']) }}
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('name', 'First Name *') }}
                                                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('lastname', 'Last Name *') }}
                                                {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('email', 'Email *') }}
                                                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required' => true]) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('role', 'Role *') }}
                                                {{ Form::select('role', $roles, 'S', ['class' => 'select2 form-select']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('password', 'Password *') }}
                                                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'required' => true]) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('password_confirmation', 'Confirm Password *') }}
                                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-start">
                                            {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-4']) }}
                                            <button id="reset" type="reset" class="btn btn-primary mr-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    {{-- <div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title"> Form elements </h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashbord</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashbord</li>
            </ol>
          </nav>
        </div>
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Admin User</h4>
          <p class="card-description">Create User </p>
          {{ Form::open(array('url' => 'admin/adminusers/store')) }}
          @csrf
            <div class="form-body">
              <div class="row">
                <div class="col-md-6 col-12">
                  <div class="form-label-group">
                    {{ Form::label('name', 'First Name *') }}
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="form-label-group">
                    {{ Form::label('lastname', 'Last Name *') }}
                    {{ Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="form-label-group">
                    {{ Form::label('email', 'Email *') }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) }}
                  </div>
                </div>
            
                <div class="col-md-6 col-12">
                  <div class="form-label-group">
                    {{ Form::label('password', 'Password *') }}
                    {{ Form::password('password',  ['class' => 'form-control', 'placeholder' => 'Enter Password']) }}
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="form-label-group">
                    {{ Form::label('password_confirmation', 'Confirm Password *') }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
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
    </div> --}}


    <script>
        $(document).ready(function() {

            $('#reset').click(function(e) {
                location.reload();
            });
        });
    </script>
@endsection
