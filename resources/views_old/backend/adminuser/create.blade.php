@extends('backend.layouts.app')
@section('title', 'Create User')

@section('content')

      <div class="content">
       
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title page-title">Create Admin User</h4>
          <p class="card-description">Create User </p>
                   @include('backend.includes.errors') 
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
                            <div class="form-group">
                             {{ Form::label('role', 'Role *') }} 
                             {{ Form::select('role', $roles, 'S',['class'=>'select2 form-control']) }}
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




@endsection
