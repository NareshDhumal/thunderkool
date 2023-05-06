@extends('backend.layouts.app')
@section('title', 'Update Vehicle')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Edit Vehicle</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.vehicle', $cutomer_data->customer_id) }}" class="btn btn-secondary my-2" title="Back"
                data-bs-toggle="tooltip"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->

    <section class="db-section admin-form">

        <div class="content">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title">Edit Vehicle</h4>
        <div class="text-end" style="position: absolute;
        right: 50px;">
        <a href="{{ route('admin.vehicle') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
        </div> --}}
                            {{-- <p class="card-description">Edit Vehicle</p> --}}
                            @include('backend.includes.errors')
                            {!! Form::model($editdata, [
                                'method' => 'POST',
                                'url' => ['admin/vehicle/update/'],
                                'class' => 'form',
                            ]) !!}
                            @csrf
                            <div class="form-body">
                                <div class="row">

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('customer_id', 'Customer Name') }}
                                            <P>{{ $cutomer_data->customer_name }}</P>
                                            {{ Form::hidden('customer_id', $cutomer_data->customer_id, null, ['class' => 'form-control', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('customer_mobile', 'Customer Mobile No') }}
                                            <P>{{ $cutomer_data->mobile_no }}</P>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('vehicle_make_id', 'Vehicle Make *') }}
                                            {{ Form::hidden('vehicle_id', $editdata->vehicle_id) }}
                                            {{ Form::select('vehicle_make_id', $make, null, ['class' => 'form-control', 'placeholder' => 'Select Make', 'id' => 'vehicle_make', 'required' => true]) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('vehicle_make_id', 'Vehicle Model *') }}
                                            {{ Form::select('vehicle_model_id', $vehicle_model, null, ['class' => 'form-control', 'placeholder' => 'Select Model', 'id' => 'vehicle_model', 'required' => true]) }}
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-12">
                    <div class="form-label-group">
                        <select name="vehicle_model" id="vehicle_model" class="form-control">
                            <option value='' selected>Select Vehicle Model</option>
                        </select>
                    </div>
                </div> --}}



                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('vehicle_no', 'Vehicle No') }}
                                            {{ Form::text('vehicle_no', null, ['class' => 'form-control', 'placeholder' => 'Enter Vehicle No']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('chassis_no', 'Chassis No') }}
                                            {{ Form::text('chassis_no', null, ['class' => 'form-control', 'placeholder' => 'Chassis No']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('serial_no', 'Serial No') }}
                                            {{ Form::text('serial_no', null, ['class' => 'form-control', 'placeholder' => 'Serial No']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('cab_no', 'Cab No') }}
                                            {{ Form::text('cab_no', null, ['class' => 'form-control', 'placeholder' => 'Cab No']) }}
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group mb-5">
                                            {{ Form::label('loco_no', 'Loco No') }}
                                            {{ Form::text('loco_no', null, ['class' => 'form-control', 'placeholder' => 'Loco No']) }}
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
    </section>


    <script>
        $(document).ready(function() {

            $('#vehicle_make').change(function() {

                var make_id = $(this).val();
                console.log(make_id);
                var csrfName = '<?= csrf_token() ?>';

                $.ajax({
                    type: "post",
                    // contentType: "application/json",
                    dataType: "json",
                    url: "{{ url('/') }}/admin/vehicle/vehiclemodel",
                    data: {
                        _token: csrfName,
                        make_id: make_id
                    },
                    success: function(response) {

                        // var html = "<option value=''>select</option>";
                        console.log(response.length);
                        var html = '';
                        for (var i = 0; i < response.length; i++) {

                            // html+="<option value="+response[i]['vehicle_model_id']+"></option>"
                            html += '<option value="' + response[i]['vehicle_model_id'] + '">' +
                                response[i]['vehicle_model_name'] + '</optoin>'
                        }

                        $('#vehicle_model').html(html);
                    }
                })
            });





            // var make_id = $('#vehicle_make').val();
            // console.log(make_id);
            // var csrfName = '<?= csrf_token() ?>';

            // $.ajax({
            //     type: "post",
            //     // contentType: "application/json",
            //     dataType: "json",
            //     url: "{{ url('/') }}/admin/vehicle/vehiclemodeledit",
            //     data: {
            //         _token: csrfName,
            //         make_id: make_id
            //     },
            //     success: function(response) {

            //         // var html = "<option value=''>select</option>";
            //         var html = '';
            //         for (var i = 0; i < response.length; i++) {

            //             // html+="<option value="+response[i]['vehicle_model_id']+"></option>"
            //             html += '<option value="' + response[i]['vehicle_model_id'] + '">' +
            //                 response[i]['vehicle_model_name'] + '</optoin>'
            //         }

            //         $('#vehicle_model').html(html);
            //     }
            // })
        });
    </script>
@endsection
