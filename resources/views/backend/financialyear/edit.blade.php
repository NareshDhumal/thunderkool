@extends('backend.layouts.app')
@section('title', 'Update Financial Year')


@section('content')

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/> --}}

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Edit Financial Year</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.financial.year') }}" class="btn btn-secondary my-2" title="Back"
                data-bs-toggle="tooltip"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->

    <section class="db-section admin-form">
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h4 class="card-title">Financial Year</h4>
        <div class="text-end" style="position: absolute;
        right: 50px;">
                          <a href="{{ route('admin.financial.year') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
  
        </div> --}}
                                {{-- <p class="card-description">Financial Year</p> --}}
                                @include('backend.includes.errors')
                                {!! Form::model($editdata, [
                                    'method' => 'POST',
                                    'url' => ['admin/financial/year/update'],
                                    'class' => 'form',
                                ]) !!}
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::hidden('financial_year_id', $editdata->financial_year_id) }}
                                                {{ Form::label('financial_year', 'Financial Year *') }}
                                                {{ Form::text('financial_year', null, ['class' => 'form-control', 'placeholder' => 'Enter Financial Year', 'required' => true]) }}
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('financial_start_year', 'Start Date*') }}
                                                {{ Form::text('financial_start_year', null, ['class' => 'datepicker form-control', 'placeholder' => 'Please Select Start Date', 'id' => 'start_date', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-5">
                                                {{ Form::label('financial_end_year', 'End Date*') }}
                                                {{ Form::text('financial_end_year', null, ['class' => 'datepicker form-control', 'placeholder' => 'Please Select Start Date', 'id' => 'end_date', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-6">
                                            <div class="mb-5">
                                                {{ Form::label('has_submenu', 'Set Has Current Fiancial Year ?') }}
                                                <div class="d-flex">
                                                    <fieldset>
                                                        <div class="radio radio-success me-5">
                                                            {{ Form::label('radioyes', 'Yes') }}
                                                            {{ Form::radio('default_flag', '1', true, ['id' => 'radioyes']) }}
                                                        </div>
                                                    </fieldset>
                                                    <fieldset>
                                                        <div class="radio radio-danger">
                                                            {{ Form::label('radiono', 'No') }}
                                                            {{ Form::radio('default_flag', '0', false, ['id' => 'radiono']) }}
                                                        </div>
                                                    </fieldset>
                                                </div>
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
        </div>
    </section>



    <script>
        $(document).ready(function() {
            // $('.datepicker').datepicker();

            $(document).ready(function() {
                // $('.datepicker').datepicker();

                $(".datepicker").datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
            });
        });
    </script>
@endsection
