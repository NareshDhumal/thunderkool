@extends('backend.layouts.app')
@section('title', 'Update Admin Users')

@section('content')
{{-- {{dd($adminuser->account_status)}} --}}

<div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title"> Form elements </h3>
          <nav aria-label="breadcrumb">
            <div class="card-header">
              <a href="{{ route('admin.adminusers') }}" class="btn btn-btn-primary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
            </div>
            {{-- <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashbord</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashbord</li>
            </ol> --}}
          </nav>
        </div>
    <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Create Admin User</h4>
          <p class="card-description">Create User </p>
                    @include('backend.includes.errors')
                    {!! Form::model($adminuser, [
                        'method' => 'POST',
                        'url' => ['admin/adminusers/update'],
                        'class' => 'form'
                    ]) !!}
                     @csrf
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('id', $adminuser->id) }}
                              {{ Form::label('first_name', 'First Name *') }}
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
                              {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Enter Email']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('role', 'Role *') }} 
                              {{ Form::select('role', $roles, null,['class'=>'select2 form-control']) }}
                            </div>
                          </div>

                          <div class="col-12 d-flex justify-content-start">
                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
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
          @if(isset($adminuser))
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Update User Status</h4>
              </div>
              <div class="card-content">
                <div class="card-body">
                  @include('backend.includes.errors')
                  {!! Form::model($adminuser, [
                      'method' => 'POST',
                      'url' => ['admin/adminusers/updatestatus'],
                      'class' => 'form'
                  ]) !!}
                    <div class="form-body">
                      <div class="row">

                        <div class="col-md-4 col-12">
                          <fieldset class="form-group">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                {{ Form::label('account_status', 'User Status ',['class'=>'']) }}
                                {{ Form::text('id',$adminuser->id ) }}
                              </div>
                              {{-- {{dd($adminuser->account_status)}} --}}
                              {{ Form::select('account_status', ['1'=>'Activate','0'=>'Deactivate'], $adminuser->account_status,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Status',]) }}
                            </div>
                          </fieldset>
                        </div>

                        <div class="col-12 d-flex justify-content-start">
                          {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                        </div>
                      </div>
                    </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
          @endif
        </section>
      </div>
    </div>



    @endsection

