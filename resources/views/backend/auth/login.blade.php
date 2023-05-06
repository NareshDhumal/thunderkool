@extends('backend.layouts.empty')
@section('content')
    {{-- 
              <div class="auth-form-light text-center p-5">
                <div class="brand-logo text-center">
            
                </div>
                <h3 class="mt-3">BILLING SOFTWARE</h3>
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
                 
                </form>
              </div> --}}

    {{-- <div class="container text-center">
                <div class="row justify-align-center align-items-center">
                  <div class="col-lg-6" style="position: relative">
                    <div class="img-div">
                    <img src="{{ asset('public/assets/images/billing-bg.png')}}" class="img-fluid" style="position: absolute;left:0;top:-160px"></div>
                  </div>
                  <div class="col-lg-6 ">
                    <div class="" style="width:80%">
                    <div class="card-group d-block d-md-flex row">
                      <div class="card col-md-4 p-4 mb-0">
                        <div class="card-body">
                          @if (Session::get('success'))
                          <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                          </div>
                        @endif
                        @if (Session::get('error'))
                          <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                          </div>
                        @endif

                          <h3 class="mt-3" style="font-weight:600">BILLING SOFTWARE</h3>
                          <form action="{{route('admin.login')}}" method="POST" class="mt-5">
                            @csrf
                            
                            <div class="form-group">
                              <input type="email"  name="email" class="form-control form-control-lg" id="email" placeholder="Email">
                            </div>
                            <div class="form-group mt-4">
                              <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                            </div>
                            <div class="mt-5">
                              <button type="submit" class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn" style="padding: 10px 50px">Login</button>
                            </div>
                           
                          </form>
                        </div>
                      </div>
                     
                    </div>
                    </div>
                  </div>
                 
                </div>
              </div> --}}

    <section class="login w-100 ">
        <div class="container login-form text-center d-flex justify-content-center align-items-center">
            <div class="row justify-align-center align-items-center">
                {{-- <div class="col-lg-6" style="position: relative"> --}}
                {{-- <div class="img-div"> --}}
                {{-- <img src="{{ asset('public/assets/images/billing-bg.png')}}" class="img-fluid" style="position: absolute;left:0;top:-160px"></div> --}}
                {{-- </div> --}}
                {{-- <div class="col-lg-6 "> --}}
                <div class="card shadow ">
                    <div class="card-body">

                        {{-- @if (count($errors) > 0)
                            <div class="text-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        @if (Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <h3 class="mt-3 login-head mb-2">BILLING SOFTWARE</h3>
                        <div class="line mb-5"></div>
                        <form action="{{ route('admin.login') }}" method="POST" class="mt-5">
                            @csrf

                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            </div>
                            @error('email')
                                <span
                                    style="color:red; text-align:left; font-size:14px; display:block; width:100%; margin-top:10px;">{{ $message }}</span>
                            @enderror

                            {{-- <div class="form-group"> --}}
                            {{-- <input type="email"  name="email" class="form-control form-control-lg" id="email" placeholder="Email"> --}}
                            {{-- </div> --}}
                            <div class="input-group mt-3">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-key"></i></span>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
                            </div>
                            @error('password')
                                <span
                                    style="color:red; text-align:left; font-size:14px; display:block; width:100%; margin-top:10px;">{{ $message }}</span>
                            @enderror

                            {{-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                  Remember Me
                                </label>
                              </div> --}}
                            <a class="for mb-4" href="{{ url('/frgtpassword') }}">Forgot Password ?</a>

                            {{-- <div class="form-group mt-4">
                                <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                              </div> --}}
                            <div class="mt-5">
                                <button type="submit"
                                    class="btn btn-block btn-dark btn-lg font-weight-medium auth-form-btn">Login</button>
                            </div>

                        </form>
                    </div>
                </div>
                {{-- </div> --}}

            </div>
        </div>
    </section>
@endsection
