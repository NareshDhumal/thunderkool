@extends('backend.layouts.app')
@section('title', 'Update Admin Users')

@section('content')
    {{-- {{dd($adminuser->account_status)}} --}}

  <!--begin::Toolbar-->
<div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
    <!--begin::Container-->
    {{-- <div id="kt_toolbar_container" class="d-flex flex-stack flex-wrap"> --}}
      {{-- <div class=""> --}}
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Edit Admin User</h4>
        </div>       
                {{-- @can('Create Admin Users') --}}
            <div class="col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.adminusers') }}" class="btn btn-secondary my-2" data-bs-toggle="tooltip" title="Back"><i class="fa fa-arrow-left"></i></a>
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
                      <div class="card mb-5">
                          <div class="card-body">
                              {{-- <h4 class="card-title">Create Admin User</h4>
                              <div class="text-end" style="position: absolute; right: 50px;">
                                  <a href="{{ route('admin.adminusers') }}" class="btn btn-inverse-danger btn-fw"><i
                                          class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                              </div> --}}
                              {{-- <p class="card-description">Create User </p> --}}
                              @include('backend.includes.errors')
                              {!! Form::model($adminuser, [
                                  'method' => 'POST',
                                  'url' => ['admin/adminusers/update'],
                                  'class' => 'form',
                              ]) !!}
                              @csrf
                              <div class="form-body">
                                  <div class="row">
                                      <div class="col-md-6 col-12">
                                          <div class="form-label-group mb-5">
                                              {{ Form::hidden('id', $adminuser->id) }}
                                              {{ Form::label('first_name', 'First Name *') }}
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
                                              {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required' => true]) }}
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-12">
                                          <div class="form-group mb-5">
                                              {{ Form::label('role', 'Role *') }}
                                              {{ Form::select('role', $roles, null, ['class' => 'select2 form-select']) }}
                                          </div>
                                      </div>
  
                                      <div class="col-12 d-flex justify-content-start">
                                          {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
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
      @if (isset($adminuser))
          <div class="col-12">
              <div class="card">
                  {{-- <div class="card-header"> --}}
                      {{-- </div> --}}
                      {{-- <div class="card-content"> --}}
                          <div class="card-body">
                          <h3 class="card-title mb-5">Update User Status</h3>
                          {{-- @include('backend.includes.errors') --}}
                          {!! Form::model($adminuser, [
                              'method' => 'POST',
                              'url' => ['admin/adminusers/updatestatus'],
                              'class' => 'form',
                          ]) !!}
                          <div class="form-body">
                              <div class="row">
  
                                  <div class="col-md-6 col-12">
                                      <fieldset class="form-group mb-5">
                                          {{-- <div class="input-group"> --}}
                                              <div class="input-group-prepend">
                                                  {{ Form::label('account_status', 'User Status ', ['class' => '']) }}
                                                  {{ Form::hidden('id', $adminuser->id) }}
                                              </div>
                                              {{-- {{dd($adminuser->account_status)}} --}}
                                              {{ Form::select('account_status', ['1' => 'Activate', '0' => 'Deactivate'], $adminuser->account_status, ['class' => 'select2 form-select ', 'placeholder' => 'Please Select Status']) }}
                                          {{-- </div> --}}
                                      </fieldset>
                                  </div>
  
                                  <div class="col-12 d-flex justify-content-start">
                                      {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                  </div>
                              </div>
                          </div>
                          {{ Form::close() }}
                      </div>
                  {{-- </div> --}}
              </div>
          </div>
      @endif
      </section>
      </div>
      </div>
  </section>



@endsection
