@extends('backend.layouts.fullempty')
@section('title', 'Forgot Password')
@section('content')

    <style>
        input,
        input::placeholder {
            font: 13px sans-serif;
            padding-left: 6px !important;
            color: #ced4da;
        }

        .login-inner-head i {
            background: #046bcc5e;
            color: #0059aa;
            padding: 20px;
            border-radius: 50%;
            font-size: 25px;
            margin-bottom: 15px;
        }

        .form-control-h:focus {
            border: 1.5px solid rgb(9, 131, 231) !important;
            box-shadow: 0px 0px 0px 2px rgba(9, 131, 231, 0.459) !important;

        }

        .form-control-h {
            border-radius: 6px !important;
        }

        .submit-btn {
            background: #0059aa;
            border: 2px solid #0059aa;
            color: rgb(255, 255, 255);
            padding: 10px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.5s ease-in;
        }

        .back-login a {
            color: rgb(9, 131, 231);
            font-weight: 500;

        }

        .submit-btn:hover {
            background: transparent;
            border: 2px solid #0059aa;
            color: black;
        }
    </style>

    <!-- login -->
    <section class="container top-padding login-page common-space">
        <div class="login-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="container container-custom">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="border-login">
                                    <div class="login-inner-head text-center">
                                        <i class="fa-sharp fa-solid fa-key"></i>
                                        <h2 class="font-weight-bold text-dark">Forgot Password?</h2>
                                        <h6>Authentication is necessary in order to change password</h6>
                                    </div>
                                    <div class="using-box pt-2">

                                        <div class="row ">
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="login">
                                                    @include('frontend.includes.errors')
                                                    <form class="login-form form-field" action="{{ url('/sendotp') }}"
                                                        method="post">
                                                        {{ csrf_field() }}
                                                        <div class="form-group col-md-12">
                                                            {{-- <div class="form-group mb-2">
                                                                  <label for="exampleFormControlInput1">Email address</label>
                                                                  <input type="email" class="form-control"
                                                                   id="exampleFormControlInput1"
                                                                  placeholder="Enter Your Mail" value="{{ old('email') }}" required>
                                                                </div> --}}
                                                            {{-- <span
                                                                class="star">*</span> --}}
                                                            <div class="input-wrapper mb-2">
                                                                <label for="exampleFormControlInput1">Email address</label>
                                                                <input class="password form-control form-control-h"
                                                                    name="email" type="email"
                                                                    placeholder="Enter Your Mail"
                                                                    value="{{ old('email') }}" required>

                                                            </div>

                                                        </div>
                                                        <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                                                            <button type="submit"
                                                                class="submit-btn btn-block  text-center "
                                                                href="#">Submit</button>
                                                            <!-- <button type="submit" class="cancel-btn btn-block mt-4 text-center " href="#">Resend OTP</button> -->
                                                            <div class="back-login text-center mt-1">

                                                                <a href="#" class="back-login"><i
                                                                        class="fas fa-long-arrow-left mr-1"></i><span>Back
                                                                        to login page</span></a>
                                                            </div>

                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- login end-->






@endsection
