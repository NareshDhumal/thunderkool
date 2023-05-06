@extends('backend.layouts.fullempty')
@section('content')


<section id="multiple-column-form">
    <div class="row match-height">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              @include('backend.includes.errors')
              <form class="form" method="POST" action="" autocomplete="off">
                {{ csrf_field() }}
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        <label>Current Password *</label>
                        <input type="password" class="form-control" name="current_password" placeholder="Enter Current Password" required>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        {{ Form::label('new_password', 'New Password *') }}
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password" required>
                      </div>
                    </div>
                    <div class="col-md-6 col-12">
                      <div class="form-group">
                        {{ Form::label('new_password_confirmation', 'Confirm New Password *') }}
                        <input type="password" class="form-control" name="new_password_confirmation" placeholder="Enter New Password again" required>
                      </div>
                    </div>
  
                    <div class="col-12 d-flex justify-content-start">
                      {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1')) }}
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
