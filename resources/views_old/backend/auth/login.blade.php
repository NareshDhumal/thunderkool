@extends('backend.layouts.empty')
@section('content')
{{-- <div class="container">
  <div class="row">
      <div class="col-md-4 offset-md-4">
          <div class="card-body">
             
              <form action="{{route('admin.login')}}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                  </div>
                <hr>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
          </div>
      </div>
  </div>
</div> --}}



              <div class="auth-form-light text-center p-5">
                <div class="brand-logo text-center">
                  <img src="{{ asset('public/assets/images/jmbaxi_logo.png')}}">
                 
                </div>
                <h3 class="mt-3">FEEDBACK PORTAL</h2>
                <form action="{{route('admin.login')}}" method="POST" class="pt-3">
                  @csrf

                  <div class="form-group">
                    <input type="email"  name="email" class="form-control form-control-lg" id="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn">Login</button>
                  </div>
                  {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>
                  </div>
                  <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="mdi mdi-facebook me-2"></i>Connect using facebook </button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.html" class="text-primary">Create</a>
                  </div> --}}
                </form>
              </div>
       
  




















  @endsection