@extends('backend.layouts.app')
@section('title', 'Update Product Details')

@section('content')

    <!--begin::Toolbar-->
    <div class="toolbar row py-5 py-lg-10" id="kt_toolbar">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="text-white fw-bolder fs-2qx me-5">Edit Products</h4>
        </div>
        {{-- @can('Create Admin Users') --}}
        <div class=" col-lg-6 col-md-6 col-sm-12 text-end">
            <a href="{{ route('admin.products') }}" class="btn btn-secondary my-2"data-bs-toggle="tooltip" title="Back"><i
                    class="fa fa-arrow-left"></i></a>
        </div>
    </div>
    <!--end::Toolbar-->

    <section class="db-section admin-form">
        <div class="content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h4 class="card-title">Edit Products</h4> --}}
                                {{-- <div class="text-end" style="position: absolute;
            right: 50px;">
            <a href="{{ route('admin.products') }}" class="btn btn-inverse-danger btn-fw"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
            </div> --}}
                                {{-- <p class="card-description">Edit Products</p> --}}
                                @include('backend.includes.errors')
                                {!! Form::model($editdata, [
                                    'method' => 'POST',
                                    'url' => ['admin/products/update'],
                                    'class' => 'form',
                                ]) !!}
                                {{-- {{ Form::open(array('url' => 'admin/products/update/'.$editdata->product_id)) }} --}}
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::hidden('product_id', $editdata->product_id) }}
                                                {{ Form::label('product_name', 'product name *', ['class' => 'label_for_product_and_service']) }}
                                                {{ Form::text('product_name', null, ['class' => 'form-control', 'id' => 'product_name', 'placeholder' => 'Enter Product Name', 'required' => true]) }}
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('company_name', 'company name *') }}
                                                {{ Form::select('company_id', $company, $editdata->company_id, ['class' => 'form-select', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('service', 'select service or product*') }}
                                                {{ Form::select('service_id', ['0' => 'Select Service Or Poduct', '1' => 'Service', '2' => 'Product'], null, ['class' => 'form-select', 'id' => 'service', 'required' => true]) }}
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('company_name', 'company name *') }}
                            {{ Form::select('company_name', ['0' => 'Thunder Kool', '1' => 'Infinity Solutions', '2' => 'Kool Air'], ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => true]) }}
                          </div>
                        </div> --}}

                                        {{-- <div class="col-md-6 col-12">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_code', 'product code *') }}
                            {{ Form::text('product_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => true]) }}
                          </div>
                        </div> --}}
                                        <div class="col-md-6 col-12 service_hide">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('product_rate', 'product rate *') }}
                                                {{ Form::number('product_rate', null, ['class' => 'form-control', 'placeholder' => 'Enter Rate', 'id' => 'rate', 'min' => 0, 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 service_hide">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('product_stock', 'product qty*') }}
                                                {{ Form::number('product_stock', null, ['class' => 'form-control product_stock', 'placeholder' => 'Enter Stock', 'id' => 'stock', 'min' => 0, 'required' => true]) }}
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 col-12 service_hide">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_party', 'product party *') }}
                            {{ Form::text('product_party', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div> --}}


                                        <div class="col-md-6 col-12 service_hide">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('hsn_code', 'Hsn Code') }}
                                                {{ Form::number('hsn_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Hsn', 'id' => 'hsn', 'min' => 0]) }}
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 col-12 service_hide">
                          <div class="form-label-group mb-5">
                            {{ Form::label('sac_code', 'sac_code *') }}
                            {{ Form::text('sac_code', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div> --}}

                                        {{-- <div class="col-md-6 col-12 service_hide">
                          <div class="form-label-group mb-5">
                            {{ Form::label('tax_percent', 'tax percent *') }}
                            {{ Form::text('tax_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div> --}}

                                        <div class="col-md-6 col-12 service_hide">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('product_part_no', 'product part no') }}
                                                {{ Form::number('product_part_no', null, ['class' => 'form-control product_part_no', 'placeholder' => 'Enter Part no', 'id' => 'part_no', 'min' => 0]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 service_hide">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('product_part_no_custom', 'product part no custom') }}
                                                {{ Form::number('product_part_no_custom', null, ['class' => 'form-control', 'placeholder' => 'Enter Custom Part No', 'id' => 'p_part_no', 'min' => 0]) }}
                                            </div>
                                        </div>



                                        <div class="col-md-6 col-12 service_hide">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('product_unit', 'product unit *') }}
                                                {{ Form::select('product_unit', $unit, null, ['class' => 'form-select', 'id' => 'product_unit', 'placeholder' => 'Select Unit', 'required' => true]) }}
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12 service_hide">
                                            <div class="form-label-group mb-5">
                                                {{ Form::label('gst_percent', 'gst percent *') }}
                                                {{ Form::select('gst_percent', $gst_percent, null, ['class' => 'form-select', 'id' => 'gst', 'placeholder' => 'Select Gst %', 'required' => true]) }}
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 col-12 service_hide">
                          <div class="form-label-group mb-5">
                            {{ Form::label('product_unit', 'product unit *') }}
                            {{ Form::text('product_unit', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div>
  
                        <div class="col-md-6 col-12 service_hide">
                          <div class="form-label-group mb-5">
                            {{ Form::label('gst_percent', 'gst percent *') }}
                            {{ Form::text('gst_percent', null, ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password']) }}
                          </div>
                        </div> --}}
                                        <div class="col-12 d-flex justify-content-start">
                                            {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1 me-5']) }}
                                            <button type="reset" class="btn btn-secondary mr-1 mb-1">Reset</button>
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
            cheakserviceorproduct();
            $('#service').change(function() {

                var value = $(this).val();
                if (value == 1) {
                    $('#rate').val('');
                    $('#stock').val('');
                    $('#hsn').val('');
                    $('#part_no').val('');
                    $('#p_part_no').val('');
                    $('#product_unit').val('');
                    $('#gst').val('');
                    $('#group').val('');


                    $('.service_hide').hide();
                } else if (value == 2) {
                    $('.service_hide').show();
                }


            })



            $('#service').change(function() {

                var value = $(this).val();
                console.log(value);
                if (value == 1) {
                    $('.label_for_product_and_service').text('Service Name *');
                    $('#product_name').attr('placeholder', 'Enter Service Name');

                    $('#rate').val('');
                    $('#stock').val('');
                    $('#hsn').val('');
                    $('#part_no').val('');
                    $('#p_part_no').val('');
                    $('#product_unit').val('');
                    $('product_unit').find('option:selected').remove();
                    $('#gst').val('');
                    $('#group').val('');



                    $('#rate').attr('required', false);
                    $('#stock').attr('required', false);
                    $('#hsn').attr('required', false);
                    $('#part_no').attr('required', false);
                    $('#p_part_no').attr('required', false);
                    $('#product_unit').attr('required', false);
                    $('#gst').attr('required', false);
                    $('#group').attr('required', false);


                    $('.service_hide').hide();
                } else if (value == 2) {
                    $('.label_for_product_and_service').text('Product Name *');
                    $('#product_name').attr('placeholder', 'Enter Product Name');



                    $('.service_hide').show();
                }


            });
        });

        function cheakserviceorproduct() {
            var data = $('#service').val();
            if (data == '1') {
                $('.service_hide').hide();

            } else {
                $('.service_hide').show();

            }
        }
    </script>
@endsection
