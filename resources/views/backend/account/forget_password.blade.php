@extends('backend.layouts.fullempty')
@section('title', 'Forgot Password')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        .error{
            color: red;

        }
        .email{
            color: black;

        }
    </style>

    <!-- login -->
    <section class="container top-padding login-page common-space">
        <div class="login-box">
            <div class="row gx-5">
                <div class="col-md-12">
                    <div class="border-login">

                        <div class="login my-auto">
                            <div class="col-md-4 g-5">
                                <div class="login-inner-head text-center">
                                    <h3><i class="fa fa-key fa-4x"></i></h3>
                                    <h2 class="font-weight-bold text-dark">Forgot Password?</h2>
                                    <h6>Authentication is necessary in order to change password</h6>
                                </div>
                                @include('backend.includes.alerts')
                                <form class="login-form form-field mt-5" action="{{ url('/sendotp') }}" method="post"
                                    autocomplete="off" id="myform">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-12">

                                        <div class="input-wrapper mb-2">
                                            <label for="exampleFormControlInput1">Email address</label>
                                               <input class="email form-control form-control-h" name="email"
                                                   autocomplete="false" type="email" placeholder="Enter Your Mail"
                                                   value="{{ old('email') }}" required>

                                        </div>
                                   

                                    </div>
                                    <div class="form-group col-md-12 mb-0 mt-3 terms-conditions-size1">
                                        <button type="submit" id="submit_btn" onchange="email();"
                                            class="submit-btn btn-block text-center mb-3 me-5 "
                                            href="#">Submit</button>
                                        <!-- <button type="submit" class="cancel-btn btn-block mt-4 text-center " href="#">Resend OTP</button> -->
                                        {{-- <div class="back-login text-center "> --}}

                                        <a href="{{ route('admin.login') }}" class="back-login text-center"><i
                                                class="fa fa-arrow-left me-2"></i><span>Back
                                                to login page</span></a>
                                        {{-- </div> --}}

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- login end-->




    <script>
        $(document).ready(function () {
            $("#myform").validate({
            rules: {
                email: "required",
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: "Please specify your email",
                email: {
                    email: "Your email address must be in the format of name@domain.com"
                }

            }
        });
        });

    </script>

@endsection
